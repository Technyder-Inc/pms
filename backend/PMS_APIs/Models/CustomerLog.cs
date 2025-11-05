using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a customer log entry for tracking changes
    /// </summary>
    [Table("customer_logs")]
    public class CustomerLog
    {
        [Key]
        [Column("log_id")]
        [StringLength(10)]
        public string LogId { get; set; } = string.Empty;

        [Column("customer_id")]
        [StringLength(10)]
        public string? CustomerId { get; set; }

        [Column("action")]
        [StringLength(100)]
        public string? Action { get; set; }

        [Column("old_values")]
        public string? OldValues { get; set; }

        [Column("new_values")]
        public string? NewValues { get; set; }

        [Column("changed_by")]
        [StringLength(100)]
        public string? ChangedBy { get; set; }

        [Column("changed_at")]
        public DateTime ChangedAt { get; set; } = DateTime.UtcNow;

        [Column("remarks")]
        public string? Remarks { get; set; }

        // Navigation properties
        [ForeignKey("CustomerId")]
        public Customer? Customer { get; set; }
    }
}