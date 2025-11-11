using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PMS_APIs.Data;
using PMS_APIs.Models;

namespace PMS_APIs.Controllers
{
    /// <summary>
    /// API Controller for managing payment schedules (child records).
    /// Provides CRUD endpoints for schedule rows.
    /// </summary>
    [Route("api/[controller]")]
    [ApiController]
    public class PaymentSchedulesController : ControllerBase
    {
        private readonly PmsDbContext _context;

        public PaymentSchedulesController(PmsDbContext context)
        {
            _context = context;
        }

        /// <summary>
        /// Get payment schedules with optional filtering and pagination.
        /// Inputs: page (default 1), pageSize (default 10), planId optional.
        /// Outputs: paginated list with data, totalCount, page, pageSize, totalPages.
        /// </summary>
        [HttpGet]
        public async Task<ActionResult> GetPaymentSchedules(
            int page = 1,
            int pageSize = 10,
            string? planId = null)
        {
            var query = _context.PaymentSchedules.AsQueryable();

            if (!string.IsNullOrWhiteSpace(planId))
            {
                query = query.Where(s => s.PlanId == planId);
            }

            var totalCount = await query.CountAsync();
            var rows = await query
                .OrderBy(s => s.DueDate)
                .ThenBy(s => s.InstallmentNo)
                .Skip((page - 1) * pageSize)
                .Take(pageSize)
                .ToListAsync();

            return Ok(new
            {
                data = rows,
                totalCount,
                page,
                pageSize,
                totalPages = (int)Math.Ceiling((double)totalCount / pageSize)
            });
        }

        /// <summary>
        /// Get a specific payment schedule row by ID.
        /// Inputs: id path param.
        /// Outputs: schedule row or 404 if not found.
        /// </summary>
        [HttpGet("{id}")]
        public async Task<ActionResult<PaymentSchedule>> GetPaymentSchedule(string id)
        {
            var row = await _context.PaymentSchedules
                .FirstOrDefaultAsync(s => s.ScheduleId == id);

            if (row == null)
            {
                return NotFound(new { message = "Payment schedule not found" });
            }

            return Ok(row);
        }

        /// <summary>
        /// Create a new payment schedule child row under a plan.
        /// Inputs: PaymentSchedule payload; if ScheduleId is missing, it will be generated.
        /// Outputs: 201 with created entity or 400 on validation error.
        /// </summary>
        [HttpPost]
        public async Task<ActionResult<PaymentSchedule>> PostPaymentSchedule(PaymentSchedule schedule)
        {
            // Validate parent plan exists
            if (string.IsNullOrWhiteSpace(schedule.PlanId) ||
                !await _context.PaymentPlans.AnyAsync(p => p.PlanId == schedule.PlanId))
            {
                return BadRequest(new { message = "Valid PlanId is required" });
            }

            // Generate ScheduleId if missing
            if (string.IsNullOrWhiteSpace(schedule.ScheduleId))
            {
                schedule.ScheduleId = await GenerateScheduleId();
            }

            // Defaults aligned to schema
            schedule.SurchargeApplied ??= true;
            schedule.SurchargeRate ??= 0.05m;

            _context.PaymentSchedules.Add(schedule);
            try
            {
                await _context.SaveChangesAsync();
                return CreatedAtAction(nameof(GetPaymentSchedule), new { id = schedule.ScheduleId }, schedule);
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error creating payment schedule", error = ex.Message });
            }
        }

        /// <summary>
        /// Update an existing payment schedule row.
        /// Inputs: id path param must match payload.ScheduleId; payload fields updated.
        /// Outputs: 200 with updated entity or error codes.
        /// </summary>
        [HttpPut("{id}")]
        public async Task<IActionResult> PutPaymentSchedule(string id, PaymentSchedule schedule)
        {
            if (id != schedule.ScheduleId)
            {
                return BadRequest(new { message = "Schedule ID mismatch" });
            }

            var existing = await _context.PaymentSchedules
                .FirstOrDefaultAsync(s => s.ScheduleId == id);
            if (existing == null)
            {
                return NotFound(new { message = "Payment schedule not found" });
            }

            // Update allowed fields
            existing.PlanId = schedule.PlanId;
            existing.PaymentDescription = schedule.PaymentDescription;
            existing.InstallmentNo = schedule.InstallmentNo;
            existing.DueDate = schedule.DueDate;
            existing.Amount = schedule.Amount;
            existing.SurchargeApplied = schedule.SurchargeApplied;
            existing.SurchargeRate = schedule.SurchargeRate;
            existing.Description = schedule.Description;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(existing);
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error updating payment schedule", error = ex.Message });
            }
        }

        /// <summary>
        /// Delete a payment schedule row by ID.
        /// Inputs: id path param.
        /// Outputs: 204 on success or 404 if not found.
        /// </summary>
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeletePaymentSchedule(string id)
        {
            var existing = await _context.PaymentSchedules
                .FirstOrDefaultAsync(s => s.ScheduleId == id);
            if (existing == null)
            {
                return NotFound(new { message = "Payment schedule not found" });
            }

            _context.PaymentSchedules.Remove(existing);
            await _context.SaveChangesAsync();
            return NoContent();
        }

        private async Task<string> GenerateScheduleId()
        {
            var last = await _context.PaymentSchedules
                .OrderByDescending(s => s.ScheduleId)
                .FirstOrDefaultAsync();

            if (last == null || string.IsNullOrWhiteSpace(last.ScheduleId) || last.ScheduleId.Length < 3)
            {
                return "PS0000001";
            }

            // Assume prefix of 2 letters, then a numeric part
            var prefix = last.ScheduleId.Substring(0, 2);
            var numeric = new string(last.ScheduleId.SkipWhile(c => !char.IsDigit(c)).ToArray());
            if (!int.TryParse(numeric, out var lastNum)) lastNum = 0;
            var next = lastNum + 1;
            return $"{prefix}{next:D7}";
        }
    }
}