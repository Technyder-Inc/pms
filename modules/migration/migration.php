<?php
// Path variables for navigation and assets
$base_path = '../../';
$css_path = '../../public/';
$js_path = '../../public/';
$assets_path = '../../';

// Migration Page
$pageTitle = 'Migration';
$currentPage = 'migration';
?>

<?php include '../../includes/header.php'; ?>

<div class="page-header">
    <div class="page-header-content">
        <h1 class="page-title">Property Migration Management</h1>
        <p class="page-description">Manage property unit migrations and transfers efficiently</p>
    </div>
    <div class="page-actions">
        <button class="btn btn-primary">
            <span>New Migration Request</span>
        </button>
    </div>
</div>

<div class="content-wrapper">
    <div class="migration-dashboard">
        <!-- Quick Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Pending Requests</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-number">0</div>
                    <div class="stat-label">In Progress</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Completed This Month</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-number">0</div>
                    <div class="stat-label">Total Migrations</div>
                </div>
            </div>
        </div>

        <!-- Migration Requests Table -->
        <div class="data-table-container">
            <div class="table-header">
                <h3>Migration Requests</h3>
                <div class="table-actions">
                    <div class="search-box">
                        <input type="text" placeholder="Search migrations..." class="search-input">
                    </div>
                    <select class="filter-select">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>
            
            <div class="empty-state">
                <div class="empty-state-content">
                    <div class="empty-state-icon">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                            <path d="M8 21v-4a2 2 0 012-2h4a2 2 0 012 2v4"/>
                            <path d="M9 9h6"/>
                            <path d="M9 13h6"/>
                        </svg>
                    </div>
                    <h3>No Migration Requests</h3>
                    <p>There are currently no migration requests in the system. Create a new migration request to get started.</p>
                    <button class="btn btn-primary">Create First Migration</button>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
