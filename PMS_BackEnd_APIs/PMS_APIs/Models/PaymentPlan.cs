using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using Microsoft.EntityFrameworkCore;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a payment plan in the Property Management System
    /// </summary>
    [Table("payment_plans")]
    public class PaymentPlan
    {
        [Key]
        [Column("plan_id")]
        [StringLength(10)]
        public string PlanId { get; set; } = string.Empty;

        [Column("plan_name")]
        [StringLength(100)]
        public string? PlanName { get; set; }

        [Column("total_installments")]
        public int? TotalInstallments { get; set; }

        [Column("installment_amount")]
        [Precision(15, 2)]
        public decimal? InstallmentAmount { get; set; }

        [Column("frequency")]
        [StringLength(50)]
        public string? Frequency { get; set; }

        [Column("down_payment")]
        [Precision(15, 2)]
        public decimal? DownPayment { get; set; }

        [Column("possession_amount")]
        [Precision(15, 2)]
        public decimal? PossessionAmount { get; set; }

        [Column("development_charges")]
        [Precision(15, 2)]
        public decimal? DevelopmentCharges { get; set; }

        [Column("maintenance_charges")]
        [Precision(15, 2)]
        public decimal? MaintenanceCharges { get; set; }

        [Column("late_fee_percentage")]
        [Precision(5, 2)]
        public decimal? LateFeePercentage { get; set; }

        [Column("grace_period_days")]
        public int? GracePeriodDays { get; set; }

        [Column("status")]
        [StringLength(50)]
        public string Status { get; set; } = "Active";

        [Column("created_at")]
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        [Column("description")]
        public string? Description { get; set; }

        [Column("terms_conditions")]
        public string? TermsConditions { get; set; }

        // Navigation properties
        public ICollection<Customer> Customers { get; set; } = new List<Customer>();
    }
}