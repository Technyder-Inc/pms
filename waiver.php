<?php
// Waiver Page
$pageTitle = 'Waiver';
$currentPage = 'waiver';
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
                <h2>Waiver Management</h2>
                <button class="btn btn-primary">Create New Waiver</button>
            </div>
            
            <div class="waiver-container">
                <div class="waiver-grid">
                    <div class="waiver-card">
                        <div class="waiver-header">
                            <h3>Property Damage Waiver</h3>
                            <span class="waiver-status status-active">Active</span>
                        </div>
                        <div class="waiver-details">
                            <p><i class="fas fa-user"></i> Member: John Smith</p>
                            <p><i class="fas fa-calendar"></i> Created: January 15, 2024</p>
                            <p><i class="fas fa-calendar-check"></i> Valid Until: January 15, 2025</p>
                            <p><i class="fas fa-home"></i> Property: Unit A-101, Block 5</p>
                        </div>
                        <div class="waiver-actions">
                            <button class="btn btn-sm btn-primary">View Document</button>
                            <button class="btn btn-sm btn-secondary">Edit</button>
                            <button class="btn btn-sm btn-danger">Revoke</button>
                        </div>
                    </div>
                    
                    <div class="waiver-card">
                        <div class="waiver-header">
                            <h3>Liability Waiver</h3>
                            <span class="waiver-status status-pending">Pending Signature</span>
                        </div>
                        <div class="waiver-details">
                            <p><i class="fas fa-user"></i> Member: Sarah Johnson</p>
                            <p><i class="fas fa-calendar"></i> Created: January 22, 2024</p>
                            <p><i class="fas fa-clock"></i> Expires: February 22, 2024</p>
                            <p><i class="fas fa-home"></i> Property: Unit B-205, Block 3</p>
                        </div>
                        <div class="waiver-actions">
                            <button class="btn btn-sm btn-primary">Send Reminder</button>
                            <button class="btn btn-sm btn-secondary">Edit</button>
                            <button class="btn btn-sm btn-danger">Cancel</button>
                        </div>
                    </div>
                    
                    <div class="waiver-card">
                        <div class="waiver-header">
                            <h3>Construction Noise Waiver</h3>
                            <span class="waiver-status status-expired">Expired</span>
                        </div>
                        <div class="waiver-details">
                            <p><i class="fas fa-user"></i> Member: Mike Wilson</p>
                            <p><i class="fas fa-calendar"></i> Created: December 1, 2023</p>
                            <p><i class="fas fa-calendar-times"></i> Expired: January 1, 2024</p>
                            <p><i class="fas fa-home"></i> Property: Unit C-301, Block 7</p>
                        </div>
                        <div class="waiver-actions">
                            <button class="btn btn-sm btn-primary">Renew</button>
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