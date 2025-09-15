<?php
$pageTitle = 'Role Assignments - Property Management System';
$currentPage = 'acl-assignments';
$breadcrumb_section = 'Access Control';
$breadcrumb_current = 'Role Assignments';
include 'includes/header.php';
?>

<div class="page-header">
    <div class="header-content">
        <h1 class="page-title">Role Assignments</h1>
        <p class="page-description">Manage user role assignments and access levels</p>
    </div>
    <div class="header-actions">
        <button class="btn btn-secondary">
            <i class="fas fa-download"></i>
            Export Assignments
        </button>
        <button class="btn btn-primary">
            <i class="fas fa-user-plus"></i>
            Assign Role
        </button>
    </div>
</div>

<!-- Assignment Overview -->
<div class="assignment-overview">
    <div class="overview-stats">
        <div class="stat-card">
            <div class="stat-icon admin">
                <i class="fas fa-crown"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">3</h3>
                <p class="stat-label">Administrators</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon manager">
                <i class="fas fa-users-cog"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">8</h3>
                <p class="stat-label">Managers</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon agent">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">24</h3>
                <p class="stat-label">Agents</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon viewer">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">12</h3>
                <p class="stat-label">Viewers</p>
            </div>
        </div>
    </div>
</div>

<!-- Assignment Filters -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Assignment Filters</h2>
    </div>
    <div class="card-content">
        <div class="filter-controls">
            <div class="filter-group">
                <label for="roleFilter">Filter by Role</label>
                <select id="roleFilter">
                    <option value="">All Roles</option>
                    <option value="admin">Administrator</option>
                    <option value="manager">Manager</option>
                    <option value="agent">Agent</option>
                    <option value="viewer">Viewer</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="departmentFilter">Filter by Department</label>
                <select id="departmentFilter">
                    <option value="">All Departments</option>
                    <option value="sales">Sales</option>
                    <option value="marketing">Marketing</option>
                    <option value="finance">Finance</option>
                    <option value="operations">Operations</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="statusFilter">Filter by Status</label>
                <select id="statusFilter">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="pending">Pending</option>
                </select>
            </div>
            
            <div class="filter-group">
                <button class="btn btn-secondary">Reset Filters</button>
                <button class="btn btn-primary">Apply Filters</button>
            </div>
        </div>
    </div>
</div>

<!-- User Assignments Table -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">User Role Assignments</h2>
        <div class="card-actions">
            <div class="search-box">
                <input type="text" placeholder="Search users...">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>
    <div class="card-content">
        <div class="assignment-table">
            <table>
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th>User</th>
                        <th>Current Role</th>
                        <th>Department</th>
                        <th>Assigned Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="checkbox" class="user-select">
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    <img src="https://via.placeholder.com/40" alt="John Smith">
                                </div>
                                <div class="user-details">
                                    <h4 class="user-name">John Smith</h4>
                                    <p class="user-email">john.smith@company.com</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="role-badge admin">Administrator</span>
                        </td>
                        <td>Operations</td>
                        <td>2024-01-15</td>
                        <td>
                            <span class="status-badge active">Active</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon" title="Change Role">
                                    <i class="fas fa-exchange-alt"></i>
                                </button>
                                <button class="btn-icon" title="View History">
                                    <i class="fas fa-history"></i>
                                </button>
                                <button class="btn-icon" title="Remove Assignment">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <input type="checkbox" class="user-select">
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    <img src="https://via.placeholder.com/40" alt="Sarah Johnson">
                                </div>
                                <div class="user-details">
                                    <h4 class="user-name">Sarah Johnson</h4>
                                    <p class="user-email">sarah.johnson@company.com</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="role-badge manager">Manager</span>
                        </td>
                        <td>Sales</td>
                        <td>2024-02-01</td>
                        <td>
                            <span class="status-badge active">Active</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon" title="Change Role">
                                    <i class="fas fa-exchange-alt"></i>
                                </button>
                                <button class="btn-icon" title="View History">
                                    <i class="fas fa-history"></i>
                                </button>
                                <button class="btn-icon" title="Remove Assignment">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <input type="checkbox" class="user-select">
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    <img src="https://via.placeholder.com/40" alt="Mike Davis">
                                </div>
                                <div class="user-details">
                                    <h4 class="user-name">Mike Davis</h4>
                                    <p class="user-email">mike.davis@company.com</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="role-badge agent">Agent</span>
                        </td>
                        <td>Marketing</td>
                        <td>2024-02-10</td>
                        <td>
                            <span class="status-badge active">Active</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon" title="Change Role">
                                    <i class="fas fa-exchange-alt"></i>
                                </button>
                                <button class="btn-icon" title="View History">
                                    <i class="fas fa-history"></i>
                                </button>
                                <button class="btn-icon" title="Remove Assignment">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <input type="checkbox" class="user-select">
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    <img src="https://via.placeholder.com/40" alt="Lisa Wilson">
                                </div>
                                <div class="user-details">
                                    <h4 class="user-name">Lisa Wilson</h4>
                                    <p class="user-email">lisa.wilson@company.com</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="role-badge viewer">Viewer</span>
                        </td>
                        <td>Finance</td>
                        <td>2024-02-15</td>
                        <td>
                            <span class="status-badge pending">Pending</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon" title="Change Role">
                                    <i class="fas fa-exchange-alt"></i>
                                </button>
                                <button class="btn-icon" title="View History">
                                    <i class="fas fa-history"></i>
                                </button>
                                <button class="btn-icon" title="Remove Assignment">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Bulk Actions -->
        <div class="bulk-actions">
            <div class="bulk-info">
                <span id="selectedCount">0</span> users selected
            </div>
            <div class="bulk-buttons">
                <button class="btn btn-secondary" disabled>Change Role</button>
                <button class="btn btn-secondary" disabled>Export Selected</button>
                <button class="btn btn-danger" disabled>Remove Assignments</button>
            </div>
        </div>
    </div>
</div>

<!-- Quick Assignment Panel -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Quick Role Assignment</h2>
        <p class="card-subtitle">Assign roles to users quickly</p>
    </div>
    <div class="card-content">
        <div class="quick-assignment">
            <div class="assignment-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="selectUser">Select User</label>
                        <select id="selectUser">
                            <option value="">Choose a user...</option>
                            <option value="1">John Smith (john.smith@company.com)</option>
                            <option value="2">Sarah Johnson (sarah.johnson@company.com)</option>
                            <option value="3">Mike Davis (mike.davis@company.com)</option>
                            <option value="4">Lisa Wilson (lisa.wilson@company.com)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="selectRole">Assign Role</label>
                        <select id="selectRole">
                            <option value="">Choose a role...</option>
                            <option value="admin">Administrator</option>
                            <option value="manager">Manager</option>
                            <option value="agent">Agent</option>
                            <option value="viewer">Viewer</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="assignmentReason">Assignment Reason</label>
                        <input type="text" id="assignmentReason" placeholder="Optional reason for assignment">
                    </div>
                    
                    <div class="form-group">
                        <button class="btn btn-primary">Assign Role</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>