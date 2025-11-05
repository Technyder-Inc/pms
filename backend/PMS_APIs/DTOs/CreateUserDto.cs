using System.ComponentModel.DataAnnotations;

namespace PMS_APIs.DTOs
{
    /// <summary>
    /// Data Transfer Object for creating new users
    /// Contains all required information for user registration
    /// </summary>
    public class CreateUserDto
    {
        /// <summary>
        /// Full name of the user
        /// Must be provided and not empty
        /// </summary>
        [Required(ErrorMessage = "Full name is required")]
        [StringLength(150, ErrorMessage = "Full name cannot exceed 150 characters")]
        public string FullName { get; set; } = string.Empty;

        /// <summary>
        /// Email address of the user
        /// Must be a valid email format and unique
        /// </summary>
        [Required(ErrorMessage = "Email is required")]
        [EmailAddress(ErrorMessage = "Invalid email format")]
        [StringLength(150, ErrorMessage = "Email cannot exceed 150 characters")]
        public string Email { get; set; } = string.Empty;

        /// <summary>
        /// Password for the user account
        /// Must meet minimum security requirements
        /// </summary>
        [Required(ErrorMessage = "Password is required")]
        // Accept 4+ for current dataset; recommend 8+ in production.
        [MinLength(4, ErrorMessage = "Password must be at least 4 characters long")]
        [StringLength(100, ErrorMessage = "Password cannot exceed 100 characters")]
        public string Password { get; set; } = string.Empty;

        /// <summary>
        /// Role identifier for the user (optional)
        /// Determines user permissions and access levels
        /// </summary>
        [StringLength(10, ErrorMessage = "Role ID cannot exceed 10 characters")]
        public string? RoleId { get; set; }

        /// <summary>
        /// Indicates whether the user account should be active
        /// Default value is true
        /// </summary>
        public bool IsActive { get; set; } = true;
    }
}