<?php
$pageTitle = 'User Management - Property Management System';
$currentPage = 'acl-users';
$breadcrumb_section = 'Access Control';
$breadcrumb_current = 'User Management';
include 'includes/header.php';
?>

<div class="page-header">
    <div class="header-content">
        <h1 class="page-title">User Management</h1>
        <p class="page-description">Manage user accounts, roles, and access permissions</p>
    </div>
    <div class="header-actions">
        <button class="btn btn-secondary">
            <i class="fas fa-download"></i>
            Export Users
        </button>
        <button class="btn btn-primary">
            <i class="fas fa-user-plus"></i>
            Add New User
        </button>
    </div>
</div>

<!-- User Statistics -->
<div class="stats-row">
    <div class="stat-item">
        <span class="stat-number">24</span>
        <span class="stat-label">Total Users</span>
    </div>
    <div class="stat-item">
        <span class="stat-number">18</span>
        <span class="stat-label">Active Users</span>
    </div>
    <div class="stat-item">
        <span class="stat-number">6</span>
        <span class="stat-label">Inactive Users</span>
    </div>
    <div class="stat-item">
        <span class="stat-number">3</span>
        <span class="stat-label">Pending Approval</span>
    </div>
</div>

<!-- User Management Table -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">User Directory</h2>
        <div class="card-actions">
            <div class="search-box">
                <input type="text" placeholder="Search users..." id="userSearch">
            </div>
            <select class="filter-select">
                <option value="all">All Roles</option>
                <option value="admin">Administrator</option>
                <option value="manager">Manager</option>
                <option value="agent">Agent</option>
                <option value="viewer">Viewer</option>
            </select>
        </div>
    </div>
    <div class="card-content">
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Last Login</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="user-info">
                                <img src="assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                <div>
                                    <div class="user-name">John Doe</div>
                                    <div class="user-id">#USR001</div>
                                </div>
                            </div>
                        </td>
                        <td>john.doe@company.com</td>
                        <td><span class="role-badge admin">Administrator</span></td>
                        <td>IT Department</td>
                        <td><span class="status-badge active">Active</span></td>
                        <td>2 hours ago</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-icon danger" title="Deactivate">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-info">
                                <img src="assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                <div>
                                    <div class="user-name">Sarah Wilson</div>
                                    <div class="user-id">#USR002</div>
                                </div>
                            </div>
                        </td>
                        <td>sarah.wilson@company.com</td>
                        <td><span class="role-badge manager">Manager</span></td>
                        <td>Sales Department</td>
                        <td><span class="status-badge active">Active</span></td>
                        <td>1 day ago</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-icon danger" title="Deactivate">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-info">
                                <img src="assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                <div>
                                    <div class="user-name">Mike Johnson</div>
                                    <div class="user-id">#USR003</div>
                                </div>
                            </div>
                        </td>
                        <td>mike.johnson@company.com</td>
                        <td><span class="role-badge agent">Agent</span></td>
                        <td>Operations</td>
                        <td><span class="status-badge inactive">Inactive</span></td>
                        <td>1 week ago</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-icon success" title="Activate">
                                    <i class="fas fa-check"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-info">
                                <img src="assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                <div>
                                    <div class="user-name">Emily Davis</div>
                                    <div class="user-id">#USR004</div>
                                </div>
                            </div>
                        </td>
                        <td>emily.davis@company.com</td>
                        <td><span class="role-badge viewer">Viewer</span></td>
                        <td>Finance</td>
                        <td><span class="status-badge pending">Pending</span></td>
                        <td>Never</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-icon" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-icon" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn-icon success" title="Approve">
                                    <i class="fas fa-check"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bulk Actions Panel -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Bulk Actions</h2>
        <p class="card-subtitle">Perform actions on multiple users</p>
    </div>
    <div class="card-content">
        <div class="bulk-actions">
            <div class="bulk-selection">
                <label class="checkbox-container">
                    <input type="checkbox" id="selectAll">
                    <span class="checkmark"></span>
                    Select All Users
                </label>
                <span class="selection-count">0 users selected</span>
            </div>
            <div class="bulk-buttons">
                <button class="btn btn-secondary" disabled>
                    <i class="fas fa-envelope"></i>
                    Send Email
                </button>
                <button class="btn btn-secondary" disabled>
                    <i class="fas fa-user-tag"></i>
                    Change Role
                </button>
                <button class="btn btn-warning" disabled>
                    <i class="fas fa-ban"></i>
                    Deactivate
                </button>
                <button class="btn btn-danger" disabled>
                    <i class="fas fa-trash"></i>
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>