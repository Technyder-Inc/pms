<?php
$pageTitle = 'Permission Control - Property Management System';
$currentPage = 'acl-permissions';
$breadcrumb_section = 'Access Control';
$breadcrumb_current = 'Permission Control';
include 'includes/header.php';
?>

<div class="page-header">
    <div class="header-content">
        <h1 class="page-title">Permission Control</h1>
        <p class="page-description">Configure granular permissions for system modules and features</p>
    </div>
    <div class="header-actions">
        <button class="btn btn-secondary">
            <i class="fas fa-download"></i>
            Export Permissions
        </button>
        <button class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Add Permission
        </button>
    </div>
</div>

<!-- Permission Categories -->
<div class="permission-categories">
    <div class="category-tabs">
        <button class="tab-btn active" data-category="dashboard">Dashboard</button>
        <button class="tab-btn" data-category="customers">Customers</button>
        <button class="tab-btn" data-category="properties">Properties</button>
        <button class="tab-btn" data-category="finance">Finance</button>
        <button class="tab-btn" data-category="reports">Reports</button>
        <button class="tab-btn" data-category="system">System</button>
    </div>
</div>

<!-- Dashboard Permissions -->
<div class="permission-section active" id="dashboard-permissions">
    <div class="content-card">
        <div class="card-header">
            <h2 class="card-title">Dashboard Permissions</h2>
            <p class="card-subtitle">Control access to dashboard features and widgets</p>
        </div>
        <div class="card-content">
            <div class="permission-list">
                <div class="permission-item">
                    <div class="permission-info">
                        <h4 class="permission-name">View Dashboard</h4>
                        <p class="permission-description">Access to main dashboard page</p>
                        <span class="permission-code">dashboard.view</span>
                    </div>
                    <div class="permission-roles">
                        <span class="role-tag admin">Admin</span>
                        <span class="role-tag manager">Manager</span>
                        <span class="role-tag agent">Agent</span>
                        <span class="role-tag viewer">Viewer</span>
                    </div>
                    <div class="permission-actions">
                        <button class="btn-icon" title="Edit Permission">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="permission-item">
                    <div class="permission-info">
                        <h4 class="permission-name">Manage Widgets</h4>
                        <p class="permission-description">Add, remove, and configure dashboard widgets</p>
                        <span class="permission-code">dashboard.widgets.manage</span>
                    </div>
                    <div class="permission-roles">
                        <span class="role-tag admin">Admin</span>
                        <span class="role-tag manager">Manager</span>
                    </div>
                    <div class="permission-actions">
                        <button class="btn-icon" title="Edit Permission">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="permission-item">
                    <div class="permission-info">
                        <h4 class="permission-name">Export Dashboard Data</h4>
                        <p class="permission-description">Export dashboard statistics and reports</p>
                        <span class="permission-code">dashboard.export</span>
                    </div>
                    <div class="permission-roles">
                        <span class="role-tag admin">Admin</span>
                        <span class="role-tag manager">Manager</span>
                        <span class="role-tag viewer">Viewer</span>
                    </div>
                    <div class="permission-actions">
                        <button class="btn-icon" title="Edit Permission">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Customer Permissions -->
<div class="permission-section" id="customers-permissions">
    <div class="content-card">
        <div class="card-header">
            <h2 class="card-title">Customer Management Permissions</h2>
            <p class="card-subtitle">Control access to customer data and operations</p>
        </div>
        <div class="card-content">
            <div class="permission-list">
                <div class="permission-item">
                    <div class="permission-info">
                        <h4 class="permission-name">View Customers</h4>
                        <p class="permission-description">Access customer list and basic information</p>
                        <span class="permission-code">customers.view</span>
                    </div>
                    <div class="permission-roles">
                        <span class="role-tag admin">Admin</span>
                        <span class="role-tag manager">Manager</span>
                        <span class="role-tag agent">Agent</span>
                        <span class="role-tag viewer">Viewer</span>
                    </div>
                    <div class="permission-actions">
                        <button class="btn-icon" title="Edit Permission">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="permission-item">
                    <div class="permission-info">
                        <h4 class="permission-name">Create Customers</h4>
                        <p class="permission-description">Add new customer records to the system</p>
                        <span class="permission-code">customers.create</span>
                    </div>
                    <div class="permission-roles">
                        <span class="role-tag admin">Admin</span>
                        <span class="role-tag manager">Manager</span>
                        <span class="role-tag agent">Agent</span>
                    </div>
                    <div class="permission-actions">
                        <button class="btn-icon" title="Edit Permission">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="permission-item">
                    <div class="permission-info">
                        <h4 class="permission-name">Edit Customers</h4>
                        <p class="permission-description">Modify existing customer information</p>
                        <span class="permission-code">customers.edit</span>
                    </div>
                    <div class="permission-roles">
                        <span class="role-tag admin">Admin</span>
                        <span class="role-tag manager">Manager</span>
                        <span class="role-tag agent">Agent</span>
                    </div>
                    <div class="permission-actions">
                        <button class="btn-icon" title="Edit Permission">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="permission-item">
                    <div class="permission-info">
                        <h4 class="permission-name">Delete Customers</h4>
                        <p class="permission-description">Remove customer records from the system</p>
                        <span class="permission-code">customers.delete</span>
                    </div>
                    <div class="permission-roles">
                        <span class="role-tag admin">Admin</span>
                        <span class="role-tag manager">Manager</span>
                    </div>
                    <div class="permission-actions">
                        <button class="btn-icon" title="Edit Permission">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Permission Builder -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Permission Builder</h2>
        <p class="card-subtitle">Create custom permissions for specific needs</p>
    </div>
    <div class="card-content">
        <div class="permission-builder">
            <div class="builder-form">
                <div class="form-group">
                    <label for="permissionName">Permission Name</label>
                    <input type="text" id="permissionName" placeholder="Enter permission name">
                </div>
                
                <div class="form-group">
                    <label for="permissionCode">Permission Code</label>
                    <input type="text" id="permissionCode" placeholder="module.action.resource">
                </div>
                
                <div class="form-group">
                    <label for="permissionDescription">Description</label>
                    <textarea id="permissionDescription" placeholder="Describe what this permission allows"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="permissionModule">Module</label>
                    <select id="permissionModule">
                        <option value="">Select Module</option>
                        <option value="dashboard">Dashboard</option>
                        <option value="customers">Customers</option>
                        <option value="properties">Properties</option>
                        <option value="finance">Finance</option>
                        <option value="reports">Reports</option>
                        <option value="system">System</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Assign to Roles</label>
                    <div class="role-checkboxes">
                        <label class="checkbox-container">
                            <input type="checkbox" value="admin">
                            <span class="checkmark"></span>
                            Administrator
                        </label>
                        <label class="checkbox-container">
                            <input type="checkbox" value="manager">
                            <span class="checkmark"></span>
                            Manager
                        </label>
                        <label class="checkbox-container">
                            <input type="checkbox" value="agent">
                            <span class="checkmark"></span>
                            Agent
                        </label>
                        <label class="checkbox-container">
                            <input type="checkbox" value="viewer">
                            <span class="checkmark"></span>
                            Viewer
                        </label>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button class="btn btn-secondary">Cancel</button>
                    <button class="btn btn-primary">Create Permission</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>