using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using System.Data;
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
        /// Get all customers with optional filtering and pagination.
        /// Purpose: Provide a lean list without joining related tables.
        /// Inputs:
        ///  - page: page number (default: 1)
        ///  - pageSize: items per page (default: 10)
        ///  - search: free text search (full_name, email, phone, cnic)
        ///  - status: filter by status (Active | Blocked | Cancelled)
        ///  - allotmentstatus: filter by Neon column (Allotted | Not Allotted | Pending)
        ///  - allotment (legacy): maps to allotmentstatus (allotted -> Allotted, unallotted -> Not Allotted)
        /// Outputs:
        ///  - Paginated list with scalar fields (includes Gender)
        /// </summary>
        [HttpGet]
        public async Task<ActionResult<IEnumerable<Customer>>> GetCustomers(
            int page = 1,
            int pageSize = 10,
            string? search = null,
            string? status = null,
            string? allotmentstatus = null,
            string? allotment = null)
        {
            // For the list endpoint, avoid joining related tables
            // This prevents 42P01 errors when related tables are missing
            var offset = (page - 1) * pageSize;

            var conn = _context.Database.GetDbConnection();
            if (conn.State != ConnectionState.Open)
            {
                await conn.OpenAsync();
            }

            // Detect optional schema elements to avoid 42703/42P01 errors when absent.
            bool hasAllotmentStatusColumn;
            bool hasAllotmentsTable;
            using (var existsColCmd = conn.CreateCommand())
            {
                existsColCmd.CommandText = "SELECT EXISTS (SELECT 1 FROM information_schema.columns WHERE table_schema = current_schema() AND table_name = 'customers' AND column_name = 'allotmentstatus')";
                var exists = await existsColCmd.ExecuteScalarAsync();
                hasAllotmentStatusColumn = Convert.ToBoolean(exists);
            }
            using (var existsTblCmd = conn.CreateCommand())
            {
                existsTblCmd.CommandText = "SELECT EXISTS (SELECT 1 FROM information_schema.tables WHERE table_schema = current_schema() AND table_name = 'allotments')";
                var existsTbl = await existsTblCmd.ExecuteScalarAsync();
                hasAllotmentsTable = Convert.ToBoolean(existsTbl);
            }

            // Build WHERE clause from filters
            var whereClauses = new List<string>();
            var parameters = new List<(string Name, object Value)>();
            if (!string.IsNullOrWhiteSpace(search))
            {
                whereClauses.Add("(full_name ILIKE @search OR email ILIKE @search OR phone ILIKE @search OR cnic ILIKE @search)");
                parameters.Add(("@search", $"%{search}%"));
            }
            if (!string.IsNullOrWhiteSpace(status))
            {
                whereClauses.Add("status = @status");
                parameters.Add(("@status", status));
            }
            // Prefer direct filter on Customers table column 'allotmentstatus' if present.
            // Map legacy 'allotment' to 'allotmentstatus' values.
            string? effectiveAllotmentStatus = null;
            if (!string.IsNullOrWhiteSpace(allotmentstatus))
            {
                effectiveAllotmentStatus = allotmentstatus;
            }
            else if (!string.IsNullOrWhiteSpace(allotment))
            {
                if (allotment.Equals("allotted", StringComparison.OrdinalIgnoreCase)) effectiveAllotmentStatus = "Allotted";
                else if (allotment.Equals("unallotted", StringComparison.OrdinalIgnoreCase)) effectiveAllotmentStatus = "Not Allotted";
            }
            if (!string.IsNullOrWhiteSpace(effectiveAllotmentStatus) && hasAllotmentStatusColumn)
            {
                whereClauses.Add("allotmentstatus = @allotmentstatus");
                parameters.Add(("@allotmentstatus", effectiveAllotmentStatus));
            }
            else if (!string.IsNullOrWhiteSpace(effectiveAllotmentStatus) && !hasAllotmentStatusColumn && hasAllotmentsTable)
            {
                // Fallback: derive Allotted/Not Allotted from presence of allotments records.
                if (effectiveAllotmentStatus.Equals("Allotted", StringComparison.OrdinalIgnoreCase))
                {
                    whereClauses.Add("EXISTS (SELECT 1 FROM allotments a WHERE a.customer_id = customers.customer_id)");
                }
                else if (effectiveAllotmentStatus.Equals("Not Allotted", StringComparison.OrdinalIgnoreCase))
                {
                    whereClauses.Add("NOT EXISTS (SELECT 1 FROM allotments a WHERE a.customer_id = customers.customer_id)");
                }
                // 'Pending' cannot be derived via allotments presence; ignore if only table fallback is available.
            }
            var where = whereClauses.Count > 0 ? $"WHERE {string.Join(" AND ", whereClauses)}" : string.Empty;

            // Get total count
            int totalCount = 0;
            using (var countCmd = conn.CreateCommand())
            {
                countCmd.CommandText = $"SELECT COUNT(*) FROM customers {where}";
                foreach (var p in parameters)
                {
                    var dbParam = countCmd.CreateParameter();
                    dbParam.ParameterName = p.Name;
                    dbParam.Value = p.Value;
                    countCmd.Parameters.Add(dbParam);
                }
                var result = await countCmd.ExecuteScalarAsync();
                totalCount = Convert.ToInt32(result);
            }

            // Fetch page of customers (scalar fields only)
            var customers = new List<object>();
            using (var listCmd = conn.CreateCommand())
            {
                var selectColumns = "customer_id, full_name, gender, email, phone, cnic, status, created_at, city, country, reg_id, plan_id";
                if (hasAllotmentStatusColumn)
                {
                    selectColumns = "customer_id, full_name, gender, email, phone, cnic, status, allotmentstatus, created_at, city, country, reg_id, plan_id";
                }
                listCmd.CommandText = $@"SELECT {selectColumns}
                                          FROM customers
                                          {where}
                                          ORDER BY customer_id
                                          OFFSET @offset LIMIT @limit";
                foreach (var p in parameters)
                {
                    var dbParam = listCmd.CreateParameter();
                    dbParam.ParameterName = p.Name;
                    dbParam.Value = p.Value;
                    listCmd.Parameters.Add(dbParam);
                }
                var offsetParam = listCmd.CreateParameter();
                offsetParam.ParameterName = "@offset";
                offsetParam.Value = offset;
                listCmd.Parameters.Add(offsetParam);

                var limitParam = listCmd.CreateParameter();
                limitParam.ParameterName = "@limit";
                limitParam.Value = pageSize;
                listCmd.Parameters.Add(limitParam);

                using var reader = await listCmd.ExecuteReaderAsync(CommandBehavior.CloseConnection);
                var colNames = new HashSet<string>(StringComparer.OrdinalIgnoreCase);
                for (int i = 0; i < reader.FieldCount; i++) colNames.Add(reader.GetName(i));
                while (await reader.ReadAsync())
                {
                    customers.Add(new
                    {
                        CustomerId = reader["customer_id"],
                        FullName = reader["full_name"],
                        Gender = reader["gender"],
                        Email = reader["email"],
                        Phone = reader["phone"],
                        Cnic = reader["cnic"],
                        Status = reader["status"],
                        AllotmentStatus = colNames.Contains("allotmentstatus") ? reader["allotmentstatus"] : null,
                        CreatedAt = reader["created_at"],
                        City = reader["city"],
                        Country = reader["country"],
                        RegId = reader["reg_id"],
                        PlanId = reader["plan_id"]
                    });
                }
            }

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