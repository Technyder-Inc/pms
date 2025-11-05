using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using Microsoft.EntityFrameworkCore;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a payment transaction in the Property Management System
    /// </summary>
    [Table("payments")]
    public class Payment
    {
        [Key]
        [Column("payment_id")]
        [StringLength(10)]
        public string PaymentId { get; set; } = string.Empty;

        [Column("customer_id")]
        [StringLength(10)]
        public string? CustomerId { get; set; }

        [Column("installment_no")]
        public int? InstallmentNo { get; set; }

        [Column("amount")]
        [Precision(15, 2)]
        public decimal? Amount { get; set; }

        [Column("payment_date")]
        public DateOnly? PaymentDate { get; set; }

        [Column("payment_method")]
        [StringLength(50)]
        public string? PaymentMethod { get; set; }

        [Column("reference_no")]
        [StringLength(100)]
        public string? ReferenceNo { get; set; }

        [Column("bank_name")]
        [StringLength(100)]
        public string? BankName { get; set; }

        [Column("branch")]
        [StringLength(100)]
        public string? Branch { get; set; }

        [Column("cheque_no")]
        [StringLength(50)]
        public string? ChequeNo { get; set; }

        [Column("cheque_date")]
        public DateOnly? ChequeDate { get; set; }

        [Column("status")]
        [StringLength(50)]
        public string Status { get; set; } = "Pending";

        [Column("created_at")]
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        [Column("verified_by")]
        [StringLength(100)]
        public string? VerifiedBy { get; set; }

        [Column("verification_date")]
        public DateTime? VerificationDate { get; set; }

        [Column("remarks")]
        public string? Remarks { get; set; }

        [Column("receipt_no")]
        [StringLength(50)]
        public string? ReceiptNo { get; set; }

        [Column("late_fee")]
        [Precision(10, 2)]
        public decimal? LateFee { get; set; }

        [Column("discount")]
        [Precision(10, 2)]
        public decimal? Discount { get; set; }

        [Column("net_amount")]
        [Precision(15, 2)]
        public decimal? NetAmount { get; set; }

        // Navigation properties
        [ForeignKey("CustomerId")]
        public Customer? Customer { get; set; }
    }
}