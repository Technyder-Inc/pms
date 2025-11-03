using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PMS_APIs.Data;
using PMS_APIs.Models;

namespace PMS_APIs.Controllers
{
    /// <summary>
    /// API Controller for managing payments in the Property Management System
    /// Provides CRUD operations for payment data
    /// </summary>
    [Route("api/[controller]")]
    [ApiController]
    public class PaymentsController : ControllerBase
    {
        private readonly PmsDbContext _context;

        public PaymentsController(PmsDbContext context)
        {
            _context = context;
        }

        /// <summary>
        /// Get all payments with optional filtering and pagination
        /// </summary>
        /// <param name="page">Page number (default: 1)</param>
        /// <param name="pageSize">Items per page (default: 10)</param>
        /// <param name="customerId">Filter by customer ID</param>
        /// <param name="status">Filter by payment status</param>
        /// <param name="fromDate">Filter from date</param>
        /// <param name="toDate">Filter to date</param>
        /// <returns>List of payments</returns>
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Payment>>> GetPayments(
            int page = 1,
            int pageSize = 10,
            string? customerId = null,
            string? status = null,
            DateOnly? fromDate = null,
            DateOnly? toDate = null)
        {
            var query = _context.Payments
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

            if (fromDate.HasValue)
            {
                query = query.Where(p => p.PaymentDate >= fromDate.Value);
            }

            if (toDate.HasValue)
            {
                query = query.Where(p => p.PaymentDate <= toDate.Value);
            }

            var totalCount = await query.CountAsync();
            var payments = await query
                .OrderByDescending(p => p.PaymentDate)
                .Skip((page - 1) * pageSize)
                .Take(pageSize)
                .ToListAsync();

            return Ok(new
            {
                data = payments,
                totalCount,
                page,
                pageSize,
                totalPages = (int)Math.Ceiling((double)totalCount / pageSize)
            });
        }

        /// <summary>
        /// Get a specific payment by ID
        /// </summary>
        /// <param name="id">Payment ID</param>
        /// <returns>Payment details</returns>
        [HttpGet("{id}")]
        public async Task<ActionResult<Payment>> GetPayment(string id)
        {
            var payment = await _context.Payments
                .Include(p => p.Customer)
                .FirstOrDefaultAsync(p => p.PaymentId == id);

            if (payment == null)
            {
                return NotFound(new { message = "Payment not found" });
            }

            return Ok(payment);
        }

        /// <summary>
        /// Create a new payment
        /// </summary>
        /// <param name="payment">Payment data</param>
        /// <returns>Created payment</returns>
        [HttpPost]
        public async Task<ActionResult<Payment>> PostPayment(Payment payment)
        {
            // Generate payment ID if not provided
            if (string.IsNullOrEmpty(payment.PaymentId))
            {
                payment.PaymentId = await GeneratePaymentId();
            }

            payment.CreatedAt = DateTime.UtcNow;
            payment.Status = "Pending";

            // Calculate net amount
            payment.NetAmount = (payment.Amount ?? 0) + (payment.LateFee ?? 0) - (payment.Discount ?? 0);

            _context.Payments.Add(payment);

            try
            {
                await _context.SaveChangesAsync();
                return CreatedAtAction(nameof(GetPayment), new { id = payment.PaymentId }, payment);
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error creating payment", error = ex.Message });
            }
        }

        /// <summary>
        /// Update an existing payment
        /// </summary>
        /// <param name="id">Payment ID</param>
        /// <param name="payment">Updated payment data</param>
        /// <returns>Updated payment</returns>
        [HttpPut("{id}")]
        public async Task<IActionResult> PutPayment(string id, Payment payment)
        {
            if (id != payment.PaymentId)
            {
                return BadRequest(new { message = "Payment ID mismatch" });
            }

            var existingPayment = await _context.Payments.FindAsync(id);
            if (existingPayment == null)
            {
                return NotFound(new { message = "Payment not found" });
            }

            // Update properties
            existingPayment.CustomerId = payment.CustomerId;
            existingPayment.InstallmentNo = payment.InstallmentNo;
            existingPayment.Amount = payment.Amount;
            existingPayment.PaymentDate = payment.PaymentDate;
            existingPayment.PaymentMethod = payment.PaymentMethod;
            existingPayment.ReferenceNo = payment.ReferenceNo;
            existingPayment.BankName = payment.BankName;
            existingPayment.Branch = payment.Branch;
            existingPayment.ChequeNo = payment.ChequeNo;
            existingPayment.ChequeDate = payment.ChequeDate;
            existingPayment.Status = payment.Status;
            existingPayment.VerifiedBy = payment.VerifiedBy;
            existingPayment.VerificationDate = payment.VerificationDate;
            existingPayment.Remarks = payment.Remarks;
            existingPayment.ReceiptNo = payment.ReceiptNo;
            existingPayment.LateFee = payment.LateFee;
            existingPayment.Discount = payment.Discount;
            
            // Recalculate net amount
            existingPayment.NetAmount = (payment.Amount ?? 0) + (payment.LateFee ?? 0) - (payment.Discount ?? 0);

            try
            {
                await _context.SaveChangesAsync();
                return Ok(existingPayment);
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!PaymentExists(id))
                {
                    return NotFound(new { message = "Payment not found" });
                }
                throw;
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error updating payment", error = ex.Message });
            }
        }

        /// <summary>
        /// Delete a payment
        /// </summary>
        /// <param name="id">Payment ID</param>
        /// <returns>Success message</returns>
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeletePayment(string id)
        {
            var payment = await _context.Payments.FindAsync(id);
            if (payment == null)
            {
                return NotFound(new { message = "Payment not found" });
            }

            // Only allow deletion of pending payments
            if (payment.Status != "Pending")
            {
                return BadRequest(new { message = "Cannot delete verified or processed payments" });
            }

            _context.Payments.Remove(payment);

            try
            {
                await _context.SaveChangesAsync();
                return Ok(new { message = "Payment deleted successfully" });
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error deleting payment", error = ex.Message });
            }
        }

        /// <summary>
        /// Verify a payment
        /// </summary>
        /// <param name="id">Payment ID</param>
        /// <param name="verificationData">Verification details</param>
        /// <returns>Verified payment</returns>
        [HttpPost("{id}/verify")]
        public async Task<IActionResult> VerifyPayment(string id, [FromBody] VerificationRequest verificationData)
        {
            var payment = await _context.Payments.FindAsync(id);
            if (payment == null)
            {
                return NotFound(new { message = "Payment not found" });
            }

            if (payment.Status != "Pending")
            {
                return BadRequest(new { message = "Payment is already verified or processed" });
            }

            payment.Status = "Verified";
            payment.VerifiedBy = verificationData.VerifiedBy;
            payment.VerificationDate = DateTime.UtcNow;
            payment.Remarks = verificationData.Remarks;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(payment);
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error verifying payment", error = ex.Message });
            }
        }

        /// <summary>
        /// Get payment statistics
        /// </summary>
        /// <returns>Payment statistics</returns>
        [HttpGet("statistics")]
        public async Task<ActionResult> GetPaymentStatistics()
        {
            var totalPayments = await _context.Payments.CountAsync();
            var totalAmount = await _context.Payments.SumAsync(p => p.NetAmount ?? 0);
            var pendingPayments = await _context.Payments.CountAsync(p => p.Status == "Pending");
            var verifiedPayments = await _context.Payments.CountAsync(p => p.Status == "Verified");

            var monthlyStats = await _context.Payments
                .Where(p => p.PaymentDate.HasValue)
                .GroupBy(p => new { p.PaymentDate!.Value.Year, p.PaymentDate!.Value.Month })
                .Select(g => new
                {
                    Year = g.Key.Year,
                    Month = g.Key.Month,
                    Count = g.Count(),
                    TotalAmount = g.Sum(p => p.NetAmount ?? 0)
                })
                .OrderByDescending(x => x.Year)
                .ThenByDescending(x => x.Month)
                .Take(12)
                .ToListAsync();

            return Ok(new
            {
                totalPayments,
                totalAmount,
                pendingPayments,
                verifiedPayments,
                monthlyStats
            });
        }

        private bool PaymentExists(string id)
        {
            return _context.Payments.Any(e => e.PaymentId == id);
        }

        private async Task<string> GeneratePaymentId()
        {
            var lastPayment = await _context.Payments
                .OrderByDescending(p => p.PaymentId)
                .FirstOrDefaultAsync();

            if (lastPayment == null)
            {
                return "PAY0000001";
            }

            var lastIdNumber = int.Parse(lastPayment.PaymentId.Substring(3));
            var newIdNumber = lastIdNumber + 1;
            return $"PAY{newIdNumber:D7}";
        }
    }

    /// <summary>
    /// Request model for payment verification
    /// </summary>
    public class VerificationRequest
    {
        public string VerifiedBy { get; set; } = string.Empty;
        public string? Remarks { get; set; }
    }
}