<?php
// Dashboard Page
$pageTitle = 'Dashboard';
$currentPage = 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Property Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="content">
        <div class="content-header">
            <h1>Dashboard</h1>
            <p class="content-description">Welcome to your Property Management System dashboard</p>
        </div>
        
        <!-- Dashboard Content -->
        <div class="content-section" id="section-overview">
            <div class="dashboard-grid">
                <!-- Quick Stats -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3>Quick Stats</h3>
                    </div>
                    <div class="card-content">
                        <div class="stat-grid">
                            <div class="stat-item">
                                <div class="stat-value">1,247</div>
                                <div class="stat-label">Total Customers</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">89</div>
                                <div class="stat-label">Active Leads</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">456</div>
                                <div class="stat-label">Units Available</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">₹2.4M</div>
                                <div class="stat-label">Monthly Revenue</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Activity -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3>Recent Activity</h3>
                    </div>
                    <div class="card-content">
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon">👤</div>
                                <div class="activity-content">
                                    <div class="activity-title">New customer registered</div>
                                    <div class="activity-time">2 minutes ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">📋</div>
                                <div class="activity-content">
                                    <div class="activity-title">KYC Status updated to Funding</div>
                                    <div class="activity-time">5 minutes ago</div>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">✅</div>
                                <div class="activity-content">
                                    <div class="activity-title">Contact information verified</div>
                                    <div class="activity-time">10 minutes ago</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3>Quick Actions</h3>
                    </div>
                    <div class="card-content">
                        <div class="quick-actions">
                            <a href="customers.php" class="action-btn">
                                <i class="fas fa-user-plus"></i>
                                <span>Add Customer</span>
                            </a>
                            <a href="leads.php" class="action-btn">
                                <i class="fas fa-clipboard-list"></i>
                                <span>Create Lead</span>
                            </a>
                            <a href="bookings.php" class="action-btn">
                                <i class="fas fa-calendar-plus"></i>
                                <span>New Booking</span>
                            </a>
                            <a href="finance.php" class="action-btn">
                                <i class="fas fa-receipt"></i>
                                <span>Record Payment</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pending Tasks -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3>Pending Tasks</h3>
                    </div>
                    <div class="card-content">
                        <div class="task-list">
                            <div class="task-item">
                                <div class="task-priority high"></div>
                                <div class="task-content">
                                    <div class="task-title">KYC verification pending</div>
                                    <div class="task-description">5 customers awaiting approval</div>
                                </div>
                                <div class="task-action">
                                    <button class="btn btn-sm btn-primary">Review</button>
                                </div>
                            </div>
                            <div class="task-item">
                                <div class="task-priority medium"></div>
                                <div class="task-content">
                                    <div class="task-title">Payment follow-ups</div>
                                    <div class="task-description">12 overdue payments</div>
                                </div>
                                <div class="task-action">
                                    <button class="btn btn-sm btn-secondary">View</button>
                                </div>
                            </div>
                            <div class="task-item">
                                <div class="task-priority low"></div>
                                <div class="task-content">
                                    <div class="task-title">Monthly reports</div>
                                    <div class="task-description">Due in 3 days</div>
                                </div>
                                <div class="task-action">
                                    <button class="btn btn-sm btn-secondary">Generate</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue Chart -->
                <div class="dashboard-card chart-card">
                    <div class="card-header">
                        <h3>Revenue Trend</h3>
                        <div class="chart-controls">
                            <select class="form-select">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option>Last 3 months</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="chart-placeholder">
                            <div class="chart-info">
                                <div class="chart-value">₹2.4M</div>
                                <div class="chart-label">Total Revenue</div>
                                <div class="chart-change positive">+12% from last month</div>
                            </div>
                            <div class="chart-visual">
                                <!-- Chart visualization would go here -->
                                <div class="chart-bars">
                                    <div class="chart-bar" style="height: 60%"></div>
                                    <div class="chart-bar" style="height: 80%"></div>
                                    <div class="chart-bar" style="height: 45%"></div>
                                    <div class="chart-bar" style="height: 90%"></div>
                                    <div class="chart-bar" style="height: 70%"></div>
                                    <div class="chart-bar" style="height: 85%"></div>
                                    <div class="chart-bar" style="height: 95%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Status -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3>Property Status</h3>
                    </div>
                    <div class="card-content">
                        <div class="status-grid">
                            <div class="status-item">
                                <div class="status-icon available">🏠</div>
                                <div class="status-content">
                                    <div class="status-value">456</div>
                                    <div class="status-label">Available</div>
                                </div>
                            </div>
                            <div class="status-item">
                                <div class="status-icon occupied">🔑</div>
                                <div class="status-content">
                                    <div class="status-value">234</div>
                                    <div class="status-label">Occupied</div>
                                </div>
                            </div>
                            <div class="status-item">
                                <div class="status-icon maintenance">🔧</div>
                                <div class="status-content">
                                    <div class="status-value">12</div>
                                    <div class="status-label">Maintenance</div>
                                </div>
                            </div>
                            <div class="status-item">
                                <div class="status-icon reserved">📋</div>
                                <div class="status-content">
                                    <div class="status-value">89</div>
                                    <div class="status-label">Reserved</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>