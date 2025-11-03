using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PMS_APIs.Data;
using PMS_APIs.Models;

namespace PMS_APIs.Controllers
{
    /// <summary>
    /// API Controller for managing allotments in the Property Management System
    /// Provides CRUD operations for allotment data
    /// </summary>
    [Route("api/[controller]")]
    [ApiController]
    public class AllotmentsController : ControllerBase
    {
        private readonly PmsDbContext _context;

        public AllotmentsController(PmsDbContext context)
        {
            _context = context;
        }

        /// <summary>
        /// Get all allotments with optional filtering and pagination
        /// </summary>
        /// <param name="page">Page number (default: 1)</param>
        /// <param name="pageSize">Items per page (default: 10)</param>
        /// <param name="customerId">Filter by customer ID</param>
        /// <param name="status">Filter by allotment status</param>
        /// <returns>List of allotments</returns>
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Allotment>>> GetAllotments(
            int page = 1,
            int pageSize = 10,
            string? customerId = null,
            string? status = null)
        {
            var query = _context.Allotments
                .Include(a => a.Customer)
                .Include(a => a.Property)
                .AsQueryable();

            if (!string.IsNullOrEmpty(customerId))
            {
                query = query.Where(a => a.CustomerId == customerId);
            }

            if (!string.IsNullOrEmpty(status))
            {
                query = query.Where(a => a.Status == status);
            }

            var totalCount = await query.CountAsync();
            var allotments = await query
                .OrderByDescending(a => a.AllotmentDate)
                .Skip((page - 1) * pageSize)
                .Take(pageSize)
                .ToListAsync();

            return Ok(new
            {
                data = allotments,
                totalCount,
                page,
                pageSize,
                totalPages = (int)Math.Ceiling((double)totalCount / pageSize)
            });
        }

        /// <summary>
        /// Get a specific allotment by ID
        /// </summary>
        /// <param name="id">Allotment ID</param>
        /// <returns>Allotment details</returns>
        [HttpGet("{id}")]
        public async Task<ActionResult<Allotment>> GetAllotment(string id)
        {
            var allotment = await _context.Allotments
                .Include(a => a.Customer)
                .Include(a => a.Property)
                .FirstOrDefaultAsync(a => a.AllotmentId == id);

            if (allotment == null)
            {
                return NotFound(new { message = "Allotment not found" });
            }

            return Ok(allotment);
        }

        /// <summary>
        /// Create a new allotment
        /// </summary>
        /// <param name="allotment">Allotment data</param>
        /// <returns>Created allotment</returns>
        [HttpPost]
        public async Task<ActionResult<Allotment>> PostAllotment(Allotment allotment)
        {
            // Validate customer exists
            var customerExists = await _context.Customers.AnyAsync(c => c.CustomerId == allotment.CustomerId);
            if (!customerExists)
            {
                return BadRequest(new { message = "Customer not found" });
            }

            // Validate property exists and is available
            var property = await _context.Properties.FindAsync(allotment.PropertyId);
            if (property == null)
            {
                return BadRequest(new { message = "Property not found" });
            }

            if (property.Status != "Available")
            {
                return BadRequest(new { message = "Property is not available for allotment" });
            }

            // Generate allotment ID if not provided
            if (string.IsNullOrEmpty(allotment.AllotmentId))
            {
                allotment.AllotmentId = await GenerateAllotmentId();
            }

            allotment.CreatedAt = DateTime.UtcNow;
            allotment.Status = "Active";

            // Update property status to Allotted
            property.Status = "Allotted";
            property.UpdatedAt = DateTime.UtcNow;

            _context.Allotments.Add(allotment);

            try
            {
                await _context.SaveChangesAsync();
                return CreatedAtAction(nameof(GetAllotment), new { id = allotment.AllotmentId }, allotment);
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error creating allotment", error = ex.Message });
            }
        }

        /// <summary>
        /// Update an existing allotment
        /// </summary>
        /// <param name="id">Allotment ID</param>
        /// <param name="allotment">Updated allotment data</param>
        /// <returns>Updated allotment</returns>
        [HttpPut("{id}")]
        public async Task<IActionResult> PutAllotment(string id, Allotment allotment)
        {
            if (id != allotment.AllotmentId)
            {
                return BadRequest(new { message = "Allotment ID mismatch" });
            }

            var existingAllotment = await _context.Allotments.FindAsync(id);
            if (existingAllotment == null)
            {
                return NotFound(new { message = "Allotment not found" });
            }

            // Update properties
            existingAllotment.AllotmentDate = allotment.AllotmentDate;
            existingAllotment.AllotmentLetterNo = allotment.AllotmentLetterNo;
            existingAllotment.Status = allotment.Status;
            existingAllotment.Remarks = allotment.Remarks;
            existingAllotment.PossessionDate = allotment.PossessionDate;
            existingAllotment.CompletionDate = allotment.CompletionDate;
            existingAllotment.BallotingDate = allotment.BallotingDate;
            existingAllotment.BallotNo = allotment.BallotNo;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(existingAllotment);
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!AllotmentExists(id))
                {
                    return NotFound(new { message = "Allotment not found" });
                }
                throw;
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error updating allotment", error = ex.Message });
            }
        }

        /// <summary>
        /// Cancel an allotment
        /// </summary>
        /// <param name="id">Allotment ID</param>
        /// <param name="reason">Cancellation reason</param>
        /// <returns>Success message</returns>
        [HttpPost("{id}/cancel")]
        public async Task<IActionResult> CancelAllotment(string id, [FromBody] CancellationRequest request)
        {
            var allotment = await _context.Allotments
                .Include(a => a.Property)
                .FirstOrDefaultAsync(a => a.AllotmentId == id);

            if (allotment == null)
            {
                return NotFound(new { message = "Allotment not found" });
            }

            if (allotment.Status == "Cancelled")
            {
                return BadRequest(new { message = "Allotment is already cancelled" });
            }

            // Update allotment status
            allotment.Status = "Cancelled";
            allotment.Remarks = request.Reason;

            // Make property available again
            if (allotment.Property != null)
            {
                allotment.Property.Status = "Available";
                allotment.Property.UpdatedAt = DateTime.UtcNow;
            }

            try
            {
                await _context.SaveChangesAsync();
                return Ok(new { message = "Allotment cancelled successfully" });
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error cancelling allotment", error = ex.Message });
            }
        }

        /// <summary>
        /// Get allotment statistics
        /// </summary>
        /// <returns>Allotment statistics</returns>
        [HttpGet("statistics")]
        public async Task<ActionResult> GetAllotmentStatistics()
        {
            var totalAllotments = await _context.Allotments.CountAsync();
            var activeAllotments = await _context.Allotments.CountAsync(a => a.Status == "Active");
            var cancelledAllotments = await _context.Allotments.CountAsync(a => a.Status == "Cancelled");
            var completedAllotments = await _context.Allotments.CountAsync(a => a.Status == "Completed");

            var monthlyAllotments = await _context.Allotments
                .Where(a => a.AllotmentDate.HasValue)
                .GroupBy(a => new { a.AllotmentDate!.Value.Year, a.AllotmentDate!.Value.Month })
                .Select(g => new
                {
                    Year = g.Key.Year,
                    Month = g.Key.Month,
                    Count = g.Count()
                })
                .OrderByDescending(x => x.Year)
                .ThenByDescending(x => x.Month)
                .Take(12)
                .ToListAsync();

            return Ok(new
            {
                totalAllotments,
                activeAllotments,
                cancelledAllotments,
                completedAllotments,
                monthlyAllotments
            });
        }

        private bool AllotmentExists(string id)
        {
            return _context.Allotments.Any(e => e.AllotmentId == id);
        }

        private async Task<string> GenerateAllotmentId()
        {
            var lastAllotment = await _context.Allotments
                .OrderByDescending(a => a.AllotmentId)
                .FirstOrDefaultAsync();

            if (lastAllotment == null)
            {
                return "ALL0000001";
            }

            var lastIdNumber = int.Parse(lastAllotment.AllotmentId.Substring(3));
            var newIdNumber = lastIdNumber + 1;
            return $"ALL{newIdNumber:D7}";
        }
    }

    /// <summary>
    /// Request model for allotment cancellation
    /// </summary>
    public class CancellationRequest
    {
        public string Reason { get; set; } = string.Empty;
    }
}