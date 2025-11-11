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
        /// User's password for authentication (optional for MVP)
        /// If provided, must be at least 4 characters long.
        /// </summary>
        // Accept 4+ chars to support existing seed data (e.g., "1234").
        // For production, prefer 8+ with complexity requirements and required password.
        [MinLength(4, ErrorMessage = "Password must be at least 4 characters long")]
        public string? Password { get; set; }
    }
}