using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PMS_APIs.Data;
using PMS_APIs.Models;

namespace PMS_APIs.Controllers
{
    /// <summary>
    /// API Controller for managing transfers in the Property Management System
    /// Provides CRUD operations for transfer data
    /// </summary>
    [Route("api/[controller]")]
    [ApiController]
    public class TransfersController : ControllerBase
    {
        private readonly PmsDbContext _context;

        public TransfersController(PmsDbContext context)
        {
            _context = context;
        }

        /// <summary>
        /// Get all transfers with optional filtering and pagination
        /// </summary>
        /// <param name="page">Page number (default: 1)</param>
        /// <param name="pageSize">Items per page (default: 10)</param>
        /// <param name="fromCustomerId">Filter by from customer ID</param>
        /// <param name="toCustomerId">Filter by to customer ID</param>
        /// <param name="status">Filter by transfer status</param>
        /// <returns>List of transfers</returns>
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Transfer>>> GetTransfers(
            int page = 1,
            int pageSize = 10,
            string? fromCustomerId = null,
            string? toCustomerId = null,
            string? status = null)
        {
            var query = _context.Transfers
                .Include(t => t.FromCustomer)
                .Include(t => t.ToCustomer)
                .AsQueryable();

            if (!string.IsNullOrEmpty(fromCustomerId))
            {
                query = query.Where(t => t.FromCustomerId == fromCustomerId);
            }

            if (!string.IsNullOrEmpty(toCustomerId))
            {
                query = query.Where(t => t.ToCustomerId == toCustomerId);
            }

            if (!string.IsNullOrEmpty(status))
            {
                query = query.Where(t => t.Status == status);
            }

            var totalCount = await query.CountAsync();
            var transfers = await query
                .OrderByDescending(t => t.TransferDate)
                .Skip((page - 1) * pageSize)
                .Take(pageSize)
                .ToListAsync();

            return Ok(new
            {
                data = transfers,
                totalCount,
                page,
                pageSize,
                totalPages = (int)Math.Ceiling((double)totalCount / pageSize)
            });
        }

        /// <summary>
        /// Get a specific transfer by ID
        /// </summary>
        /// <param name="id">Transfer ID</param>
        /// <returns>Transfer details</returns>
        [HttpGet("{id}")]
        public async Task<ActionResult<Transfer>> GetTransfer(string id)
        {
            var transfer = await _context.Transfers
                .Include(t => t.FromCustomer)
                .Include(t => t.ToCustomer)
                .FirstOrDefaultAsync(t => t.TransferId == id);

            if (transfer == null)
            {
                return NotFound(new { message = "Transfer not found" });
            }

            return Ok(transfer);
        }

        /// <summary>
        /// Create a new transfer
        /// </summary>
        /// <param name="transfer">Transfer data</param>
        /// <returns>Created transfer</returns>
        [HttpPost]
        public async Task<ActionResult<Transfer>> PostTransfer(Transfer transfer)
        {
            // Validate from customer exists
            var fromCustomerExists = await _context.Customers.AnyAsync(c => c.CustomerId == transfer.FromCustomerId);
            if (!fromCustomerExists)
            {
                return BadRequest(new { message = "From customer not found" });
            }

            // Validate to customer exists
            var toCustomerExists = await _context.Customers.AnyAsync(c => c.CustomerId == transfer.ToCustomerId);
            if (!toCustomerExists)
            {
                return BadRequest(new { message = "To customer not found" });
            }

            // Validate customers are different
            if (transfer.FromCustomerId == transfer.ToCustomerId)
            {
                return BadRequest(new { message = "From and To customers cannot be the same" });
            }

            // Generate transfer ID if not provided
            if (string.IsNullOrEmpty(transfer.TransferId))
            {
                transfer.TransferId = await GenerateTransferId();
            }

            transfer.CreatedAt = DateTime.UtcNow;
            transfer.Status = "Pending";

            _context.Transfers.Add(transfer);

            try
            {
                await _context.SaveChangesAsync();
                return CreatedAtAction(nameof(GetTransfer), new { id = transfer.TransferId }, transfer);
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error creating transfer", error = ex.Message });
            }
        }

        /// <summary>
        /// Update an existing transfer
        /// </summary>
        /// <param name="id">Transfer ID</param>
        /// <param name="transfer">Updated transfer data</param>
        /// <returns>Updated transfer</returns>
        [HttpPut("{id}")]
        public async Task<IActionResult> PutTransfer(string id, Transfer transfer)
        {
            if (id != transfer.TransferId)
            {
                return BadRequest(new { message = "Transfer ID mismatch" });
            }

            var existingTransfer = await _context.Transfers.FindAsync(id);
            if (existingTransfer == null)
            {
                return NotFound(new { message = "Transfer not found" });
            }

            // Update properties
            existingTransfer.TransferDate = transfer.TransferDate;
            existingTransfer.TransferFee = transfer.TransferFee;
            existingTransfer.Reason = transfer.Reason;
            existingTransfer.Status = transfer.Status;
            existingTransfer.ApprovalDate = transfer.ApprovalDate;
            existingTransfer.ApprovedBy = transfer.ApprovedBy;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(existingTransfer);
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!TransferExists(id))
                {
                    return NotFound(new { message = "Transfer not found" });
                }
                throw;
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error updating transfer", error = ex.Message });
            }
        }

        /// <summary>
        /// Approve a transfer
        /// </summary>
        /// <param name="id">Transfer ID</param>
        /// <param name="approvedBy">Approver name</param>
        /// <returns>Success message</returns>
        [HttpPost("{id}/approve")]
        public async Task<IActionResult> ApproveTransfer(string id, [FromBody] ApprovalRequest request)
        {
            var transfer = await _context.Transfers.FindAsync(id);

            if (transfer == null)
            {
                return NotFound(new { message = "Transfer not found" });
            }

            if (transfer.Status != "Pending")
            {
                return BadRequest(new { message = "Only pending transfers can be approved" });
            }

            transfer.Status = "Approved";
            transfer.ApprovalDate = DateOnly.FromDateTime(DateTime.UtcNow);
            transfer.ApprovedBy = request.ApprovedBy;
            transfer.Reason = request.Remarks;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(new { message = "Transfer approved successfully" });
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error approving transfer", error = ex.Message });
            }
        }

        /// <summary>
        /// Reject a transfer
        /// </summary>
        /// <param name="id">Transfer ID</param>
        /// <param name="reason">Rejection reason</param>
        /// <returns>Success message</returns>
        [HttpPost("{id}/reject")]
        public async Task<IActionResult> RejectTransfer(string id, [FromBody] RejectionRequest request)
        {
            var transfer = await _context.Transfers.FindAsync(id);

            if (transfer == null)
            {
                return NotFound(new { message = "Transfer not found" });
            }

            if (transfer.Status != "Pending")
            {
                return BadRequest(new { message = "Only pending transfers can be rejected" });
            }

            transfer.Status = "Rejected";
            transfer.Reason = request.Reason;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(new { message = "Transfer rejected successfully" });
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error rejecting transfer", error = ex.Message });
            }
        }

        /// <summary>
        /// Get transfer statistics
        /// </summary>
        /// <returns>Transfer statistics</returns>
        [HttpGet("statistics")]
        public async Task<ActionResult> GetTransferStatistics()
        {
            var totalTransfers = await _context.Transfers.CountAsync();
            var pendingTransfers = await _context.Transfers.CountAsync(t => t.Status == "Pending");
            var approvedTransfers = await _context.Transfers.CountAsync(t => t.Status == "Approved");
            var rejectedTransfers = await _context.Transfers.CountAsync(t => t.Status == "Rejected");

            var totalTransferFees = await _context.Transfers
                .Where(t => t.Status == "Approved")
                .SumAsync(t => t.TransferFee ?? 0);

            var monthlyTransfers = await _context.Transfers
                .Where(t => t.TransferDate.HasValue)
                .GroupBy(t => new { t.TransferDate!.Value.Year, t.TransferDate!.Value.Month })
                .Select(g => new
                {
                    Year = g.Key.Year,
                    Month = g.Key.Month,
                    Count = g.Count(),
                    TotalFees = g.Sum(t => t.TransferFee ?? 0)
                })
                .OrderByDescending(x => x.Year)
                .ThenByDescending(x => x.Month)
                .Take(12)
                .ToListAsync();

            return Ok(new
            {
                totalTransfers,
                pendingTransfers,
                approvedTransfers,
                rejectedTransfers,
                totalTransferFees,
                monthlyTransfers
            });
        }

        private bool TransferExists(string id)
        {
            return _context.Transfers.Any(e => e.TransferId == id);
        }

        private async Task<string> GenerateTransferId()
        {
            var lastTransfer = await _context.Transfers
                .OrderByDescending(t => t.TransferId)
                .FirstOrDefaultAsync();

            if (lastTransfer == null)
            {
                return "TRF0000001";
            }

            var lastIdNumber = int.Parse(lastTransfer.TransferId.Substring(3));
            var newIdNumber = lastIdNumber + 1;
            return $"TRF{newIdNumber:D7}";
        }
    }

    /// <summary>
    /// Request model for transfer approval
    /// </summary>
    public class ApprovalRequest
    {
        public string ApprovedBy { get; set; } = string.Empty;
        public string? Remarks { get; set; }
    }

    /// <summary>
    /// Request model for transfer rejection
    /// </summary>
    public class RejectionRequest
    {
        public string Reason { get; set; } = string.Empty;
    }
}