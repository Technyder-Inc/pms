using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PMS_APIs.Data;
using PMS_APIs.Models;

namespace PMS_APIs.Controllers
{
    /// <summary>
    /// API Controller for managing penalties in the Property Management System
    /// Provides CRUD operations for penalty data
    /// </summary>
    [Route("api/[controller]")]
    [ApiController]
    public class PenaltiesController : ControllerBase
    {
        private readonly PmsDbContext _context;

        public PenaltiesController(PmsDbContext context)
        {
            _context = context;
        }

        /// <summary>
        /// Get all penalties with optional filtering and pagination
        /// </summary>
        /// <param name="page">Page number (default: 1)</param>
        /// <param name="pageSize">Items per page (default: 10)</param>
        /// <param name="customerId">Filter by customer ID</param>
        /// <param name="status">Filter by penalty status</param>
        /// <returns>List of penalties</returns>
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Penalty>>> GetPenalties(
            int page = 1,
            int pageSize = 10,
            string? customerId = null,
            string? status = null)
        {
            var query = _context.Penalties
                .Include(p => p.Customer)
                .AsQueryable();

            if (!string.IsNullOrEmpty(customerId))
            {
                query = query.Where(p => p.CustomerId == customerId);
            }

            if (!string.IsNullOrEmpty(status))
            {
                query = query.Where(p => p.Status == status);
            }

            var totalCount = await query.CountAsync();
            var penalties = await query
                .OrderByDescending(p => p.PenaltyDate)
                .Skip((page - 1) * pageSize)
                .Take(pageSize)
                .ToListAsync();

            return Ok(new
            {
                data = penalties,
                totalCount,
                page,
                pageSize,
                totalPages = (int)Math.Ceiling((double)totalCount / pageSize)
            });
        }

        /// <summary>
        /// Get a specific penalty by ID
        /// </summary>
        /// <param name="id">Penalty ID</param>
        /// <returns>Penalty details</returns>
        [HttpGet("{id}")]
        public async Task<ActionResult<Penalty>> GetPenalty(string id)
        {
            var penalty = await _context.Penalties
                .Include(p => p.Customer)
                .FirstOrDefaultAsync(p => p.PenaltyId == id);

            if (penalty == null)
            {
                return NotFound(new { message = "Penalty not found" });
            }

            return Ok(penalty);
        }

        /// <summary>
        /// Create a new penalty
        /// </summary>
        /// <param name="penalty">Penalty data</param>
        /// <returns>Created penalty</returns>
        [HttpPost]
        public async Task<ActionResult<Penalty>> PostPenalty(Penalty penalty)
        {
            // Validate customer exists
            var customerExists = await _context.Customers.AnyAsync(c => c.CustomerId == penalty.CustomerId);
            if (!customerExists)
            {
                return BadRequest(new { message = "Customer not found" });
            }

            // Generate penalty ID if not provided
            if (string.IsNullOrEmpty(penalty.PenaltyId))
            {
                penalty.PenaltyId = await GeneratePenaltyId();
            }

            penalty.CreatedAt = DateTime.UtcNow;
            penalty.Status = "Active";

            _context.Penalties.Add(penalty);

            try
            {
                await _context.SaveChangesAsync();
                return CreatedAtAction(nameof(GetPenalty), new { id = penalty.PenaltyId }, penalty);
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error creating penalty", error = ex.Message });
            }
        }

        /// <summary>
        /// Update an existing penalty
        /// </summary>
        /// <param name="id">Penalty ID</param>
        /// <param name="penalty">Updated penalty data</param>
        /// <returns>Updated penalty</returns>
        [HttpPut("{id}")]
        public async Task<IActionResult> PutPenalty(string id, Penalty penalty)
        {
            if (id != penalty.PenaltyId)
            {
                return BadRequest(new { message = "Penalty ID mismatch" });
            }

            var existingPenalty = await _context.Penalties.FindAsync(id);
            if (existingPenalty == null)
            {
                return NotFound(new { message = "Penalty not found" });
            }

            // Update properties
            existingPenalty.Amount = penalty.Amount;
            existingPenalty.PenaltyDate = penalty.PenaltyDate;
            existingPenalty.Reason = penalty.Reason;
            existingPenalty.Status = penalty.Status;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(existingPenalty);
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!PenaltyExists(id))
                {
                    return NotFound(new { message = "Penalty not found" });
                }
                throw;
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error updating penalty", error = ex.Message });
            }
        }

        /// <summary>
        /// Waive a penalty
        /// </summary>
        /// <param name="id">Penalty ID</param>
        /// <param name="reason">Waiver reason</param>
        /// <returns>Success message</returns>
        [HttpPost("{id}/waive")]
        public async Task<IActionResult> WaivePenalty(string id, [FromBody] WaiverRequest request)
        {
            var penalty = await _context.Penalties.FindAsync(id);

            if (penalty == null)
            {
                return NotFound(new { message = "Penalty not found" });
            }

            if (penalty.Status == "Waived")
            {
                return BadRequest(new { message = "Penalty is already waived" });
            }

            penalty.Status = "Waived";
            penalty.Reason = request.Reason;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(new { message = "Penalty waived successfully" });
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error waiving penalty", error = ex.Message });
            }
        }

        /// <summary>
        /// Get penalty statistics
        /// </summary>
        /// <returns>Penalty statistics</returns>
        [HttpGet("statistics")]
        public async Task<ActionResult> GetPenaltyStatistics()
        {
            var totalPenalties = await _context.Penalties.CountAsync();
            var activePenalties = await _context.Penalties.CountAsync(p => p.Status == "Active");
            var waivedPenalties = await _context.Penalties.CountAsync(p => p.Status == "Waived");
            var paidPenalties = await _context.Penalties.CountAsync(p => p.Status == "Paid");

            var totalPenaltyAmount = await _context.Penalties
                .Where(p => p.Status == "Active" || p.Status == "Paid")
                .SumAsync(p => p.Amount ?? 0);

            var monthlyPenalties = await _context.Penalties
                .Where(p => p.PenaltyDate.HasValue)
                .GroupBy(p => new { p.PenaltyDate!.Value.Year, p.PenaltyDate!.Value.Month })
                .Select(g => new
                {
                    Year = g.Key.Year,
                    Month = g.Key.Month,
                    Count = g.Count(),
                    TotalAmount = g.Sum(p => p.Amount ?? 0)
                })
                .OrderByDescending(x => x.Year)
                .ThenByDescending(x => x.Month)
                .Take(12)
                .ToListAsync();

            return Ok(new
            {
                totalPenalties,
                activePenalties,
                waivedPenalties,
                paidPenalties,
                totalPenaltyAmount,
                monthlyPenalties
            });
        }

        private bool PenaltyExists(string id)
        {
            return _context.Penalties.Any(e => e.PenaltyId == id);
        }

        private async Task<string> GeneratePenaltyId()
        {
            var lastPenalty = await _context.Penalties
                .OrderByDescending(p => p.PenaltyId)
                .FirstOrDefaultAsync();

            if (lastPenalty == null)
            {
                return "PEN0000001";
            }

            var lastIdNumber = int.Parse(lastPenalty.PenaltyId.Substring(3));
            var newIdNumber = lastIdNumber + 1;
            return $"PEN{newIdNumber:D7}";
        }
    }

    /// <summary>
    /// Request model for penalty waiver
    /// </summary>
    public class WaiverRequest
    {
        public string Reason { get; set; } = string.Empty;
    }
}