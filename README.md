# Property Management System (PMS)

An open-source, AI-augmented Property Management System designed for modern real estate developers, housing societies, and property managers.

## 🏗️ Project Structure

The project has been reorganized into a clean, modular structure for better maintainability and scalability:

### Public Assets (`/public/`)
- `index.php` - Main dashboard with key metrics and quick actions
- `app.js` - Core JavaScript functionality
- `styles.css` - Global CSS styles and branding

### Configuration (`/config/`)
- `settings.php` - System configuration and preferences

### Business Logic Modules (`/modules/`)
#### Access Control (`/modules/acl/`)
- `acl-dashboard.php` - ACL overview and management
- `acl-users.php` - User access management
- `acl-roles.php` - Role definition and assignment
- `acl-permissions.php` - Permission management
- `acl-assignments.php` - Role-permission assignments
- `acl-audit.php` - Access control audit logs

#### Core Business Modules
- `modules/customers/customers.php` - Member management and profiles
- `modules/finance/finance.php` - Financial tracking and payment management
- `modules/bookings/bookings.php` - Booking management and reservations
- `modules/inventory/inventory.php` - Property inventory and unit management
- `modules/reports/reports.php` - Analytics and reporting dashboard
- `modules/compliance/compliance.php` - Regulatory compliance and documentation
- `modules/audit/audit.php` - Audit trails and system logs

#### Property Operations
- `modules/transfers/transfer.php` - Property transfer management and tracking
- `modules/possession/possession.php` - Property possession and handover management
- `modules/cancellation/cancellation.php` - Property cancellation and refund processing
- `modules/migration/migration.php` - Property migration and unit changes
- `modules/scheduling/schedule.php` - Schedule management and appointments
- `modules/waivers/waiver.php` - Waiver management and documentation
- `modules/reminders/reminder.php` - Reminder system and notifications
- `modules/ai/ai-assistance.php` - AI-powered assistance features

### Specialized Modules

#### CRM Module (`/crm/`)
- `customers-form.php` - Customer registration and editing
- `customers-list.php` - Customer listing and search
- `customers-view.php` - Detailed customer profiles

#### Operations Module (`/operations/`)
- `attachments.php` - Document management system
- `migration.php` - Data migration tools
- `ndc.php` - No Dues Certificate management
- `notifications.php` - System notifications
- `ownership-history.php` - Property ownership tracking
- `transfers.php` - Property transfer management

#### Projects Module (`/projects/`)
- `projects.php` - Project overview and management
- `phases.php` - Project phase tracking
- `blocks-sectors.php` - Block and sector management
- `blocks-unblocks.php` - Block/unblock operations
- `holds-reservations.php` - Hold and reservation management
- `units.php` - Individual unit management

#### Sales Module (`/sales/`)
- `payment-plans.php` - Payment plan configuration
- `receipts.php` - Receipt generation and management
- `surcharge-rules.php` - Surcharge and penalty rules

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

### Folder Structure Reorganization (Latest)
- **Modular Architecture**: Reorganized entire codebase into logical modules for better maintainability
- **Public Assets**: Moved main entry point and assets to `/public/` folder
- **Configuration Management**: Centralized settings in `/config/` folder
- **Business Logic Separation**: Organized business modules into `/modules/` with clear categorization
- **Path Updates**: Updated all include/require paths to work with new structure
- **ACL Module**: Created dedicated Access Control List module for user management
- **Documentation**: Updated README.md to reflect new structure and organization

### Navigation Restructure
- **Removed**: Leads page (`leads.php`) from main navigation
- **Added**: Four new core property management pages:
  - `transfer.php` - Property transfer management with approval workflows
  - `possession.php` - Property possession and handover tracking
  - `cancellation.php` - Property cancellation and refund processing
  - `migration.php` - Property migration and unit change management
- **Enhanced**: Schedule, Waiver, and Reminder pages with comprehensive functionality
- **Updated**: Navigation terminology from "Customers" to "Members"
- **Improved**: All pages feature modern card-based layouts with status indicators

### Project Cleanup
- Removed duplicate HTML files that existed in both root and subfolders
- Cleaned up unnecessary PowerShell scripts
- Streamlined project structure for better maintainability
- Updated navigation icons from emoji to professional Font Awesome icons

### Navigation Enhancement
- Replaced emoji icons with Font Awesome icons across all pages
- Added automatic active navigation highlighting
- Improved visual consistency and professional appearance

## 🛠️ Development

### Local Setup
1. Install WAMP/XAMPP server
2. Clone repository to `www` directory
3. Access via `http://localhost/pms/public/`
4. Main entry point is now `/public/index.php`

### File Organization
- `/public/`: Main entry point and public assets (index.php, styles.css, app.js)
- `/config/`: System configuration files
- `/modules/`: Business logic modules organized by functionality
  - `/modules/acl/`: Access Control List management
  - `/modules/customers/`: Customer management
  - `/modules/finance/`: Financial operations
  - `/modules/bookings/`: Booking management
  - And more specialized modules...
- `/crm/`: Customer relationship management
- `/operations/`: Operational workflows
- `/projects/`: Project management features
- `/sales/`: Sales and payment management
- `/setup/`: System configuration
- `/system/`: Core system files
- `/includes/`: Shared components (header, footer)
- `/assets/`: Static assets and resources

## 📋 Next Steps

- Implement backend API integration
- Add database connectivity
- Enhance responsive design for mobile devices
- Add user authentication and authorization
- Implement real-time notifications
- Add data export/import functionality
