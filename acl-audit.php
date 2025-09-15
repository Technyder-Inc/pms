<?php
$pageTitle = 'Access Audit - Property Management System';
$currentPage = 'acl-audit';
$breadcrumb_section = 'Access Control';
$breadcrumb_current = 'Access Audit';
include 'includes/header.php';
?>

<div class="page-header">
    <div class="header-content">
        <h1 class="page-title">Access Audit</h1>
        <p class="page-description">Monitor and track system access activities and security events</p>
    </div>
    <div class="header-actions">
        <button class="btn btn-secondary">
            <i class="fas fa-download"></i>
            Export Audit Log
        </button>
        <button class="btn btn-primary">
            <i class="fas fa-shield-alt"></i>
            Security Report
        </button>
    </div>
</div>

<!-- Audit Overview -->
<div class="audit-overview">
    <div class="overview-stats">
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">1,247</h3>
                <p class="stat-label">Successful Logins</p>
                <span class="stat-period">Last 30 days</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">23</h3>
                <p class="stat-label">Failed Attempts</p>
                <span class="stat-period">Last 30 days</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon info">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">156</h3>
                <p class="stat-label">Permission Changes</p>
                <span class="stat-period">Last 30 days</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon danger">
                <i class="fas fa-ban"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">5</h3>
                <p class="stat-label">Blocked Access</p>
                <span class="stat-period">Last 30 days</span>
            </div>
        </div>
    </div>
</div>

<!-- Audit Filters -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Audit Filters</h2>
    </div>
    <div class="card-content">
        <div class="filter-controls">
            <div class="filter-group">
                <label for="eventTypeFilter">Event Type</label>
                <select id="eventTypeFilter">
                    <option value="">All Events</option>
                    <option value="login">Login</option>
                    <option value="logout">Logout</option>
                    <option value="permission_change">Permission Change</option>
                    <option value="role_assignment">Role Assignment</option>
                    <option value="access_denied">Access Denied</option>
                    <option value="data_access">Data Access</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="userFilter">User</label>
                <select id="userFilter">
                    <option value="">All Users</option>
                    <option value="john.smith">John Smith</option>
                    <option value="sarah.johnson">Sarah Johnson</option>
                    <option value="mike.davis">Mike Davis</option>
                    <option value="lisa.wilson">Lisa Wilson</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="dateFromFilter">Date From</label>
                <input type="date" id="dateFromFilter">
            </div>
            
            <div class="filter-group">
                <label for="dateToFilter">Date To</label>
                <input type="date" id="dateToFilter">
            </div>
            
            <div class="filter-group">
                <label for="severityFilter">Severity</label>
                <select id="severityFilter">
                    <option value="">All Levels</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="critical">Critical</option>
                </select>
            </div>
            
            <div class="filter-group">
                <button class="btn btn-secondary">Reset</button>
                <button class="btn btn-primary">Apply Filters</button>
            </div>
        </div>
    </div>
</div>

<!-- Audit Log Table -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Audit Log</h2>
        <div class="card-actions">
            <div class="search-box">
                <input type="text" placeholder="Search audit logs...">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>
    <div class="card-content">
        <div class="audit-table">
            <table>
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Event Type</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Resource</th>
                        <th>IP Address</th>
                        <th>Severity</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="timestamp">
                                <span class="date">2024-02-20</span>
                                <span class="time">14:32:15</span>
                            </div>
                        </td>
                        <td>
                            <span class="event-type login">Login</span>
                        </td>
                        <td>
                            <div class="user-info">
                                <span class="user-name">John Smith</span>
                                <span class="user-role">Administrator</span>
                            </div>
                        </td>
                        <td>User Login</td>
                        <td>/dashboard</td>
                        <td>192.168.1.100</td>
                        <td>
                            <span class="severity-badge low">Low</span>
                        </td>
                        <td>
                            <span class="status-badge success">Success</span>
                        </td>
                        <td>
                            <button class="btn-icon" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="timestamp">
                                <span class="date">2024-02-20</span>
                                <span class="time">14:28:42</span>
                            </div>
                        </td>
                        <td>
                            <span class="event-type permission">Permission Change</span>
                        </td>
                        <td>
                            <div class="user-info">
                                <span class="user-name">Sarah Johnson</span>
                                <span class="user-role">Manager</span>
                            </div>
                        </td>
                        <td>Role Assignment</td>
                        <td>User: Mike Davis</td>
                        <td>192.168.1.105</td>
                        <td>
                            <span class="severity-badge medium">Medium</span>
                        </td>
                        <td>
                            <span class="status-badge success">Success</span>
                        </td>
                        <td>
                            <button class="btn-icon" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="timestamp">
                                <span class="date">2024-02-20</span>
                                <span class="time">14:15:33</span>
                            </div>
                        </td>
                        <td>
                            <span class="event-type access-denied">Access Denied</span>
                        </td>
                        <td>
                            <div class="user-info">
                                <span class="user-name">Lisa Wilson</span>
                                <span class="user-role">Viewer</span>
                            </div>
                        </td>
                        <td>Unauthorized Access</td>
                        <td>/admin/settings</td>
                        <td>192.168.1.112</td>
                        <td>
                            <span class="severity-badge high">High</span>
                        </td>
                        <td>
                            <span class="status-badge failed">Failed</span>
                        </td>
                        <td>
                            <button class="btn-icon" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="timestamp">
                                <span class="date">2024-02-20</span>
                                <span class="time">13:45:18</span>
                            </div>
                        </td>
                        <td>
                            <span class="event-type data-access">Data Access</span>
                        </td>
                        <td>
                            <div class="user-info">
                                <span class="user-name">Mike Davis</span>
                                <span class="user-role">Agent</span>
                            </div>
                        </td>
                        <td>Customer Data Export</td>
                        <td>/customers/export</td>
                        <td>192.168.1.108</td>
                        <td>
                            <span class="severity-badge medium">Medium</span>
                        </td>
                        <td>
                            <span class="status-badge success">Success</span>
                        </td>
                        <td>
                            <button class="btn-icon" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="timestamp">
                                <span class="date">2024-02-20</span>
                                <span class="time">13:22:07</span>
                            </div>
                        </td>
                        <td>
                            <span class="event-type login">Failed Login</span>
                        </td>
                        <td>
                            <div class="user-info">
                                <span class="user-name">Unknown User</span>
                                <span class="user-role">-</span>
                            </div>
                        </td>
                        <td>Invalid Credentials</td>
                        <td>/login</td>
                        <td>203.45.67.89</td>
                        <td>
                            <span class="severity-badge critical">Critical</span>
                        </td>
                        <td>
                            <span class="status-badge failed">Failed</span>
                        </td>
                        <td>
                            <button class="btn-icon" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="pagination">
            <div class="pagination-info">
                Showing 1-5 of 1,247 entries
            </div>
            <div class="pagination-controls">
                <button class="btn btn-secondary" disabled>Previous</button>
                <button class="btn btn-primary">1</button>
                <button class="btn btn-secondary">2</button>
                <button class="btn btn-secondary">3</button>
                <span>...</span>
                <button class="btn btn-secondary">25</button>
                <button class="btn btn-secondary">Next</button>
            </div>
        </div>
    </div>
</div>

<!-- Security Alerts -->
<div class="content-card">
    <div class="card-header">
        <h2 class="card-title">Security Alerts</h2>
        <p class="card-subtitle">Recent security events requiring attention</p>
    </div>
    <div class="card-content">
        <div class="security-alerts">
            <div class="alert-item critical">
                <div class="alert-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="alert-content">
                    <h4 class="alert-title">Multiple Failed Login Attempts</h4>
                    <p class="alert-description">5 failed login attempts from IP 203.45.67.89 in the last hour</p>
                    <span class="alert-time">2 minutes ago</span>
                </div>
                <div class="alert-actions">
                    <button class="btn btn-sm btn-danger">Block IP</button>
                    <button class="btn btn-sm btn-secondary">Investigate</button>
                </div>
            </div>
            
            <div class="alert-item warning">
                <div class="alert-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="alert-content">
                    <h4 class="alert-title">Unusual Access Pattern</h4>
                    <p class="alert-description">User Lisa Wilson attempted to access admin areas multiple times</p>
                    <span class="alert-time">15 minutes ago</span>
                </div>
                <div class="alert-actions">
                    <button class="btn btn-sm btn-warning">Review Access</button>
                    <button class="btn btn-sm btn-secondary">Dismiss</button>
                </div>
            </div>
            
            <div class="alert-item info">
                <div class="alert-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="alert-content">
                    <h4 class="alert-title">New User Registration</h4>
                    <p class="alert-description">New user account created: alex.brown@company.com</p>
                    <span class="alert-time">1 hour ago</span>
                </div>
                <div class="alert-actions">
                    <button class="btn btn-sm btn-primary">Assign Role</button>
                    <button class="btn btn-sm btn-secondary">View Profile</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>