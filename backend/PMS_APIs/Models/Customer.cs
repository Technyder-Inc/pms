using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a customer in the Property Management System
    /// </summary>
    [Table("customers")]
    public class Customer
    {
        [Key]
        [Column("customer_id")]
        [StringLength(10)]
        public string CustomerId { get; set; } = string.Empty;

        [Column("reg_id")]
        [StringLength(10)]
        public string? RegId { get; set; }

        [Column("plan_id")]
        [StringLength(10)]
        public string? PlanId { get; set; }

        [Column("full_name")]
        [StringLength(150)]
        public string? FullName { get; set; }

        [Column("father_name")]
        [StringLength(150)]
        public string? FatherName { get; set; }

        [Column("cnic")]
        [StringLength(50)]
        public string? Cnic { get; set; }

        [Column("passport_no")]
        [StringLength(50)]
        public string? PassportNo { get; set; }

        [Column("dob")]
        public DateOnly? Dob { get; set; }

        [Column("gender")]
        [StringLength(20)]
        public string? Gender { get; set; }

        [Column("phone")]
        [StringLength(50)]
        public string? Phone { get; set; }

        [Column("email")]
        [StringLength(150)]
        public string? Email { get; set; }

        [Column("mailing_address")]
        [StringLength(255)]
        public string? MailingAddress { get; set; }

        [Column("permanent_address")]
        [StringLength(255)]
        public string? PermanentAddress { get; set; }

        [Column("city")]
        [StringLength(100)]
        public string? City { get; set; }

        [Column("country")]
        [StringLength(100)]
        public string? Country { get; set; }

        [Column("sub_project")]
        [StringLength(100)]
        public string? SubProject { get; set; }

        [Column("registered_size")]
        [StringLength(50)]
        public string? RegisteredSize { get; set; }

        [Column("created_at")]
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        [Column("status")]
        [StringLength(50)]
        public string Status { get; set; } = "Active";

        [Column("nominee_name")]
        [StringLength(100)]
        public string? NomineeName { get; set; }

        [Column("nominee_id")]
        [StringLength(50)]
        public string? NomineeId { get; set; }

        [Column("nominee_relation")]
        [StringLength(50)]
        public string? NomineeRelation { get; set; }

        [Column("additional_info")]
        public string? AdditionalInfo { get; set; }

        // Navigation properties
        public Registration? Registration { get; set; }
        public PaymentPlan? PaymentPlan { get; set; }
        public ICollection<Allotment> Allotments { get; set; } = new List<Allotment>();
        public ICollection<Payment> Payments { get; set; } = new List<Payment>();
        public ICollection<CustomerLog> CustomerLogs { get; set; } = new List<CustomerLog>();
        public ICollection<Penalty> Penalties { get; set; } = new List<Penalty>();
        public ICollection<Waiver> Waivers { get; set; } = new List<Waiver>();
        public ICollection<Refund> Refunds { get; set; } = new List<Refund>();
        public ICollection<Transfer> TransfersFrom { get; set; } = new List<Transfer>();
        public ICollection<Transfer> TransfersTo { get; set; } = new List<Transfer>();
        public ICollection<Ndc> Ndcs { get; set; } = new List<Ndc>();
        public ICollection<Possession> Possessions { get; set; } = new List<Possession>();
    }
}