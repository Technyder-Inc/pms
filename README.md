# Property Management System (PMS)

An open-source, AI-augmented Property Management System designed for modern real estate developers, housing societies, and property managers.

## 🏗️ Project Structure

### Root Pages
- `index.php` - Dashboard with key metrics and quick actions
- `customers.html` - Customer management and profiles
- `leads.html` - Lead tracking and conversion pipeline
- `inventory.html` - Property inventory and unit management
- `bookings.html` - Booking management and reservations
- `finance.html` - Financial tracking and payment management
- `compliance.html` - Regulatory compliance and documentation
- `reports.html` - Analytics and reporting dashboard
- `settings.html` - System configuration and preferences
- `audit.html` - Audit trails and system logs

### Specialized Modules

#### CRM Module (`/crm/`)
- `customers-form.html` - Customer registration and editing
- `customers-list.html` - Customer listing and search
- `customers-view.html` - Detailed customer profiles

#### Operations Module (`/operations/`)
- `attachments.html` - Document management system
- `migration.html` - Data migration tools
- `ndc.html` - No Dues Certificate management
- `notifications.html` - System notifications
- `ownership-history.html` - Property ownership tracking
- `transfers.html` - Property transfer management

#### Projects Module (`/projects/`)
- `projects.html` - Project overview and management
- `phases.html` - Project phase tracking
- `blocks-sectors.html` - Block and sector management
- `blocks-unblocks.html` - Block/unblock operations
- `holds-reservations.html` - Hold and reservation management
- `units.html` - Individual unit management

#### Sales Module (`/sales/`)
- `payment-plans.html` - Payment plan configuration
- `receipts.html` - Receipt generation and management
- `surcharge-rules.html` - Surcharge and penalty rules

#### Setup Module (`/setup/`)
- `setup/company-settings.php` - Company configuration
- `setup/users-roles.php` - User management and role assignment

#### System Module (`/system/`)
- `system/ai-assist.php` - AI-powered assistance features
- `system/audit-logs.php` - Detailed audit logging
- `system/system-settings.php` - System-wide configuration
- `system/user-management.php` - Advanced user management

## 🎨 Design System

### Brand Colors
- **Primary**: `#dd9c6b` (Warm copper)
- **Secondary**: `#00234C` (Deep navy)
- **Font**: Lexend (Google Fonts)

### Navigation
- Clean white Font Awesome icons for professional appearance
- Automatic active page highlighting
- Responsive sidebar with collapse functionality

## 🚀 Features

- **Modern UI/UX**: Clean, professional interface with consistent branding
- **Responsive Design**: Works seamlessly across desktop and mobile devices
- **Modular Architecture**: Organized into logical modules for easy maintenance
- **Professional Icons**: Font Awesome integration for crisp, scalable icons
- **Active Navigation**: Automatic highlighting of current page
- **Clean Structure**: Removed duplicate files for better organization

## 📁 Recent Updates

### Project Cleanup (Latest)
- Removed duplicate HTML files that existed in both root and subfolders
- Cleaned up unnecessary PowerShell scripts
- Streamlined project structure for better maintainability
- Updated navigation icons from emoji to professional Font Awesome icons

### Navigation Enhancement
- Replaced emoji icons with Font Awesome icons across all pages
- Added automatic active navigation highlighting
- Improved visual consistency and professional appearance

## 🛠️ Development

### Local Development
1. Use WAMP server for local development
2. Access via `http://localhost/pms/`
3. All pages are static HTML with JavaScript functionality

### File Organization
- Root level contains main navigation pages
- Subfolders contain specialized module pages
- Shared assets in `/assets/` folder
- Global styles in `styles.css`
- Main JavaScript functionality in `app.js`

## 📋 Next Steps

- Implement backend API integration
- Add database connectivity
- Enhance responsive design for mobile devices
- Add user authentication and authorization
- Implement real-time notifications
- Add data export/import functionality
