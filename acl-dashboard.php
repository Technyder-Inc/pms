<?php
$pageTitle = 'ACL Dashboard - Property Management System';
$currentPage = 'acl-dashboard';
$breadcrumb_section = 'Access Control';
$breadcrumb_current = 'Dashboard';
include 'includes/header.php';
?>

<div class="page-header">
    <div class="header-content">
        <h1 class="page-title">Access Control Dashboard</h1>
        <p class="page-description">Monitor and manage user access, roles, and permissions across the system</p>
    </div>
    <div class="header-actions">
        <button class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Quick Setup
        </button>
    </div>
</div>

<!-- ACL Overview Cards -->
<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-number">24</h3>
            <p class="stat-label">Active Users</p>
            <span class="stat-change positive">+3 this week</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-user-tag"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-number">8</h3>
            <p class="stat-label">User Roles</p>
            <span class="stat-change neutral">No changes</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-key"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-number">45</h3>
            <p class="stat-label">Permissions</p>
            <span class="stat-change positive">+2 new</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-shield-alt"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-number">156</h3>
            <p class="stat-label">Access Events</p>
            <span class="stat-change neutral">Last 24h</span>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="content-grid">
    <div class="content-card">
        <div class="card-header">
            <h2 class="card-title">Quick Actions</h2>
            <p class="card-subtitle">Common ACL management tasks</p>
        </div>
        <div class="card-content">
            <div class="action-grid">
                <a href="acl-users.php" class="action-item">
                    <div class="action-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="action-content">
                        <h4>Add New User</h4>
                        <p>Create user account with role assignment</p>
                    </div>
                </a>
                
                <a href="acl-roles.php" class="action-item">
                    <div class="action-icon">
                        <i class="fas fa-user-tag"></i>
                    </div>
                    <div class="action-content">
                        <h4>Manage Roles</h4>
                        <p>Create and modify user roles</p>
                    </div>
                </a>
                
                <a href="acl-permissions.php" class="action-item">
                    <div class="action-icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <div class="action-content">
                        <h4>Set Permissions</h4>
                        <p>Configure access permissions</p>
                    </div>
                </a>
                
                <a href="acl-audit.php" class="action-item">
                    <div class="action-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="action-content">
                        <h4>View Audit Log</h4>
                        <p>Review access and security events</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <div class="content-card">
        <div class="card-header">
            <h2 class="card-title">Recent Activity</h2>
            <p class="card-subtitle">Latest access control events</p>
        </div>
        <div class="card-content">
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon success">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="activity-content">
                        <h4>User Login</h4>
                        <p>John Doe logged in successfully</p>
                        <span class="activity-time">2 minutes ago</span>
                    </div>
                </div>
                
                <div class="activity-item">
                    <div class="activity-icon info">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <h4>New User Created</h4>
                        <p>Sarah Wilson added to Marketing role</p>
                        <span class="activity-time">15 minutes ago</span>
                    </div>
                </div>
                
                <div class="activity-item">
                    <div class="activity-icon warning">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Permission Changed</h4>
                        <p>Admin role permissions updated</p>
                        <span class="activity-time">1 hour ago</span>
                    </div>
                </div>
                
                <div class="activity-item">
                    <div class="activity-icon error">
                        <i class="fas fa-ban"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Access Denied</h4>
                        <p>Failed login attempt detected</p>
                        <span class="activity-time">2 hours ago</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- System Status Section -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">System Status</h2>
        <p class="card-subtitle">Current ACL system health and configuration</p>
    </div>
    <div class="card-content">
        <div class="status-grid">
            <div class="status-item">
                <div class="status-indicator success"></div>
                <div class="status-content">
                    <h4>Authentication Service</h4>
                    <p>All systems operational</p>
                </div>
            </div>
            
            <div class="status-item">
                <div class="status-indicator success"></div>
                <div class="status-content">
                    <h4>Permission Engine</h4>
                    <p>Running smoothly</p>
                </div>
            </div>
            
            <div class="status-item">
                <div class="status-indicator warning"></div>
                <div class="status-content">
                    <h4>Session Management</h4>
                    <p>High load detected</p>
                </div>
            </div>
            
            <div class="status-item">
                <div class="status-indicator success"></div>
                <div class="status-content">
                    <h4>Audit Logging</h4>
                    <p>All events captured</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>