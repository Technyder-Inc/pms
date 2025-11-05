using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using Microsoft.EntityFrameworkCore;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a registration record in the Property Management System
    /// </summary>
    [Table("registration")]
    public class Registration
    {
        [Key]
        [Column("reg_id")]
        [StringLength(10)]
        public string RegId { get; set; } = string.Empty;

        [Column("reg_date")]
        public DateOnly? RegDate { get; set; }

        [Column("project_name")]
        [StringLength(100)]
        public string? ProjectName { get; set; }

        [Column("sub_project")]
        [StringLength(100)]
        public string? SubProject { get; set; }

        [Column("size")]
        [StringLength(50)]
        public string? Size { get; set; }

        [Column("category")]
        [StringLength(50)]
        public string? Category { get; set; }

        [Column("booking_amount")]
        [Precision(15, 2)]
        public decimal? BookingAmount { get; set; }

        [Column("total_price")]
        [Precision(15, 2)]
        public decimal? TotalPrice { get; set; }

        [Column("payment_plan")]
        [StringLength(50)]
        public string? PaymentPlan { get; set; }

        [Column("status")]
        [StringLength(50)]
        public string Status { get; set; } = "Active";

        [Column("created_at")]
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        [Column("created_by")]
        [StringLength(100)]
        public string? CreatedBy { get; set; }

        [Column("remarks")]
        public string? Remarks { get; set; }

        [Column("priority")]
        public int? Priority { get; set; }

        [Column("source")]
        [StringLength(100)]
        public string? Source { get; set; }

        [Column("agent_name")]
        [StringLength(100)]
        public string? AgentName { get; set; }

        [Column("agent_commission")]
        [Precision(10, 2)]
        public decimal? AgentCommission { get; set; }

        // Navigation properties
        public ICollection<Customer> Customers { get; set; } = new List<Customer>();
    }
}