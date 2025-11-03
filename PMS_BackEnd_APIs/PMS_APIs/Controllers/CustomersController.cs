using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PMS_APIs.Data;
using PMS_APIs.Models;

namespace PMS_APIs.Controllers
{
    /// <summary>
    /// API Controller for managing customers in the Property Management System
    /// Provides CRUD operations for customer data
    /// </summary>
    [Route("api/[controller]")]
    [ApiController]
    public class CustomersController : ControllerBase
    {
        private readonly PmsDbContext _context;

        public CustomersController(PmsDbContext context)
        {
            _context = context;
        }

        /// <summary>
        /// Get all customers with optional filtering and pagination
        /// </summary>
        /// <param name="page">Page number (default: 1)</param>
        /// <param name="pageSize">Items per page (default: 10)</param>
        /// <param name="search">Search term for filtering</param>
        /// <returns>List of customers</returns>
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Customer>>> GetCustomers(
            int page = 1, 
            int pageSize = 10, 
            string? search = null)
        {
            var query = _context.Customers
                .Include(c => c.Registration)
                .Include(c => c.PaymentPlan)
                .AsQueryable();

            if (!string.IsNullOrEmpty(search))
            {
                query = query.Where(c => 
                    c.FullName!.Contains(search) ||
                    c.Email!.Contains(search) ||
                    c.Phone!.Contains(search) ||
                    c.Cnic!.Contains(search));
            }

            var totalCount = await query.CountAsync();
            var customers = await query
                .Skip((page - 1) * pageSize)
                .Take(pageSize)
                .ToListAsync();

            return Ok(new
            {
                data = customers,
                totalCount,
                page,
                pageSize,
                totalPages = (int)Math.Ceiling((double)totalCount / pageSize)
            });
        }

        /// <summary>
        /// Get a specific customer by ID
        /// </summary>
        /// <param name="id">Customer ID</param>
        /// <returns>Customer details</returns>
        [HttpGet("{id}")]
        public async Task<ActionResult<Customer>> GetCustomer(string id)
        {
            var customer = await _context.Customers
                .Include(c => c.Registration)
                .Include(c => c.PaymentPlan)
                .Include(c => c.Allotments)
                    .ThenInclude(a => a.Property)
                .Include(c => c.Payments)
                .FirstOrDefaultAsync(c => c.CustomerId == id);

            if (customer == null)
            {
                return NotFound(new { message = "Customer not found" });
            }

            return Ok(customer);
        }

        /// <summary>
        /// Create a new customer
        /// </summary>
        /// <param name="customer">Customer data</param>
        /// <returns>Created customer</returns>
        [HttpPost]
        public async Task<ActionResult<Customer>> PostCustomer(Customer customer)
        {
            // Generate customer ID if not provided
            if (string.IsNullOrEmpty(customer.CustomerId))
            {
                customer.CustomerId = await GenerateCustomerId();
            }

            customer.CreatedAt = DateTime.UtcNow;
            customer.Status = "Active";

            _context.Customers.Add(customer);
            
            try
            {
                await _context.SaveChangesAsync();
                return CreatedAtAction(nameof(GetCustomer), new { id = customer.CustomerId }, customer);
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error creating customer", error = ex.Message });
            }
        }

        /// <summary>
        /// Update an existing customer
        /// </summary>
        /// <param name="id">Customer ID</param>
        /// <param name="customer">Updated customer data</param>
        /// <returns>Updated customer</returns>
        [HttpPut("{id}")]
        public async Task<IActionResult> PutCustomer(string id, Customer customer)
        {
            if (id != customer.CustomerId)
            {
                return BadRequest(new { message = "Customer ID mismatch" });
            }

            var existingCustomer = await _context.Customers.FindAsync(id);
            if (existingCustomer == null)
            {
                return NotFound(new { message = "Customer not found" });
            }

            // Update properties
            existingCustomer.RegId = customer.RegId;
            existingCustomer.PlanId = customer.PlanId;
            existingCustomer.FullName = customer.FullName;
            existingCustomer.FatherName = customer.FatherName;
            existingCustomer.Cnic = customer.Cnic;
            existingCustomer.PassportNo = customer.PassportNo;
            existingCustomer.Dob = customer.Dob;
            existingCustomer.Gender = customer.Gender;
            existingCustomer.Phone = customer.Phone;
            existingCustomer.Email = customer.Email;
            existingCustomer.MailingAddress = customer.MailingAddress;
            existingCustomer.PermanentAddress = customer.PermanentAddress;
            existingCustomer.City = customer.City;
            existingCustomer.Country = customer.Country;
            existingCustomer.SubProject = customer.SubProject;
            existingCustomer.RegisteredSize = customer.RegisteredSize;
            existingCustomer.Status = customer.Status;
            existingCustomer.NomineeName = customer.NomineeName;
            existingCustomer.NomineeId = customer.NomineeId;
            existingCustomer.NomineeRelation = customer.NomineeRelation;
            existingCustomer.AdditionalInfo = customer.AdditionalInfo;

            try
            {
                await _context.SaveChangesAsync();
                return Ok(existingCustomer);
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!CustomerExists(id))
                {
                    return NotFound(new { message = "Customer not found" });
                }
                throw;
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error updating customer", error = ex.Message });
            }
        }

        /// <summary>
        /// Delete a customer
        /// </summary>
        /// <param name="id">Customer ID</param>
        /// <returns>Success message</returns>
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteCustomer(string id)
        {
            var customer = await _context.Customers.FindAsync(id);
            if (customer == null)
            {
                return NotFound(new { message = "Customer not found" });
            }

            // Soft delete by updating status
            customer.Status = "Deleted";
            
            try
            {
                await _context.SaveChangesAsync();
                return Ok(new { message = "Customer deleted successfully" });
            }
            catch (DbUpdateException ex)
            {
                return BadRequest(new { message = "Error deleting customer", error = ex.Message });
            }
        }

        /// <summary>
        /// Get customer payment history
        /// </summary>
        /// <param name="id">Customer ID</param>
        /// <returns>Payment history</returns>
        [HttpGet("{id}/payments")]
        public async Task<ActionResult<IEnumerable<Payment>>> GetCustomerPayments(string id)
        {
            var payments = await _context.Payments
                .Where(p => p.CustomerId == id)
                .OrderByDescending(p => p.PaymentDate)
                .ToListAsync();

            return Ok(payments);
        }

        /// <summary>
        /// Get customer allotments
        /// </summary>
        /// <param name="id">Customer ID</param>
        /// <returns>Customer allotments</returns>
        [HttpGet("{id}/allotments")]
        public async Task<ActionResult<IEnumerable<Allotment>>> GetCustomerAllotments(string id)
        {
            var allotments = await _context.Allotments
                .Include(a => a.Property)
                .Where(a => a.CustomerId == id)
                .ToListAsync();

            return Ok(allotments);
        }

        private bool CustomerExists(string id)
        {
            return _context.Customers.Any(e => e.CustomerId == id);
        }

        private async Task<string> GenerateCustomerId()
        {
            var lastCustomer = await _context.Customers
                .OrderByDescending(c => c.CustomerId)
                .FirstOrDefaultAsync();

            if (lastCustomer == null)
            {
                return "CUS0000001";
            }

            var lastIdNumber = int.Parse(lastCustomer.CustomerId.Substring(3));
            var newIdNumber = lastIdNumber + 1;
            return $"CUS{newIdNumber:D7}";
        }
    }
}