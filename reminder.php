<?php
// Reminder Page
$pageTitle = 'Reminder';
$currentPage = 'reminder';
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
                <h2>Reminder Management</h2>
                <button class="btn btn-primary">Create New Reminder</button>
            </div>
            
            <div class="reminder-container">
                <div class="reminder-grid">
                    <div class="reminder-card urgent">
                        <div class="reminder-header">
                            <h3>Payment Due Reminder</h3>
                            <span class="reminder-priority priority-high">High Priority</span>
                        </div>
                        <div class="reminder-details">
                            <p><i class="fas fa-user"></i> Member: John Smith</p>
                            <p><i class="fas fa-calendar"></i> Due Date: January 30, 2024</p>
                            <p><i class="fas fa-dollar-sign"></i> Amount: $2,500</p>
                            <p><i class="fas fa-home"></i> Property: Unit A-101, Block 5</p>
                            <p><i class="fas fa-clock"></i> Reminder: 3 days before due</p>
                        </div>
                        <div class="reminder-actions">
                            <button class="btn btn-sm btn-primary">Send Now</button>
                            <button class="btn btn-sm btn-secondary">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </div>
                    </div>
                    
                    <div class="reminder-card">
                        <div class="reminder-header">
                            <h3>Maintenance Inspection</h3>
                            <span class="reminder-priority priority-medium">Medium Priority</span>
                        </div>
                        <div class="reminder-details">
                            <p><i class="fas fa-user"></i> Member: Sarah Johnson</p>
                            <p><i class="fas fa-calendar"></i> Scheduled: February 5, 2024</p>
                            <p><i class="fas fa-tools"></i> Type: Annual HVAC Check</p>
                            <p><i class="fas fa-home"></i> Property: Unit B-205, Block 3</p>
                            <p><i class="fas fa-clock"></i> Reminder: 1 week before</p>
                        </div>
                        <div class="reminder-actions">
                            <button class="btn btn-sm btn-primary">Send Reminder</button>
                            <button class="btn btn-sm btn-secondary">Reschedule</button>
                            <button class="btn btn-sm btn-danger">Cancel</button>
                        </div>
                    </div>
                    
                    <div class="reminder-card">
                        <div class="reminder-header">
                            <h3>Document Renewal</h3>
                            <span class="reminder-priority priority-low">Low Priority</span>
                        </div>
                        <div class="reminder-details">
                            <p><i class="fas fa-user"></i> Member: Mike Wilson</p>
                            <p><i class="fas fa-calendar"></i> Expires: March 15, 2024</p>
                            <p><i class="fas fa-file-alt"></i> Document: Insurance Policy</p>
                            <p><i class="fas fa-home"></i> Property: Unit C-301, Block 7</p>
                            <p><i class="fas fa-clock"></i> Reminder: 30 days before expiry</p>
                        </div>
                        <div class="reminder-actions">
                            <button class="btn btn-sm btn-primary">Send Reminder</button>
                            <button class="btn btn-sm btn-secondary">Update</button>
                            <button class="btn btn-sm btn-success">Mark Complete</button>
                        </div>
                    </div>
                    
                    <div class="reminder-card completed">
                        <div class="reminder-header">
                            <h3>Lease Renewal Notice</h3>
                            <span class="reminder-priority priority-completed">Completed</span>
                        </div>
                        <div class="reminder-details">
                            <p><i class="fas fa-user"></i> Member: Emma Davis</p>
                            <p><i class="fas fa-calendar"></i> Sent: January 10, 2024</p>
                            <p><i class="fas fa-file-contract"></i> Type: Lease Renewal</p>
                            <p><i class="fas fa-home"></i> Property: Unit D-402, Block 2</p>
                            <p><i class="fas fa-check"></i> Status: Acknowledged</p>
                        </div>
                        <div class="reminder-actions">
                            <button class="btn btn-sm btn-secondary">View Details</button>
                            <button class="btn btn-sm btn-secondary">Archive</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>