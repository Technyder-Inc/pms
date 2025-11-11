using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using Microsoft.EntityFrameworkCore;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a payment plan in the Property Management System.
    /// Inputs: None (entity class).
    /// Outputs: ORM-mapped properties to PostgreSQL table 'paymentplan' with Neon column names.
    /// </summary>
    [Table("paymentplan")]
    public class PaymentPlan
    {
        [Key]
        [Column("planid")]
        [StringLength(10)]
        public string PlanId { get; set; } = string.Empty;

        [Column("projectid")]
        [StringLength(10)]
        public string? ProjectId { get; set; }

        [Column("planname")]
        [StringLength(150)]
        public string? PlanName { get; set; }

        [Column("totalamount")]
        [Precision(18, 2)]
        public decimal? TotalAmount { get; set; }

        [Column("durationmonths")]
        public int? DurationMonths { get; set; }

        [Column("frequency")]
        [StringLength(50)]
        public string? Frequency { get; set; }

        [Column("description")]
        public string? Description { get; set; }

        [Column("createdat")]
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        // Navigation properties
        public ICollection<Customer> Customers { get; set; } = new List<Customer>();
    }
}