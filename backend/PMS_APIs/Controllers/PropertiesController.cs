using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PMS_APIs.Data;
using PMS_APIs.Models;

namespace PMS_APIs.Controllers
{
    /// <summary>
    /// API Controller for managing properties in the Property Management System
    /// Provides CRUD operations for property data
    /// </summary>
    [Route("api/[controller]")]
    [ApiController]
    public class PropertiesController : ControllerBase
    {
        private readonly PmsDbContext _context;

        public PropertiesController(PmsDbContext context)
        {
            _context = context;
        }

        /// <summary>
        /// Get all properties with optional filtering and pagination
        /// </summary>
        /// <param name="page">Page number (default: 1)</param>
        /// <param name="pageSize">Items per page (default: 10)</param>
        /// <param name="search">Search term for filtering</param>
        /// <param name="status">Filter by status</param>
        /// <param name="projectName">Filter by project name</param>
        /// <param name="size">Filter by size</param>
        /// <returns>List of properties</returns>
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Property>>> GetProperties(
            int page = 1,
            int pageSize = 10,
            string? search = null,
            string? status = null,
            string? projectName = null,
            string? size = null)
        {
            var query = _context.Properties.AsQueryable();

            if (!string.IsNullOrEmpty(search))
            {
                query = query.Where(p =>
                    p.ProjectName!.Contains(search) ||
                    p.Block!.Contains(search) ||
                    p.PlotNo!.Contains(search) ||
                    p.Location!.Contains(search));
            }

            if (!string.IsNullOrEmpty(status))
            {
                query = query.Where(p => p.Status == status);
            }

            if (!string.IsNullOrEmpty(projectName))
            {
                query = query.Where(p => p.ProjectName == projectName);
            }

            if (!string.IsNullOrEmpty(size))
            {
                query = query.Where(p => p.Size == size);
            }

            var totalCount = await query.CountAsync();
            var properties = await query
                .Skip((page - 1) * pageSize)
                .Take(pageSize)
                .ToListAsync();

            return Ok(new
            {
                data = properties,
                totalCount,
                page,
                pageSize,
                totalPages = (int)Math.Ceiling((double)totalCount / pageSize)
            });
        }

        /// <summary>
        /// Get a specific property by ID
        /// </summary>
        /// <param name="id">Property ID</param>
        /// <returns>Property details</returns>
        [HttpGet("{id}")]
        public async Task<ActionResult<Property>> GetProperty(string id)
        {
            var property = await _context.Properties
                .Include(p => p.Allotments)
                    .ThenInclude(a => a.Customer)
                .FirstOrDefaultAsync(p => p.PropertyId == id);

            if (property == null)
            {
                return NotFound(new { message = "Property not found" });
            }

            return Ok(property);
        }

        /// <summary>
        /// Create a new property
        /// </summary>
        /// <param name="property">Property data</param>
        /// <returns>Created property</returns>
        [HttpPost]
        public async Task<ActionResult<Property>> PostProperty(Property property)
        {
            // Generate property ID if not provided
            if (string.IsNullOrEmpty(property.PropertyId))
            {
                property.PropertyId = await GeneratePropertyId();
            }

            property.CreatedAt = DateTime.UtcNow;
            property.Status = "Available";

            _context.Properties.Add(property);

            try
            {
                await _context.SaveChangesAsync();
                return CreatedAtAction(nameof(GetProperty), new { id = property.PropertyId }, property);
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error creating property", error = ex.Message });
            }
        }

        /// <summary>
        /// Update an existing property
        /// </summary>
        /// <param name="id">Property ID</param>
        /// <param name="property">Updated property data</param>
        /// <returns>Updated property</returns>
        [HttpPut("{id}")]
        public async Task<IActionResult> PutProperty(string id, Property property)
        {
            if (id != property.PropertyId)
            {
                return BadRequest(new { message = "Property ID mismatch" });
            }

            var existingProperty = await _context.Properties.FindAsync(id);
            if (existingProperty == null)
            {
                return NotFound(new { message = "Property not found" });
            }

            // Update properties
            existingProperty.ProjectName = property.ProjectName;
            existingProperty.SubProject = property.SubProject;
            existingProperty.Block = property.Block;
            existingProperty.PlotNo = property.PlotNo;
            existingProperty.Size = property.Size;
            existingProperty.Category = property.Category;
            existingProperty.Type = property.Type;
            existingProperty.Location = property.Location;
            existingProperty.Price = property.Price;
            existingProperty.Status = property.Status;
            existingProperty.Description = property.Description;
            existingProperty.Features = property.Features;
            existingProperty.Coordinates = property.Coordinates;
            existingProperty.Facing = property.Facing;
            existingProperty.Corner = property.Corner;
            existingProperty.ParkFacing = property.ParkFacing;
            existingProperty.MainRoad = property.MainRoad;
            existingProperty.UpdatedAt = DateTime.UtcNow;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(existingProperty);
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!PropertyExists(id))
                {
                    return NotFound(new { message = "Property not found" });
                }
                throw;
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error updating property", error = ex.Message });
            }
        }

        /// <summary>
        /// Delete a property
        /// </summary>
        /// <param name="id">Property ID</param>
        /// <returns>Success message</returns>
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteProperty(string id)
        {
            var property = await _context.Properties.FindAsync(id);
            if (property == null)
            {
                return NotFound(new { message = "Property not found" });
            }

            // Check if property has allotments
            var hasAllotments = await _context.Allotments.AnyAsync(a => a.PropertyId == id);
            if (hasAllotments)
            {
                return BadRequest(new { message = "Cannot delete property with existing allotments" });
            }

            _context.Properties.Remove(property);

            try
            {
                await _context.SaveChangesAsync();
                return Ok(new { message = "Property deleted successfully" });
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error deleting property", error = ex.Message });
            }
        }

        /// <summary>
        /// Get available properties for allotment
        /// </summary>
        /// <returns>Available properties</returns>
        [HttpGet("available")]
        public async Task<ActionResult<IEnumerable<Property>>> GetAvailableProperties()
        {
            var availableProperties = await _context.Properties
                .Where(p => p.Status == "Available")
                .OrderBy(p => p.ProjectName)
                .ThenBy(p => p.Block)
                .ThenBy(p => p.PlotNo)
                .ToListAsync();

            return Ok(availableProperties);
        }

        /// <summary>
        /// Get property statistics
        /// </summary>
        /// <returns>Property statistics</returns>
        [HttpGet("statistics")]
        public async Task<ActionResult> GetPropertyStatistics()
        {
            var totalProperties = await _context.Properties.CountAsync();
            var availableProperties = await _context.Properties.CountAsync(p => p.Status == "Available");
            var allottedProperties = await _context.Properties.CountAsync(p => p.Status == "Allotted");
            var soldProperties = await _context.Properties.CountAsync(p => p.Status == "Sold");

            var projectStats = await _context.Properties
                .GroupBy(p => p.ProjectName)
                .Select(g => new
                {
                    ProjectName = g.Key,
                    TotalProperties = g.Count(),
                    AvailableProperties = g.Count(p => p.Status == "Available"),
                    AllottedProperties = g.Count(p => p.Status == "Allotted")
                })
                .ToListAsync();

            return Ok(new
            {
                totalProperties,
                availableProperties,
                allottedProperties,
                soldProperties,
                projectStats
            });
        }

        private bool PropertyExists(string id)
        {
            return _context.Properties.Any(e => e.PropertyId == id);
        }

        private async Task<string> GeneratePropertyId()
        {
            var lastProperty = await _context.Properties
                .OrderByDescending(p => p.PropertyId)
                .FirstOrDefaultAsync();

            if (lastProperty == null)
            {
                return "PROP000001";
            }

            var lastIdNumber = int.Parse(lastProperty.PropertyId.Substring(4));
            var newIdNumber = lastIdNumber + 1;
            return $"PROP{newIdNumber:D6}";
        }
    }
}