using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using Microsoft.EntityFrameworkCore;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a property transfer record in the Property Management System
    /// </summary>
    [Table("transfers")]
    public class Transfer
    {
        [Key]
        [Column("transfer_id")]
        [StringLength(10)]
        public string TransferId { get; set; } = string.Empty;

        [Column("from_customer_id")]
        [StringLength(10)]
        public string? FromCustomerId { get; set; }

        [Column("to_customer_id")]
        [StringLength(10)]
        public string? ToCustomerId { get; set; }

        [Column("property_id")]
        [StringLength(10)]
        public string? PropertyId { get; set; }

        [Column("transfer_date")]
        public DateOnly? TransferDate { get; set; }

        [Column("transfer_fee")]
        [Precision(15, 2)]
        public decimal? TransferFee { get; set; }

        [Column("status")]
        [StringLength(50)]
        public string Status { get; set; } = "Pending";

        [Column("approved_by")]
        [StringLength(100)]
        public string? ApprovedBy { get; set; }

        [Column("approval_date")]
        public DateOnly? ApprovalDate { get; set; }

        [Column("reason")]
        public string? Reason { get; set; }

        [Column("documents")]
        public string? Documents { get; set; }

        [Column("created_at")]
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        [Column("created_by")]
        [StringLength(100)]
        public string? CreatedBy { get; set; }

        [Column("completion_date")]
        public DateOnly? CompletionDate { get; set; }

        // Navigation properties
        [ForeignKey("FromCustomerId")]
        public Customer? FromCustomer { get; set; }

        [ForeignKey("ToCustomerId")]
        public Customer? ToCustomer { get; set; }

        [ForeignKey("PropertyId")]
        public Property? Property { get; set; }
    }
}