<?php
// Migration Page
$pageTitle = 'Migration';
$currentPage = 'migration';
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
        <!-- Content Area -->
        <div class="content" id="pageContent">
            <div class="section-header">
                <h2>Property Migration Management</h2>
                <button class="btn btn-primary">Initiate Migration</button>
            </div>
            
            <div class="migration-container">
                <div class="migration-grid">
                    <div class="migration-card">
                        <div class="migration-header">
                            <h3>Unit A-101 → Unit B-205</h3>
                            <span class="migration-status status-pending">Pending Approval</span>
                        </div>
                        <div class="migration-details">
                            <p><i class="fas fa-user"></i> Customer: John Smith</p>
                            <p><i class="fas fa-home"></i> From: Unit A-101, Block 5</p>
                            <p><i class="fas fa-arrow-right"></i> To: Unit B-205, Block 3</p>
                            <p><i class="fas fa-calendar"></i> Request Date: February 8, 2024</p>
                            <p><i class="fas fa-file-alt"></i> Reason: Larger Space Required</p>
                            <p><i class="fas fa-dollar-sign"></i> Price Difference: +$5,000</p>
                        </div>
                        <div class="migration-actions">
                            <button class="btn btn-sm btn-primary">Review Request</button>
                            <button class="btn btn-sm btn-success">Approve</button>
                            <button class="btn btn-sm btn-danger">Reject</button>
                        </div>
                    </div>
                    
                    <div class="migration-card">
                        <div class="migration-header">
                            <h3>Unit C-301 → Unit A-101</h3>
                            <span class="migration-status status-approved">Approved</span>
                        </div>
                        <div class="migration-details">
                            <p><i class="fas fa-user"></i> Customer: Mike Wilson</p>
                            <p><i class="fas fa-home"></i> From: Unit C-301, Block 7</p>
                            <p><i class="fas fa-arrow-right"></i> To: Unit A-101, Block 5</p>
                            <p><i class="fas fa-calendar"></i> Approved: February 5, 2024</p>
                            <p><i class="fas fa-file-alt"></i> Reason: Better Location</p>
                            <p><i class="fas fa-dollar-sign"></i> Price Difference: -$2,000 (Refund)</p>
                        </div>
                        <div class="migration-actions">
                            <button class="btn btn-sm btn-primary">Schedule Move</button>
                            <button class="btn btn-sm btn-secondary">Process Payment</button>
                            <button class="btn btn-sm btn-success">Complete Migration</button>
                        </div>
                    </div>
                    
                    <div class="migration-card">
                        <div class="migration-header">
                            <h3>Unit D-402 → Unit E-503</h3>
                            <span class="migration-status status-in-progress">In Progress</span>
                        </div>
                        <div class="migration-details">
                            <p><i class="fas fa-user"></i> Customer: Lisa Brown</p>
                            <p><i class="fas fa-home"></i> From: Unit D-402, Block 2</p>
                            <p><i class="fas fa-arrow-right"></i> To: Unit E-503, Block 1</p>
                            <p><i class="fas fa-calendar"></i> Started: February 3, 2024</p>
                            <p><i class="fas fa-truck"></i> Moving Date: February 15, 2024</p>
                            <p><i class="fas fa-clipboard-check"></i> Progress: 60% Complete</p>
                        </div>
                        <div class="migration-actions">
                            <button class="btn btn-sm btn-primary">Track Progress</button>
                            <button class="btn btn-sm btn-secondary">Update Status</button>
                            <button class="btn btn-sm btn-warning">Report Issue</button>
                        </div>
                    </div>
                    
                    <div class="migration-card">
                        <div class="migration-header">
                            <h3>Unit F-604 → Unit C-301</h3>
                            <span class="migration-status status-completed">Completed</span>
                        </div>
                        <div class="migration-details">
                            <p><i class="fas fa-user"></i> Customer: Robert Taylor</p>
                            <p><i class="fas fa-home"></i> From: Unit F-604, Block 4</p>
                            <p><i class="fas fa-arrow-right"></i> To: Unit C-301, Block 7</p>
                            <p><i class="fas fa-calendar"></i> Completed: January 28, 2024</p>
                            <p><i class="fas fa-check-circle"></i> All Documents Updated</p>
                            <p><i class="fas fa-key"></i> Keys Transferred</p>
                        </div>
                        <div class="migration-actions">
                            <button class="btn btn-sm btn-secondary">View Certificate</button>
                            <button class="btn btn-sm btn-secondary">Download Documents</button>
                        </div>
                    </div>
                    
                    <div class="migration-card rejected">
                        <div class="migration-header">
                            <h3>Unit B-205 → Unit F-604</h3>
                            <span class="migration-status status-rejected">Rejected</span>
                        </div>
                        <div class="migration-details">
                            <p><i class="fas fa-user"></i> Customer: Jennifer White</p>
                            <p><i class="fas fa-home"></i> From: Unit B-205, Block 3</p>
                            <p><i class="fas fa-arrow-right"></i> To: Unit F-604, Block 4</p>
                            <p><i class="fas fa-calendar"></i> Rejected: February 1, 2024</p>
                            <p><i class="fas fa-exclamation-triangle"></i> Reason: Target Unit Unavailable</p>
                            <p><i class="fas fa-clock"></i> Alternative Options: 3 Available</p>
                        </div>
                        <div class="migration-actions">
                            <button class="btn btn-sm btn-primary">View Alternatives</button>
                            <button class="btn btn-sm btn-secondary">Resubmit Request</button>
                        </div>
                    </div>
                    
                    <div class="migration-card on-hold">
                        <div class="migration-header">
                            <h3>Unit E-503 → Unit D-402</h3>
                            <span class="migration-status status-on-hold">On Hold</span>
                        </div>
                        <div class="migration-details">
                            <p><i class="fas fa-user"></i> Customer: Michael Johnson</p>
                            <p><i class="fas fa-home"></i> From: Unit E-503, Block 1</p>
                            <p><i class="fas fa-arrow-right"></i> To: Unit D-402, Block 2</p>
                            <p><i class="fas fa-calendar"></i> On Hold Since: February 6, 2024</p>
                            <p><i class="fas fa-pause-circle"></i> Reason: Pending Documentation</p>
                            <p><i class="fas fa-file-times"></i> Missing: Income Verification</p>
                        </div>
                        <div class="migration-actions">
                            <button class="btn btn-sm btn-primary">Resume Process</button>
                            <button class="btn btn-sm btn-secondary">Contact Customer</button>
                        </div>
                    </div>
                    
                    <div class="migration-card scheduled">
                        <div class="migration-header">
                            <h3>Unit G-705 → Unit H-806</h3>
                            <span class="migration-status status-scheduled">Scheduled</span>
                        </div>
                        <div class="migration-details">
                            <p><i class="fas fa-user"></i> Customer: Sarah Davis</p>
                            <p><i class="fas fa-home"></i> From: Unit G-705, Block 6</p>
                            <p><i class="fas fa-arrow-right"></i> To: Unit H-806, Block 8</p>
                            <p><i class="fas fa-calendar"></i> Scheduled: February 20, 2024</p>
                            <p><i class="fas fa-clock"></i> Time: 9:00 AM - 5:00 PM</p>
                            <p><i class="fas fa-truck"></i> Moving Company: Assigned</p>
                        </div>
                        <div class="migration-actions">
                            <button class="btn btn-sm btn-primary">View Schedule</button>
                            <button class="btn btn-sm btn-secondary">Reschedule</button>
                            <button class="btn btn-sm btn-success">Confirm</button>
                        </div>
                    </div>
                    
                    <div class="migration-card urgent">
                        <div class="migration-header">
                            <h3>Unit I-907 → Unit J-1008</h3>
                            <span class="migration-status status-urgent">Urgent</span>
                        </div>
                        <div class="migration-details">
                            <p><i class="fas fa-user"></i> Customer: David Wilson</p>
                            <p><i class="fas fa-home"></i> From: Unit I-907, Block 9</p>
                            <p><i class="fas fa-arrow-right"></i> To: Unit J-1008, Block 10</p>
                            <p><i class="fas fa-calendar"></i> Deadline: February 12, 2024</p>
                            <p><i class="fas fa-exclamation-circle"></i> Reason: Emergency Relocation</p>
                            <p><i class="fas fa-bolt"></i> Priority: High</p>
                        </div>
                        <div class="migration-actions">
                            <button class="btn btn-sm btn-danger">Expedite Process</button>
                            <button class="btn btn-sm btn-primary">Emergency Protocol</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>