namespace PMS_APIs.DTOs
{
    /// <summary>
    /// Data Transfer Object for successful login responses
    /// Contains user information and authentication token
    /// </summary>
    public class LoginResponseDto
    {
        /// <summary>
        /// JWT token for authenticated requests
        /// Used for authorization in subsequent API calls
        /// </summary>
        public string Token { get; set; } = string.Empty;

        /// <summary>
        /// Token expiration time in UTC
        /// Indicates when the token will expire
        /// </summary>
        public DateTime ExpiresAt { get; set; }

        /// <summary>
        /// User information for the authenticated user
        /// Contains basic user profile data
        /// </summary>
        public UserDto User { get; set; } = new UserDto();
    }
}