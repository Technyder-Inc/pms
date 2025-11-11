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

            // Detect optional schema elements and resolve actual column names to avoid 42703/42P01 errors.
            bool hasAllotmentStatusColumn;
            bool hasAllotmentsTable;
            var customerCols = new HashSet<string>(StringComparer.OrdinalIgnoreCase);
            using (var custColsCmd = conn.CreateCommand())
            {
                custColsCmd.CommandText = @"SELECT column_name
                                             FROM information_schema.columns
                                             WHERE table_schema = current_schema()
                                               AND table_name = 'customers'
                                               AND column_name IN (
                                                   'customer_id','customerid',
                                                   'full_name','fullname',
                                                   'created_at','createdat',
                                                   'reg_id','regid',
                                                   'plan_id','planid',
                                                   'allotmentstatus'
                                               )";
                using var r = await custColsCmd.ExecuteReaderAsync();
                while (await r.ReadAsync())
                {
                    var name = Convert.ToString(r[0]);
                    if (!string.IsNullOrEmpty(name)) customerCols.Add(name);
                }
            }
            hasAllotmentStatusColumn = customerCols.Contains("allotmentstatus");

            using (var existsTblCmd = conn.CreateCommand())
            {
                existsTblCmd.CommandText = "SELECT EXISTS (SELECT 1 FROM information_schema.tables WHERE table_schema = current_schema() AND table_name = 'allotments')";
                var existsTbl = await existsTblCmd.ExecuteScalarAsync();
                hasAllotmentsTable = Convert.ToBoolean(existsTbl);
            }
            var allotmentCols = new HashSet<string>(StringComparer.OrdinalIgnoreCase);
            if (hasAllotmentsTable)
            {
                using var allotColsCmd = conn.CreateCommand();
                allotColsCmd.CommandText = @"SELECT column_name
                                              FROM information_schema.columns
                                              WHERE table_schema = current_schema()
                                                AND table_name = 'allotments'
                                                AND column_name IN ('customer_id','customerid')";
                using var r2 = await allotColsCmd.ExecuteReaderAsync();
                while (await r2.ReadAsync())
                {
                    var name = Convert.ToString(r2[0]);
                    if (!string.IsNullOrEmpty(name)) allotmentCols.Add(name);
                }
            }

            // Resolve actual column identifiers present in the schema
            var colCustomerId = customerCols.Contains("customer_id") ? "customer_id" : "customerid";
            var colFullName = customerCols.Contains("full_name") ? "full_name" : "fullname";
            var colCreatedAt = customerCols.Contains("created_at") ? "created_at" : "createdat";
            var colRegId = customerCols.Contains("reg_id") ? "reg_id" : "regid";
            var colPlanId = customerCols.Contains("plan_id") ? "plan_id" : "planid";
            var colAllotCustomerId = allotmentCols.Contains("customer_id") ? "customer_id" : "customerid";

            // Build WHERE clause from filters
            var whereClauses = new List<string>();
            var parameters = new List<(string Name, object Value)>();
            if (!string.IsNullOrWhiteSpace(search))
            {
                // Search across present name column and common scalar fields
                whereClauses.Add($"(({colFullName}) ILIKE @search OR email ILIKE @search OR phone ILIKE @search OR cnic ILIKE @search)");
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
                    whereClauses.Add($"EXISTS (SELECT 1 FROM allotments a WHERE a.{colAllotCustomerId} = customers.{colCustomerId})");
                }
                else if (effectiveAllotmentStatus.Equals("Not Allotted", StringComparison.OrdinalIgnoreCase))
                {
                    whereClauses.Add($"NOT EXISTS (SELECT 1 FROM allotments a WHERE a.{colAllotCustomerId} = customers.{colCustomerId})");
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
                // Alias selected columns to snake_case names expected by the reader
                var selectColumns = $"{colCustomerId} AS customer_id,\n                                       {colFullName} AS full_name,\n                                       gender,\n                                       email,\n                                       phone,\n                                       cnic,\n                                       status,\n                                       {colCreatedAt} AS created_at,\n                                       city,\n                                       country,\n                                       {colRegId} AS reg_id,\n                                       {colPlanId} AS plan_id";
                if (hasAllotmentStatusColumn)
                {
                    selectColumns = $"{colCustomerId} AS customer_id,\n                                       {colFullName} AS full_name,\n                                       gender,\n                                       email,\n                                       phone,\n                                       cnic,\n                                       status,\n                                       allotmentstatus,\n                                       {colCreatedAt} AS created_at,\n                                       city,\n                                       country,\n                                       {colRegId} AS reg_id,\n                                       {colPlanId} AS plan_id";
                }
                listCmd.CommandText = $@"SELECT {selectColumns}
                                          FROM customers
                                          {where}
                                          ORDER BY {colCustomerId}
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
            // Guard invalid id
            if (string.IsNullOrWhiteSpace(id))
            {
                return BadRequest(new { message = "Invalid customer id" });
            }

            try
            {
                // Primary path: fetch with related entities when available
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
            catch (Exception)
            {
                // Fallback path: dynamically detect actual column names and return a lean record
                var conn = _context.Database.GetDbConnection();
                if (conn.State != System.Data.ConnectionState.Open)
                {
                    await conn.OpenAsync();
                }

                // Discover existing columns to avoid referencing non-existent ones
                var cols = new HashSet<string>(StringComparer.OrdinalIgnoreCase);
                using (var colsCmd = conn.CreateCommand())
                {
                    colsCmd.CommandText = @"SELECT column_name
                                             FROM information_schema.columns
                                             WHERE table_schema = current_schema()
                                               AND table_name = 'customers'";
                    using var cr = await colsCmd.ExecuteReaderAsync();
                    while (await cr.ReadAsync())
                    {
                        var name = Convert.ToString(cr[0]);
                        if (!string.IsNullOrEmpty(name)) cols.Add(name);
                    }
                }

                // Resolve variants for mixed schemas
                string Col(string a, string b) => cols.Contains(a) ? a : b;
                var colCustomerId      = cols.Contains("customer_id")      ? "customer_id"      : "customerid";
                var colRegId           = Col("reg_id", "regid");
                var colPlanId          = Col("plan_id", "planid");
                var colFullName        = Col("full_name", "fullname");
                var colFatherName      = Col("father_name", "fathername");
                var colPassportNo      = Col("passport_no", "passportno");
                var colMailingAddress  = Col("mailing_address", "mailingaddress");
                var colPermanentAddr   = Col("permanent_address", "permanentaddress");
                var colSubProject      = Col("sub_project", "subproject");
                var colRegisteredSize  = cols.Contains("registered_size") ? "registered_size" : "registeredsize";
                var colCreatedAt       = Col("created_at", "createdat");
                var colStatus          = "status"; // present in both variants
                var colNomineeName     = Col("nominee_name", "nomineename");
                var colNomineeId       = Col("nominee_id", "nomineeid");
                var colNomineeRelation = Col("nominee_relation", "nomineerelation");
                var colAdditionalInfo  = Col("additional_info", "additionalinfo");

                using (var cmd = conn.CreateCommand())
                {
                    cmd.CommandText = $@"SELECT
                            {colCustomerId} AS customer_id,
                            {(cols.Contains(colRegId) ? colRegId : "NULL")} AS reg_id,
                            {(cols.Contains(colPlanId) ? colPlanId : "NULL")} AS plan_id,
                            {(cols.Contains(colFullName) ? colFullName : "NULL")} AS full_name,
                            {(cols.Contains(colFatherName) ? colFatherName : "NULL")} AS father_name,
                            {(cols.Contains("cnic") ? "cnic" : "NULL")} AS cnic,
                            {(cols.Contains(colPassportNo) ? colPassportNo : "NULL")} AS passport_no,
                            {(cols.Contains("dob") ? "dob" : "NULL")} AS dob,
                            {(cols.Contains("gender") ? "gender" : "NULL")} AS gender,
                            {(cols.Contains("phone") ? "phone" : "NULL")} AS phone,
                            {(cols.Contains("email") ? "email" : "NULL")} AS email,
                            {(cols.Contains(colMailingAddress) ? colMailingAddress : "NULL")} AS mailing_address,
                            {(cols.Contains(colPermanentAddr) ? colPermanentAddr : "NULL")} AS permanent_address,
                            {(cols.Contains("city") ? "city" : "NULL")} AS city,
                            {(cols.Contains("country") ? "country" : "NULL")} AS country,
                            {(cols.Contains(colSubProject) ? colSubProject : "NULL")} AS sub_project,
                            {(cols.Contains(colRegisteredSize) ? colRegisteredSize : "NULL")} AS registered_size,
                            {(cols.Contains(colCreatedAt) ? colCreatedAt : "NULL")} AS created_at,
                            {(cols.Contains(colStatus) ? colStatus : "NULL")} AS status,
                            {(cols.Contains(colNomineeName) ? colNomineeName : "NULL")} AS nominee_name,
                            {(cols.Contains(colNomineeId) ? colNomineeId : "NULL")} AS nominee_id,
                            {(cols.Contains(colNomineeRelation) ? colNomineeRelation : "NULL")} AS nominee_relation,
                            {(cols.Contains(colAdditionalInfo) ? colAdditionalInfo : "NULL")} AS additional_info
                        FROM customers
                        WHERE TRIM(BOTH FROM {colCustomerId}) = TRIM(BOTH FROM @id)
                        LIMIT 1";

                    var p = cmd.CreateParameter();
                    p.ParameterName = "@id";
                    p.Value = id?.Trim() ?? string.Empty;
                    cmd.Parameters.Add(p);

                    using (var reader = await cmd.ExecuteReaderAsync())
                    {
                        if (!await reader.ReadAsync())
                        {
                            return NotFound(new { message = "Customer not found" });
                        }

                        var result = new Customer
                        {
                            CustomerId = Convert.ToString(reader["customer_id"]) ?? string.Empty,
                            RegId = Convert.ToString(reader["reg_id"]) ?? null,
                            PlanId = Convert.ToString(reader["plan_id"]) ?? null,
                            FullName = Convert.ToString(reader["full_name"]) ?? null,
                            FatherName = Convert.ToString(reader["father_name"]) ?? null,
                            Cnic = Convert.ToString(reader["cnic"]) ?? null,
                            PassportNo = Convert.ToString(reader["passport_no"]) ?? null,
                            Gender = Convert.ToString(reader["gender"]) ?? null,
                            Phone = Convert.ToString(reader["phone"]) ?? null,
                            Email = Convert.ToString(reader["email"]) ?? null,
                            MailingAddress = Convert.ToString(reader["mailing_address"]) ?? null,
                            PermanentAddress = Convert.ToString(reader["permanent_address"]) ?? null,
                            City = Convert.ToString(reader["city"]) ?? null,
                            Country = Convert.ToString(reader["country"]) ?? null,
                            SubProject = Convert.ToString(reader["sub_project"]) ?? null,
                            RegisteredSize = Convert.ToString(reader["registered_size"]) ?? null,
                            CreatedAt = reader["created_at"] is DateTime dt ? dt : DateTime.UtcNow,
                            Status = Convert.ToString(reader["status"]) ?? "Active",
                            NomineeName = Convert.ToString(reader["nominee_name"]) ?? null,
                            NomineeId = Convert.ToString(reader["nominee_id"]) ?? null,
                            NomineeRelation = Convert.ToString(reader["nominee_relation"]) ?? null,
                            AdditionalInfo = Convert.ToString(reader["additional_info"]) ?? null,
                        };

                        // Handle optional DateOnly for dob with multiple backend types
                        var dobObj = reader["dob"];
                        if (dobObj is DateTime dobDt)
                        {
                            result.Dob = DateOnly.FromDateTime(dobDt);
                        }
                        else if (dobObj is DateOnly dobOnly)
                        {
                            result.Dob = dobOnly;
                        }
                        else if (dobObj is string dobStr && !string.IsNullOrWhiteSpace(dobStr))
                        {
                            if (DateTime.TryParse(dobStr, out var parsed))
                            {
                                result.Dob = DateOnly.FromDateTime(parsed);
                            }
                            else
                            {
                                result.Dob = null;
                            }
                        }
                        else
                        {
                            result.Dob = null;
                        }

                        return Ok(result);
                    }
                }
            }
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
            // Normalize IDs to avoid trailing/leading whitespace mismatches from CHAR columns.
            var routeId = (id ?? string.Empty).Trim();
            var payloadId = (customer.CustomerId ?? string.Empty).Trim();
            if (string.IsNullOrWhiteSpace(routeId) || string.IsNullOrWhiteSpace(payloadId))
            {
                return BadRequest(new { message = "Invalid or missing CustomerId" });
            }
            if (!string.Equals(routeId, payloadId, StringComparison.Ordinal))
            {
                return BadRequest(new { message = "Customer ID mismatch" });
            }

            // Primary path: attempt EF update (works when EF column mapping matches the DB schema).
            try
            {
                var existingCustomer = await _context.Customers
                    .FirstOrDefaultAsync(c => c.CustomerId.Trim() == routeId);
                if (existingCustomer == null)
                {
                    return NotFound(new { message = "Customer not found" });
                }

                // Partial update: update only provided fields to avoid wiping data
                if (!string.IsNullOrWhiteSpace(customer.RegId)) existingCustomer.RegId = customer.RegId;
                if (!string.IsNullOrWhiteSpace(customer.PlanId)) existingCustomer.PlanId = customer.PlanId;
                if (!string.IsNullOrWhiteSpace(customer.FullName)) existingCustomer.FullName = customer.FullName;
                if (!string.IsNullOrWhiteSpace(customer.FatherName)) existingCustomer.FatherName = customer.FatherName;
                if (!string.IsNullOrWhiteSpace(customer.Cnic)) existingCustomer.Cnic = customer.Cnic;
                if (!string.IsNullOrWhiteSpace(customer.PassportNo)) existingCustomer.PassportNo = customer.PassportNo;
                if (customer.Dob.HasValue) existingCustomer.Dob = customer.Dob;
                if (!string.IsNullOrWhiteSpace(customer.Gender)) existingCustomer.Gender = customer.Gender;
                if (!string.IsNullOrWhiteSpace(customer.Phone)) existingCustomer.Phone = customer.Phone;
                if (!string.IsNullOrWhiteSpace(customer.Email)) existingCustomer.Email = customer.Email;
                if (!string.IsNullOrWhiteSpace(customer.MailingAddress)) existingCustomer.MailingAddress = customer.MailingAddress;
                if (!string.IsNullOrWhiteSpace(customer.PermanentAddress)) existingCustomer.PermanentAddress = customer.PermanentAddress;
                if (!string.IsNullOrWhiteSpace(customer.City)) existingCustomer.City = customer.City;
                if (!string.IsNullOrWhiteSpace(customer.Country)) existingCustomer.Country = customer.Country;
                if (!string.IsNullOrWhiteSpace(customer.SubProject)) existingCustomer.SubProject = customer.SubProject;
                if (!string.IsNullOrWhiteSpace(customer.RegisteredSize)) existingCustomer.RegisteredSize = customer.RegisteredSize;
                if (!string.IsNullOrWhiteSpace(customer.Status)) existingCustomer.Status = customer.Status;
                if (!string.IsNullOrWhiteSpace(customer.NomineeName)) existingCustomer.NomineeName = customer.NomineeName;
                if (!string.IsNullOrWhiteSpace(customer.NomineeId)) existingCustomer.NomineeId = customer.NomineeId;
                if (!string.IsNullOrWhiteSpace(customer.NomineeRelation)) existingCustomer.NomineeRelation = customer.NomineeRelation;
                if (!string.IsNullOrWhiteSpace(customer.AdditionalInfo)) existingCustomer.AdditionalInfo = customer.AdditionalInfo;

                await _context.SaveChangesAsync();
                return Ok(existingCustomer);
            }
            catch (Exception)
            {
                // Fallback path: raw SQL update with dynamic column detection to support mixed schemas.
                var conn = _context.Database.GetDbConnection();
                if (conn.State != System.Data.ConnectionState.Open)
                {
                    await conn.OpenAsync();
                }

                // Detect present column variants on customers table.
                var customerCols = new HashSet<string>(StringComparer.OrdinalIgnoreCase);
                using (var custColsCmd = conn.CreateCommand())
                {
                    custColsCmd.CommandText = @"SELECT column_name
                                                 FROM information_schema.columns
                                                 WHERE table_schema = current_schema()
                                                   AND table_name = 'customers'
                                                   AND column_name IN (
                                                       'customer_id','customerid',
                                                       'full_name','fullname',
                                                       'father_name','fathername',
                                                       'cnic',
                                                       'passport_no','passportno',
                                                       'dob',
                                                       'gender',
                                                       'phone',
                                                       'email',
                                                       'mailing_address','mailingaddress',
                                                       'permanent_address','permanentaddress',
                                                       'city','country',
                                                       'sub_project','subproject',
                                                        'registered_size','registeredsize',
                                                        'status',
                                                        'reg_id','regid',
                                                        'plan_id','planid',
                                                        'additional_info','additionalinfo',
                                                        'nominee_name','nomineename',
                                                        'nominee_id','nomineeid',
                                                        'nominee_relation','nomineerelation'
                                                    )";
                    using var r = await custColsCmd.ExecuteReaderAsync();
                    while (await r.ReadAsync())
                    {
                        var name = Convert.ToString(r[0]);
                        if (!string.IsNullOrEmpty(name)) customerCols.Add(name);
                    }
                }

                // Resolve identifiers
                var colCustomerId = customerCols.Contains("customer_id") ? "customer_id" : "customerid";
                var colFullName = customerCols.Contains("full_name") ? "full_name" : "fullname";
                var colFatherName = customerCols.Contains("father_name") ? "father_name" : "fathername";
                var colPassportNo = customerCols.Contains("passport_no") ? "passport_no" : "passportno";
                var colMailingAddress = customerCols.Contains("mailing_address") ? "mailing_address" : "mailingaddress";
                var colPermanentAddress = customerCols.Contains("permanent_address") ? "permanent_address" : "permanentaddress";
                var colSubProject = customerCols.Contains("sub_project") ? "sub_project" : "subproject";
                var colRegId = customerCols.Contains("reg_id") ? "reg_id" : "regid";
                var colPlanId = customerCols.Contains("plan_id") ? "plan_id" : "planid";
                var colRegisteredSize = customerCols.Contains("registered_size") ? "registered_size" : "registeredsize";
                var colAdditionalInfo = customerCols.Contains("additional_info") ? "additional_info" : "additionalinfo";
                var colNomineeName = customerCols.Contains("nominee_name") ? "nominee_name" : "nomineename";
                var colNomineeId = customerCols.Contains("nominee_id") ? "nominee_id" : "nomineeid";
                var colNomineeRelation = customerCols.Contains("nominee_relation") ? "nominee_relation" : "nomineerelation";

                using (var cmd = conn.CreateCommand())
                {
                    // Build dynamic UPDATE with parameters for only provided fields
                    var setClauses = new List<string>();

                    var pId = cmd.CreateParameter(); pId.ParameterName = "@id"; pId.Value = routeId; cmd.Parameters.Add(pId);

                    if (!string.IsNullOrWhiteSpace(customer.FullName)) { setClauses.Add($"{colFullName} = @full_name"); var p = cmd.CreateParameter(); p.ParameterName = "@full_name"; p.Value = customer.FullName; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.FatherName)) { setClauses.Add($"{colFatherName} = @father_name"); var p = cmd.CreateParameter(); p.ParameterName = "@father_name"; p.Value = customer.FatherName; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.Cnic)) { setClauses.Add("cnic = @cnic"); var p = cmd.CreateParameter(); p.ParameterName = "@cnic"; p.Value = customer.Cnic; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.PassportNo)) { setClauses.Add($"{colPassportNo} = @passport_no"); var p = cmd.CreateParameter(); p.ParameterName = "@passport_no"; p.Value = customer.PassportNo; cmd.Parameters.Add(p); }
                    if (customer.Dob.HasValue) { setClauses.Add("dob = @dob"); var p = cmd.CreateParameter(); p.ParameterName = "@dob"; p.Value = customer.Dob; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.Gender)) { setClauses.Add("gender = @gender"); var p = cmd.CreateParameter(); p.ParameterName = "@gender"; p.Value = customer.Gender; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.Phone)) { setClauses.Add("phone = @phone"); var p = cmd.CreateParameter(); p.ParameterName = "@phone"; p.Value = customer.Phone; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.Email)) { setClauses.Add("email = @email"); var p = cmd.CreateParameter(); p.ParameterName = "@email"; p.Value = customer.Email; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.MailingAddress)) { setClauses.Add($"{colMailingAddress} = @mailing_address"); var p = cmd.CreateParameter(); p.ParameterName = "@mailing_address"; p.Value = customer.MailingAddress; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.PermanentAddress)) { setClauses.Add($"{colPermanentAddress} = @permanent_address"); var p = cmd.CreateParameter(); p.ParameterName = "@permanent_address"; p.Value = customer.PermanentAddress; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.City)) { setClauses.Add("city = @city"); var p = cmd.CreateParameter(); p.ParameterName = "@city"; p.Value = customer.City; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.Country)) { setClauses.Add("country = @country"); var p = cmd.CreateParameter(); p.ParameterName = "@country"; p.Value = customer.Country; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.SubProject)) { setClauses.Add($"{colSubProject} = @sub_project"); var p = cmd.CreateParameter(); p.ParameterName = "@sub_project"; p.Value = customer.SubProject; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.RegisteredSize)) { setClauses.Add($"{colRegisteredSize} = @registered_size"); var p = cmd.CreateParameter(); p.ParameterName = "@registered_size"; p.Value = customer.RegisteredSize; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.Status)) { setClauses.Add("status = @status"); var p = cmd.CreateParameter(); p.ParameterName = "@status"; p.Value = customer.Status; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.RegId)) { setClauses.Add($"{colRegId} = @reg_id"); var p = cmd.CreateParameter(); p.ParameterName = "@reg_id"; p.Value = customer.RegId; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.PlanId)) { setClauses.Add($"{colPlanId} = @plan_id"); var p = cmd.CreateParameter(); p.ParameterName = "@plan_id"; p.Value = customer.PlanId; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.AdditionalInfo)) { setClauses.Add($"{colAdditionalInfo} = @additional_info"); var p = cmd.CreateParameter(); p.ParameterName = "@additional_info"; p.Value = customer.AdditionalInfo; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.NomineeName)) { setClauses.Add($"{colNomineeName} = @nominee_name"); var p = cmd.CreateParameter(); p.ParameterName = "@nominee_name"; p.Value = customer.NomineeName; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.NomineeId)) { setClauses.Add($"{colNomineeId} = @nominee_id"); var p = cmd.CreateParameter(); p.ParameterName = "@nominee_id"; p.Value = customer.NomineeId; cmd.Parameters.Add(p); }
                    if (!string.IsNullOrWhiteSpace(customer.NomineeRelation)) { setClauses.Add($"{colNomineeRelation} = @nominee_relation"); var p = cmd.CreateParameter(); p.ParameterName = "@nominee_relation"; p.Value = customer.NomineeRelation; cmd.Parameters.Add(p); }

                    if (setClauses.Count == 0)
                    {
                        return BadRequest(new { message = "No updatable fields provided" });
                    }

                    cmd.CommandText = $"UPDATE customers SET {string.Join(", ", setClauses)} WHERE TRIM(BOTH FROM {colCustomerId}) = @id";

                    var rows = await cmd.ExecuteNonQueryAsync();
                    if (rows == 0)
                    {
                        return NotFound(new { message = "Customer not found" });
                    }
                }

                // Return the updated record using the existing GetCustomer logic, adapted to IActionResult
                var getResp = await GetCustomer(routeId);
                if (getResp.Result != null) return getResp.Result;
                return Ok(getResp.Value);
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