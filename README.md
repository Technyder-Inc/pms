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
- Customer management and trackings
- Payment plan management
- Property allotment and transfer system
- Interactive dashboards and reports
- Real-time updates

### New: All Properties Page (CRUD)
- Route: `http://localhost:3003/property/all-properties`
- Component: `frontend/src/pages/property/AllProperties.js`
- Grid: `frontend/src/components/PropertiesGrid.js` with filters, pagination, and modals
- Backend APIs: `/api/Properties` (list/create), `/api/Properties/{id}` (get/update/delete)

Quick usage
- Open the route above and use the status filter or search.
- Click “New Property” to add a record; required fields are minimal for MVP.
- Double‑click a row to view details; edit or delete via row actions.
- Pagination controls manage `page` and `pageSize` server‑side.

MVP vs Enterprise
- MVP: Local component state, direct API calls, simple modals.
- Enterprise: Central store (Context/Zustand/Redux), optimistic updates, audit logging, role‑based permissions, form validation, and undo/redo.

Notes
- Brand styling uses Lexend font and theme colors: primary `#dd9c6b`, secondary `#00234C`.
- If backend returns errors, ensure migrations are up‑to‑date and the `Property` table columns match EF model.

### New: Payment Plan Master–Detail Flow (Updated)
- Routes:
  - Plans list: `http://localhost:3003/schedule/payment-plans`
  - Plan details: `http://localhost:3003/schedule/payment-plans/<PlanId>`
  - Customer payments: `http://localhost:3003/payments/customer/<CustomerId>`
- Components:
  - `frontend/src/pages/schedule/PaymentPlanDetails.js` — shows only Schedule Payments for the selected plan (Child Schedules removed).
  - `frontend/src/pages/schedule/PaymentSchedules.js` — accepts `defaultPlanId` to pre-filter by Plan ID and fetches `/api/PaymentSchedules?planId=<PlanId>`.
  - `frontend/src/pages/payments/CustomerPayments.js` — lists and updates payments for a selected customer.
- Usage:
  - Open Plans list and click “View Details” to drill into a plan.
  - The details page shows only Schedule Payments tied to the selected `PlanId`.
  - From the details page, open a customer’s payments and edit via modal.
- MVP vs Enterprise:
  - MVP: Client-side filtering of customers by `PlanId`, direct calls to `/api/Payments`.
  - Enterprise: Add server-side `planId` filter in `CustomersController`, centralize state (Redux/Zustand), role-based permissions, and audit logging.

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

## 🖱️ Sidebar Interaction (Click-Only)

- Behavior: Sidebar groups expand/collapse only on click. Hover does not open groups.
- Active-route auto-open: When the current route is inside a module (e.g., `/customers/...`), that module remains expanded for context.
- Where to edit: `frontend/src/layouts/Sidebar.js` → `ModuleItem` component.

Example (click-only header):

```jsx
// In ModuleItem
<NavItem>
  <ModuleHeader onClick={() => setIsOpen(!isOpen)} isActive={isOpen}>
    {/* icon + label */}
  </ModuleHeader>
  <SubMenu isOpen={isOpen}>{/* sublinks */}</SubMenu>
</NavItem>
```

MVP vs Enterprise options
- MVP: Local `useState` per group (current implementation). Multiple groups can stay open; minimal code.
- Enterprise: Centralized state (Context/Zustand/Redux) to enforce single-open accordion, persist user preference, and instrument analytics on group toggles.

Verification
- Open `http://localhost:3003/dashboard`.
- Hover a group header → it should not open.
- Click a group header → it toggles open/closed; sublinks remain clickable.


## 📚 Sidebar Navigation (Expanded)

- The sidebar now reflects the full structure requested, grouped by modules with branded emoji labels and Lexend font.
- New groups and sub-links:
  - `🏠 DASHBOARD`: Home Overview
  - `📋 CUSTOMERS`: All Customers, Active Customers, Blocked Customers, Member Directory, Member Segments, Member Import/Bulk Actions
  - `🏘️ PROPERTY`: Projects, Inventory Status, Price Management, Availability Matrix
  - `💳 PAYMENTS`: Collections, Dues & Defaulters, Waivers & Adjustments, NDC Management, Refunds, Financial Ledger
  - `📅 SCHEDULE`: Payment Plans, Payment Schedules, Payment Schedule Editor, Bookings, Holds Management, Possession, Booking Approvals
  - `🔄 TRANSFER`: Transfer Requests, Transfer Approvals
  - `📊 REPORTS`: Sales Analytics, Collections Analytics, Dues Analysis, Possession Status, Transfer Summary, Custom Reports
  - `🤖 AI & AUTOMATION (NEW)`: Lead Scoring, Collection Prediction, Anomaly Detection, Automated Reminders, Smart Recommendations, Audit Trail (AI Actions)
  - `⚙️ SETTINGS`: Company Settings, Business Rules, Payment Configuration, Notification Rules, Users & Roles, Approval Workflows, System Configuration, Compliance Configuration (NEW)
  - `🔐 COMPLIANCE`: Audit Trail, Approval Queue, Compliance Events, Data Management, Risk Assessment, Policy Monitoring, Compliance Reports
  - `📞 SUPPORT & HELP`: Documentation, FAQs, Contact Support, System Status

Order update
- Under `📅 SCHEDULE`, `Payment Plans` and `Payment Schedules` are pinned at the top for quick access.
- Where to edit: `frontend/src/layouts/Sidebar.js` → `modules[...].sublinks` for the `SCHEDULE` group.
- Verify: Open `http://localhost:3024/schedule/payment-plans` and confirm these links appear first.

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

## 📊 Dashboard Summary (Static)

- The dashboard shows summary KPIs with brand styling: Total Customers, Paid Customers, Blocked Customers, Active Customers.
- Static values are used for MVP. Edit the `metrics` array in `frontend/src/pages/Dashboard.js` to change numbers.

Where to edit
- `frontend/src/pages/Dashboard.js` → update the `metrics` array and card labels.

Quick verification
- Open `http://localhost:3003/dashboard` and confirm four branded cards render with Lexend font and colors (primary `#dd9c6b`, secondary `#00234C`).

Approaches
- MVP: Static values in the `metrics` array; fast to ship; no API calls.
- Enterprise: Fetch counts from backend endpoints (e.g., `/api/Customers/stats`) with caching, skeleton loading states, and role-based visibility. Consider server-side aggregation and rate limiting.

### 📊 Dashboard Graphs (Bar + Pie)

- Two graphs render side-by-side under the summary cards: a bar chart and a pie chart.
- Bar chart shows monthly paid customers; pie chart shows status distribution.
- Both use inline SVG, Lexend font, and brand colors (primary `#dd9c6b`, secondary `#00234C`).

Where to edit
- `frontend/src/pages/Dashboard.js`
  - Update `barData` for months and values (e.g., `{ label: 'Nov', value: 805 }`).
  - Update `pieData` for segment labels, values, and colors.

Code examples
```js
// Bar chart data
const barData = [
  { label: 'May', value: 620 },
  { label: 'Jun', value: 660 },
  { label: 'Jul', value: 700 },
  { label: 'Aug', value: 720 },
  { label: 'Sep', value: 750 },
  { label: 'Oct', value: 780 },
];

// Pie chart data
const pieData = [
  { label: 'Paid', value: 780, color: '#dd9c6b' },
  { label: 'Active', value: 950, color: '#00234C' },
  { label: 'Blocked', value: 32, color: '#888888' },
];
```

Quick verification
- Open `http://localhost:3003/dashboard` → confirm two charts appear side-by-side.
- Resize the browser to confirm they stack on small screens.

Approaches
- MVP: Inline SVG charts with static arrays (`barData`, `pieData`); zero dependencies.
- Enterprise: Use `chart.js` or `echarts` with live data from a backend stats endpoint, tooltips, legends, animations, and accessibility features. Add loading states and caching.

## 🌐 API Endpoints

### Customer Management
- `GET /api/Customers` - Get all customers (paginated)
- `GET /api/Customers/{id}` - Get customer by ID
- `POST /api/Customers` - Create new customer
- `PUT /api/Customers/{id}` - Update customer
- `DELETE /api/Customers/{id}` - Delete customer
 
#### Editing Customers (Frontend UI)

- Open `http://localhost:3003/customers/all-customers`.
- Double‑click a row to open the customer detail modal.
- Click `Edit` to enable fields like Full Name, Email, Phone, CNIC, Gender, Status, City, Country, Reg ID, Plan ID.
- Click `Save Changes` to persist. The grid and detail update immediately after a successful save.

API example (PUT):

```powershell
# Replace CUST000123 with a real ID from your list
$body = '{
  "CustomerId": "CUST000123",
  "FullName": "Updated Name",
  "Email": "updated@example.com",
  "Phone": "+92-300-0000000",
  "Cnic": "35202-1234567-1",
  "Gender": "Male",
  "Status": "Active",
  "City": "Lahore",
  "Country": "Pakistan",
  "RegId": "REG-88",
  "PlanId": "PLAN-12"
}'
Invoke-WebRequest -Method PUT -Uri http://localhost:5296/api/Customers/CUST000123 -ContentType 'application/json' -Body $body | Select-Object -ExpandProperty Content
```

Notes
- The backend is case‑insensitive for JSON keys; the UI sends PascalCase keys.
- If you see `Customer ID mismatch`, ensure `CustomerId` in the payload matches the `{id}` path.
- Brand styling: Lexend font, primary `#dd9c6b`, secondary `#00234C`.

### Property Management
- `GET /api/Properties` - Get all properties (paginated)
- `GET /api/Properties/{id}` - Get property by ID
- `POST /api/Properties` - Create new property
- `PUT /api/Properties/{id}` - Update property
- `DELETE /api/Properties/{id}` - Delete property

### Payment Plans
- `GET /api/PaymentPlans` - Get all payment plans (paginated)

### Schedule Manager (Child Schedules)
- Route: `http://localhost:3001/schedule/payment-plans/<PlanId>`
- Component: `frontend/src/pages/schedule/ScheduleManager.js`
- Purpose: Manage child payment schedules under a parent payment plan.

### Payment Plan Details (Updated)
- Route: `/schedule/payment-plans/:planId`
- Component: `frontend/src/pages/schedule/PaymentPlanDetails.js`
- Change: Removed customer details section. The page now focuses on schedules.
- Sections on the page:
  - Child Schedules — manage schedules for the plan.
  - Schedule Payments — table of payment schedules filtered by the current `planId`.

Verification steps
- Open `http://localhost:3024/schedule/payment-plans` and click “View Details” on a plan.
- Confirm the details page shows schedule payments below and no customer details.
- Backend APIs:
  - `GET /api/PaymentSchedules?planId=<PlanId>&page=<n>&pageSize=<m>` — list schedules for a plan
  - `GET /api/PaymentSchedules/<ScheduleId>` — get a single schedule
  - `POST /api/PaymentSchedules` — create a schedule
  - `PUT /api/PaymentSchedules/<ScheduleId>` — update a schedule
  - `DELETE /api/PaymentSchedules/<ScheduleId>` — delete a schedule

Usage
- Open a plan detail route and use the “Add Schedule” button to create child entries.
- Use search to filter by `ScheduleId` or `PaymentDescription`.
- Edit and delete via row actions in the grid; pagination controls manage `page` and `pageSize`.

Request examples

```powershell
# Create a schedule (PowerShell)
$body = '{
  "PlanId": "PLAN001",
  "PaymentDescription": "Installment 1",
  "InstallmentNo": 1,
  "DueDate": "2025-12-01",
  "Amount": 50000,
  "SurchargeApplied": true,
  "SurchargeRate": 0.05,
  "Description": "First installment"
}'
Invoke-RestMethod -Method Post -Uri http://localhost:5296/api/PaymentSchedules -ContentType 'application/json' -Body $body

# Update a schedule
$update = '{
  "ScheduleId": "PS0000001",
  "PlanId": "PLAN001",
  "PaymentDescription": "Installment 1 (updated)",
  "Amount": 52000,
  "SurchargeApplied": true,
  "SurchargeRate": 0.05
}'
Invoke-RestMethod -Method Put -Uri http://localhost:5296/api/PaymentSchedules/PS0000001 -ContentType 'application/json' -Body $update

# Delete a schedule
Invoke-RestMethod -Method Delete -Uri http://localhost:5296/api/PaymentSchedules/PS0000001
```

Frontend helpers
- `frontend/src/utils/api.js` provides typed helpers with function-level docs:
  - `getPaymentSchedules(params)`
  - `getPaymentSchedule(id)`
  - `createPaymentSchedule(payload)`
  - `updatePaymentSchedule(id, payload)`
  - `deletePaymentSchedule(id)`

Branding & UX
- Uses Lexend font and theme colors: primary `#dd9c6b`, secondary `#00234C`.
- Modal headers use primary; table headers use light gray background with secondary text.
- Compact layout mirrors the Customers module for consistency.

MVP vs Enterprise
- MVP: Local state, direct API calls, simple modals and client-side search.
- Enterprise: Server-side filtering and pagination; optimistic UI updates; role-based auth; audit logging; standardized error and toast system; form validation; and performance instrumentation.

Setup notes
- Ensure the backend is running: `cd pms/backend/PMS_APIs && dotnet run --launch-profile http` → `http://localhost:5296`.
- Ensure the frontend is running: `cd pms/frontend && npm start` → `http://localhost:3001`.
- If `REACT_APP_API_URL` is set, the frontend uses it as the API base; otherwise it defaults to `http://localhost:5296`.

Verification
- Open `http://localhost:3001/schedule/payment-plans/PLAN001`.
- Confirm child schedules load, pagination works, and add/edit/delete mutate rows correctly.
- Check dev server console for warnings; fix unused variables and dependency warnings where relevant.

### Authentication (Email-Based)

- `POST /api/Auth/login` — Authenticate using email (password optional)

Request body examples:

```
// Standard email + password
{
  "email": "ali@example.com",
  "password": "yourPassword123"
}

// Email-only (if backend supports it)
{
  "email": "ali@example.com"
}
```

Response body example:

```
{
  "token": "<JWT>",
  "expiresAt": "2025-11-07T15:47:57.5432602Z",
  "user": {
    "userId": "USR8888069",
    "fullName": "Ali",
    "email": "ali@example.com",
    "roleId": null,
    "isActive": true,
    "createdAt": "2025-11-05T15:40:37.576461"
  }
}
```

Frontend integration:
- The login form at `frontend/src/pages/Login.js` displays `Email` and `Password` fields, aligned with brand font `Lexend` and colors (primary `#dd9c6b`, secondary `#00234C`).
- The client calls `login(email, password)` from `frontend/src/utils/api.js`.
- If `password` is left empty, the client sends only `{ email }` (requires backend support).
- On success, the app stores `jwt`, `jwt_expires`, and `user` in `localStorage` and redirects to `/dashboard`.

### Login Behavior (MVP Plaintext Support — Updated)

- The backend login supports plaintext password verification when a legacy `users.password` column exists.
- If `users.password` is present, the API matches the provided password exactly (trimmed). If it matches, login succeeds.
- If no `users.password` is available but `users.password_hash` exists, the API verifies the hash and allows login on match.
- If neither is available, the API falls back to email-only login (MVP) and allows access if the email exists.

#### Payload Update
- The `Password` field is optional for login in development/MVP. If you leave the password empty in the UI, the client only sends `{ email }` to avoid backend validation on empty strings.
- For enterprise deployments, require a non-empty password and enforce minimum length + complexity.

Where to edit
- `backend/PMS_APIs/Controllers/AuthController.cs` → `Login` endpoint implements plaintext fallback and raw SQL email lookup.

Quick test (PowerShell)
```powershell
# Email-only (when password is not required in MVP)
$body = @{ email = 'admin@technyder.co' } | ConvertTo-Json
Invoke-RestMethod -Method Post -Uri 'http://localhost:5296/api/Auth/login' -ContentType 'application/json' -Body $body | ConvertTo-Json -Depth 5

# Email + password (when password exists, plaintext or hash)
$body = @{ email = 'admin@technyder.co'; password = 'technyderteam' } | ConvertTo-Json
Invoke-RestMethod -Method Post -Uri 'http://localhost:5296/api/Auth/login' -ContentType 'application/json' -Body $body | ConvertTo-Json -Depth 5
```

Troubleshooting 401
- Ensure the user record exists in the `users` table. If not, create via:
```powershell
$body = @{ fullName = 'Admin'; email = 'admin@technyder.co'; password = 'technyderteam'; isActive = $true } | ConvertTo-Json
Invoke-RestMethod -Method Post -Uri 'http://localhost:5296/api/Auth/register' -ContentType 'application/json' -Body $body
```
- Normalize inputs: emails compared in lowercase and trimmed; passwords are trimmed.
- If your DB only has a `password` column and no `password_hash`, the login still works via plaintext fallback.

Quick verification:
- Start frontend: `cd pms/frontend && npm start` → open `http://localhost:3000/login`.
- Enter an email and optionally a password, press `Sign In`.
- Confirm navigation to `/dashboard` and that `localStorage.jwt` is present.

Environment variables:
- Set `REACT_APP_API_URL` in the frontend as needed. Defaults to `http://localhost:5296`.
- Example: `set REACT_APP_API_URL=http://localhost:5296` when starting the React dev server.

Best practices:
- MVP: Accept email-only login for internal/test environments; add rate limiting.
- Enterprise: Require password (hashed via BCrypt), enforce minimum complexity, add account lockout for repeated failures, implement refresh tokens with short-lived access tokens, and audit login attempts.


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

### Troubleshooting: Initial migration fails with existing tables

If `dotnet ef database update` fails with errors like `42P07: relation "customers" already exists`, it means your database has some tables created manually or from a prior script, and the EF migration history table (`__EFMigrationsHistory`) is missing.

Quick fix (MVP): create only the missing tables manually, then run the API.

- Example: create the `properties` table to resolve `relation "properties" does not exist`:

```
-- Create table if missing (Neon/PostgreSQL)
CREATE TABLE IF NOT EXISTS properties (
  property_id VARCHAR(10) PRIMARY KEY,
  project_name VARCHAR(100),
  sub_project VARCHAR(100),
  block VARCHAR(50),
  plot_no VARCHAR(50),
  size VARCHAR(50),
  category VARCHAR(50),
  type VARCHAR(50),
  location VARCHAR(255),
  price NUMERIC(15,2),
  status VARCHAR(50) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL,
  description TEXT,
  features TEXT,
  coordinates VARCHAR(100),
  facing VARCHAR(50),
  corner BOOLEAN,
  park_facing BOOLEAN,
  main_road BOOLEAN
);

CREATE INDEX IF NOT EXISTS IX_properties_project_name_block_plot_no
  ON properties (project_name, block, plot_no);
```

#### Seed Sample Properties (Local Testing)

Populate the grid quickly with sample data via the API. With backend on `http://localhost:5296` and frontend on `http://localhost:3004`, run:

```powershell
$properties = @(
  @{ ProjectName = 'Sunrise Villas'; Block = 'A'; PlotNo = 'A-12'; Size = '10 Marla'; Location = 'Near Park'; Price = 6500000 },
  @{ ProjectName = 'Sunrise Villas'; Block = 'B'; PlotNo = 'B-07'; Size = '1 Kanal'; Location = 'Main Boulevard'; Price = 14500000 },
  @{ ProjectName = 'Emerald Heights'; Block = 'C'; PlotNo = 'C-30'; Size = '5 Marla'; Location = 'Corner'; Price = 4200000 },
  @{ ProjectName = 'Emerald Heights'; Block = 'C'; PlotNo = 'C-31'; Size = '5 Marla'; Location = 'Opposite Park'; Price = 4100000 }
);
foreach ($p in $properties) {
  $json = $p | ConvertTo-Json -Compress;
  Invoke-WebRequest -Method POST -Uri http://localhost:5296/api/Properties -ContentType 'application/json' -Body $json | Out-Null;
}

# Verify list
Invoke-WebRequest -Method GET http://localhost:5296/api/Properties -Headers @{ Origin = 'http://localhost:3004' } | Select-Object -ExpandProperty Content
```

You should see `data` with 4 items and pagination meta.

Enterprise option: reconcile EF migrations with the existing database.

- Add `__EFMigrationsHistory` and mark already-applied migrations as applied.
- Alternatively, generate a tailored SQL script: `dotnet ef migrations script` and edit out statements for already-existing tables, then run the script.
- Add a lightweight startup check to ensure critical tables exist and alert when out-of-sync (do not auto-create in production).

Best practices:
- Keep one authoritative migration path (EF) for consistent schema evolution.
- Avoid mixing manual DDL with EF migrations on the same DB unless you document and track changes.
- Use staging databases to test migrations before applying to production.
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

## UI Update: Sidebar Navigation

- Hidden modules: `COMPLIANCE` and `SUPPORT & HELP` (bottom of the sidebar).
- Reason: Requested to simplify navigation by removing non-essential bottom links for now.
- Where: `frontend/src/layouts/Sidebar.js` — filtered by label using `hiddenLabels`.

Example:

```js
// Sidebar.js
// Hidden labels set used to filter out modules from rendering
const hiddenLabels = new Set(['COMPLIANCE', 'SUPPORT & HELP']);

// ...
<NavList>
  {modules
    .filter(m => !hiddenLabels.has(m.label))
    .map((m, index) => (
      <ModuleItem
        key={index}
        label={m.label}
        slug={m.slug}
        icon={m.icon}
        sublinks={m.sublinks}
      />
  ))}
</NavList>
```

Re-enable later:
- Remove labels from `hiddenLabels` or delete the filter to show all modules again.

Brand alignment:
- Font: `Lexend` is used throughout the sidebar.
- Colors: primary `#dd9c6b`, secondary `#00234C`.

### Hover Behavior (New)

- Modules now open on hover: moving the cursor over a module header expands its submenu.
- Sublinks animate forward on hover: each link slides slightly to the right and shows a subtle `›` indicator.

Implementation notes:
- File: `frontend/src/layouts/Sidebar.js`
- Module hover-open: attach `onMouseEnter`/`onMouseLeave` to the module container and keep open when navigating inside the module.
- Sublink forward-slide:

```js
const StyledNavLink = styled(NavLink)`
  position: relative;
  transition: transform 0.15s ease, background-color 0.15s ease;
  &:hover { transform: translateX(6px); }
  &::after {
    content: '›';
    position: absolute; right: 8px; top: 50%;
    transform: translateY(-50%) translateX(-4px);
    opacity: 0; color: ${p => p.theme.colors.primary};
    transition: transform 0.15s ease, opacity 0.15s ease;
  }
  &:hover::after { opacity: 1; transform: translateY(-50%) translateX(0); }
`;
```

MVP vs Enterprise:
- MVP: static hover behavior as implemented; minimal code changes.
- Enterprise: drive hover/expand behavior from a global navigation config, allow per-role visibility and interaction settings, and add motion-reduced variants for accessibility.

### Collapsed Icons (New)

- When the sidebar is collapsed, it shows an icon-only rail similar to GitHub.
- Clicking an icon navigates to its primary route (e.g., `DASHBOARD → /dashboard`, `CUSTOMERS → /customers/all-customers`).
- Toggle control: the arrow button at the top switches between collapsed and expanded states.

Where to edit
- `frontend/src/layouts/Layout.js` — sets the grid column widths to `64px` collapsed and `280px` expanded and passes `isCollapsed` to `Sidebar`.
- `frontend/src/layouts/Sidebar.js` — renders icons-only when `isCollapsed` is true.

Implementation notes
- The sidebar container adapts to grid width and centers icons when collapsed.
- Collapsed icon links use brand colors and simple hover feedback.

Example: collapsed rendering

```js
// Layout.js
<Shell $sidebarHidden={isSidebarHidden}>
  <SidebarArea>
    <Sidebar isCollapsed={isSidebarHidden} onToggleLinksBar={handleToggleLinksBar} />
  </SidebarArea>
  {/* ... */}
</Shell>

// Sidebar.js
const CollapsedIconLink = styled(NavLink)`
  width: 40px; height: 40px; border-radius: 8px;
  display: inline-flex; align-items: center; justify-content: center;
  color: #ffffff; text-decoration: none;
  transition: background-color 0.15s ease, transform 0.15s ease;
  &:hover { background-color: rgba(221, 156, 107, 0.18); transform: translateX(2px); }
  &.active { background-color: rgba(221, 156, 107, 0.25); }
`;
```

Verification
- Start the frontend and collapse the sidebar with the top arrow.
- Confirm the icon rail stays visible and icons navigate correctly.
- Expanded state shows full labels and sublinks with hover-open behavior.

Options
- MVP: icon-only rail with click navigation and simple tooltips (`title` attribute).
- Enterprise: add floating flyout panels showing module titles and sublinks on hover, keyboard accessibility, and role-based visibility.

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

### Legacy Plaintext Passwords (Login Compatibility)

Some databases store passwords as plaintext (e.g., `1234`) instead of hashes.
The login endpoint supports plaintext across common columns without requiring a schema change:

- Accepts plaintext stored in `users.password`, `users.passwordhash`, or `users.password_hash`.
- If a hashed value exists (`password_hash`/`passwordhash`), it verifies using the hash first.

Troubleshooting a `401: Invalid email or password`:
- Ensure the user exists and `is_active = TRUE`.
- Normalize email (lowercase, no spaces) and password (trim spaces).
- Backend now trims stored emails during lookup to avoid trailing/leading-space mismatches:
  - If you manually inserted users and the `email` column contains spaces, login will still work.
  - If a specific email still fails, re-register that user via `POST /api/Auth/register` to ensure a clean record.
- If only a `password` column exists, login still works. For production, migrate to hashed passwords via the registration flow or a one-off script.

- Clear browser storage (`localStorage`: `jwt`, `jwt_expires`, `user`) and retry.

Quick re-test (PowerShell):
```powershell
Invoke-WebRequest -Uri "http://localhost:5296/api/Auth/register" -Method POST -ContentType "application/json" -Body '{"fullName":"Ayesha Khan","email":"ayesha.khan@example.com","password":"1234","isActive":true}'
Invoke-WebRequest -Uri "http://localhost:5296/api/Auth/login" -Method POST -ContentType "application/json" -Body '{"email":"ayesha.khan@example.com","password":"1234"}'
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

You can switch between SQLite (local file) and PostgreSQL (Neon) without code changes. Set the provider and connection string in `backend/PMS_APIs/appsettings.Development.json`.

1. **Choose provider**
   - Set `DatabaseProvider` to `"Postgres"` or `"Sqlite"`.
   - Example:
     ```json
     {
       "DatabaseProvider": "Postgres",
       "ConnectionStrings": {
         "DefaultConnection": "Host=YOUR_HOST;Database=YOUR_DB;Username=YOUR_USER;Password=YOUR_PASS;Port=5432;SSL Mode=Require;Trust Server Certificate=true"
       }
     }
     ```
     ```json
     {
       "DatabaseProvider": "Sqlite",
       "ConnectionStrings": {
         "DefaultConnection": "Data Source=pms_test.db"
       }
     }
     ```

2. **What the app uses**
   - `Program.cs` selects the provider at startup based on `DatabaseProvider` and wires up EF accordingly.
   - No other changes are required.

3. **Verify Payment Plans record count**
   - After starting the backend, run:
     ```powershell
     Invoke-RestMethod -Uri "http://localhost:5296/api/PaymentPlans?page=1&pageSize=1000" | ConvertTo-Json -Depth 6
     ```
   - Confirm `totalCount` matches your `payment_plan` table. If the count is lower than expected, the API is pointing at a different database. Update `DatabaseProvider` and `ConnectionStrings:DefaultConnection` to target the DB that holds your data.

4. **Frontend display (no joins)**
   - The grid under `Schedule > Payment Plans` reads the `PaymentPlan` table only and requests `pageSize=1000` to show all rows from the chosen database.
   - If you still see fewer rows, verify the backend API response as above and adjust the connection string.

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

### Inline Child Schedules (New)
- Feature: Clicking a `Plan ID` in the customers grid expands a child table showing payment schedules for that plan.
- UI Changes:
  - A new `Plan ID` column is added to `frontend/src/components/CustomersGrid.js`.
  - Clicking the `Plan ID` toggles an inline child grid rendered right below the row.
- Implementation:
  - Reuses `frontend/src/pages/schedule/PaymentSchedules.js` and passes `defaultPlanId`.
  - Safe key mapping for mixed schemas: uses `c.PlanId ?? c.planId` from customer rows.
  - Brand styling: link uses `#dd9c6b` (primary) with `Lexend` font, content uses `#00234C`.
- Backend Dependency:
  - Child grid fetches data via `GET /api/PaymentSchedules?page=<n>&pageSize=<m>&planId=<PLAN001>`.
  - Works with column variants: `PlanId` or `planid` in the schedules table.
- Usage:
  - Navigate to `Customers: All Customers` and click any visible `Plan ID` to expand.
  - Click again to collapse. Double-click the row still opens the detail modal.
- Troubleshooting:
  - If the `Plan ID` displays as `—`, the customer record has no plan linked or the key is missing.
  - If the child grid shows “No payment schedules found”, verify schedules exist for the given plan and the backend endpoint is reachable.
  - Ensure `PaymentSchedules` endpoint supports `planId` query param (case-insensitive).

Example (simplified):
```jsx
// CustomersGrid row cell
const planId = c.PlanId ?? c.planId;
<span
  role="button"
  onClick={(e) => { e.stopPropagation(); handlePlanClick(rowId, planId); }}
  style={{ color: '#dd9c6b', textDecoration: 'underline', cursor: 'pointer' }}
>
  {toText(planId)}
</span>

// Expanded child row
{isExpanded && expandedPlanId && (
  <tr>
    <td colSpan={8}>
      <PaymentSchedules defaultPlanId={expandedPlanId} />
    </td>
  </tr>
)}
```

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

### Login Normalization & Common 401 Causes (Updated)

- Backend login explicitly allows anonymous: `AuthController.Login` has `[AllowAnonymous]` so it is reachable without a token.
- Inputs are normalized to avoid whitespace/casing issues:
  - Email: `trim().toLowerCase()` before lookup
  - Password: `trim()` before verification
- Frontend `fetchJson` no longer sends `Authorization` for `/api/Auth/login` and `/api/Auth/register`, preventing stale/invalid JWTs from interfering with auth.
- Frontend `login(email, password)` trims both values before sending.

If you still get 401 for a specific user:
- Confirm the user exists and is active:
  - Log in with a working account, then call `GET /api/Auth` with your JWT to inspect `isActive`.
- Ensure the stored password was created by the API’s registration flow.
  - Records inserted manually or hashed with a different algorithm/salt won’t verify.
  - Quick fix: update the user’s password via `register` endpoint (unique email required) or implement an admin reset.
- Watch for trailing spaces in the password; trimming fixes most input mismatch issues.

Example re-test (PowerShell):
```powershell
Invoke-WebRequest -Uri "http://localhost:5296/api/Auth/login" -Method POST -ContentType "application/json" -Body '{"email":"second.user@example.com","password":"1234"}'
```

Best practices:
- Prefer BCrypt for hashing per-user with unique salts (production).
- Auto-migrate legacy plaintext passwords on successful login (already supported).
- Add a password reset flow and admin deactivation/activation tools.

## 🔒 Route Protection (Login Required)

- All application pages (dashboard, customers, modules, settings, etc.) are protected behind an auth guard.
- Unauthenticated users are redirected to `http://localhost:3007/login`.
- The guard checks for a JWT in `localStorage.jwt` and preserves the intended path (for post-login redirect).

Where to edit
- `frontend/src/components/RequireAuth.js` – route guard component.
- `frontend/src/App.js` – wraps protected routes with `RequireAuth` and defaults index to `/login`.

How it works
- `RequireAuth` uses React Router’s `<Outlet />` for nested protected routes.
- If `localStorage.jwt` is missing, it returns `<Navigate to="/login" state={{ from: location }} replace />`.
- On successful login, navigate back to `state.from` or a default route (e.g., `/dashboard`).

Quick verification
- Clear token: open DevTools → Application → Local Storage → remove `jwt`.
- Visit `http://localhost:3007/customers/all-customers` → you should be redirected to `/login`.
- Log in → you should navigate to Dashboard or back to the original page.

Best practices
- Decode JWT and check expiry; auto-logout when expired.
- Persist session securely; avoid storing sensitive user info in localStorage.
- Use role-based route guards for admin-only sections.

## 🌐 CORS for Multiple Frontend Ports (Updated)

- If you run the frontend on ports other than `3000`/`3001` (e.g., `3003`, `3004`, `3007`, `3008`), add them to the backend CORS policy in `backend/PMS_APIs/Program.cs`:

  ```csharp
  builder.Services.AddCors(options =>
  {
      options.AddPolicy("ReactApp", policy =>
      {
          policy.WithOrigins(
              "http://localhost:3000",
              "http://localhost:3001",
              "http://localhost:3003",
              "http://localhost:3004",
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
### Top Bar: User Name & Logout (New)
- Displays the logged-in user’s name: `Logged in as: <Fullname>`.
- Shows initials avatar derived from the name.
- Adds a `Logout` button that clears auth and redirects to `/login`.

Where to edit
- `frontend/src/layouts/TopBar.js` – reads `localStorage.user` and renders fullname; adds logout.
- `frontend/src/utils/api.js` – login persists `{ token, expiresAt, user }` to `localStorage`.

Backend expectations
- Login response should include a `user` object with a `fullname` field (or `fullName`/`Fullname`).
- The frontend gracefully falls back to `name` or `firstName + lastName` if `fullname` is missing.

Quick verification
- Log in at `http://localhost:3007/login`.
- Open `http://localhost:3007/dashboard` or `http://localhost:3007/customers/all-customers`.
- Confirm the top bar shows your name and the `Logout` button works.

## 🖼️ Sidebar Vector Icons (New)

- Change: Replaced emoji module labels with SVG vector icons using `react-icons/fi` for a clean, scalable look aligned with brand.
- Brand: Icons use brand primary `#dd9c6b` on a brand secondary `#00234C` sidebar background; font remains `Lexend`.

How it works
- Each module now includes an `icon` property that points to a Feather icon (e.g., `FiUsers`).
- The `ModuleItem` renders the icon before the module label and keeps the collapse chevron on the right.

Code reference
```jsx
// frontend/src/layouts/Sidebar.js
import { FiUsers } from 'react-icons/fi';

// Module config
const modules = [
  { label: 'CUSTOMERS', slug: 'customers', icon: FiUsers, sublinks: [ /* ... */ ] },
];

// ModuleItem signature and render
/**
 * ModuleItem
 * Purpose: Render a top-level sidebar module with collapsible sublinks.
 * Inputs:
 *  - label: display string (e.g., 'CUSTOMERS')
 *  - slug: base path for routing (e.g., 'customers')
 *  - sublinks: array of { label, path } items
 *  - icon: React component for vector icon (e.g., FiUsers)
 * Outputs: Collapsible section with NavLink items.
 */
const ModuleItem = ({ label, slug, sublinks, icon: Icon }) => (
  <ModuleHeader>
    <HeaderLeft>
      {Icon && <IconBox><Icon size={18} /></IconBox>}
      <span>{label}</span>
    </HeaderLeft>
    {/* chevron */}
  </ModuleHeader>
);
```

Verify
- Start frontend: `cd pms/frontend && npm start`
- Open `http://localhost:3000/` and confirm vector icons appear next to module labels.

Notes
- `react-icons` is already used for chevrons; adding Feather icons (`react-icons/fi`) keeps bundle small and consistent.
- Icons render as SVGs, ensuring crisp visuals on all DPI scales.

### Sidebar UX Tweaks (Updated)
- Icon color changed to white for better contrast on `#00234C`.
- Reduced link spacing and padding for a denser, more scannable menu.
- Enabled vertical scrolling in the sidebar so all bottom modules are visible.

Code refs
- `frontend/src/layouts/Sidebar.js`
  - `SidebarContainer`: `overflow-y: auto` and `overscroll-behavior: contain`.
  - `IconBox`: `color: #ffffff`.
  - `NavItem`: `margin-bottom: 0.25rem`.
  - `SubMenu`: reduced `padding-left` and `margin-top`.
  - `StyledNavLink`: compact `padding` and font size.

### Sidebar Hide/Unhide Toggle (New)
- Adds a small button at the top of the links bar to hide/unhide the sidebar.
- When hidden, a slim vertical handle remains on the left with an icon-only chevron; click it to unhide.
- Styling follows brand: primary `#dd9c6b`, secondary `#00234C`, font `Lexend`.

Where to edit
- `frontend/src/layouts/Layout.js` – maintains `isSidebarHidden` state and collapses the grid to `12px` when hidden; shows the vertical “Show Links” handle.
- `frontend/src/layouts/Sidebar.js` – renders a `Hide Links` button at the top to toggle the links bar.

Code reference
```jsx
// Layout.js
/** Layout
 * Purpose: Render a two-column app shell with a hide/unhide toggle for the links bar.
 * Inputs: None.
 * Outputs: Sidebar (can be collapsed), TopBar, and routed content.
 */
const [isSidebarHidden, setIsSidebarHidden] = useState(false);
<Shell $sidebarHidden={isSidebarHidden}>
  <SidebarArea>
    {isSidebarHidden ? (
      <CollapsedHandle aria-label="Open sidebar" onClick={() => setIsSidebarHidden(false)}>
        <FiChevronRight size={16} />
      </CollapsedHandle>
    ) : (
      <Sidebar onToggleLinksBar={() => setIsSidebarHidden(s => !s)} />
    )}
  </SidebarArea>
```

```jsx
// Sidebar.js
/** Sidebar
 * Inputs:
 *  - onToggleLinksBar: function to hide/unhide the links bar
 */
<ToggleRow>
  <ToggleButton aria-label="Close sidebar" title="Close sidebar" onClick={onToggleLinksBar}>
    <FiChevronLeft size={16} />
  </ToggleButton>
 </ToggleRow>
```

Quick verification
- Start frontend: `cd pms/frontend && npm start`
- Open `http://localhost:3000/`.
- Click `Hide Links` in the sidebar; the links bar collapses to a slim handle.
- Click the vertical `Show Links` handle to restore the sidebar.

### Sidebar Colors & Sizes (Adjusted)
- Active sublink uses a subtle brand tint instead of a full solid block:
  - Active: background `rgba(221, 156, 107, 0.18)`, text `#dd9c6b`, left border accent `3px`.
  - Hover: background `rgba(221, 156, 107, 0.12)`.
- Submenu link font size restored to `0.83rem` (as before), with compact padding.
- Module heading labels (Dashboard, Customers, Property…) reduced to `0.8rem` for a cleaner hierarchy.
- “Hide Links” button is now a ghost style (transparent) with primary border; on hover it fills with primary.

Where to edit
- `frontend/src/layouts/Sidebar.js`
  - `StyledNavLink`: active/hover colors and smaller font size.
  - `ToggleButton`: ghost style with brand primary and hover fill.

Quick verification
- With the app running at `http://localhost:3000`, navigate the sidebar:
  - Hover a sublink and confirm the subtle brand tint.
  - Click a sublink; confirm active text color and left accent.
  - Confirm the “Hide Links” button shows a ghost style and fills on hover.

## 🔐 Email-Only Login (Temporary MVP)

- Change: Login now authenticates solely by email existence. Password is ignored and no database writes occur during login.
- Impact: Immediate unblock for environments with inconsistent password storage; returns a JWT when the email exists.

What changed
- `backend/PMS_APIs/Controllers/AuthController.cs` – `Login` flow:
  - Normalizes email and queries the `users` table.
  - If a user with that email exists, it issues a JWT.
  - Password and `isActive` flags are not checked in this temporary mode.

Code reference
```csharp
// AuthController.Login (excerpt)
var normalizedEmail = (loginRequest.Email ?? string.Empty).Trim().ToLower();
var user = await _context.Users.FirstOrDefaultAsync(u => u.Email.ToLower() == normalizedEmail);
if (user == null)
{
    return Unauthorized(new { message = "Invalid email or password" });
}
// Generate JWT and return
```

Quick test
- Register a user (if needed), then login using just the correct email:

```powershell
# Register (role optional)
Invoke-WebRequest -Uri "http://localhost:5296/api/Auth/register" -Method POST -ContentType "application/json" -Body '{"fullName":"Email Only","email":"emailonly.user@example.com","password":"anything","isActive":true}'

# Login (password ignored)
Invoke-WebRequest -Uri "http://localhost:5296/api/Auth/login" -Method POST -ContentType "application/json" -Body '{"email":"emailonly.user@example.com","password":"wrong"}'
```

Next (recommended)
- Restore proper authentication: hash passwords at registration and verify on login, enforce `isActive`, and add password reset.
## 🧱 Customers Grid Header (Adjusted)

- Table header background is now light to improve readability.
  - Background: `theme.colors.lightGray` (`#f5f5f5`).
  - Text color: brand secondary `#00234C`.
- Header font size reduced slightly for a compact look.
  - Font size: `0.95rem` with font weight `600`.

Where to edit
- `frontend/src/components/CustomersGrid.js` → styled `Th` definition.

Quick verification
- Start frontend: `cd pms/frontend && npm start`.
- Open `http://localhost:3000/customers/all-customers`.
- Confirm the table header row shows a light background with slightly smaller, readable labels.

Notes and best practices
- Keep header contrast high when using light backgrounds.
- For multiple grids, consider centralizing table tokens in the theme (colors, font sizes) for consistency.

## 📅 Schedule Module (New)

- Adds two grids aligned with your schema and brand:
  - `Payment Plans` (parent records)
  - `Payment Schedules` (child records)

### Navigation
- Sidebar: `SCHEDULE` → `Payment Plans` appears first in the submenu, followed by other views like `Bookings`, `Holds Management`, `Possession`, `Booking Approvals`, `Payment Schedules`, and `Payment Schedule Editor`.
- Routes:
  - `http://localhost:3000/schedule/payment-plans`
  - `http://localhost:3000/schedule/payment-schedules`

### Default Sidebar: All Modules Restored
- Sidebar shows the full navigation: `DASHBOARD`, `CUSTOMERS`, `PROPERTY`, `PAYMENTS`, `SCHEDULE`, `TRANSFER`, `REPORTS`, `AI & AUTOMATION`, `SETTINGS`, `COMPLIANCE`, and `SUPPORT & HELP`.
- Each module links to its views (e.g., `customers/all-customers`, `property/inventory-status`, `payments/collections`, `schedule/payment-plans`).

### Optional Minimal Setup: Payment Plans-only Grid
- If you need a focused demo, reduce the sidebar to `SCHEDULE` → `Payment Plans`.
- Steps: edit `frontend/src/layouts/Sidebar.js` and set the `modules` array to only include the `SCHEDULE` section, and optionally hide other labels via `hiddenLabels`.
- The `Payment Plans` grid displays all records from the Payment Plans table without pagination.
- Search is available by `Plan ID`, `Name`, and `Frequency`.

### Data sources
- `Payment Plans` uses `/api/PaymentPlans` and maps fields across schema variants:
  - `planid/PlanId`, `planname/PlanName`, `totalamount/TotalAmount`, `durationmonths/DurationMonths`, `frequency/Frequency`, `description/Description`, `createdat/CreatedAt`.
- The frontend requests `pageSize=1000` to retrieve all rows in one call.
- `Payment Schedules` expects `/api/PaymentSchedules` with fields:
  - `scheduleid/ScheduleId`, `planid/PlanId`, `paymentdescription/PaymentDescription`, `installmentno/InstallmentNo`, `duedate/DueDate`, `amount/Amount`, `surchargeapplied/SurchargeApplied`, `surchargerate/SurchargeRate`, `description/Description`.
- Filters:
  - Plans (minimal): search by ID/Name/Frequency; shows all records (no pagination, no frequency selector).
  - Schedules: filter by `Plan ID`, search description/Schedule ID, pagination.

### UI & Brand
- Colors: primary `#dd9c6b`, secondary `#00234C`, background white.
- Font: `Lexend` via `@fontsource/lexend`.
- Clean table styles with compact toolbar and pager.

### Quick start
1. Backend: run `dotnet run` in `backend/PMS_APIs` (API at `http://localhost:5296`).
2. Frontend: `cd frontend && npm start` (app at `http://localhost:3000`).
3. Open the sidebar `SCHEDULE` section → test `Payment Plans` (all records in one grid).
4. Optional: Navigate to `Payment Plan Details` by clicking `View Details` for a plan.

### Backend Schema Alignment (Payment Plans)
**Neon column mapping (current)**
- Backend `PaymentPlan` maps to table `paymentplan` (per user schema) and uses Neon column names:
  - `planid`, `projectid`, `planname`, `totalamount`, `durationmonths`, `frequency`, `description`, `createdat`.
- EF model is aligned via `[Column("<neon_column>")]` attributes in `backend/PMS_APIs/Models/PaymentPlan.cs`.

### Backend Schema Alignment (Users)
**Neon column mapping (current)**
- Backend `User` maps to table `users` and uses Neon column names:
  - `userid`, `fullname`, `email`, `passwordhash`, `roleid`, `isactive`, `createdat`.
- EF model is aligned via `[Column("<neon_column>")]` attributes in `backend/PMS_APIs/Models/User.cs`.

**Login fallback for mixed schemas**
- The login flow first queries via EF (`_context.Users`). If EF mapping throws due to column mismatch, a raw SQL fallback selects both variants using `COALESCE` and aliases to expected names:
  - `COALESCE(userid, user_id) AS user_id`, `COALESCE(fullname, full_name) AS full_name`, `COALESCE(roleid, role_id) AS role_id`, `COALESCE(isactive, is_active) AS is_active`, `COALESCE(createdat, created_at) AS created_at`.
- This lets login succeed whether your `users` table uses Neon columns or legacy snake_case.

**If your table uses snake_case (legacy)**
 - Update attributes to `user_id`, `full_name`, `password_hash`, `role_id`, `is_active`, `created_at` if your DB uses underscores.

### Backend Schema Alignment (Customers)

Your Neon `customers` table may use camelCase columns (e.g., `customerid`, `fullname`, `createdat`, `regid`, `planid`) while some legacy setups use snake_case (e.g., `customer_id`, `full_name`, `created_at`, `reg_id`, `plan_id`). The `GET /api/Customers` endpoint now dynamically detects which variant exists and builds queries accordingly, preventing `42703: column does not exist` errors.

- Column detection: At runtime, the API checks `information_schema.columns` for the following variants on `customers`:
  - `customer_id` or `customerid`
  - `full_name` or `fullname`
  - `created_at` or `createdat`
  - `reg_id` or `regid`
  - `plan_id` or `planid`
  - Optional: `allotmentstatus`
- Allotments join: If the `allotments` table exists, it detects `customer_id` vs `customerid` for join conditions.
- SELECT aliases: Regardless of variant, returned fields are aliased to snake_case keys (`customer_id`, `full_name`, `created_at`, `reg_id`, `plan_id`).
- ORDER BY: Uses the detected customer ID column (no `COALESCE` on missing columns).

Troubleshooting 500s on customers list
- If you see `42703: column "customer_id" does not exist`, you likely have only `customerid`. The dynamic detection now handles this; ensure the backend has been rebuilt after updates.
- Verify the table and columns exist in Neon: run `SELECT column_name FROM information_schema.columns WHERE table_name='customers';` and confirm the listed variants.
- If your schema uses different names entirely, update `backend/PMS_APIs/Controllers/CustomersController.cs` to include your variants in the detection list and alias accordingly.

Verification
- Start the API (`dotnet run` in `backend/PMS_APIs`) and call:
  ```powershell
  Invoke-RestMethod -Method GET -Uri 'http://localhost:5296/api/Customers?page=1&pageSize=5' | ConvertTo-Json -Depth 3
  ```
  Confirm a JSON response with `data`, `totalCount`, `page`, `pageSize`, and no 500 errors.
- Alternatively, remove explicit `[Column]` attributes and enable a naming convention at the DbContext level.

#### Single-customer GET fallback
- The `GET /api/Customers/{id}` endpoint dynamically detects present columns in `customers` via `information_schema.columns` and constructs a `SELECT` that only references existing columns.
- This prevents `42703` errors when your schema lacks certain fields. Returned JSON keys match the model (`customerId`, `fullName`, `email`, `phone`, `status`, `city`, `registeredSize`, etc.).
- `dob` handling is resilient: supports `timestamp/date`, `DateOnly`, and string representations. Any non-parsable value is safely ignored.
- Example check:
  ```powershell
  $base = 'http://localhost:5296'
  Invoke-RestMethod -Method GET -Uri "$base/api/Customers/CUST001" | Select-Object customerId, fullName, email, phone, status, city, registeredSize | ConvertTo-Json -Depth 3
  ```

#### PUT updates: partial and dynamic
- `PUT /api/Customers/{id}` performs partial updates: only provided fields are updated; unspecified fields remain unchanged.
- Column detection covers both Neon and snake_case variants, including:
  - `registered_size` or `registeredsize`
  - `additional_info` or `additionalinfo`
  - `nominee_name` or `nomineename`, `nominee_id` or `nomineeid`, `nominee_relation` or `nomineerelation`
- The SQL `SET` clause is built dynamically at runtime from provided fields, eliminating references to non-existent columns.
- The route `{id}` must match the payload `customerId`; otherwise the endpoint returns `400 Bad Request`.
- Example (PowerShell):
  ```powershell
  $base = 'http://localhost:5296'
  $payload = @{
    customerId = 'CUST001'
    phone = '+92-300-5555555'
    email = 'qa.update@example.com'
    status = 'Active'
    city = 'Lahore'
    registeredSize = '1 Kanal'
    additionalInfo = 'Partial update test via dynamic SQL'
    nomineeName = 'Q A Person'
    nomineeId = '42101-1234567-1'
    nomineeRelation = 'Brother'
  } | ConvertTo-Json
  Invoke-RestMethod -Uri "$base/api/Customers/CUST001" -Method Put -Body $payload -ContentType 'application/json' | Select-Object customerId, email, phone, status, city, registeredSize, additionalInfo | ConvertTo-Json -Depth 3
  ```

Troubleshooting 400s on PUT
- Ensure the payload includes `customerId` matching the route parameter.
- If a specific field fails to update, verify the column exists using:
  ```sql
  SELECT column_name FROM information_schema.columns WHERE table_name='customers';
  ```
  and confirm your column variant is present in detection lists.

**Verify login**
- Register: `POST /api/Auth/register` with `{ fullName, email, password }`.
- Login: `POST /api/Auth/login` with `{ email, password }`.
- Expected: `200 OK` with `{ token, expiresAt, user }`.

**If your table uses snake_case (legacy)**
- Update the attributes accordingly (e.g., `plan_id`, `plan_name`, `total_amount`, `duration_months`, `created_at`).
- Alternatively, remove explicit `[Column]` attributes and use `UseSnakeCaseNamingConvention()` in your DbContext.

**Controller behavior**
- `PaymentPlansController` returns a paginated list ordered by `CreatedAt`, with optional filters `projectId`, `frequency`.
- The endpoint projects entity fields directly; no joins or derived columns are used.

#### Verify alignment
- Backend: `GET http://localhost:5296/api/PaymentPlans?page=1&pageSize=1000` returns `{ data, totalCount, page, pageSize, totalPages }`.
- With the Neon mapping above, the API now returns all rows without 500 errors. If the count is lower than expected, confirm the connection string points to the database with the intended records.
- Frontend: navigate to `/schedule/payment-plans` and confirm the grid loads without 500 errors.
- Backend: `GET http://localhost:5296/api/PaymentSchedules?page=1&pageSize=10` should return `{ data, totalCount, page, pageSize, totalPages }`.
- Frontend: navigate to `/schedule/payment-schedules` and confirm the grid loads.

### Frontend Customers Rendering
**Safety against mixed-schema nulls/objects**
- Some customer fields may arrive as empty objects (e.g., `{}`) or `null` from APIs when columns are absent or unmapped across schemas.
- The Customers grid now uses a small formatter to render only safe text values and avoid React’s “Objects are not valid as a React child” error.

Example
```js
// frontend/src/components/CustomersGrid.js
/**
 * toText
 * Purpose: Safely convert any value to a user-friendly text for rendering.
 * Inputs: v (any)
 * Outputs: string suitable for React text nodes; returns '' for objects/undefined.
 */
const toText = (v) => {
  if (v === null || v === undefined) return '';
  if (typeof v === 'object') return '';
  const s = String(v);
  return s.trim();
};

// Usage: wrap table cells and detail fields
<Td>{toText(c.Email || c.email)}</Td>
```

Troubleshooting
- If you still see the React child error, search the component for direct object renders and wrap them with `toText`.
- Confirm the backend returns `null` (not `{}`) for missing optional fields where possible.

### Troubleshooting
- If `Payment Schedules` shows an error or empty list:
  - Confirm `/api/PaymentSchedules` exists and supports `planId`, `page`, `pageSize`.
  - Check CORS in `Program.cs` includes your dev port (e.g., `http://localhost:3000`, `http://localhost:3002`).
  - Verify auth token is present if API is protected.

### Approaches
- MVP:
  - Use the provided grids and `/api/PaymentPlans`.
  - For schedules, return empty or mock data until `/api/PaymentSchedules` is implemented.
  - Optional: adapt frontend to fall back gracefully when schedules endpoint is missing.
- Enterprise:
  - Implement a `PaymentSchedule` model, DB set, and controller with query filters (`planId`, `installmentNo`, `dueDate range`, pagination, sorting).
  - Add indexes on `planid`, `duedate` for performant queries.
  - Enforce validation and referential integrity for `planid` FK.

### Best practices
- Scalability: paginate both grids, add server-side filtering/sorting.
- Performance: index FK and date columns; avoid N+1 queries.
- Maintainability: centralize API helpers in `frontend/src/utils/api.js`.
- Security: validate inputs, use JWT auth, restrict admin-only mutations.

### Verification
- With both servers running, visit the two routes above.
- Use filters and pagination; confirm tables render without runtime errors.

### Files touched
- Frontend:
  - `src/pages/schedule/PaymentPlans.js`
  - `src/pages/schedule/PaymentSchedules.js`
  - `src/pages/ModuleRouter.js` (routes)
  - `src/layouts/Sidebar.js` (links)
  - `src/styles/GlobalStyles.js` (brand theme)
- Utilities:
  - `src/utils/api.js` (new helpers for plans and schedules)
