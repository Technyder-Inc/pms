using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using Microsoft.EntityFrameworkCore;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a refund record in the Property Management System
    /// </summary>
    [Table("refunds")]
    public class Refund
    {
        [Key]
        [Column("refund_id")]
        [StringLength(10)]
        public string RefundId { get; set; } = string.Empty;

        [Column("customer_id")]
        [StringLength(10)]
        public string? CustomerId { get; set; }

        [Column("refund_amount")]
        [Precision(15, 2)]
        public decimal? RefundAmount { get; set; }

        [Column("refund_date")]
        public DateOnly? RefundDate { get; set; }

        [Column("reason")]
        public string? Reason { get; set; }

        [Column("status")]
        [StringLength(50)]
        public string Status { get; set; } = "Pending";

        [Column("approved_by")]
        [StringLength(100)]
        public string? ApprovedBy { get; set; }

        [Column("approval_date")]
        public DateOnly? ApprovalDate { get; set; }

        [Column("processed_by")]
        [StringLength(100)]
        public string? ProcessedBy { get; set; }

        [Column("processed_date")]
        public DateOnly? ProcessedDate { get; set; }

        [Column("payment_method")]
        [StringLength(50)]
        public string? PaymentMethod { get; set; }

        [Column("reference_no")]
        [StringLength(100)]
        public string? ReferenceNo { get; set; }

        [Column("bank_details")]
        public string? BankDetails { get; set; }

        [Column("created_at")]
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        [Column("created_by")]
        [StringLength(100)]
        public string? CreatedBy { get; set; }

        // Navigation properties
        [ForeignKey("CustomerId")]
        public Customer? Customer { get; set; }
    }
}