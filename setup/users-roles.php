<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

// Users & Roles Page
$pageTitle = 'Users & Roles';
$currentPage = 'users-roles';
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
                <h2 class="card-title">User Management</h2>
                <button class="btn btn-primary">Add User</button>
            </div>
            <div class="card-content">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="../assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                        <span>John Smith</span>
                                    </div>
                                </td>
                                <td>john.smith@company.com</td>
                                <td><span class="badge badge-primary">Administrator</span></td>
                                <td><span class="status-active">Active</span></td>
                                <td>2024-01-15 10:30 AM</td>
                                <td>
                                    <button class="btn-icon" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-icon" title="Delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="../assets/sample-avatar.png" alt="User" class="user-avatar-small">
                                        <span>Sarah Johnson</span>
                                    </div>
                                </td>
                                <td>sarah.johnson@company.com</td>
                                <td><span class="badge badge-secondary">Manager</span></td>
                                <td><span class="status-active">Active</span></td>
                                <td>2024-01-15 09:15 AM</td>
                                <td>
                                    <button class="btn-icon" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-icon" title="Delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Role Management</h2>
                <button class="btn btn-primary">Create Role</button>
            </div>
            <div class="card-content">
                <div class="roles-grid">
                    <div class="role-card">
                        <div class="role-header">
                            <h3>Administrator</h3>
                            <span class="role-users">2 users</span>
                        </div>
                        <div class="role-permissions">
                            <span class="permission-tag">Full Access</span>
                            <span class="permission-tag">User Management</span>
                            <span class="permission-tag">System Settings</span>
                        </div>
                        <div class="role-actions">
                            <button class="btn btn-secondary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                    
                    <div class="role-card">
                        <div class="role-header">
                            <h3>Manager</h3>
                            <span class="role-users">5 users</span>
                        </div>
                        <div class="role-permissions">
                            <span class="permission-tag">Property Management</span>
                            <span class="permission-tag">Customer Management</span>
                            <span class="permission-tag">Reports</span>
                        </div>
                        <div class="role-actions">
                            <button class="btn btn-secondary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                    
                    <div class="role-card">
                        <div class="role-header">
                            <h3>Sales Agent</h3>
                            <span class="role-users">12 users</span>
                        </div>
                        <div class="role-permissions">
                            <span class="permission-tag">Lead Management</span>
                            <span class="permission-tag">Customer View</span>
                            <span class="permission-tag">Booking Creation</span>
                        </div>
                        <div class="role-actions">
                            <button class="btn btn-secondary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Permission Matrix</h2>
            </div>
            <div class="card-content">
                <div class="permission-matrix">
                    <table class="matrix-table">
                        <thead>
                            <tr>
                                <th>Permission</th>
                                <th>Administrator</th>
                                <th>Manager</th>
                                <th>Sales Agent</th>
                                <th>Viewer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>User Management</td>
                                <td><i class="fas fa-check text-success"></i></td>
                                <td><i class="fas fa-times text-danger"></i></td>
                                <td><i class="fas fa-times text-danger"></i></td>
                                <td><i class="fas fa-times text-danger"></i></td>
                            </tr>
                            <tr>
                                <td>Property Management</td>
                                <td><i class="fas fa-check text-success"></i></td>
                                <td><i class="fas fa-check text-success"></i></td>
                                <td><i class="fas fa-times text-danger"></i></td>
                                <td><i class="fas fa-times text-danger"></i></td>
                            </tr>
                            <tr>
                                <td>Customer Management</td>
                                <td><i class="fas fa-check text-success"></i></td>
                                <td><i class="fas fa-check text-success"></i></td>
                                <td><i class="fas fa-check text-success"></i></td>
                                <td><i class="fas fa-eye text-warning"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>