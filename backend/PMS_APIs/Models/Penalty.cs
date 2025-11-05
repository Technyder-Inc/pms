using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using Microsoft.EntityFrameworkCore;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a penalty record in the Property Management System
    /// </summary>
    [Table("penalties")]
    public class Penalty
    {
        [Key]
        [Column("penalty_id")]
        [StringLength(10)]
        public string PenaltyId { get; set; } = string.Empty;

        [Column("customer_id")]
        [StringLength(10)]
        public string? CustomerId { get; set; }

        [Column("penalty_type")]
        [StringLength(100)]
        public string? PenaltyType { get; set; }

        [Column("amount")]
        [Precision(15, 2)]
        public decimal? Amount { get; set; }

        [Column("penalty_date")]
        public DateOnly? PenaltyDate { get; set; }

        [Column("due_date")]
        public DateOnly? DueDate { get; set; }

        [Column("status")]
        [StringLength(50)]
        public string Status { get; set; } = "Pending";

        [Column("reason")]
        public string? Reason { get; set; }

        [Column("created_at")]
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        [Column("created_by")]
        [StringLength(100)]
        public string? CreatedBy { get; set; }

        [Column("paid_date")]
        public DateOnly? PaidDate { get; set; }

        [Column("waived_date")]
        public DateOnly? WaivedDate { get; set; }

        [Column("waived_by")]
        [StringLength(100)]
        public string? WaivedBy { get; set; }

        // Navigation properties
        [ForeignKey("CustomerId")]
        public Customer? Customer { get; set; }
    }
}