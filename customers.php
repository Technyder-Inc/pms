<?php
// Customers Page
$pageTitle = 'Customers';
$currentPage = 'customers';
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
                <li><a href="#list" role="tab" aria-selected="true" class="subnav-pill active">List</a></li>
                <li><a href="#new" role="tab" aria-selected="false" class="subnav-pill">New</a></li>
                <li><a href="#view" role="tab" aria-selected="false" class="subnav-pill">View</a></li>
                <li><a href="#kyc" role="tab" aria-selected="false" class="subnav-pill">KYC Status</a></li>
                <li><a href="#attachments" role="tab" aria-selected="false" class="subnav-pill">Attachments</a></li>
                <li><a href="#schedule" role="tab" aria-selected="false" class="subnav-pill">Schedule</a></li>
                <li><a href="#waiver" role="tab" aria-selected="false" class="subnav-pill">Waiver</a></li>
                <li><a href="#reminder" role="tab" aria-selected="false" class="subnav-pill">Reminder</a></li>
            </ul>
        </nav>

        <!-- Content Area -->
        <div class="content" id="pageContent">
            <!-- List Section -->
            <section id="list-section" class="content-section" role="tabpanel" aria-labelledby="list-tab">
                <div class="section-header">
                    <h2>Customer List</h2>
                    <button class="btn btn-primary" onclick="showSection('new')">Add New Customer</button>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="customersTableBody">
                            <!-- Customer data will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- New/Edit Section -->
            <section id="new-section" class="content-section hidden" role="tabpanel" aria-labelledby="new-tab">
                <div class="section-header">
                    <h2 id="formTitle">Add New Customer</h2>
                    <button class="btn btn-secondary" onclick="showSection('list')">Back to List</button>
                </div>
                
                <form id="customerForm" class="form-container">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="firstName">First Name *</label>
                            <input type="text" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name *</label>
                            <input type="text" id="lastName" name="lastName" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save Customer</button>
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">Reset</button>
                    </div>
                </form>
            </section>

            <!-- View Section -->
            <section id="view-section" class="content-section hidden" role="tabpanel" aria-labelledby="view-tab">
                <div class="section-header">
                    <h2>Customer Details</h2>
                    <div class="header-actions">
                        <button class="btn btn-primary" onclick="editCustomer()">Edit</button>
                        <button class="btn btn-secondary" onclick="showSection('list')">Back to List</button>
                    </div>
                </div>
                
                <div id="customerDetails" class="details-container">
                    <!-- Customer details will be populated by JavaScript -->
                </div>
            </section>

            <!-- KYC Status Section -->
            <section id="kyc-section" class="content-section hidden" role="tabpanel" aria-labelledby="kyc-tab">
                <div class="section-header">
                    <h2>KYC Status Management</h2>
                </div>
                
                <div class="kyc-container">
                    <div class="kyc-status-card">
                        <h3>Document Verification</h3>
                        <div class="status-grid">
                            <div class="status-item">
                                <span class="status-label">Identity Proof:</span>
                                <span class="status-badge status-verified">Verified</span>
                            </div>
                            <div class="status-item">
                                <span class="status-label">Address Proof:</span>
                                <span class="status-badge status-pending">Pending</span>
                            </div>
                            <div class="status-item">
                                <span class="status-label">Income Proof:</span>
                                <span class="status-badge status-not-submitted">Not Submitted</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Attachments Section -->
            <section id="attachments-section" class="content-section hidden" role="tabpanel" aria-labelledby="attachments-tab">
                <div class="section-header">
                    <h2>Customer Attachments</h2>
                    <button class="btn btn-primary">Upload Document</button>
                </div>
                
                <div class="attachments-grid">
                    <div class="attachment-card">
                        <div class="attachment-icon">📄</div>
                        <div class="attachment-info">
                            <h4>Identity Proof</h4>
                            <p>passport.pdf</p>
                            <span class="attachment-date">Uploaded: 2024-01-15</span>
                        </div>
                        <div class="attachment-actions">
                            <button class="btn btn-sm">View</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </section>
        

        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>