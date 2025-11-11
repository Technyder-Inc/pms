using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace PMS_APIs.Models
{
    /// <summary>
    /// Represents a user in the Property Management System
    /// Contains user authentication and profile information
    /// </summary>
    [Table("users")]
    public class User
    {
        /// <summary>
        /// Unique identifier for the user (10 characters)
        /// Primary key for the users table
        /// </summary>
        [Key]
        [Column("userid")]
        [StringLength(10)]
        public string UserId { get; set; } = string.Empty;

        /// <summary>
        /// Full name of the user
        /// Maximum length of 150 characters
        /// </summary>
        [Column("fullname")]
        [StringLength(150)]
        [Required]
        public string FullName { get; set; } = string.Empty;

        /// <summary>
        /// Email address of the user
        /// Used for login and communication
        /// Maximum length of 150 characters
        /// </summary>
        [Column("email")]
        [StringLength(150)]
        [Required]
        [EmailAddress]
        public string Email { get; set; } = string.Empty;

        /// <summary>
        /// Hashed password for user authentication
        /// Maximum length of 256 characters
        /// </summary>
        [Column("passwordhash")]
        [StringLength(256)]
        [Required]
        public string PasswordHash { get; set; } = string.Empty;

        /// <summary>
        /// Role identifier for the user (10 characters)
        /// Determines user permissions and access levels
        /// </summary>
        [Column("roleid")]
        [StringLength(10)]
        public string? RoleId { get; set; }

        /// <summary>
        /// Indicates whether the user account is active
        /// Default value is true
        /// </summary>
        [Column("isactive")]
        public bool IsActive { get; set; } = true;

        /// <summary>
        /// Timestamp when the user account was created
        /// Automatically set to current timestamp on creation
        /// </summary>
        [Column("createdat")]
        public DateTime CreatedAt { get; set; } = DateTime.UtcNow;
    }
}