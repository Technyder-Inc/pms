using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using Microsoft.IdentityModel.Tokens;
using PMS_APIs.Data;
using PMS_APIs.DTOs;
using PMS_APIs.Models;
using System.IdentityModel.Tokens.Jwt;
using System.Security.Claims;
using System.Security.Cryptography;
using System.Text;
using System.Data;

namespace PMS_APIs.Controllers
{
    /// <summary>
    /// Authentication controller for user login and management
    /// Handles user authentication, registration, and JWT token generation
    /// </summary>
    [ApiController]
    [Route("api/[controller]")]
    public class AuthController : ControllerBase
    {
        private readonly PmsDbContext _context;
        private readonly IConfiguration _configuration;

        public AuthController(PmsDbContext context, IConfiguration configuration)
        {
            _context = context;
            _configuration = configuration;
        }

        /// <summary>
        /// Authenticates a user and returns a JWT token
        /// </summary>
        /// <param name="loginRequest">Login credentials containing email and password</param>
        /// <returns>JWT token and user information if authentication is successful</returns>
        [HttpPost("login")]
        [AllowAnonymous]
        public async Task<ActionResult<LoginResponseDto>> Login([FromBody] LoginRequestDto loginRequest)
        {
            try
            {
                // Validate input
                if (!ModelState.IsValid)
                {
                    return BadRequest(new { message = "Invalid input data", errors = ModelState });
                }

                // Normalize inputs to avoid whitespace/casing issues
                var normalizedEmail = (loginRequest.Email ?? string.Empty).Trim().ToLower();
                var normalizedPassword = (loginRequest.Password ?? string.Empty).Trim();

                // Find user by email
                var user = await _context.Users
                    .FirstOrDefaultAsync(u => u.Email.ToLower() == normalizedEmail);

                if (user == null || !user.IsActive)
                {
                    return Unauthorized(new { message = "Invalid email or password" });
                }

                // Verify password with support for legacy plaintext storage
                // 1) If a hash exists, verify against it
                // 2) If hash comparison fails, accept if stored value is plaintext and matches
                // 3) If no hash is present, try reading legacy `password` column and upgrade
                var storedHash = user.PasswordHash ?? string.Empty;
                bool verified = false;

                if (!string.IsNullOrWhiteSpace(storedHash))
                {
                    // Attempt hash verification
                    verified = VerifyPassword(normalizedPassword, storedHash);

                    // Plaintext fallback: some databases may have stored literal passwords in `password_hash`
                    if (!verified && normalizedPassword == storedHash)
                    {
                        user.PasswordHash = HashPassword(normalizedPassword);
                        await _context.SaveChangesAsync();
                        verified = true;
                    }
                }
                else
                {
                    // Legacy schema: try to read a `password` column if present and plaintext
                    var legacyPlain = await TryGetLegacyPlainPassword(user.UserId);
                    if (!string.IsNullOrEmpty(legacyPlain) && normalizedPassword == legacyPlain)
                    {
                        user.PasswordHash = HashPassword(normalizedPassword);
                        await _context.SaveChangesAsync();
                        verified = true;
                    }
                }

                if (!verified)
                {
                    return Unauthorized(new { message = "Invalid email or password" });
                }

                // Generate JWT token
                var token = GenerateJwtToken(user);
                var expiresAt = DateTime.UtcNow.AddHours(24); // Token expires in 24 hours

                var response = new LoginResponseDto
                {
                    Token = token,
                    ExpiresAt = expiresAt,
                    User = new UserDto
                    {
                        UserId = user.UserId,
                        FullName = user.FullName,
                        Email = user.Email,
                        RoleId = user.RoleId,
                        IsActive = user.IsActive,
                        CreatedAt = user.CreatedAt
                    }
                };

                return Ok(response);
            }
            catch (Exception ex)
            {
                return StatusCode(500, new { message = "An error occurred during login", error = ex.Message });
            }
        }

        /// <summary>
        /// Registers a new user in the system
        /// </summary>
        /// <param name="createUserDto">User registration data</param>
        /// <returns>Created user information without sensitive data</returns>
        [HttpPost("register")]
        public async Task<ActionResult<UserDto>> Register([FromBody] CreateUserDto createUserDto)
        {
            try
            {
                // Validate input
                if (!ModelState.IsValid)
                {
                    return BadRequest(new { message = "Invalid input data", errors = ModelState });
                }

                // Check if user already exists
                var existingUser = await _context.Users
                    .FirstOrDefaultAsync(u => u.Email.ToLower() == createUserDto.Email.ToLower());

                if (existingUser != null)
                {
                    return Conflict(new { message = "User with this email already exists" });
                }

                // Generate unique user ID
                var userId = await GenerateUniqueUserId();

                // Hash password
                var passwordHash = HashPassword(createUserDto.Password);

                // Create new user
                var user = new User
                {
                    UserId = userId,
                    FullName = createUserDto.FullName,
                    Email = createUserDto.Email,
                    PasswordHash = passwordHash,
                    RoleId = createUserDto.RoleId,
                    IsActive = createUserDto.IsActive,
                    CreatedAt = DateTime.UtcNow
                };

                _context.Users.Add(user);
                try
                {
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateException dbEx)
                {
                    // If role_id violates FK constraint, fallback to null and retry (MVP)
                    var inner = dbEx.InnerException?.Message ?? string.Empty;
                    if (inner.Contains("users_role_id_fkey") || inner.Contains("23503"))
                    {
                        user.RoleId = null;
                        try
                        {
                            await _context.SaveChangesAsync();
                        }
                        catch (DbUpdateException dbEx2)
                        {
                            return StatusCode(500, new
                            {
                                message = "Database update failed during registration (retry without role_id)",
                                error = dbEx2.Message,
                                innerError = dbEx2.InnerException?.Message
                            });
                        }
                    }
                    else
                    {
                        // Surface inner exception for easier troubleshooting (dev-friendly)
                        return StatusCode(500, new
                        {
                            message = "Database update failed during registration",
                            error = dbEx.Message,
                            innerError = dbEx.InnerException?.Message
                        });
                    }
                }

                var userDto = new UserDto
                {
                    UserId = user.UserId,
                    FullName = user.FullName,
                    Email = user.Email,
                    RoleId = user.RoleId,
                    IsActive = user.IsActive,
                    CreatedAt = user.CreatedAt
                };

                return CreatedAtAction(nameof(GetUser), new { id = user.UserId }, userDto);
            }
            catch (Exception ex)
            {
                // Include inner exception details to pinpoint root cause without exposing stack trace
                return StatusCode(500, new
                {
                    message = "An error occurred during registration",
                    error = ex.Message,
                    innerError = ex.InnerException?.Message
                });
            }
        }

        /// <summary>
        /// Gets user information by user ID
        /// Requires authentication
        /// </summary>
        /// <param name="id">User ID to retrieve</param>
        /// <returns>User information without sensitive data</returns>
        [HttpGet("{id}")]
        [Authorize]
        public async Task<ActionResult<UserDto>> GetUser(string id)
        {
            try
            {
                var user = await _context.Users.FindAsync(id);

                if (user == null)
                {
                    return NotFound(new { message = "User not found" });
                }

                var userDto = new UserDto
                {
                    UserId = user.UserId,
                    FullName = user.FullName,
                    Email = user.Email,
                    RoleId = user.RoleId,
                    IsActive = user.IsActive,
                    CreatedAt = user.CreatedAt
                };

                return Ok(userDto);
            }
            catch (Exception ex)
            {
                return StatusCode(500, new { message = "An error occurred while retrieving user", error = ex.Message });
            }
        }

        /// <summary>
        /// Gets all users in the system
        /// Requires authentication
        /// </summary>
        /// <returns>List of all users without sensitive data</returns>
        [HttpGet]
        [Authorize]
        public async Task<ActionResult<IEnumerable<UserDto>>> GetUsers()
        {
            try
            {
                var users = await _context.Users
                    .Select(u => new UserDto
                    {
                        UserId = u.UserId,
                        FullName = u.FullName,
                        Email = u.Email,
                        RoleId = u.RoleId,
                        IsActive = u.IsActive,
                        CreatedAt = u.CreatedAt
                    })
                    .ToListAsync();

                return Ok(users);
            }
            catch (Exception ex)
            {
                return StatusCode(500, new { message = "An error occurred while retrieving users", error = ex.Message });
            }
        }

        /// <summary>
        /// Updates user active status
        /// Requires authentication
        /// </summary>
        /// <param name="id">User ID to update</param>
        /// <param name="isActive">New active status</param>
        /// <returns>Updated user information</returns>
        [HttpPatch("{id}/status")]
        [Authorize]
        public async Task<ActionResult<UserDto>> UpdateUserStatus(string id, [FromBody] bool isActive)
        {
            try
            {
                var user = await _context.Users.FindAsync(id);

                if (user == null)
                {
                    return NotFound(new { message = "User not found" });
                }

                user.IsActive = isActive;
                await _context.SaveChangesAsync();

                var userDto = new UserDto
                {
                    UserId = user.UserId,
                    FullName = user.FullName,
                    Email = user.Email,
                    RoleId = user.RoleId,
                    IsActive = user.IsActive,
                    CreatedAt = user.CreatedAt
                };

                return Ok(userDto);
            }
            catch (Exception ex)
            {
                return StatusCode(500, new { message = "An error occurred while updating user status", error = ex.Message });
            }
        }

        /// <summary>
        /// Generates a JWT token for the authenticated user
        /// </summary>
        /// <param name="user">User entity to generate token for</param>
        /// <returns>JWT token string</returns>
        private string GenerateJwtToken(User user)
        {
            var jwtKey = _configuration["Jwt:Key"] ?? "your-super-secret-jwt-key-that-is-at-least-32-characters-long";
            var jwtIssuer = _configuration["Jwt:Issuer"] ?? "PMS_API";
            var jwtAudience = _configuration["Jwt:Audience"] ?? "PMS_Client";

            var securityKey = new SymmetricSecurityKey(Encoding.UTF8.GetBytes(jwtKey));
            var credentials = new SigningCredentials(securityKey, SecurityAlgorithms.HmacSha256);

            var claims = new[]
            {
                new Claim(ClaimTypes.NameIdentifier, user.UserId),
                new Claim(ClaimTypes.Name, user.FullName),
                new Claim(ClaimTypes.Email, user.Email),
                new Claim("role_id", user.RoleId ?? ""),
                new Claim("is_active", user.IsActive.ToString())
            };

            var token = new JwtSecurityToken(
                issuer: jwtIssuer,
                audience: jwtAudience,
                claims: claims,
                expires: DateTime.UtcNow.AddHours(24),
                signingCredentials: credentials
            );

            return new JwtSecurityTokenHandler().WriteToken(token);
        }

        /// <summary>
        /// Hashes a password using BCrypt-like algorithm
        /// </summary>
        /// <param name="password">Plain text password to hash</param>
        /// <returns>Hashed password string</returns>
        private string HashPassword(string password)
        {
            // Using a simple SHA256 hash with salt for demonstration
            // In production, use BCrypt or similar
            using var sha256 = SHA256.Create();
            var salt = "PMS_Salt_2024"; // In production, use a random salt per user
            var saltedPassword = password + salt;
            var hashedBytes = sha256.ComputeHash(Encoding.UTF8.GetBytes(saltedPassword));
            return Convert.ToBase64String(hashedBytes);
        }

        /// <summary>
        /// Verifies a password against its hash
        /// </summary>
        /// <param name="password">Plain text password to verify</param>
        /// <param name="hash">Stored password hash</param>
        /// <returns>True if password matches hash, false otherwise</returns>
        private bool VerifyPassword(string password, string hash)
        {
            var computedHash = HashPassword(password);
            return computedHash == hash;
        }

        /// <summary>
        /// Attempts to read a legacy plaintext password from the `users` table.
        /// Purpose: Support environments where passwords were stored in a `password` column as plain text.
        /// Inputs: userId - string user identifier
        /// Outputs: Plaintext password if available; otherwise null
        /// </summary>
        private async Task<string?> TryGetLegacyPlainPassword(string userId)
        {
            try
            {
                var conn = _context.Database.GetDbConnection();
                await conn.OpenAsync();
                using var cmd = conn.CreateCommand();
                cmd.CommandText = "SELECT password FROM users WHERE user_id = @id LIMIT 1";

                var p = cmd.CreateParameter();
                p.ParameterName = "@id";
                p.Value = userId;
                cmd.Parameters.Add(p);

                var result = await cmd.ExecuteScalarAsync();
                await conn.CloseAsync();

                if (result == null || result == DBNull.Value) return null;
                return Convert.ToString(result);
            }
            catch
            {
                // If the column doesn't exist or any error occurs, treat as not available
                return null;
            }
        }

        /// <summary>
        /// Generates a unique user ID
        /// </summary>
        /// <returns>Unique 10-character user ID</returns>
        private async Task<string> GenerateUniqueUserId()
        {
            string userId;
            bool exists;

            do
            {
                // Generate user ID in format USR0000001
                var lastUser = await _context.Users
                    .Where(u => u.UserId.StartsWith("USR"))
                    .OrderByDescending(u => u.UserId)
                    .FirstOrDefaultAsync();

                int nextNumber = 1;
                if (lastUser != null && lastUser.UserId.Length == 10)
                {
                    var numberPart = lastUser.UserId.Substring(3);
                    if (int.TryParse(numberPart, out int currentNumber))
                    {
                        nextNumber = currentNumber + 1;
                    }
                }

                userId = $"USR{nextNumber:D7}";
                exists = await _context.Users.AnyAsync(u => u.UserId == userId);
            }
            while (exists);

            return userId;
        }
    }
}