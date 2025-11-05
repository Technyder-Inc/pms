using System.ComponentModel.DataAnnotations;

namespace PMS_APIs.DTOs
{
    /// <summary>
    /// Data Transfer Object for user login requests
    /// Contains the credentials required for user authentication
    /// </summary>
    public class LoginRequestDto
    {
        /// <summary>
        /// User's email address for login
        /// Must be a valid email format
        /// </summary>
        [Required(ErrorMessage = "Email is required")]
        [EmailAddress(ErrorMessage = "Invalid email format")]
        public string Email { get; set; } = string.Empty;

        /// <summary>
        /// User's password for authentication
        /// Must be provided and not empty
        /// </summary>
        [Required(ErrorMessage = "Password is required")]
        [MinLength(6, ErrorMessage = "Password must be at least 6 characters long")]
        public string Password { get; set; } = string.Empty;
    }
}