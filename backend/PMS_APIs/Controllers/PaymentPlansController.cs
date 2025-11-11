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
        /// Get all payment plans with optional filtering and pagination.
        /// Inputs: page (default 1), pageSize (default 10), projectId optional, frequency optional.
        /// Outputs: paginated list with totalCount, page, pageSize, totalPages.
        /// </summary>
        [HttpGet]
        public async Task<ActionResult<IEnumerable<PaymentPlan>>> GetPaymentPlans(
            int page = 1,
            int pageSize = 10,
            string? projectId = null,
            string? frequency = null)
        {
            var query = _context.PaymentPlans
                .AsQueryable();

            if (!string.IsNullOrEmpty(projectId))
            {
                query = query.Where(pp => pp.ProjectId == projectId);
            }

            if (!string.IsNullOrEmpty(frequency))
            {
                query = query.Where(pp => pp.Frequency == frequency);
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
        /// Create a new payment plan.
        /// Inputs: PaymentPlan payload aligned to payment_plan schema.
        /// Outputs: 201 with created entity or 400 on error.
        /// </summary>
        [HttpPost]
        public async Task<ActionResult<PaymentPlan>> PostPaymentPlan(PaymentPlan paymentPlan)
        {
            // Generate payment plan ID if not provided
            if (string.IsNullOrEmpty(paymentPlan.PlanId))
            {
                paymentPlan.PlanId = await GeneratePaymentPlanId();
            }

            paymentPlan.CreatedAt = DateTime.UtcNow;

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
        /// Update an existing payment plan.
        /// Inputs: id path param, PaymentPlan payload fields present in schema.
        /// Outputs: 200 with updated entity or error codes.
        /// </summary>
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

            // Update properties aligned with the current schema
            existingPaymentPlan.ProjectId = paymentPlan.ProjectId;
            existingPaymentPlan.PlanName = paymentPlan.PlanName;
            existingPaymentPlan.TotalAmount = paymentPlan.TotalAmount;
            existingPaymentPlan.DurationMonths = paymentPlan.DurationMonths;
            existingPaymentPlan.Frequency = paymentPlan.Frequency;
            existingPaymentPlan.Description = paymentPlan.Description;

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
        /// Update payment plan status.
        /// Purpose: Not supported because schema has no status column.
        /// Inputs: id, status request body.
        /// Outputs: 400 explaining unsupported operation.
        /// </summary>
        [HttpPost("{id}/status")]
        public IActionResult UpdatePaymentPlanStatus(string id, [FromBody] StatusUpdateRequest request)
        {
            return BadRequest(new { message = "Status field is not supported in current payment_plan schema." });
        }

        /// <summary>
        /// Get payment plan statistics.
        /// Outputs: totalPlans, averageTotalAmount, averageDurationMonths.
        /// </summary>
        [HttpGet("statistics")]
        public async Task<ActionResult> GetPaymentPlanStatistics()
        {
            var totalPlans = await _context.PaymentPlans.CountAsync();
            var averageTotalAmount = await _context.PaymentPlans
                .Where(pp => pp.TotalAmount.HasValue)
                .AverageAsync(pp => pp.TotalAmount!.Value);

            var averageDurationMonths = await _context.PaymentPlans
                .Where(pp => pp.DurationMonths.HasValue)
                .AverageAsync(pp => pp.DurationMonths!.Value);

            return Ok(new
            {
                totalPlans,
                averageTotalAmount,
                averageDurationMonths
            });
        }

        /// <summary>
        /// Get overdue payment plans.
        /// Definition: plans created more than 30 days ago (simple heuristic).
        /// </summary>
        [HttpGet("overdue")]
        public async Task<ActionResult> GetOverduePaymentPlans()
        {
            var currentDate = DateTime.UtcNow.Date;
            
            // Since PaymentPlan doesn't have status, EndDate or RemainingAmount,
            // return plans created more than 30 days ago.
            var overduePlans = await _context.PaymentPlans
                .Where(pp => pp.CreatedAt < currentDate.AddDays(-30))
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