using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using Microsoft.EntityFrameworkCore;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a waiver record in the Property Management System
    /// </summary>
    [Table("waivers")]
    public class Waiver
    {
        [Key]
        [Column("waiver_id")]
        [StringLength(10)]
        public string WaiverId { get; set; } = string.Empty;

        [Column("customer_id")]
        [StringLength(10)]
        public string? CustomerId { get; set; }

        [Column("waiver_type")]
        [StringLength(100)]
        public string? WaiverType { get; set; }

        [Column("amount")]
        [Precision(15, 2)]
        public decimal? Amount { get; set; }

        [Column("waiver_date")]
        public DateOnly? WaiverDate { get; set; }

        [Column("reason")]
        public string? Reason { get; set; }

        [Column("approved_by")]
        [StringLength(100)]
        public string? ApprovedBy { get; set; }

        [Column("approval_date")]
        public DateOnly? ApprovalDate { get; set; }

        [Column("status")]
        [StringLength(50)]
        public string Status { get; set; } = "Pending";

        [Column("created_at")]
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        [Column("created_by")]
        [StringLength(100)]
        public string? CreatedBy { get; set; }

        [Column("reference_no")]
        [StringLength(100)]
        public string? ReferenceNo { get; set; }

        // Navigation properties
        [ForeignKey("CustomerId")]
        public Customer? Customer { get; set; }
    }
}