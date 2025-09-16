<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

// Audit Logs Page
$pageTitle = 'Audit Logs';
$currentPage = 'audit-logs';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Property Management System</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">System Audit Logs</h2>
                <div class="card-actions">
                    <button class="btn btn-secondary">Export Logs</button>
                    <button class="btn btn-primary">Refresh</button>
                </div>
            </div>
            <div class="card-content">
                <div class="filters-bar">
                    <div class="filter-group">
                        <label>Date Range:</label>
                        <input type="date" class="form-input" value="2024-01-01">
                        <span>to</span>
                        <input type="date" class="form-input" value="2024-01-15">
                    </div>
                    <div class="filter-group">
                        <label>User:</label>
                        <select class="form-select">
                            <option value="">All Users</option>
                            <option value="admin">Administrator</option>
                            <option value="john.smith">John Smith</option>
                            <option value="sarah.johnson">Sarah Johnson</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Action Type:</label>
                        <select class="form-select">
                            <option value="">All Actions</option>
                            <option value="login">Login/Logout</option>
                            <option value="create">Create</option>
                            <option value="update">Update</option>
                            <option value="delete">Delete</option>
                            <option value="view">View</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Module:</label>
                        <select class="form-select">
                            <option value="">All Modules</option>
                            <option value="customers">Customers</option>
                            <option value="properties">Properties</option>
                            <option value="bookings">Bookings</option>
                            <option value="finance">Finance</option>
                            <option value="system">System</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <input type="text" class="form-input" placeholder="Search logs...">
                    </div>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Timestamp</th>
                                <th>User</th>
                                <th>Action</th>
                                <th>Module</th>
                                <th>Details</th>
                                <th>IP Address</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024-01-15 10:30:25</td>
                                <td>
                                    <div class="user-info">
                                        <img src="../assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                        <span>John Smith</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-primary">Login</span></td>
                                <td>Authentication</td>
                                <td>User logged in successfully</td>
                                <td>192.168.1.100</td>
                                <td><span class="status-success">Success</span></td>
                            </tr>
                            <tr>
                                <td>2024-01-15 10:28:15</td>
                                <td>
                                    <div class="user-info">
                                        <img src="../assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                        <span>Sarah Johnson</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-success">Create</span></td>
                                <td>Customers</td>
                                <td>Created new customer: Mike Wilson</td>
                                <td>192.168.1.105</td>
                                <td><span class="status-success">Success</span></td>
                            </tr>
                            <tr>
                                <td>2024-01-15 10:25:42</td>
                                <td>
                                    <div class="user-info">
                                        <img src="../assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                        <span>John Smith</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-warning">Update</span></td>
                                <td>Properties</td>
                                <td>Updated property details for ID: 12345</td>
                                <td>192.168.1.100</td>
                                <td><span class="status-success">Success</span></td>
                            </tr>
                            <tr>
                                <td>2024-01-15 10:22:18</td>
                                <td>
                                    <div class="user-info">
                                        <img src="../assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                        <span>Tom Brown</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-danger">Login</span></td>
                                <td>Authentication</td>
                                <td>Failed login attempt - Invalid password</td>
                                <td>192.168.1.200</td>
                                <td><span class="status-error">Failed</span></td>
                            </tr>
                            <tr>
                                <td>2024-01-15 10:20:33</td>
                                <td>
                                    <div class="user-info">
                                        <img src="../assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                        <span>Sarah Johnson</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-info">View</span></td>
                                <td>Reports</td>
                                <td>Generated monthly financial report</td>
                                <td>192.168.1.105</td>
                                <td><span class="status-success">Success</span></td>
                            </tr>
                            <tr>
                                <td>2024-01-15 10:18:07</td>
                                <td>
                                    <div class="user-info">
                                        <img src="../assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                        <span>John Smith</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-danger">Delete</span></td>
                                <td>Bookings</td>
                                <td>Deleted cancelled booking ID: 98765</td>
                                <td>192.168.1.100</td>
                                <td><span class="status-success">Success</span></td>
                            </tr>
                            <tr>
                                <td>2024-01-15 10:15:44</td>
                                <td>
                                    <div class="user-info">
                                        <img src="../assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                        <span>System</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-secondary">System</span></td>
                                <td>Backup</td>
                                <td>Automated database backup completed</td>
                                <td>127.0.0.1</td>
                                <td><span class="status-success">Success</span></td>
                            </tr>
                            <tr>
                                <td>2024-01-15 10:12:29</td>
                                <td>
                                    <div class="user-info">
                                        <img src="../assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                        <span>Sarah Johnson</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-warning">Update</span></td>
                                <td>System</td>
                                <td>Updated user permissions for Mike Wilson</td>
                                <td>192.168.1.105</td>
                                <td><span class="status-success">Success</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="pagination">
                    <button class="btn btn-secondary" disabled>Previous</button>
                    <span class="pagination-info">Page 1 of 15 (147 total records)</span>
                    <button class="btn btn-secondary">Next</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Audit Summary</h2>
            </div>
            <div class="card-content">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value">1,247</div>
                        <div class="stat-label">Total Actions Today</div>
                        <div class="stat-change positive">+12% from yesterday</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">23</div>
                        <div class="stat-label">Failed Login Attempts</div>
                        <div class="stat-change negative">+5 from yesterday</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">156</div>
                        <div class="stat-label">Data Modifications</div>
                        <div class="stat-change positive">-8% from yesterday</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">89</div>
                        <div class="stat-label">System Events</div>
                        <div class="stat-change neutral">Same as yesterday</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Security Alerts</h2>
            </div>
            <div class="card-content">
                <div class="alert-list">
                    <div class="alert-item alert-warning">
                        <div class="alert-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="alert-content">
                            <div class="alert-title">Multiple Failed Login Attempts</div>
                            <div class="alert-description">User 'tom.brown' has 5 failed login attempts in the last hour</div>
                            <div class="alert-time">2 hours ago</div>
                        </div>
                        <div class="alert-actions">
                            <button class="btn btn-sm btn-secondary">Investigate</button>
                            <button class="btn btn-sm btn-danger">Block User</button>
                        </div>
                    </div>
                    
                    <div class="alert-item alert-info">
                        <div class="alert-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="alert-content">
                            <div class="alert-title">Unusual Access Pattern</div>
                            <div class="alert-description">Login from new location detected for user 'sarah.johnson'</div>
                            <div class="alert-time">4 hours ago</div>
                        </div>
                        <div class="alert-actions">
                            <button class="btn btn-sm btn-secondary">Review</button>
                            <button class="btn btn-sm btn-primary">Approve</button>
                        </div>
                    </div>
                    
                    <div class="alert-item alert-success">
                        <div class="alert-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="alert-content">
                            <div class="alert-title">Security Scan Completed</div>
                            <div class="alert-description">Weekly security scan completed successfully - No threats detected</div>
                            <div class="alert-time">1 day ago</div>
                        </div>
                        <div class="alert-actions">
                            <button class="btn btn-sm btn-secondary">View Report</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>