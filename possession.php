<?php
// Possession Page
$pageTitle = 'Possession';
$currentPage = 'possession';
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
                <h2>Property Possession Management</h2>
                <button class="btn btn-primary">Schedule Possession</button>
            </div>
            
            <div class="possession-container">
                <div class="possession-grid">
                    <div class="possession-card">
                        <div class="possession-header">
                            <h3>Unit A-101 Possession</h3>
                            <span class="possession-status status-scheduled">Scheduled</span>
                        </div>
                        <div class="possession-details">
                            <p><i class="fas fa-user"></i> Owner: John Smith</p>
                            <p><i class="fas fa-home"></i> Property: Unit A-101, Block 5</p>
                            <p><i class="fas fa-calendar"></i> Possession Date: February 15, 2024</p>
                            <p><i class="fas fa-clock"></i> Time: 10:00 AM - 12:00 PM</p>
                            <p><i class="fas fa-user-tie"></i> Assigned Officer: Sarah Johnson</p>
                            <p><i class="fas fa-clipboard-list"></i> Checklist: 12/15 Items</p>
                        </div>
                        <div class="possession-actions">
                            <button class="btn btn-sm btn-primary">View Checklist</button>
                            <button class="btn btn-sm btn-secondary">Reschedule</button>
                            <button class="btn btn-sm btn-success">Start Handover</button>
                        </div>
                    </div>
                    
                    <div class="possession-card">
                        <div class="possession-header">
                            <h3>Unit B-205 Possession</h3>
                            <span class="possession-status status-in-progress">In Progress</span>
                        </div>
                        <div class="possession-details">
                            <p><i class="fas fa-user"></i> Owner: Mike Wilson</p>
                            <p><i class="fas fa-home"></i> Property: Unit B-205, Block 3</p>
                            <p><i class="fas fa-calendar"></i> Started: February 10, 2024</p>
                            <p><i class="fas fa-clock"></i> Duration: 2 hours 30 minutes</p>
                            <p><i class="fas fa-user-tie"></i> Officer: Emma Davis</p>
                            <p><i class="fas fa-clipboard-check"></i> Progress: 8/15 Items Completed</p>
                        </div>
                        <div class="possession-actions">
                            <button class="btn btn-sm btn-primary">Continue Inspection</button>
                            <button class="btn btn-sm btn-warning">Report Issue</button>
                            <button class="btn btn-sm btn-success">Complete Handover</button>
                        </div>
                    </div>
                    
                    <div class="possession-card">
                        <div class="possession-header">
                            <h3>Unit C-301 Possession</h3>
                            <span class="possession-status status-completed">Completed</span>
                        </div>
                        <div class="possession-details">
                            <p><i class="fas fa-user"></i> Owner: Lisa Brown</p>
                            <p><i class="fas fa-home"></i> Property: Unit C-301, Block 7</p>
                            <p><i class="fas fa-calendar"></i> Completed: February 5, 2024</p>
                            <p><i class="fas fa-clock"></i> Duration: 1 hour 45 minutes</p>
                            <p><i class="fas fa-user-tie"></i> Officer: David Miller</p>
                            <p><i class="fas fa-check-circle"></i> All Items Verified</p>
                        </div>
                        <div class="possession-actions">
                            <button class="btn btn-sm btn-secondary">View Report</button>
                            <button class="btn btn-sm btn-secondary">Download Certificate</button>
                        </div>
                    </div>
                    
                    <div class="possession-card pending">
                        <div class="possession-header">
                            <h3>Unit D-402 Possession</h3>
                            <span class="possession-status status-pending">Pending</span>
                        </div>
                        <div class="possession-details">
                            <p><i class="fas fa-user"></i> Owner: Robert Taylor</p>
                            <p><i class="fas fa-home"></i> Property: Unit D-402, Block 2</p>
                            <p><i class="fas fa-calendar"></i> Requested: February 8, 2024</p>
                            <p><i class="fas fa-exclamation-triangle"></i> Status: Awaiting Documentation</p>
                            <p><i class="fas fa-file-times"></i> Missing: Completion Certificate</p>
                            <p><i class="fas fa-clock"></i> Expected: February 20, 2024</p>
                        </div>
                        <div class="possession-actions">
                            <button class="btn btn-sm btn-primary">Review Documents</button>
                            <button class="btn btn-sm btn-secondary">Contact Owner</button>
                        </div>
                    </div>
                    
                    <div class="possession-card delayed">
                        <div class="possession-header">
                            <h3>Unit E-503 Possession</h3>
                            <span class="possession-status status-delayed">Delayed</span>
                        </div>
                        <div class="possession-details">
                            <p><i class="fas fa-user"></i> Owner: Jennifer White</p>
                            <p><i class="fas fa-home"></i> Property: Unit E-503, Block 1</p>
                            <p><i class="fas fa-calendar"></i> Original Date: February 1, 2024</p>
                            <p><i class="fas fa-exclamation-circle"></i> Reason: Construction Delays</p>
                            <p><i class="fas fa-calendar-plus"></i> New Date: February 25, 2024</p>
                            <p><i class="fas fa-user-tie"></i> Assigned: Mark Anderson</p>
                        </div>
                        <div class="possession-actions">
                            <button class="btn btn-sm btn-primary">Update Schedule</button>
                            <button class="btn btn-sm btn-secondary">Notify Owner</button>
                        </div>
                    </div>
                    
                    <div class="possession-card ready">
                        <div class="possession-header">
                            <h3>Unit F-604 Possession</h3>
                            <span class="possession-status status-ready">Ready</span>
                        </div>
                        <div class="possession-details">
                            <p><i class="fas fa-user"></i> Owner: Michael Johnson</p>
                            <p><i class="fas fa-home"></i> Property: Unit F-604, Block 4</p>
                            <p><i class="fas fa-calendar"></i> Available From: February 12, 2024</p>
                            <p><i class="fas fa-check-circle"></i> All Requirements Met</p>
                            <p><i class="fas fa-clipboard-check"></i> Pre-inspection: Passed</p>
                            <p><i class="fas fa-key"></i> Keys: Available</p>
                        </div>
                        <div class="possession-actions">
                            <button class="btn btn-sm btn-success">Schedule Handover</button>
                            <button class="btn btn-sm btn-secondary">View Details</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>