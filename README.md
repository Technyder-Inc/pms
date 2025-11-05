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
- Reduced the sidebar width from `280px` to `220px` to tighten the blue area and provide more space for main content.

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
