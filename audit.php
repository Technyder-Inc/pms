<?php
// PHP Configuration
$pageTitle = "Audit";
$currentPage = "audit";
$breadcrumb_section = "Company";
$breadcrumb_current = "Audit Log";
$show_subnav = true;
$subnav_items = [
    ['href' => '#audit', 'label' => 'Audit Log'],
    ['href' => '#overview', 'label' => 'Overview']
];
include 'includes/header.php';
?>

        <!-- Content Area -->
        <div class="content" id="pageContent">
            <!-- Audit Log Section -->
            <section id="audit-log-section" class="content-section" role="tabpanel" aria-labelledby="audit-log-tab">
                <div class="section-header">
                    <h2>Audit Log</h2>
                    <div class="header-actions">
                        <button class="btn btn-secondary" onclick="exportAuditLog()">Export CSV</button>
                        <button class="btn btn-secondary" onclick="toggleFilters()">Filter</button>
                        <button class="btn btn-primary" onclick="refreshAuditLog()">Refresh</button>
                    </div>
                </div>
                
                <!-- Filters -->
                <div class="filters-bar">
                    <div class="filter-group">
                        <label for="dateRange">Date Range:</label>
                        <select id="dateRange">
                            <option value="today">Today</option>
                            <option value="week" selected>Last 7 days</option>
                            <option value="month">Last 30 days</option>
                            <option value="custom">Custom Range</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="userFilter">User:</label>
                        <select id="userFilter">
                            <option value="all">All Users</option>
                            <option value="admin">Admin User</option>
                            <option value="manager">Sales Manager</option>
                            <option value="agent">Sales Agent</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="actionFilter">Action Type:</label>
                        <select id="actionFilter">
                            <option value="all">All Actions</option>
                            <option value="create">Create</option>
                            <option value="update">Update</option>
                            <option value="delete">Delete</option>
                            <option value="login">Login</option>
                            <option value="logout">Logout</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="moduleFilter">Module:</label>
                        <select id="moduleFilter">
                            <option value="all">All Modules</option>
                            <option value="customers">Customers</option>
                            <option value="leads">Leads</option>
                            <option value="inventory">Inventory</option>
                            <option value="bookings">Bookings</option>
                            <option value="finance">Finance</option>
                            <option value="compliance">Compliance</option>
                            <option value="reports">Reports</option>
                            <option value="settings">Settings</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" onclick="applyFilters()">Apply Filters</button>
                </div>

                <!-- Audit Log Table -->
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Timestamp</th>
                                <th>User</th>
                                <th>Action</th>
                                <th>Module</th>
                                <th>Record ID</th>
                                <th>Details</th>
                                <th>IP Address</th>
                            </tr>
                        </thead>
                        <tbody id="auditLogTableBody">
                            <!-- Table content will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-container">
                    <div class="pagination-info">
                        <span>Showing <span id="currentRange">1-25</span> of <span id="totalRecords">156</span> records</span>
                    </div>
                    <div class="pagination">
                        <button class="pagination-btn" onclick="previousPage()" disabled>Previous</button>
                        <span class="pagination-pages">
                            <button class="pagination-page active">1</button>
                            <button class="pagination-page">2</button>
                            <button class="pagination-page">3</button>
                            <span class="pagination-ellipsis">...</span>
                            <button class="pagination-page">7</button>
                        </span>
                        <button class="pagination-btn" onclick="nextPage()">Next</button>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="app.js"></script>
    <script>
        // Initialize audit log functionality
        document.addEventListener('DOMContentLoaded', function() {
            loadAuditLog();
        });

        function loadAuditLog() {
            // Load audit log data
            console.log('Loading audit log data...');
        }

        function exportAuditLog() {
            console.log('Exporting audit log...');
        }

        function toggleFilters() {
            const filtersBar = document.querySelector('.filters-bar');
            filtersBar.style.display = filtersBar.style.display === 'none' ? 'flex' : 'none';
        }

        function refreshAuditLog() {
            loadAuditLog();
        }

        function applyFilters() {
            console.log('Applying filters...');
            loadAuditLog();
        }

        function previousPage() {
            console.log('Previous page');
        }

        function nextPage() {
            console.log('Next page');
        }
    </script>
</body>
</html>