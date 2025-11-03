using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PMS_APIs.Data;
using PMS_APIs.Models;

namespace PMS_APIs.Controllers
{
    /// <summary>
    /// API Controller for managing registrations in the Property Management System
    /// Provides CRUD operations for registration data
    /// </summary>
    [Route("api/[controller]")]
    [ApiController]
    public class RegistrationsController : ControllerBase
    {
        private readonly PmsDbContext _context;

        public RegistrationsController(PmsDbContext context)
        {
            _context = context;
        }

        /// <summary>
        /// Get all registrations with optional filtering and pagination
        /// </summary>
        /// <param name="page">Page number (default: 1)</param>
        /// <param name="pageSize">Items per page (default: 10)</param>
        /// <param name="customerId">Filter by customer ID</param>
        /// <param name="status">Filter by registration status</param>
        /// <returns>List of registrations</returns>
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Registration>>> GetRegistrations(
            int page = 1,
            int pageSize = 10,
            string? customerId = null,
            string? status = null)
        {
            var query = _context.Registrations
                .AsQueryable();

            if (!string.IsNullOrEmpty(customerId))
            {
                // Note: Registration model doesn't have CustomerId, this filter is removed
                // query = query.Where(r => r.CustomerId == customerId);
            }

            if (!string.IsNullOrEmpty(status))
            {
                query = query.Where(r => r.Status == status);
            }

            var totalCount = await query.CountAsync();
            var registrations = await query
                .OrderByDescending(r => r.RegDate)
                .Skip((page - 1) * pageSize)
                .Take(pageSize)
                .ToListAsync();

            return Ok(new
            {
                data = registrations,
                totalCount,
                page,
                pageSize,
                totalPages = (int)Math.Ceiling((double)totalCount / pageSize)
            });
        }

        /// <summary>
        /// Get a specific registration by ID
        /// </summary>
        /// <param name="id">Registration ID</param>
        /// <returns>Registration details</returns>
        [HttpGet("{id}")]
        public async Task<ActionResult<Registration>> GetRegistration(string id)
        {
            var registration = await _context.Registrations
                .FirstOrDefaultAsync(r => r.RegId == id);

            if (registration == null)
            {
                return NotFound(new { message = "Registration not found" });
            }

            return Ok(registration);
        }

        /// <summary>
        /// Create a new registration
        /// </summary>
        /// <param name="registration">Registration data</param>
        /// <returns>Created registration</returns>
        [HttpPost]
        public async Task<ActionResult<Registration>> PostRegistration(Registration registration)
        {
            // Generate registration ID if not provided
            if (string.IsNullOrEmpty(registration.RegId))
            {
                registration.RegId = await GenerateRegistrationId();
            }

            registration.CreatedAt = DateTime.UtcNow;
            registration.Status = "Active";

            _context.Registrations.Add(registration);

            try
            {
                await _context.SaveChangesAsync();
                return CreatedAtAction(nameof(GetRegistration), new { id = registration.RegId }, registration);
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error creating registration", error = ex.Message });
            }
        }

        /// <summary>
        /// Update an existing registration
        /// </summary>
        /// <param name="id">Registration ID</param>
        /// <param name="registration">Updated registration data</param>
        /// <returns>Updated registration</returns>
        [HttpPut("{id}")]
        public async Task<IActionResult> PutRegistration(string id, Registration registration)
        {
            if (id != registration.RegId)
            {
                return BadRequest(new { message = "Registration ID mismatch" });
            }

            var existingRegistration = await _context.Registrations.FindAsync(id);
            if (existingRegistration == null)
            {
                return NotFound(new { message = "Registration not found" });
            }

            // Update properties
            existingRegistration.RegDate = registration.RegDate;
            existingRegistration.ProjectName = registration.ProjectName;
            existingRegistration.SubProject = registration.SubProject;
            existingRegistration.Size = registration.Size;
            existingRegistration.Category = registration.Category;
            existingRegistration.BookingAmount = registration.BookingAmount;
            existingRegistration.TotalPrice = registration.TotalPrice;
            existingRegistration.PaymentPlan = registration.PaymentPlan;
            existingRegistration.Status = registration.Status;
            existingRegistration.Remarks = registration.Remarks;
            existingRegistration.Priority = registration.Priority;
            existingRegistration.Source = registration.Source;
            existingRegistration.AgentName = registration.AgentName;
            existingRegistration.AgentCommission = registration.AgentCommission;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(existingRegistration);
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!RegistrationExists(id))
                {
                    return NotFound(new { message = "Registration not found" });
                }
                throw;
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error updating registration", error = ex.Message });
            }
        }

        /// <summary>
        /// Cancel a registration
        /// </summary>
        /// <param name="id">Registration ID</param>
        /// <param name="reason">Cancellation reason</param>
        /// <returns>Success message</returns>
        [HttpPost("{id}/cancel")]
        public async Task<IActionResult> CancelRegistration(string id, [FromBody] CancellationRequest request)
        {
            var registration = await _context.Registrations.FindAsync(id);

            if (registration == null)
            {
                return NotFound(new { message = "Registration not found" });
            }

            if (registration.Status == "Cancelled")
            {
                return BadRequest(new { message = "Registration is already cancelled" });
            }

            registration.Status = "Cancelled";
            registration.Remarks = request.Reason;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(new { message = "Registration cancelled successfully" });
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error cancelling registration", error = ex.Message });
            }
        }

        /// <summary>
        /// Get registration statistics
        /// </summary>
        /// <returns>Registration statistics</returns>
        [HttpGet("statistics")]
        public async Task<ActionResult> GetRegistrationStatistics()
        {
            var totalRegistrations = await _context.Registrations.CountAsync();
            var activeRegistrations = await _context.Registrations.CountAsync(r => r.Status == "Active");
            var cancelledRegistrations = await _context.Registrations.CountAsync(r => r.Status == "Cancelled");
            var completedRegistrations = await _context.Registrations.CountAsync(r => r.Status == "Completed");

            var totalBookingAmount = await _context.Registrations
                .Where(r => r.Status == "Active")
                .SumAsync(r => r.BookingAmount ?? 0);

            var monthlyRegistrations = await _context.Registrations
                .Where(r => r.RegDate.HasValue)
                .GroupBy(r => new { r.RegDate!.Value.Year, r.RegDate!.Value.Month })
                .Select(g => new
                {
                    Year = g.Key.Year,
                    Month = g.Key.Month,
                    Count = g.Count(),
                    TotalAmount = g.Sum(r => r.BookingAmount ?? 0)
                })
                .OrderByDescending(x => x.Year)
                .ThenByDescending(x => x.Month)
                .ToListAsync();

            return Ok(new
            {
                totalRegistrations,
                activeRegistrations,
                cancelledRegistrations,
                completedRegistrations,
                totalBookingAmount,
                monthlyRegistrations
            });
        }

        /// <summary>
        /// Get registrations by payment plan
        /// </summary>
        /// <returns>Registration statistics grouped by payment plan</returns>
        [HttpGet("by-payment-plan")]
        public async Task<ActionResult> GetRegistrationsByPaymentPlan()
        {
            var paymentPlanStats = await _context.Registrations
                .Where(r => !string.IsNullOrEmpty(r.PaymentPlan))
                .GroupBy(r => r.PaymentPlan)
                .Select(g => new
                {
                    PaymentPlan = g.Key,
                    Count = g.Count(),
                    TotalAmount = g.Sum(r => r.BookingAmount ?? 0)
                })
                .OrderByDescending(x => x.Count)
                .ToListAsync();

            return Ok(paymentPlanStats);
        }

        private bool RegistrationExists(string id)
        {
            return _context.Registrations.Any(e => e.RegId == id);
        }

        private async Task<string> GenerateRegistrationId()
        {
            var lastRegistration = await _context.Registrations
                .OrderByDescending(r => r.RegId)
                .FirstOrDefaultAsync();

            if (lastRegistration == null)
            {
                return "REG0000001";
            }

            var lastIdNumber = int.Parse(lastRegistration.RegId.Substring(3));
            var newIdNumber = lastIdNumber + 1;
            return $"REG{newIdNumber:D7}";
        }
    }
}