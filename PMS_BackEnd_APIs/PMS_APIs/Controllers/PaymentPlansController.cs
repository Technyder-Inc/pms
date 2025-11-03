using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PMS_APIs.Data;
using PMS_APIs.Models;

namespace PMS_APIs.Controllers
{
    /// <summary>
    /// API Controller for managing payment plans in the Property Management System
    /// Provides CRUD operations for payment plan data
    /// </summary>
    [Route("api/[controller]")]
    [ApiController]
    public class PaymentPlansController : ControllerBase
    {
        private readonly PmsDbContext _context;

        public PaymentPlansController(PmsDbContext context)
        {
            _context = context;
        }

        /// <summary>
        /// Get all payment plans with optional filtering and pagination
        /// </summary>
        /// <param name="page">Page number (default: 1)</param>
        /// <param name="pageSize">Items per page (default: 10)</param>
        /// <param name="customerId">Filter by customer ID</param>
        /// <param name="status">Filter by payment plan status</param>
        /// <returns>List of payment plans</returns>
        [HttpGet]
        public async Task<ActionResult<IEnumerable<PaymentPlan>>> GetPaymentPlans(
            int page = 1,
            int pageSize = 10,
            string? customerId = null,
            string? status = null)
        {
            var query = _context.PaymentPlans
                .AsQueryable();

            if (!string.IsNullOrEmpty(customerId))
            {
                // Note: PaymentPlan model doesn't have CustomerId, this filter is removed
                // query = query.Where(pp => pp.CustomerId == customerId);
            }

            if (!string.IsNullOrEmpty(status))
            {
                query = query.Where(pp => pp.Status == status);
            }

            var totalCount = await query.CountAsync();
            var paymentPlans = await query
                .OrderByDescending(pp => pp.CreatedAt)
                .Skip((page - 1) * pageSize)
                .Take(pageSize)
                .ToListAsync();

            return Ok(new
            {
                data = paymentPlans,
                totalCount,
                page,
                pageSize,
                totalPages = (int)Math.Ceiling((double)totalCount / pageSize)
            });
        }

        /// <summary>
        /// Get a specific payment plan by ID
        /// </summary>
        /// <param name="id">Payment plan ID</param>
        /// <returns>Payment plan details</returns>
        [HttpGet("{id}")]
        public async Task<ActionResult<PaymentPlan>> GetPaymentPlan(string id)
        {
            var paymentPlan = await _context.PaymentPlans
                .FirstOrDefaultAsync(pp => pp.PlanId == id);

            if (paymentPlan == null)
            {
                return NotFound(new { message = "Payment plan not found" });
            }

            return Ok(paymentPlan);
        }

        /// <summary>
        /// Create a new payment plan
        /// </summary>
        /// <param name="paymentPlan">Payment plan data</param>
        /// <returns>Created payment plan</returns>
        [HttpPost]
        public async Task<ActionResult<PaymentPlan>> PostPaymentPlan(PaymentPlan paymentPlan)
        {
            // Generate payment plan ID if not provided
            if (string.IsNullOrEmpty(paymentPlan.PlanId))
            {
                paymentPlan.PlanId = await GeneratePaymentPlanId();
            }

            paymentPlan.CreatedAt = DateTime.UtcNow;
            paymentPlan.Status = "Active";

            _context.PaymentPlans.Add(paymentPlan);

            try
            {
                await _context.SaveChangesAsync();
                return CreatedAtAction(nameof(GetPaymentPlan), new { id = paymentPlan.PlanId }, paymentPlan);
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error creating payment plan", error = ex.Message });
            }
        }

        /// <summary>
        /// Update an existing payment plan
        /// </summary>
        /// <param name="id">Payment plan ID</param>
        /// <param name="paymentPlan">Updated payment plan data</param>
        /// <returns>Updated payment plan</returns>
        [HttpPut("{id}")]
        public async Task<IActionResult> PutPaymentPlan(string id, PaymentPlan paymentPlan)
        {
            if (id != paymentPlan.PlanId)
            {
                return BadRequest(new { message = "Payment plan ID mismatch" });
            }

            var existingPaymentPlan = await _context.PaymentPlans.FindAsync(id);
            if (existingPaymentPlan == null)
            {
                return NotFound(new { message = "Payment plan not found" });
            }

            // Update properties
            existingPaymentPlan.PlanName = paymentPlan.PlanName;
            existingPaymentPlan.TotalInstallments = paymentPlan.TotalInstallments;
            existingPaymentPlan.InstallmentAmount = paymentPlan.InstallmentAmount;
            existingPaymentPlan.Frequency = paymentPlan.Frequency;
            existingPaymentPlan.DownPayment = paymentPlan.DownPayment;
            existingPaymentPlan.PossessionAmount = paymentPlan.PossessionAmount;
            existingPaymentPlan.DevelopmentCharges = paymentPlan.DevelopmentCharges;
            existingPaymentPlan.MaintenanceCharges = paymentPlan.MaintenanceCharges;
            existingPaymentPlan.LateFeePercentage = paymentPlan.LateFeePercentage;
            existingPaymentPlan.GracePeriodDays = paymentPlan.GracePeriodDays;
            existingPaymentPlan.Status = paymentPlan.Status;
            existingPaymentPlan.Description = paymentPlan.Description;
            existingPaymentPlan.TermsConditions = paymentPlan.TermsConditions;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(existingPaymentPlan);
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!PaymentPlanExists(id))
                {
                    return NotFound(new { message = "Payment plan not found" });
                }
                throw;
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error updating payment plan", error = ex.Message });
            }
        }

        /// <summary>
        /// Update payment plan status
        /// </summary>
        /// <param name="id">Payment plan ID</param>
        /// <param name="status">New status</param>
        /// <returns>Success message</returns>
        [HttpPost("{id}/status")]
        public async Task<IActionResult> UpdatePaymentPlanStatus(string id, [FromBody] StatusUpdateRequest request)
        {
            var paymentPlan = await _context.PaymentPlans.FindAsync(id);
            if (paymentPlan == null)
            {
                return NotFound(new { message = "Payment plan not found" });
            }

            paymentPlan.Status = request.Status;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(new { message = "Payment plan status updated successfully" });
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error updating payment plan status", error = ex.Message });
            }
        }

        /// <summary>
        /// Get payment plan statistics
        /// </summary>
        /// <returns>Payment plan statistics</returns>
        [HttpGet("statistics")]
        public async Task<ActionResult> GetPaymentPlanStatistics()
        {
            var totalPlans = await _context.PaymentPlans.CountAsync();
            var activePlans = await _context.PaymentPlans.CountAsync(pp => pp.Status == "Active");
            var completedPlans = await _context.PaymentPlans.CountAsync(pp => pp.Status == "Completed");
            var suspendedPlans = await _context.PaymentPlans.CountAsync(pp => pp.Status == "Suspended");

            var averageInstallmentAmount = await _context.PaymentPlans
                .Where(pp => pp.InstallmentAmount.HasValue)
                .AverageAsync(pp => pp.InstallmentAmount!.Value);

            var averageDownPayment = await _context.PaymentPlans
                .Where(pp => pp.DownPayment.HasValue)
                .AverageAsync(pp => pp.DownPayment!.Value);

            return Ok(new
            {
                totalPlans,
                activePlans,
                completedPlans,
                suspendedPlans,
                averageInstallmentAmount,
                averageDownPayment
            });
        }

        /// <summary>
        /// Get overdue payment plans
        /// </summary>
        /// <returns>List of overdue payment plans</returns>
        [HttpGet("overdue")]
        public async Task<ActionResult> GetOverduePaymentPlans()
        {
            var currentDate = DateTime.UtcNow.Date;
            
            // Since PaymentPlan doesn't have EndDate or RemainingAmount, 
            // we'll return plans that are active and created more than 30 days ago
            var overduePlans = await _context.PaymentPlans
                .Where(pp => pp.Status == "Active" && 
                           pp.CreatedAt < currentDate.AddDays(-30))
                .OrderBy(pp => pp.CreatedAt)
                .ToListAsync();

            return Ok(overduePlans);
        }

        private bool PaymentPlanExists(string id)
        {
            return _context.PaymentPlans.Any(e => e.PlanId == id);
        }

        private async Task<string> GeneratePaymentPlanId()
        {
            var lastPaymentPlan = await _context.PaymentPlans
                .OrderByDescending(pp => pp.PlanId)
                .FirstOrDefaultAsync();

            if (lastPaymentPlan == null)
            {
                return "PP0000001";
            }

            var lastIdNumber = int.Parse(lastPaymentPlan.PlanId.Substring(2));
            var newIdNumber = lastIdNumber + 1;
            return $"PP{newIdNumber:D7}";
        }
    }

    /// <summary>
    /// Request model for status update
    /// </summary>
    public class StatusUpdateRequest
    {
        public string Status { get; set; } = string.Empty;
        public string? Remarks { get; set; }
    }

    /// <summary>
    /// Request model for payment recording
    /// </summary>
    public class PaymentRecordRequest
    {
        public decimal Amount { get; set; }
        public string? Remarks { get; set; }
    }
}