<?php
// Transfer Page
$pageTitle = 'Transfer';
$currentPage = 'transfer';
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
                <h2>Property Transfer Management</h2>
                <button class="btn btn-primary">Initiate New Transfer</button>
            </div>
            
            <div class="transfer-container">
                <div class="transfer-grid">
                    <div class="transfer-card">
                        <div class="transfer-header">
                            <h3>Unit A-101 Transfer</h3>
                            <span class="transfer-status status-pending">Pending Approval</span>
                        </div>
                        <div class="transfer-details">
                            <p><i class="fas fa-user"></i> From: John Smith</p>
                            <p><i class="fas fa-user-plus"></i> To: Sarah Johnson</p>
                            <p><i class="fas fa-home"></i> Property: Unit A-101, Block 5</p>
                            <p><i class="fas fa-calendar"></i> Request Date: January 20, 2024</p>
                            <p><i class="fas fa-dollar-sign"></i> Transfer Fee: $1,500</p>
                            <p><i class="fas fa-file-alt"></i> Documents: 3/5 Submitted</p>
                        </div>
                        <div class="transfer-actions">
                            <button class="btn btn-sm btn-primary">Review Documents</button>
                            <button class="btn btn-sm btn-success">Approve</button>
                            <button class="btn btn-sm btn-danger">Reject</button>
                        </div>
                    </div>
                    
                    <div class="transfer-card">
                        <div class="transfer-header">
                            <h3>Unit B-205 Transfer</h3>
                            <span class="transfer-status status-in-progress">In Progress</span>
                        </div>
                        <div class="transfer-details">
                            <p><i class="fas fa-user"></i> From: Mike Wilson</p>
                            <p><i class="fas fa-user-plus"></i> To: Emma Davis</p>
                            <p><i class="fas fa-home"></i> Property: Unit B-205, Block 3</p>
                            <p><i class="fas fa-calendar"></i> Approved: January 15, 2024</p>
                            <p><i class="fas fa-dollar-sign"></i> Transfer Fee: $2,000 (Paid)</p>
                            <p><i class="fas fa-clipboard-check"></i> Legal Review: Completed</p>
                        </div>
                        <div class="transfer-actions">
                            <button class="btn btn-sm btn-primary">View Progress</button>
                            <button class="btn btn-sm btn-secondary">Update Status</button>
                            <button class="btn btn-sm btn-success">Complete Transfer</button>
                        </div>
                    </div>
                    
                    <div class="transfer-card">
                        <div class="transfer-header">
                            <h3>Unit C-301 Transfer</h3>
                            <span class="transfer-status status-completed">Completed</span>
                        </div>
                        <div class="transfer-details">
                            <p><i class="fas fa-user"></i> From: Lisa Brown</p>
                            <p><i class="fas fa-user-plus"></i> To: David Miller</p>
                            <p><i class="fas fa-home"></i> Property: Unit C-301, Block 7</p>
                            <p><i class="fas fa-calendar"></i> Completed: January 10, 2024</p>
                            <p><i class="fas fa-dollar-sign"></i> Transfer Fee: $1,800 (Paid)</p>
                            <p><i class="fas fa-check-circle"></i> Registry Updated</p>
                        </div>
                        <div class="transfer-actions">
                            <button class="btn btn-sm btn-secondary">View Certificate</button>
                            <button class="btn btn-sm btn-secondary">Download Documents</button>
                        </div>
                    </div>
                    
                    <div class="transfer-card rejected">
                        <div class="transfer-header">
                            <h3>Unit D-402 Transfer</h3>
                            <span class="transfer-status status-rejected">Rejected</span>
                        </div>
                        <div class="transfer-details">
                            <p><i class="fas fa-user"></i> From: Robert Taylor</p>
                            <p><i class="fas fa-user-plus"></i> To: Jennifer White</p>
                            <p><i class="fas fa-home"></i> Property: Unit D-402, Block 2</p>
                            <p><i class="fas fa-calendar"></i> Rejected: January 18, 2024</p>
                            <p><i class="fas fa-exclamation-triangle"></i> Reason: Incomplete Documentation</p>
                            <p><i class="fas fa-file-times"></i> Missing: NOC Certificate</p>
                        </div>
                        <div class="transfer-actions">
                            <button class="btn btn-sm btn-primary">Resubmit</button>
                            <button class="btn btn-sm btn-secondary">View Rejection Details</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>