namespace PMS_APIs.DTOs
{
    /// <summary>
    /// Data Transfer Object for user information
    /// Contains user profile data without sensitive information
    /// </summary>
    public class UserDto
    {
        /// <summary>
        /// Unique identifier for the user
        /// </summary>
        public string UserId { get; set; } = string.Empty;

        /// <summary>
        /// Full name of the user
        /// </summary>
        public string FullName { get; set; } = string.Empty;

        /// <summary>
        /// Email address of the user
        /// </summary>
        public string Email { get; set; } = string.Empty;

        /// <summary>
        /// Role identifier for the user
        /// Determines user permissions and access levels
        /// </summary>
        public string? RoleId { get; set; }

        /// <summary>
        /// Indicates whether the user account is active
        /// </summary>
        public bool IsActive { get; set; }

        /// <summary>
        /// Timestamp when the user account was created
        /// </summary>
        public DateTime CreatedAt { get; set; }
    }
}