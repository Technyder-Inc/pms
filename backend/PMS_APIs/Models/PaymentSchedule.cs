using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using Microsoft.EntityFrameworkCore;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a payment schedule entry for a payment plan.
    /// Inputs: None (entity class).
    /// Outputs: ORM-mapped properties to Neon PostgreSQL table 'paymentschedule'.
    /// </summary>
    [Table("paymentschedule")]
    public class PaymentSchedule
    {
        /// <summary>
        /// Primary key for the schedule row.
        /// Inputs: None.
        /// Outputs: Mapped to column `scheduleid` on table `paymentschedule`.
        /// </summary>
        [Key]
        [Column("scheduleid")]
        [StringLength(12)]
        public string ScheduleId { get; set; } = string.Empty;

        /// <summary>
        /// Foreign key to the parent payment plan.
        /// Inputs: None.
        /// Outputs: Mapped to column `planid` (nullable).
        /// </summary>
        [Column("planid")]
        [StringLength(10)]
        public string? PlanId { get; set; }

        /// <summary>
        /// Human-friendly description for the scheduled payment.
        /// Inputs: None.
        /// Outputs: Mapped to column `paymentdescription`.
        /// </summary>
        [Column("paymentdescription")]
        public string? PaymentDescription { get; set; }

        /// <summary>
        /// Installment number within the plan sequence.
        /// Inputs: None.
        /// Outputs: Mapped to column `installmentno`.
        /// </summary>
        [Column("installmentno")]
        public int? InstallmentNo { get; set; }

        /// <summary>
        /// Scheduled due date for the payment.
        /// Inputs: None.
        /// Outputs: Mapped to column `duedate`.
        /// </summary>
        [Column("duedate")]
        public DateTime? DueDate { get; set; }

        /// <summary>
        /// Scheduled amount for the payment.
        /// Inputs: None.
        /// Outputs: Mapped to column `amount` with precision (18,2).
        /// </summary>
        [Column("amount")]
        [Precision(18, 2)]
        public decimal? Amount { get; set; }

        /// <summary>
        /// Whether surcharge is applied to this schedule row.
        /// Inputs: None.
        /// Outputs: Mapped to column `surchargeapplied`.
        /// </summary>
        [Column("surchargeapplied")]
        public bool? SurchargeApplied { get; set; }

        /// <summary>
        /// Surcharge percentage rate.
        /// Inputs: None.
        /// Outputs: Mapped to column `surchargerate` with precision (5,2).
        /// </summary>
        [Column("surchargerate")]
        [Precision(5, 2)]
        public decimal? SurchargeRate { get; set; }

        /// <summary>
        /// Additional notes or description.
        /// Inputs: None.
        /// Outputs: Mapped to column `description`.
        /// </summary>
        [Column("description")]
        public string? Description { get; set; }

        // Navigation
        public PaymentPlan? PaymentPlan { get; set; }
    }
}