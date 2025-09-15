<?php
$pageTitle = 'Role Management - Property Management System';
$currentPage = 'acl-roles';
$breadcrumb_section = 'Access Control';
$breadcrumb_current = 'Role Management';
include 'includes/header.php';
?>

<div class="page-header">
    <div class="header-content">
        <h1 class="page-title">Role Management</h1>
        <p class="page-description">Create and manage user roles with specific permissions</p>
    </div>
    <div class="header-actions">
        <button class="btn btn-secondary">
            <i class="fas fa-copy"></i>
            Clone Role
        </button>
        <button class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Create New Role
        </button>
    </div>
</div>

<!-- Role Overview Cards -->
<div class="role-grid">
    <div class="role-card admin">
        <div class="role-header">
            <div class="role-icon">
                <i class="fas fa-crown"></i>
            </div>
            <div class="role-info">
                <h3 class="role-name">Administrator</h3>
                <p class="role-description">Full system access and control</p>
            </div>
            <div class="role-actions">
                <button class="btn-icon" title="Edit Role">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn-icon" title="View Details">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
        <div class="role-stats">
            <div class="stat-item">
                <span class="stat-number">3</span>
                <span class="stat-label">Users</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">45</span>
                <span class="stat-label">Permissions</span>
            </div>
        </div>
        <div class="role-permissions">
            <span class="permission-badge">All Modules</span>
            <span class="permission-badge">User Management</span>
            <span class="permission-badge">System Settings</span>
            <span class="permission-more">+42 more</span>
        </div>
    </div>
    
    <div class="role-card manager">
        <div class="role-header">
            <div class="role-icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="role-info">
                <h3 class="role-name">Manager</h3>
                <p class="role-description">Department management and oversight</p>
            </div>
            <div class="role-actions">
                <button class="btn-icon" title="Edit Role">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn-icon" title="View Details">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
        <div class="role-stats">
            <div class="stat-item">
                <span class="stat-number">8</span>
                <span class="stat-label">Users</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">28</span>
                <span class="stat-label">Permissions</span>
            </div>
        </div>
        <div class="role-permissions">
            <span class="permission-badge">Property Management</span>
            <span class="permission-badge">Customer Management</span>
            <span class="permission-badge">Reports</span>
            <span class="permission-more">+25 more</span>
        </div>
    </div>
    
    <div class="role-card agent">
        <div class="role-header">
            <div class="role-icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="role-info">
                <h3 class="role-name">Agent</h3>
                <p class="role-description">Property operations and customer service</p>
            </div>
            <div class="role-actions">
                <button class="btn-icon" title="Edit Role">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn-icon" title="View Details">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
        <div class="role-stats">
            <div class="stat-item">
                <span class="stat-number">12</span>
                <span class="stat-label">Users</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">15</span>
                <span class="stat-label">Permissions</span>
            </div>
        </div>
        <div class="role-permissions">
            <span class="permission-badge">Bookings</span>
            <span class="permission-badge">Customer Support</span>
            <span class="permission-badge">Inventory</span>
            <span class="permission-more">+12 more</span>
        </div>
    </div>
    
    <div class="role-card viewer">
        <div class="role-header">
            <div class="role-icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="role-info">
                <h3 class="role-name">Viewer</h3>
                <p class="role-description">Read-only access to reports and data</p>
            </div>
            <div class="role-actions">
                <button class="btn-icon" title="Edit Role">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn-icon" title="View Details">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
        <div class="role-stats">
            <div class="stat-item">
                <span class="stat-number">6</span>
                <span class="stat-label">Users</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">8</span>
                <span class="stat-label">Permissions</span>
            </div>
        </div>
        <div class="role-permissions">
            <span class="permission-badge">View Reports</span>
            <span class="permission-badge">View Dashboard</span>
            <span class="permission-badge">View Properties</span>
            <span class="permission-more">+5 more</span>
        </div>
    </div>
</div>

<!-- Role Permissions Matrix -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Permission Matrix</h2>
        <p class="card-subtitle">Overview of role permissions across modules</p>
    </div>
    <div class="card-content">
        <div class="permission-matrix">
            <table class="matrix-table">
                <thead>
                    <tr>
                        <th>Module / Feature</th>
                        <th>Administrator</th>
                        <th>Manager</th>
                        <th>Agent</th>
                        <th>Viewer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="module-name">Dashboard</td>
                        <td><span class="permission-status full">Full Access</span></td>
                        <td><span class="permission-status full">Full Access</span></td>
                        <td><span class="permission-status limited">Limited</span></td>
                        <td><span class="permission-status read">Read Only</span></td>
                    </tr>
                    <tr>
                        <td class="module-name">Customer Management</td>
                        <td><span class="permission-status full">Full Access</span></td>
                        <td><span class="permission-status full">Full Access</span></td>
                        <td><span class="permission-status limited">Limited</span></td>
                        <td><span class="permission-status read">Read Only</span></td>
                    </tr>
                    <tr>
                        <td class="module-name">Property Management</td>
                        <td><span class="permission-status full">Full Access</span></td>
                        <td><span class="permission-status full">Full Access</span></td>
                        <td><span class="permission-status limited">Limited</span></td>
                        <td><span class="permission-status none">No Access</span></td>
                    </tr>
                    <tr>
                        <td class="module-name">Financial Reports</td>
                        <td><span class="permission-status full">Full Access</span></td>
                        <td><span class="permission-status read">Read Only</span></td>
                        <td><span class="permission-status none">No Access</span></td>
                        <td><span class="permission-status read">Read Only</span></td>
                    </tr>
                    <tr>
                        <td class="module-name">User Management</td>
                        <td><span class="permission-status full">Full Access</span></td>
                        <td><span class="permission-status none">No Access</span></td>
                        <td><span class="permission-status none">No Access</span></td>
                        <td><span class="permission-status none">No Access</span></td>
                    </tr>
                    <tr>
                        <td class="module-name">System Settings</td>
                        <td><span class="permission-status full">Full Access</span></td>
                        <td><span class="permission-status none">No Access</span></td>
                        <td><span class="permission-status none">No Access</span></td>
                        <td><span class="permission-status none">No Access</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Role Templates -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Role Templates</h2>
        <p class="card-subtitle">Pre-configured role templates for quick setup</p>
    </div>
    <div class="card-content">
        <div class="template-grid">
            <div class="template-card">
                <div class="template-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="template-content">
                    <h4>Department Head</h4>
                    <p>Manage department operations and team members</p>
                    <div class="template-permissions">
                        <span class="permission-count">22 permissions</span>
                    </div>
                </div>
                <button class="btn btn-outline">Use Template</button>
            </div>
            
            <div class="template-card">
                <div class="template-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <div class="template-content">
                    <h4>Support Agent</h4>
                    <p>Customer service and basic property operations</p>
                    <div class="template-permissions">
                        <span class="permission-count">12 permissions</span>
                    </div>
                </div>
                <button class="btn btn-outline">Use Template</button>
            </div>
            
            <div class="template-card">
                <div class="template-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="template-content">
                    <h4>Analyst</h4>
                    <p>Data analysis and reporting capabilities</p>
                    <div class="template-permissions">
                        <span class="permission-count">10 permissions</span>
                    </div>
                </div>
                <button class="btn btn-outline">Use Template</button>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>