# Property Management System (PMS)

A comprehensive property management system with React.js frontend and .NET Core Web API backend.

## 🏗️ System Architecture

This project consists of two main components:
- **Frontend**: React.js application for user interface
- **Backend**: .NET Core Web API for data management and business logic

## 🚀 Features

### Frontend Features
- Modern, responsive UI with brand styling
- Comprehensive property management modules
- Customer management and tracking
- Payment plan management
- Property allotment and transfer system
- Interactive dashboards and reports
- Real-time updates

### Backend API Features
- RESTful API endpoints for all operations
- **JWT Authentication & Authorization** for secure access
- **User Management System** with role-based access control
- Entity Framework Core with SQLite database
- Comprehensive data models for property management
- CORS enabled for frontend integration
- Pagination support for large datasets
- Proper HTTP status codes and error handling
- **Password hashing** with BCrypt for security

## 🛠️ Tech Stack

### Frontend
- React.js 18
- React Router for navigation
- Styled Components for styling
- Lexend font for brand typography

### Backend
- .NET Core 8.0
- Entity Framework Core 8.0.11
- **JWT Authentication** with Bearer tokens
- **BCrypt** for password hashing
- PostgreSQL via Npgsql (Neon-compatible)
- SQLite (legacy/dev only)

## 📁 Project Structure

```
pms/
├── db/                   # Data folder (contains database.txt)
├── frontend/              # React.js application
│   ├── src/               # Frontend source code
│   │   ├── assets/        # Static assets (images, icons)
│   │   ├── components/    # Reusable UI components
│   │   ├── layouts/       # Layout components (Sidebar, TopBar)
│   │   ├── pages/         # Page components for each route
│   │   │   ├── customers/  # Customers module pages
│   │   │   ├── property/   # Property module pages
│   │   │   ├── payments/   # Payments module pages
│   │   │   ├── schedule/   # Schedule module pages
│   │   │   ├── transfer/   # Transfer module pages
│   │   │   ├── reports/    # Reports module pages
│   │   │   ├── ai-automation/ # AI & Automation module pages
│   │   │   ├── settings/   # Settings module pages
│   │   │   └── compliance/ # Compliance module pages
│   │   ├── styles/        # Global styles and theme
│   │   └── utils/         # Utility functions and helpers
│   ├── public/            # HTML template and public assets
│   ├── package.json
│   └── package-lock.json
├── backend/               # .NET Core Web API
│   └── PMS_APIs/
│       ├── Controllers/   # API controllers
│       ├── Models/        # Data models
│       ├── Data/          # Database context
│       ├── Migrations/    # EF Core migrations
│       ├── Program.cs
│       ├── appsettings.json
│       └── appsettings.Development.json
└── README.md
```

### db Folder
- The `db` folder (with `database.txt`) lives at the repository root `pms/db`.
- If any code referenced the old `frontend/DB/database.txt` path, update references to `../db/database.txt` relative to `frontend`, or use an absolute path from the project root.
- For frontend usage, prefer placing consumable data in `frontend/public` and fetch via `/database.txt`. Files outside `public` are not served by the dev server.

## 💄 UI Layout (Updated)

- Header at the top using `TopBar`.
- First row below the header sits inside a white card container and has two full-width columns (panels).
- Second row contains a side links bar (`Sidebar`) and a main content area (`Outlet`).
- Styling follows brand guidelines: primary `#dd9c6b`, secondary `#00234C`, font `Lexend`.
  - The top header background color matches the sidebar background (`#00234C`) for consistent branding.

Customize panels:
- Edit `src/layouts/Layout.js` and update the two `Panel` components in the first row.
- Main content is the current route rendered via React Router `Outlet`.

### Customers Page: Secondary Header Update
- Background changed to brand primary `#dd9c6b` (golden).
- Height reduced with compact padding (`0.25rem`) for a cleaner feel.
- Full-bleed width (`100vw`) to match the very top header.
- Removed the gap above so it touches the top header.
- Title styled with `Lexend`, white color for contrast.

### Layout Cleanup
- Removed the Overview/Highlights card (third header) from `src/layouts/Layout.js` to streamline the second row directly under the top header.

### Sidebar Width Update
- Increased the sidebar width to `280px` for improved readability and consistent spacing with the brand.

## 🏠 Home Page Layout (Two-Column)

- First column: sidebar fills full height with no outer spacing.
- Second column: top bar at the top; main content starts directly below.
- Styling follows brand: primary `#dd9c6b`, secondary `#00234C`, font `Lexend`.

Where to edit
- `frontend/src/layouts/Layout.js` – defines the two-column grid and stacks `TopBar` above content in column two.
- `frontend/src/layouts/Sidebar.js` – ensures full-height sidebar and removes extra gaps/margins.
- `frontend/src/styles/GlobalStyles.js` – contains brand theme and global font.

How to verify
- Start frontend: `cd pms/frontend && $env:PORT=3001; npm start`.
- Open `http://localhost:3001/dashboard`.
- Confirm: sidebar is flush to edges (no spacing), top bar sits above content, and content begins immediately below the top bar.
- Top bar background is near-white (`#f8fafc`) with text/icons in brand secondary (`#00234C`).

Notes
- The layout uses CSS grid to guarantee the sidebar spans full viewport height.
- If you need a compact header, adjust `TopBar` height and padding in its component.

## 📋 Sidebar Navigation (Updated)

- Groups: adds branded modules with emoji labels and Lexend font.
- Customers section includes three sublinks that retain context when navigating:
  - `All Customers` → `http://localhost:3001/customers/all-customers`
  - `Active Customers` → `http://localhost:3001/customers/active-customers`
  - `Blocked Customers` → `http://localhost:3001/customers/blocked-customers`
- The Customers group auto-expands whenever the current route starts with `/customers`.
- Active link styling uses brand primary `#dd9c6b` on a secondary `#00234C` background.

Where to edit
- `frontend/src/layouts/Sidebar.js` – module config and rendering logic.
- `frontend/src/components/CustomersGrid.js` – reusable grid with filters, pagination, and detail modal.
- `frontend/src/pages/customers/AllCustomers.js` | `ActiveCustomers.js` | `BlockedCustomers.js` – wrappers for specific customer views using `CustomersGrid`.
- `frontend/src/App.js` – route definitions (module routes) and `ModuleRouter` integration.

Implementation details
- Sidebar modules are defined as objects with `label`, `slug`, and `sublinks`.
- Each sublink uses `{ label, path }` for predictable routes.
- The module header uses collapse/expand behavior and stays open while inside its route.

Quick verification
- Start frontend and open `http://localhost:3001/customers/all-customers`.
- Confirm the Customers section is expanded and the active sublink is highlighted.
- Switch to `Active Customers` and `Blocked Customers`; the grid updates accordingly.

## 📚 Sidebar Navigation (Expanded)

- The sidebar now reflects the full structure requested, grouped by modules with branded emoji labels and Lexend font.
- New groups and sub-links:
  - `🏠 DASHBOARD`: Home Overview
  - `📋 CUSTOMERS`: All Customers, Active Customers, Blocked Customers, Member Directory, Member Segments, Member Import/Bulk Actions
  - `🏘️ PROPERTY`: Projects, Inventory Status, Price Management, Availability Matrix
  - `💳 PAYMENTS`: Collections, Dues & Defaulters, Waivers & Adjustments, NDC Management, Refunds, Financial Ledger
  - `📅 SCHEDULE`: Bookings, Holds Management, Possession, Booking Approvals, Payment Schedule Editor
  - `🔄 TRANSFER`: Transfer Requests, Transfer Approvals
  - `📊 REPORTS`: Sales Analytics, Collections Analytics, Dues Analysis, Possession Status, Transfer Summary, Custom Reports
  - `🤖 AI & AUTOMATION (NEW)`: Lead Scoring, Collection Prediction, Anomaly Detection, Automated Reminders, Smart Recommendations, Audit Trail (AI Actions)
  - `⚙️ SETTINGS`: Company Settings, Business Rules, Payment Configuration, Notification Rules, Users & Roles, Approval Workflows, System Configuration, Compliance Configuration (NEW)
  - `🔐 COMPLIANCE`: Audit Trail, Approval Queue, Compliance Events, Data Management, Risk Assessment, Policy Monitoring, Compliance Reports
  - `📞 SUPPORT & HELP`: Documentation, FAQs, Contact Support, System Status

Routing behavior
- All module links route to `/:module/:view` and resolve via `ModuleRouter`.
- `ModuleRouter` lazily loads `frontend/src/pages/<module>/<Page>.js` for each sub-link.
- If a page isn’t implemented yet, a small branded placeholder is shown.
- The `customers/:view` route is handled by `ModuleRouter` and uses folder-based pages (`AllCustomers`, `ActiveCustomers`, `BlockedCustomers`) built on `CustomersGrid`.

Where to edit
- `frontend/src/layouts/Sidebar.js` – Full module and sublink configuration.
- `frontend/src/pages/ModuleRouter.js` – Central mapping from `module → view → component`.
- `frontend/src/pages/<module>/<Page>.js` – Individual page components per sub-link.
- `frontend/src/App.js` – Uses `ModuleRouter` for `:module` and `:module/:view` routes.

Quick verification (dev server)
- Start frontend: `cd pms/frontend && $env:PORT=3003; npm start`
- Open `http://localhost:3003/dashboard` → confirm the main shell renders.
- Open `http://localhost:3003/customers/all-customers` → customers folder page renders.
- Open `http://localhost:3003/ai-automation/lead-scoring` → AI page renders.
- Open `http://localhost:3003/compliance/audit-trail` → compliance page renders.
- Open `http://localhost:3003/settings/payment-configuration` → settings page renders.

## 🌐 API Endpoints

### Customer Management
- `GET /api/Customers` - Get all customers (paginated)
- `GET /api/Customers/{id}` - Get customer by ID
- `POST /api/Customers` - Create new customer
- `PUT /api/Customers/{id}` - Update customer
- `DELETE /api/Customers/{id}` - Delete customer

### Property Management
- `GET /api/Properties` - Get all properties (paginated)
- `GET /api/Properties/{id}` - Get property by ID
- `POST /api/Properties` - Create new property
- `PUT /api/Properties/{id}` - Update property
- `DELETE /api/Properties/{id}` - Delete property

### Payment Plans
- `GET /api/PaymentPlans` - Get all payment plans (paginated)

## 🟦 PostgreSQL (Neon) Setup

You can run the backend against Neon PostgreSQL. Follow these steps:

1) Add your Neon connection string
- Put your Neon URI in `backend/PMS_APIs/appsettings.json` under `ConnectionStrings:DefaultConnection`.
- Also add it in `backend/PMS_APIs/appsettings.Development.json` so local runs use Neon.

Example:

```
{
  "ConnectionStrings": {
    "DefaultConnection": "Host=YOUR_HOST;Database=YOUR_DB;Username=YOUR_USER;Password=YOUR_PASS;Port=5432;SSL Mode=Require;Trust Server Certificate=true"
  }
}
```

2) Use Npgsql EF provider
- We already configure Npgsql in `Program.cs`:
  - `builder.Services.AddDbContext<PmsDbContext>(options => options.UseNpgsql(builder.Configuration.GetConnectionString("DefaultConnection")));`

3) Run the API
- From `backend/PMS_APIs`:
  - `dotnet run`
- Open Swagger: `http://localhost:5296/swagger`

4) Migrations vs existing schema
- If your Neon DB is empty: run `dotnet ef database update` to create tables.
- If tables already exist but with different names/columns:
  - MVP: use lightweight projections (as in `CustomersController.GetCustomers`) so list endpoints don’t join missing tables.
  - Enterprise: align EF models and migrations to your Neon schema, standardize table names (e.g., `customers`, `registration`, `payment_plans`), and apply migrations in CI.

5) Troubleshooting
- Error `42P01 relation "payment_plans" does not exist` means the table is missing.
  - Create the missing table via migrations or adjust EF mappings to match Neon.
  - For read-only lists, project to scalar fields to avoid navigation joins until schema is aligned.

6) Best practices
- Consistent naming: use snake_case table and column names.
- Environment configs: keep connection strings in `appsettings.*` and secrets in environment variables for production.
- Observability: enable EF Core logging and SQL output in Development.
- Performance: prefer `.AsNoTracking()` for read-heavy endpoints and project to DTOs.
- Security: enforce SSL to Neon and avoid storing plaintext secrets in source.

## 🔄 What Changed For Neon

- Switched EF Core provider from SQLite to Npgsql in `Program.cs`.
- Added Neon connection strings in both `appsettings.json` and `appsettings.Development.json`.
- Updated `CustomersController` list endpoint to return a lightweight payload from the `customers` table only, avoiding joins to missing tables.

## 📝 Notes

- Detail endpoints (e.g., `GET /api/Customers/{id}`) still include related entities. If Neon is missing those tables, either add them via migrations or temporarily remove `.Include(...)` calls until the schema is complete.
- Once the Neon schema is aligned, you can revert the list endpoint to use normal EF includes.
- `GET /api/PaymentPlans/{id}` - Get payment plan by ID
- `POST /api/PaymentPlans` - Create new payment plan
- `PUT /api/PaymentPlans/{id}` - Update payment plan
- `DELETE /api/PaymentPlans/{id}` - Delete payment plan

### User Authentication & Management
- `POST /api/Auth/register` - Register a new user
- `POST /api/Auth/login` - User login (returns JWT token)
- `GET /api/Auth` - Get all users (requires authentication)
- `GET /api/Auth/{id}` - Get user by ID (requires authentication)
- `PATCH /api/Auth/{id}/status` - Update user active status (requires authentication)

#### Authentication Examples

**User Registration**
```bash
# PowerShell
Invoke-WebRequest -Uri "http://localhost:5296/api/Auth/register" -Method POST -ContentType "application/json" -Body '{"fullName":"John Doe","email":"john.doe@example.com","password":"password123","roleId":"ADMIN","isActive":true}'
```

**User Login**
```bash
# PowerShell
Invoke-WebRequest -Uri "http://localhost:5296/api/Auth/login" -Method POST -ContentType "application/json" -Body '{"email":"john.doe@example.com","password":"password123"}'
```

**Response Format (Login)**
```json
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
  "expiresAt": "2025-11-04T16:24:07.6537178Z",
  "user": {
    "userId": "USR0000001",
    "fullName": "John Doe",
    "email": "john.doe@example.com",
    "roleId": "ADMIN",
    "isActive": true,
    "createdAt": "2025-11-03T16:23:32.8972004"
  }
}
```

**Using JWT Token for Protected Endpoints**
```bash
# PowerShell
$token = "your-jwt-token-here"
Invoke-WebRequest -Uri "http://localhost:5296/api/Auth" -Method GET -Headers @{"Authorization" = "Bearer $token"}
```

**Update User Status**
```bash
# PowerShell
$token = "your-jwt-token-here"
Invoke-WebRequest -Uri "http://localhost:5296/api/Auth/USR0000001/status" -Method PATCH -ContentType "application/json" -Body 'false' -Headers @{"Authorization" = "Bearer $token"}
```

### Additional Endpoints
- Allotments, Payments, Penalties, Waivers, Refunds, Transfers, NDCs, Possessions, Registrations

## 🔐 Authentication & Security

The API uses JWT (JSON Web Tokens) for authentication. Here's how it works:

1. **Register or Login** to get a JWT token
2. **Include the token** in the Authorization header for protected endpoints
3. **Token expires** after 24 hours (configurable)
4. **Protected endpoints** return 401 Unauthorized without valid token

### JWT Configuration
- **Issuer**: PMS_API
- **Audience**: PMS_Client
- **Expiration**: 24 hours
- **Algorithm**: HS256

### User Roles
- **ADMIN**: Full system access
- **USER**: Limited access (customizable)
- **MANAGER**: Property management access (customizable)

## 🚀 Getting Started

### Prerequisites
- Node.js (v16 or higher)
- .NET Core SDK 8.0
- Git

### Frontend Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd pms/frontend
   ```

2. **Install dependencies**
   ```bash
   npm install
   ```

3. **Start the development server**
   ```bash
   npm start
   ```

4. **Open your browser**
   Navigate to [http://localhost:3000](http://localhost:3000)

### Backend API Setup

1. **Navigate to the API directory**
   ```bash
   cd pms/backend/PMS_APIs
   ```

2. **Restore NuGet packages**
   ```bash
   dotnet restore
   ```

3. **Update the database**
   ```bash
   dotnet ef database update
   ```

4. **Start the API server**
   ```bash
   dotnet run
   ```

5. **API will be available at**
   [http://localhost:5296](http://localhost:5296)

### Full System Setup

1. **Start the backend API** (Terminal 1)
   ```bash
   cd pms/backend/PMS_APIs
   dotnet run
   ```

2. **Start the frontend** (Terminal 2)
   ```bash
   cd pms/frontend
   npm start
   ```

3. **Access the application**
   - Frontend: [http://localhost:3000](http://localhost:3000)
   - API: [http://localhost:5296](http://localhost:5296)

### Swagger & Alternate Frontend Port

- **Swagger UI** for API testing: [http://localhost:5296/swagger](http://localhost:5296/swagger)
- **Run frontend on a specific port (Windows PowerShell):**
  ```powershell
  cd pms/frontend
  $env:PORT=3001; npm start
  ```
- If you use `3001`, update CORS in `pms/backend/PMS_APIs/Program.cs`:
  ```csharp
  policy.WithOrigins("http://localhost:3000", "http://localhost:3001")
        .AllowAnyHeader()
        .AllowAnyMethod()
        .AllowCredentials();
  ```

## 🎨 Brand Guidelines

- **Primary Color**: #dd9c6b
- **Secondary Color**: #00234C
- **Font**: Lexend

## 📊 API Response Format

All API endpoints return data in a consistent format:

```json
{
  "data": [...],
  "totalCount": 0,
  "page": 1,
  "pageSize": 10,
  "totalPages": 0
}
```

### Customers Pagination Usage

- The frontend Customers page supports server-side pagination aligned with the API.
- Use the pager at the bottom to change `Rows per page` (10, 25, 50, 100) and navigate pages.
- Requests include `page` and `pageSize` query params and optional filters:

```http
GET /api/Customers?page=1&pageSize=50
GET /api/Customers?page=2&pageSize=50
GET /api/Customers?page=1&pageSize=25&status=Active
GET /api/Customers?page=1&pageSize=25&status=Blocked
GET /api/Customers?page=1&pageSize=25&status=Cancelled
GET /api/Customers?page=1&pageSize=25&allotment=allotted
GET /api/Customers?page=1&pageSize=25&allotment=unallotted
```

- If `REACT_APP_API_URL` is set, the frontend uses that as the API base; otherwise it defaults to `http://localhost:5296`.
- The grid shows "Showing X of Y customers" along with page navigation.

## 🧪 Testing the API

### Test Customer Creation
```bash
# PowerShell
Invoke-WebRequest -Uri "http://localhost:5296/api/Customers" -Method POST -Headers @{"Accept"="application/json"; "Content-Type"="application/json"} -Body '{"name":"John Doe","email":"john.doe@example.com","phone":"123-456-7890","address":"123 Main St","cnic":"12345-1234567-1"}'
```

### Test Customer Retrieval
```bash
# PowerShell
Invoke-WebRequest -Uri "http://localhost:5296/api/Customers" -Method GET -Headers @{"Accept"="application/json"}
```

## 🗄️ Database Configuration

The system currently uses SQLite for development and testing. To switch to PostgreSQL for production:

1. **Update connection string in `appsettings.json`**
2. **Change database provider in `Program.cs`**
   ```csharp
   builder.Services.AddDbContext<PmsDbContext>(options =>
       options.UseNpgsql(builder.Configuration.GetConnectionString("DefaultConnection")));
   ```

## 🔧 Development Guidelines

### Frontend
1. Follow the component structure for new features
2. Use styled-components for styling
3. Implement responsive design
4. Add proper documentation for new components
5. Follow React best practices and hooks guidelines

### Backend
1. Follow RESTful API conventions
2. Add proper error handling and validation
3. Use Entity Framework best practices
4. Add comprehensive logging
5. Follow .NET Core coding standards

## 🚀 Deployment

### Frontend Deployment
```bash
npm run build
# Deploy the build folder to your web server
```

### Backend Deployment
```bash
dotnet publish -c Release
# Deploy the published files to your server
```

## 🤝 Contributing

1. Create a feature branch
2. Make your changes
3. Test thoroughly
4. Submit a pull request

## 📝 License

This project is private and confidential.

---

## 📞 Support

For technical support or questions, please contact the development team.
- ### Customers Page

- Navigate via sidebar: `Customers → All Customers | Active Customers | Blocked Customers`
- Direct routes:
  - `http://localhost:3000/customers/all-customers`
  - `http://localhost:3000/customers/active-customers`
  - `http://localhost:3000/customers/blocked-customers`
- Data source: `GET /api/Customers` (optional `?status=Active|Blocked` if supported)
- JWT: If a token exists in `localStorage.jwt`, it is sent in `Authorization: Bearer <token>`.
#### Frontend Filters (Updated)
- Route filter: All / Active / Blocked.
- Dropdown filters:
  - Status: Active, Blocked, Cancelled.
  - Allotment Status (Neon DB `allotmentstatus`): Allotted, Not Allotted, Pending.
- The frontend sends `status` and `allotmentstatus` as query params when selected, and also applies client-side filtering to ensure results match even if the backend ignores filters.
#### Backend Filters (Updated)
- Endpoint `GET /api/Customers` accepts `allotmentstatus` and filters directly on `customers.allotmentstatus`.
- Supported values: `Allotted`, `Not Allotted`, `Pending`.
- Legacy param `allotment` is still accepted and mapped to `Allotted`/`Not Allotted`.
- No SQL joins to `allotments` are used for this list to avoid 42P01 errors.
## 🖱️ Customers Grid Interaction (New)

- Double-click any row in `Customers > All Customers` to open a detail modal.
- The modal fetches full details from `GET /api/Customers/{id}` and displays key fields.
- Styling follows brand: header uses `#dd9c6b`, content in `Lexend`.
- Close the modal by clicking outside or using the `Close` button.

### CustomersGrid Component

- Location: `frontend/src/components/CustomersGrid.js`
- Purpose: A reusable, branded grid for customers that supports server-side pagination and filtering (status, allotment), plus an on-demand detail modal.
- Props:
  - `title` (string): Heading text for the page (e.g., `"Customers: All Customers"`).
  - `defaultFilter` ("All" | "Active" | "Blocked"): Initial view filter applied on load.
- Usage:
  ```jsx
  import CustomersGrid from '../../components/CustomersGrid';

  export default function AllCustomers() {
    return <CustomersGrid title="Customers: All Customers" defaultFilter="All" />;
  }
  ```
- Server-side request format: `GET /api/Customers?page=<n>&pageSize=<m>&status=<Active|Blocked>&allotmentstatus=<Allotted|Not Allotted|Pending>`.
- Auth: Requests include `Authorization: Bearer <jwt>` if `localStorage.jwt` is set (via `fetchJson`).

### MVP vs Enterprise Approaches

- MVP (current):
  - Server-side pagination and basic filtering via query params.
  - Client-side fallback filtering to keep UI consistent if API ignores filters.
  - Simple modal detail fetch on double-click.
- Enterprise-grade (recommended for scale):
  - Virtualized rows (e.g., `react-window`) for large lists.
  - Debounced filter inputs and server-side search/sort endpoints.
  - Cache list and detail responses (e.g., React Query) with background revalidation.
  - Role-based column visibility and export (CSV/XLSX) with streaming.

### Best Practices
- Performance: paginate and virtualize long lists; avoid rendering offscreen rows.
- Maintainability: centralize API calls (`frontend/src/utils/api.js`) and keep grid generic.
- Security: send JWT via `Authorization` header; never store secrets in source.
- UX: consistent branding (`Lexend`, `#dd9c6b` primary, `#00234C` secondary) and compact controls.

### Frontend Implementation Notes
- Added `getCustomer(id)` in `frontend/src/utils/api.js`.
- Added `onDoubleClick` on table rows in `frontend/src/pages/Customers.js`.
- Uses a simple modal with backdrop; no external dependencies.

### Troubleshooting
- If details fail to load, ensure the API is running at `http://localhost:5296` and CORS allows `http://localhost:3000` (configured in `Program.cs`).
- Set `REACT_APP_API_URL` if your API runs elsewhere:
  ```powershell
  cd pms/frontend
  $env:REACT_APP_API_URL='http://localhost:5296'; npm start
  ```
#### Troubleshooting (Neon/PostgreSQL)
- Foreign key error `users_role_id_fkey` (code `23503`) during registration means the provided `roleId` does not exist in your Neon DB roles table.
  - Quick fix (MVP): omit `roleId` in the registration payload or set it to `null`. The API now gracefully retries save without `roleId` if this FK violation occurs.
  - Scalable option: create a `roles` table and insert valid roles (e.g., `ADMIN`, `USER`, `MANAGER`) that match your business rules, then keep `roleId` required and add validation.
  - Example registration without role:
    ```powershell
    Invoke-WebRequest -Uri "http://localhost:5296/api/Auth/register" -Method POST -ContentType "application/json" -Body '{"fullName":"QA Tester","email":"qa.tester@example.com","password":"1234","isActive":true}'
    ```
  - If you prefer to keep `roleId`, ensure the referenced role exists before registering.

#### Notes on Dev Initializers
- We removed the dev-only initializer that auto-created the `users` table at startup to keep production code clean. Use EF migrations or explicit SQL to manage schema.
- If your Neon DB is missing `users`, run migrations or create the table manually based on your schema design.

## 🔓 Frontend Login Troubleshooting

- Ensure the frontend is running at `http://localhost:3000` and the backend at `http://localhost:5296`.
- Set the API base URL explicitly in `frontend/.env.local`:
  
  ```bash
  REACT_APP_API_URL=http://localhost:5296
  ```
  
  Restart `npm start` after creating or changing `.env.local`.
- CORS is enabled for `http://localhost:3000` and `http://localhost:3001` in `backend/PMS_APIs/Program.cs`.
- Test login via PowerShell to verify credentials:
  
  ```powershell
  Invoke-WebRequest -Uri "http://localhost:5296/api/Auth/login" -Method POST -ContentType "application/json" -Body '{"email":"qa.tester@example.com","password":"1234"}'
  ```
- If the UI shows "Login failed", open the browser console and network tab:
  - 401 Unauthorized: wrong email/password or inactive user.
  - 500 Internal Server Error: backend issue (see `AuthController` logs).
  - CORS preflight failing: confirm origin is `localhost:3000` and backend is running.
- The frontend now stores auth robustly even if the backend returns PascalCase keys.

## 🌐 CORS for Multiple Frontend Ports (Updated)

- If you run the frontend on ports other than `3000`/`3001` (e.g., `3003`, `3007`, `3008`), add them to the backend CORS policy in `backend/PMS_APIs/Program.cs`:

  ```csharp
  builder.Services.AddCors(options =>
  {
      options.AddPolicy("ReactApp", policy =>
      {
          policy.WithOrigins(
              "http://localhost:3000",
              "http://localhost:3001",
              "http://localhost:3003",
              "http://localhost:3007",
              "http://localhost:3008"
          )
          .AllowAnyHeader()
          .AllowAnyMethod()
          .AllowCredentials();
      });
  });
  ```

- Restart the API after changes: `cd pms/backend/PMS_APIs && dotnet run`.
- Frontend uses `REACT_APP_API_URL` if set; otherwise defaults to `http://localhost:5296`.
