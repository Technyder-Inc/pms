<?php
// Cancellation Page
$pageTitle = 'Cancellation';
$currentPage = 'cancellation';
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
                <h2>Property Cancellation Management</h2>
                <button class="btn btn-primary">Process New Cancellation</button>
            </div>
            
            <div class="cancellation-container">
                <div class="cancellation-grid">
                    <div class="cancellation-card">
                        <div class="cancellation-header">
                            <h3>Unit A-101 Cancellation</h3>
                            <span class="cancellation-status status-pending">Pending Review</span>
                        </div>
                        <div class="cancellation-details">
                            <p><i class="fas fa-user"></i> Customer: John Smith</p>
                            <p><i class="fas fa-home"></i> Property: Unit A-101, Block 5</p>
                            <p><i class="fas fa-calendar"></i> Request Date: February 8, 2024</p>
                            <p><i class="fas fa-file-alt"></i> Reason: Financial Constraints</p>
                            <p><i class="fas fa-dollar-sign"></i> Paid Amount: $25,000</p>
                            <p><i class="fas fa-percentage"></i> Refund Eligible: 80% ($20,000)</p>
                        </div>
                        <div class="cancellation-actions">
                            <button class="btn btn-sm btn-primary">Review Request</button>
                            <button class="btn btn-sm btn-success">Approve</button>
                            <button class="btn btn-sm btn-danger">Reject</button>
                        </div>
                    </div>
                    
                    <div class="cancellation-card">
                        <div class="cancellation-header">
                            <h3>Unit B-205 Cancellation</h3>
                            <span class="cancellation-status status-approved">Approved</span>
                        </div>
                        <div class="cancellation-details">
                            <p><i class="fas fa-user"></i> Customer: Mike Wilson</p>
                            <p><i class="fas fa-home"></i> Property: Unit B-205, Block 3</p>
                            <p><i class="fas fa-calendar"></i> Approved: February 5, 2024</p>
                            <p><i class="fas fa-file-alt"></i> Reason: Job Relocation</p>
                            <p><i class="fas fa-dollar-sign"></i> Refund Amount: $18,500</p>
                            <p><i class="fas fa-credit-card"></i> Refund Status: Processing</p>
                        </div>
                        <div class="cancellation-actions">
                            <button class="btn btn-sm btn-primary">Process Refund</button>
                            <button class="btn btn-sm btn-secondary">View Agreement</button>
                            <button class="btn btn-sm btn-success">Complete</button>
                        </div>
                    </div>
                    
                    <div class="cancellation-card">
                        <div class="cancellation-header">
                            <h3>Unit C-301 Cancellation</h3>
                            <span class="cancellation-status status-completed">Completed</span>
                        </div>
                        <div class="cancellation-details">
                            <p><i class="fas fa-user"></i> Customer: Lisa Brown</p>
                            <p><i class="fas fa-home"></i> Property: Unit C-301, Block 7</p>
                            <p><i class="fas fa-calendar"></i> Completed: January 28, 2024</p>
                            <p><i class="fas fa-file-alt"></i> Reason: Medical Emergency</p>
                            <p><i class="fas fa-check-circle"></i> Refund: $22,000 (Processed)</p>
                            <p><i class="fas fa-file-contract"></i> Agreement: Terminated</p>
                        </div>
                        <div class="cancellation-actions">
                            <button class="btn btn-sm btn-secondary">View Receipt</button>
                            <button class="btn btn-sm btn-secondary">Download Documents</button>
                        </div>
                    </div>
                    
                    <div class="cancellation-card rejected">
                        <div class="cancellation-header">
                            <h3>Unit D-402 Cancellation</h3>
                            <span class="cancellation-status status-rejected">Rejected</span>
                        </div>
                        <div class="cancellation-details">
                            <p><i class="fas fa-user"></i> Customer: Robert Taylor</p>
                            <p><i class="fas fa-home"></i> Property: Unit D-402, Block 2</p>
                            <p><i class="fas fa-calendar"></i> Rejected: February 3, 2024</p>
                            <p><i class="fas fa-exclamation-triangle"></i> Reason: Beyond Cancellation Period</p>
                            <p><i class="fas fa-clock"></i> Request: 95 days after booking</p>
                            <p><i class="fas fa-times-circle"></i> Policy: 90-day limit</p>
                        </div>
                        <div class="cancellation-actions">
                            <button class="btn btn-sm btn-secondary">View Policy</button>
                            <button class="btn btn-sm btn-primary">Appeal Process</button>
                        </div>
                    </div>
                    
                    <div class="cancellation-card partial">
                        <div class="cancellation-header">
                            <h3>Unit E-503 Cancellation</h3>
                            <span class="cancellation-status status-partial">Partial Refund</span>
                        </div>
                        <div class="cancellation-details">
                            <p><i class="fas fa-user"></i> Customer: Jennifer White</p>
                            <p><i class="fas fa-home"></i> Property: Unit E-503, Block 1</p>
                            <p><i class="fas fa-calendar"></i> Processed: February 1, 2024</p>
                            <p><i class="fas fa-file-alt"></i> Reason: Change in Requirements</p>
                            <p><i class="fas fa-dollar-sign"></i> Paid: $30,000</p>
                            <p><i class="fas fa-percentage"></i> Refund: 60% ($18,000)</p>
                        </div>
                        <div class="cancellation-actions">
                            <button class="btn btn-sm btn-primary">Process Refund</button>
                            <button class="btn btn-sm btn-secondary">View Calculation</button>
                        </div>
                    </div>
                    
                    <div class="cancellation-card dispute">
                        <div class="cancellation-header">
                            <h3>Unit F-604 Cancellation</h3>
                            <span class="cancellation-status status-dispute">Under Dispute</span>
                        </div>
                        <div class="cancellation-details">
                            <p><i class="fas fa-user"></i> Customer: Michael Johnson</p>
                            <p><i class="fas fa-home"></i> Property: Unit F-604, Block 4</p>
                            <p><i class="fas fa-calendar"></i> Dispute Filed: February 6, 2024</p>
                            <p><i class="fas fa-gavel"></i> Issue: Refund Amount Disagreement</p>
                            <p><i class="fas fa-user-tie"></i> Assigned: Legal Team</p>
                            <p><i class="fas fa-clock"></i> Next Hearing: February 20, 2024</p>
                        </div>
                        <div class="cancellation-actions">
                            <button class="btn btn-sm btn-primary">View Case Details</button>
                            <button class="btn btn-sm btn-secondary">Schedule Meeting</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>