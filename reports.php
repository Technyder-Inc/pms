<?php
// Reports Page
$pageTitle = 'Reports';
$currentPage = 'reports';
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
        <!-- Horizontal Sub-Navigation -->
        <nav class="subnav" id="moduleSubnav" aria-label="Section navigation">
            <ul role="tablist">
                <li><a href="#sales" role="tab" aria-selected="true" class="subnav-pill active">Sales Reports</a></li>
                <li><a href="#financial" role="tab" aria-selected="false" class="subnav-pill">Financial</a></li>
                <li><a href="#inventory" role="tab" aria-selected="false" class="subnav-pill">Inventory</a></li>
                <li><a href="#customer" role="tab" aria-selected="false" class="subnav-pill">Customer</a></li>
                <li><a href="#compliance" role="tab" aria-selected="false" class="subnav-pill">Compliance</a></li>
            </ul>
        </nav>

        <!-- Content Area -->
        <div class="content" id="pageContent">
            <!-- Sales Reports Section -->
            <section id="sales-section" class="content-section" role="tabpanel" aria-labelledby="sales-tab">
                <div class="section-header">
                    <h2>Sales Reports</h2>
                    <div class="header-actions">
                        <button class="btn btn-secondary" onclick="exportReport('pdf')">Export PDF</button>
                        <button class="btn btn-primary" onclick="generateReport()">Generate Report</button>
                    </div>
                </div>
                
                <div class="reports-grid">
                    <div class="report-card">
                        <h3>Sales Summary</h3>
                        <p>Monthly sales performance and trends</p>
                        <div class="report-stats">
                            <div class="stat">
                                <span class="stat-value">$2.4M</span>
                                <span class="stat-label">Total Sales</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">45</span>
                                <span class="stat-label">Units Sold</span>
                            </div>
                        </div>
                        <button class="btn btn-sm" onclick="viewReportDetails('sales-summary')">View Details</button>
                    </div>
                    
                    <div class="report-card">
                        <h3>Lead Conversion</h3>
                        <p>Lead to customer conversion analysis</p>
                        <div class="report-stats">
                            <div class="stat">
                                <span class="stat-value">32%</span>
                                <span class="stat-label">Conversion Rate</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">156</span>
                                <span class="stat-label">Total Leads</span>
                            </div>
                        </div>
                        <button class="btn btn-sm" onclick="viewReportDetails('lead-conversion')">View Details</button>
                    </div>
                    
                    <div class="report-card">
                        <h3>Sales by Project</h3>
                        <p>Project-wise sales breakdown and performance</p>
                        <div class="report-stats">
                            <div class="stat">
                                <span class="stat-value">3</span>
                                <span class="stat-label">Active Projects</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">85%</span>
                                <span class="stat-label">Avg. Occupancy</span>
                            </div>
                        </div>
                        <button class="btn btn-sm" onclick="viewReportDetails('sales-by-project')">View Details</button>
                    </div>
                    
                    <div class="report-card">
                        <h3>Agent Performance</h3>
                        <p>Sales team performance metrics</p>
                        <div class="report-stats">
                            <div class="stat">
                                <span class="stat-value">8</span>
                                <span class="stat-label">Active Agents</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">$300K</span>
                                <span class="stat-label">Avg. Sales</span>
                            </div>
                        </div>
                        <button class="btn btn-sm" onclick="viewReportDetails('agent-performance')">View Details</button>
                    </div>
                </div>
            </section>

            <!-- Financial Reports Section -->
            <section id="financial-section" class="content-section hidden" role="tabpanel" aria-labelledby="financial-tab">
                <div class="section-header">
                    <h2>Financial Reports</h2>
                    <div class="header-actions">
                        <button class="btn btn-secondary" onclick="exportReport('excel')">Export Excel</button>
                        <button class="btn btn-primary" onclick="generateFinancialReport()">Generate Report</button>
                    </div>
                </div>
                
                <div class="reports-grid">
                    <div class="report-card">
                        <h3>Revenue Analysis</h3>
                        <p>Monthly and quarterly revenue breakdown</p>
                        <div class="report-stats">
                            <div class="stat">
                                <span class="stat-value">$1.8M</span>
                                <span class="stat-label">This Quarter</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">+15%</span>
                                <span class="stat-label">Growth</span>
                            </div>
                        </div>
                        <button class="btn btn-sm" onclick="viewReportDetails('revenue-analysis')">View Details</button>
                    </div>
                    
                    <div class="report-card">
                        <h3>Payment Collections</h3>
                        <p>Payment collection efficiency and trends</p>
                        <div class="report-stats">
                            <div class="stat">
                                <span class="stat-value">92%</span>
                                <span class="stat-label">Collection Rate</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">$380K</span>
                                <span class="stat-label">Outstanding</span>
                            </div>
                        </div>
                        <button class="btn btn-sm" onclick="viewReportDetails('payment-collections')">View Details</button>
                    </div>
                </div>
            </section>

            <!-- Inventory Reports Section -->
            <section id="inventory-section" class="content-section hidden" role="tabpanel" aria-labelledby="inventory-tab">
                <div class="section-header">
                    <h2>Inventory Reports</h2>
                    <div class="header-actions">
                        <button class="btn btn-secondary" onclick="exportReport('csv')">Export CSV</button>
                        <button class="btn btn-primary" onclick="generateInventoryReport()">Generate Report</button>
                    </div>
                </div>
                
                <div class="reports-grid">
                    <div class="report-card">
                        <h3>Unit Availability</h3>
                        <p>Available units across all projects</p>
                        <div class="report-stats">
                            <div class="stat">
                                <span class="stat-value">156</span>
                                <span class="stat-label">Available Units</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">78%</span>
                                <span class="stat-label">Occupancy Rate</span>
                            </div>
                        </div>
                        <button class="btn btn-sm" onclick="viewReportDetails('unit-availability')">View Details</button>
                    </div>
                    
                    <div class="report-card">
                        <h3>Project Status</h3>
                        <p>Construction and delivery status</p>
                        <div class="report-stats">
                            <div class="stat">
                                <span class="stat-value">2</span>
                                <span class="stat-label">Ready Projects</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">1</span>
                                <span class="stat-label">Under Construction</span>
                            </div>
                        </div>
                        <button class="btn btn-sm" onclick="viewReportDetails('project-status')">View Details</button>
                    </div>
                </div>
            </section>

            <!-- Customer Reports Section -->
            <section id="customer-section" class="content-section hidden" role="tabpanel" aria-labelledby="customer-tab">
                <div class="section-header">
                    <h2>Customer Reports</h2>
                    <div class="header-actions">
                        <button class="btn btn-secondary" onclick="exportReport('pdf')">Export PDF</button>
                        <button class="btn btn-primary" onclick="generateCustomerReport()">Generate Report</button>
                    </div>
                </div>
                
                <div class="reports-grid">
                    <div class="report-card">
                        <h3>Customer Demographics</h3>
                        <p>Customer profile and demographic analysis</p>
                        <div class="report-stats">
                            <div class="stat">
                                <span class="stat-value">1,247</span>
                                <span class="stat-label">Total Customers</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">89%</span>
                                <span class="stat-label">Satisfaction Rate</span>
                            </div>
                        </div>
                        <button class="btn btn-sm" onclick="viewReportDetails('customer-demographics')">View Details</button>
                    </div>
                    
                    <div class="report-card">
                        <h3>Customer Lifecycle</h3>
                        <p>Customer journey and lifecycle analysis</p>
                        <div class="report-stats">
                            <div class="stat">
                                <span class="stat-value">45</span>
                                <span class="stat-label">Avg. Days to Close</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">$450K</span>
                                <span class="stat-label">Avg. Deal Size</span>
                            </div>
                        </div>
                        <button class="btn btn-sm" onclick="viewReportDetails('customer-lifecycle')">View Details</button>
                    </div>
                </div>
            </section>

            <!-- Compliance Reports Section -->
            <section id="compliance-section" class="content-section hidden" role="tabpanel" aria-labelledby="compliance-tab">
                <div class="section-header">
                    <h2>Compliance Reports</h2>
                    <div class="header-actions">
                        <button class="btn btn-secondary" onclick="exportReport('pdf')">Export PDF</button>
                        <button class="btn btn-primary" onclick="generateComplianceReport()">Generate Report</button>
                    </div>
                </div>
                
                <div class="reports-grid">
                    <div class="report-card">
                        <h3>Regulatory Compliance</h3>
                        <p>RERA and regulatory compliance status</p>
                        <div class="report-stats">
                            <div class="stat">
                                <span class="stat-value">100%</span>
                                <span class="stat-label">RERA Compliance</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">3</span>
                                <span class="stat-label">Active Licenses</span>
                            </div>
                        </div>
                        <button class="btn btn-sm" onclick="viewReportDetails('regulatory-compliance')">View Details</button>
                    </div>
                    
                    <div class="report-card">
                        <h3>Document Status</h3>
                        <p>Legal document and approval status</p>
                        <div class="report-stats">
                            <div class="stat">
                                <span class="stat-value">95%</span>
                                <span class="stat-label">Documents Complete</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">2</span>
                                <span class="stat-label">Pending Approvals</span>
                            </div>
                        </div>
                        <button class="btn btn-sm" onclick="viewReportDetails('document-status')">View Details</button>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>