<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

// User Management Page
$pageTitle = 'User Management';
$currentPage = 'user-management';
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
                <h2 class="card-title">Active Users</h2>
                <div class="card-actions">
                    <button class="btn btn-secondary">Export</button>
                    <button class="btn btn-primary">Add User</button>
                </div>
            </div>
            <div class="card-content">
                <div class="filters-bar">
                    <div class="filter-group">
                        <label>Role:</label>
                        <select class="form-select">
                            <option value="">All Roles</option>
                            <option value="admin">Administrator</option>
                            <option value="manager">Manager</option>
                            <option value="agent">Sales Agent</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Status:</label>
                        <select class="form-select">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <input type="text" class="form-input" placeholder="Search users...">
                    </div>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="../assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                        <div>
                                            <div class="user-name">John Smith</div>
                                            <div class="user-email">john.smith@company.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-primary">Administrator</span></td>
                                <td>IT Department</td>
                                <td><span class="status-active">Active</span></td>
                                <td>2024-01-15 10:30 AM</td>
                                <td>2023-06-15</td>
                                <td>
                                    <button class="btn-icon" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-icon" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-icon" title="Suspend"><i class="fas fa-ban"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="../assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                        <div>
                                            <div class="user-name">Sarah Johnson</div>
                                            <div class="user-email">sarah.johnson@company.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-secondary">Manager</span></td>
                                <td>Sales Department</td>
                                <td><span class="status-active">Active</span></td>
                                <td>2024-01-15 09:15 AM</td>
                                <td>2023-08-20</td>
                                <td>
                                    <button class="btn-icon" title="View"><i class="fas fa-eye"></i></button>
                                    <button class="btn-icon" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-icon" title="Suspend"><i class="fas fa-ban"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">User Activity</h2>
            </div>
            <div class="card-content">
                <div class="activity-stats">
                    <div class="stat-item">
                        <div class="stat-value">24</div>
                        <div class="stat-label">Active Today</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">156</div>
                        <div class="stat-label">Total Users</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">12</div>
                        <div class="stat-label">New This Month</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">3</div>
                        <div class="stat-label">Pending Approval</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Recent User Actions</h2>
            </div>
            <div class="card-content">
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-plus text-success"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">New user registered</div>
                            <div class="activity-description">Mike Wilson joined as Sales Agent</div>
                            <div class="activity-time">2 hours ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-edit text-primary"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">User profile updated</div>
                            <div class="activity-description">Sarah Johnson updated her contact information</div>
                            <div class="activity-time">4 hours ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-times text-warning"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">User suspended</div>
                            <div class="activity-description">Tom Brown was suspended for policy violation</div>
                            <div class="activity-time">1 day ago</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>