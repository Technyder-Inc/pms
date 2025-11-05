using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents an NDC (No Dues Certificate) record in the Property Management System
    /// </summary>
    [Table("ndcs")]
    public class Ndc
    {
        [Key]
        [Column("ndc_id")]
        [StringLength(10)]
        public string NdcId { get; set; } = string.Empty;

        [Column("customer_id")]
        [StringLength(10)]
        public string? CustomerId { get; set; }

        [Column("ndc_no")]
        [StringLength(50)]
        public string? NdcNo { get; set; }

        [Column("issue_date")]
        public DateOnly? IssueDate { get; set; }

        [Column("status")]
        [StringLength(50)]
        public string Status { get; set; } = "Active";

        [Column("issued_by")]
        [StringLength(100)]
        public string? IssuedBy { get; set; }

        [Column("remarks")]
        public string? Remarks { get; set; }

        [Column("created_at")]
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        [Column("expiry_date")]
        public DateOnly? ExpiryDate { get; set; }

        [Column("conditions")]
        public string? Conditions { get; set; }

        [Column("verified_by")]
        [StringLength(100)]
        public string? VerifiedBy { get; set; }

        [Column("verification_date")]
        public DateOnly? VerificationDate { get; set; }

        // Navigation properties
        [ForeignKey("CustomerId")]
        public Customer? Customer { get; set; }
    }
}