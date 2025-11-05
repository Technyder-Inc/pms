using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using Microsoft.EntityFrameworkCore;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a property in the Property Management System
    /// </summary>
    [Table("properties")]
    public class Property
    {
        [Key]
        [Column("property_id")]
        [StringLength(10)]
        public string PropertyId { get; set; } = string.Empty;

        [Column("project_name")]
        [StringLength(100)]
        public string? ProjectName { get; set; }

        [Column("sub_project")]
        [StringLength(100)]
        public string? SubProject { get; set; }

        [Column("block")]
        [StringLength(50)]
        public string? Block { get; set; }

        [Column("plot_no")]
        [StringLength(50)]
        public string? PlotNo { get; set; }

        [Column("size")]
        [StringLength(50)]
        public string? Size { get; set; }

        [Column("category")]
        [StringLength(50)]
        public string? Category { get; set; }

        [Column("type")]
        [StringLength(50)]
        public string? Type { get; set; }

        [Column("location")]
        [StringLength(255)]
        public string? Location { get; set; }

        [Column("price")]
        [Precision(15, 2)]
        public decimal? Price { get; set; }

        [Column("status")]
        [StringLength(50)]
        public string Status { get; set; } = "Available";

        [Column("created_at")]
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;

        [Column("updated_at")]
        public DateTime? UpdatedAt { get; set; }

        [Column("description")]
        public string? Description { get; set; }

        [Column("features")]
        public string? Features { get; set; }

        [Column("coordinates")]
        [StringLength(100)]
        public string? Coordinates { get; set; }

        [Column("facing")]
        [StringLength(50)]
        public string? Facing { get; set; }

        [Column("corner")]
        public bool? Corner { get; set; }

        [Column("park_facing")]
        public bool? ParkFacing { get; set; }

        [Column("main_road")]
        public bool? MainRoad { get; set; }

        // Navigation properties
        public ICollection<Allotment> Allotments { get; set; } = new List<Allotment>();
        public ICollection<Transfer> Transfers { get; set; } = new List<Transfer>();
        public ICollection<Possession> Possessions { get; set; } = new List<Possession>();
    }
}