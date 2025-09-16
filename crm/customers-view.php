<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

$pageTitle = "Customer Details - Property Management System";
$currentPage = "customers-view";
include '../includes/header.php';

// Get customer ID from URL parameter
$customerId = $_GET['id'] ?? '001';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-user"></i> Customer Details</h1>
            <p>View and manage customer information</p>
        </div>
        <div class="header-actions">
            <a href="customers-list.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
            <a href="customers-form.php?id=<?php echo $customerId; ?>" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Customer
            </a>
        </div>
    </div>

    <div class="customer-profile">
        <div class="profile-header">
            <div class="customer-avatar-large">JD</div>
            <div class="customer-details">
                <h2>John Doe</h2>
                <p class="customer-id">Customer ID: #<?php echo $customerId; ?></p>
                <div class="status-badges">
                    <span class="badge badge-success">Active</span>
                    <span class="badge badge-info">Individual</span>
                </div>
            </div>
        </div>

        <div class="profile-content">
            <div class="info-grid">
                <div class="info-section">
                    <h3><i class="fas fa-user"></i> Personal Information</h3>
                    <div class="info-items">
                        <div class="info-item">
                            <label>Full Name</label>
                            <span>John Doe</span>
                        </div>
                        <div class="info-item">
                            <label>Email</label>
                            <span>john.doe@email.com</span>
                        </div>
                        <div class="info-item">
                            <label>Phone</label>
                            <span>+92 300 1234567</span>
                        </div>
                        <div class="info-item">
                            <label>CNIC/ID</label>
                            <span>12345-6789012-3</span>
                        </div>
                        <div class="info-item">
                            <label>Date of Birth</label>
                            <span>January 15, 1985</span>
                        </div>
                    </div>
                </div>

                <div class="info-section">
                    <h3><i class="fas fa-map-marker-alt"></i> Address Information</h3>
                    <div class="info-items">
                        <div class="info-item">
                            <label>Street Address</label>
                            <span>123 Main Street, Block A</span>
                        </div>
                        <div class="info-item">
                            <label>City</label>
                            <span>Karachi</span>
                        </div>
                        <div class="info-item">
                            <label>State/Province</label>
                            <span>Sindh</span>
                        </div>
                        <div class="info-item">
                            <label>ZIP/Postal Code</label>
                            <span>75500</span>
                        </div>
                        <div class="info-item">
                            <label>Country</label>
                            <span>Pakistan</span>
                        </div>
                    </div>
                </div>

                <div class="info-section">
                    <h3><i class="fas fa-info-circle"></i> Customer Details</h3>
                    <div class="info-items">
                        <div class="info-item">
                            <label>Customer Type</label>
                            <span>Individual</span>
                        </div>
                        <div class="info-item">
                            <label>Status</label>
                            <span class="badge badge-success">Active</span>
                        </div>
                        <div class="info-item">
                            <label>Lead Source</label>
                            <span>Website</span>
                        </div>
                        <div class="info-item">
                            <label>Registration Date</label>
                            <span>January 15, 2024</span>
                        </div>
                        <div class="info-item">
                            <label>Last Updated</label>
                            <span>January 20, 2024</span>
                        </div>
                    </div>
                </div>

                <div class="info-section full-width">
                    <h3><i class="fas fa-sticky-note"></i> Notes</h3>
                    <div class="notes-content">
                        <p>Interested in 2-bedroom apartment in Phase 1. Prefers ground floor units. Budget range: 5-7 million PKR. Follow up scheduled for next week.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="related-sections">
        <div class="section-tabs">
            <button class="tab-btn active" onclick="showTab('bookings')">Bookings</button>
            <button class="tab-btn" onclick="showTab('payments')">Payments</button>
            <button class="tab-btn" onclick="showTab('documents')">Documents</button>
            <button class="tab-btn" onclick="showTab('activity')">Activity Log</button>
        </div>

        <div class="tab-content">
            <div id="bookings" class="tab-pane active">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Property</th>
                                <th>Unit</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#BK001</td>
                                <td>Green Valley Phase 1</td>
                                <td>A-101</td>
                                <td>6,500,000 PKR</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td>2024-01-15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="payments" class="tab-pane">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#PAY001</td>
                                <td>650,000 PKR</td>
                                <td>Booking</td>
                                <td>Bank Transfer</td>
                                <td><span class="badge badge-success">Completed</span></td>
                                <td>2024-01-15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="documents" class="tab-pane">
                <div class="documents-grid">
                    <div class="document-item">
                        <i class="fas fa-file-pdf"></i>
                        <span>CNIC Copy</span>
                        <button class="btn-icon"><i class="fas fa-download"></i></button>
                    </div>
                    <div class="document-item">
                        <i class="fas fa-file-image"></i>
                        <span>Passport Photo</span>
                        <button class="btn-icon"><i class="fas fa-download"></i></button>
                    </div>
                </div>
            </div>

            <div id="activity" class="tab-pane">
                <div class="activity-timeline">
                    <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-user-plus"></i></div>
                        <div class="activity-content">
                            <h4>Customer Created</h4>
                            <p>Customer profile was created in the system</p>
                            <span class="activity-time">January 15, 2024 - 10:30 AM</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon"><i class="fas fa-edit"></i></div>
                        <div class="activity-content">
                            <h4>Profile Updated</h4>
                            <p>Contact information was updated</p>
                            <span class="activity-time">January 20, 2024 - 2:15 PM</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
}

.header-actions {
    display: flex;
    gap: 1rem;
}

.customer-profile {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
    overflow: hidden;
}

.profile-header {
    background: linear-gradient(135deg, var(--primary-color), #c8895a);
    color: white;
    padding: 2rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.customer-avatar-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background-color: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 600;
}

.customer-details h2 {
    margin: 0 0 0.5rem 0;
    font-size: 2rem;
}

.customer-id {
    margin: 0 0 1rem 0;
    opacity: 0.9;
}

.status-badges {
    display: flex;
    gap: 0.5rem;
}

.profile-content {
    padding: 2rem;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.info-section {
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 1.5rem;
}

.info-section.full-width {
    grid-column: 1 / -1;
}

.info-section h3 {
    color: var(--secondary-color);
    margin: 0 0 1rem 0;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-items {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.info-item label {
    font-weight: 600;
    color: #666;
    font-size: 0.9rem;
}

.info-item span {
    color: var(--secondary-color);
}

.notes-content {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 4px;
    border-left: 4px solid var(--primary-color);
}

.related-sections {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.section-tabs {
    display: flex;
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.tab-btn {
    padding: 1rem 1.5rem;
    border: none;
    background: none;
    cursor: pointer;
    font-weight: 500;
    color: #666;
    transition: all 0.3s ease;
}

.tab-btn.active {
    background: white;
    color: var(--primary-color);
    border-bottom: 2px solid var(--primary-color);
}

.tab-content {
    padding: 2rem;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

.documents-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
}

.document-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border: 1px solid #eee;
    border-radius: 8px;
    background: #f8f9fa;
}

.document-item i {
    font-size: 1.5rem;
    color: var(--primary-color);
}

.activity-timeline {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.activity-item {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--primary-color);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.activity-content h4 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
}

.activity-content p {
    margin: 0 0 0.5rem 0;
    color: #666;
}

.activity-time {
    font-size: 0.85rem;
    color: #999;
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .header-actions {
        width: 100%;
        justify-content: stretch;
    }
    
    .profile-header {
        flex-direction: column;
        text-align: center;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .section-tabs {
        flex-wrap: wrap;
    }
    
    .tab-btn {
        flex: 1;
        min-width: 120px;
    }
}
</style>

<script>
function showTab(tabName) {
    // Hide all tab panes
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('active');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected tab pane
    document.getElementById(tabName).classList.add('active');
    
    // Add active class to clicked button
    event.target.classList.add('active');
}
</script>

<?php include '../includes/footer.php'; ?>