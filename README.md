<<<<<<< HEAD
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
- Entity Framework Core with SQLite database
- Comprehensive data models for property management
- CORS enabled for frontend integration
- Pagination support for large datasets
- Proper HTTP status codes and error handling

## 🛠️ Tech Stack

### Frontend
- React.js 18
- React Router for navigation
- Styled Components for styling
- Lexend font for brand typography

### Backend
- .NET Core 8.0
- Entity Framework Core 8.0.11
- SQLite database
- Npgsql (PostgreSQL support available)

## 📁 Project Structure

```
PMS_FrontEnd/
├── src/                    # React frontend source
│   ├── assets/            # Static assets (images, icons)
│   ├── components/        # Reusable UI components
│   ├── layouts/           # Layout components (Sidebar, TopBar)
│   ├── pages/             # Page components for each route
│   ├── styles/            # Global styles and theme
│   └── utils/             # Utility functions and helpers
├── PMS_BackEnd_APIs/      # .NET Core Web API
│   └── PMS_APIs/
│       ├── Controllers/   # API controllers
│       ├── Models/        # Data models
│       ├── Data/          # Database context
│       └── Migrations/    # EF Core migrations
└── README.md
```

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
- `GET /api/PaymentPlans/{id}` - Get payment plan by ID
- `POST /api/PaymentPlans` - Create new payment plan
- `PUT /api/PaymentPlans/{id}` - Update payment plan
- `DELETE /api/PaymentPlans/{id}` - Delete payment plan

### Additional Endpoints
- Allotments, Payments, Penalties, Waivers, Refunds, Transfers, NDCs, Possessions, Registrations

## 🚀 Getting Started

### Prerequisites
- Node.js (v16 or higher)
- .NET Core SDK 8.0
- Git

### Frontend Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd PMS_FrontEnd
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
   cd PMS_BackEnd_APIs/PMS_APIs
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
   cd PMS_BackEnd_APIs/PMS_APIs
   dotnet run
   ```

2. **Start the frontend** (Terminal 2)
   ```bash
   npm start
   ```

3. **Access the application**
   - Frontend: [http://localhost:3000](http://localhost:3000)
   - API: [http://localhost:5296](http://localhost:5296)

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
=======
# 🏢 Technyder PMS (Property Management System)

### Overview
Technyder PMS is an enterprise-ready Property Management System designed to manage customers, leads, bookings, inventory, finance, and compliance workflows in a modular, scalable architecture.

---

### Features
- Secure user authentication and session management  
- Role-based access control (RBAC)  
- Modular architecture (Customers, Leads, Bookings, Finance, Compliance, Reports)  
- Company and region configuration  
- Audit logging and activity tracking  
- Ready for multi-company and future AI integrations  

---

### Folder Structure
>>>>>>> 78f7ae05603ce8b870f5c4d14ccc6fbdf5f7ac4f
