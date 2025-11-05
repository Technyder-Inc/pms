using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a possession record in the Property Management System
    /// </summary>
    [Table("possessions")]
    public class Possession
    {
        [Key]
        [Column("possession_id")]
        [StringLength(10)]
        public string PossessionId { get; set; } = string.Empty;

        [Column("customer_id")]
        [StringLength(10)]
        public string? CustomerId { get; set; }

        [Column("property_id")]
        [StringLength(10)]
        public string? PropertyId { get; set; }

        [Column("possession_date")]
        public DateOnly? PossessionDate { get; set; }

        [Column("possession_letter_no")]
        [StringLength(50)]
        public string? PossessionLetterNo { get; set; }

        [Column("status")]
        [StringLength(50)]
        public string Status { get; set; } = "Pending";

        [Column("handover_date")]
        public DateOnly? HandoverDate { get; set; }

        [Column("handover_by")]
        [StringLength(100)]
        public string? HandoverBy { get; set; }

        [Column("received_by")]
        [StringLength(100)]
        public string? ReceivedBy { get; set; }

        [Column("conditions")]
        public string? Conditions { get; set; }

        [Column("documents")]
        public string? Documents { get; set; }

        [Column("created_at")]
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        [Column("created_by")]
        [StringLength(100)]
        public string? CreatedBy { get; set; }

        [Column("remarks")]
        public string? Remarks { get; set; }

        // Navigation properties
        [ForeignKey("CustomerId")]
        public Customer? Customer { get; set; }

        [ForeignKey("PropertyId")]
        public Property? Property { get; set; }
    }
}