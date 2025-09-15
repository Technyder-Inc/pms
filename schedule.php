<?php
// Schedule Page
$pageTitle = 'Schedule';
$currentPage = 'schedule';
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
                <h2>Schedule Management</h2>
                <button class="btn btn-primary">Add New Schedule</button>
            </div>
            
            <div class="schedule-container">
                <div class="schedule-grid">
                    <div class="schedule-card">
                        <div class="schedule-header">
                            <h3>Property Viewing</h3>
                            <span class="schedule-status status-upcoming">Upcoming</span>
                        </div>
                        <div class="schedule-details">
                            <p><i class="fas fa-calendar"></i> January 25, 2024</p>
                            <p><i class="fas fa-clock"></i> 2:00 PM - 3:00 PM</p>
                            <p><i class="fas fa-map-marker-alt"></i> Unit A-101, Block 5</p>
                            <p><i class="fas fa-user"></i> John Smith</p>
                        </div>
                        <div class="schedule-actions">
                            <button class="btn btn-sm btn-primary">Edit</button>
                            <button class="btn btn-sm btn-secondary">Reschedule</button>
                            <button class="btn btn-sm btn-danger">Cancel</button>
                        </div>
                    </div>
                    
                    <div class="schedule-card">
                        <div class="schedule-header">
                            <h3>Site Visit</h3>
                            <span class="schedule-status status-completed">Completed</span>
                        </div>
                        <div class="schedule-details">
                            <p><i class="fas fa-calendar"></i> January 20, 2024</p>
                            <p><i class="fas fa-clock"></i> 10:00 AM - 11:30 AM</p>
                            <p><i class="fas fa-map-marker-alt"></i> Phase 2 Construction Site</p>
                            <p><i class="fas fa-user"></i> Sarah Johnson</p>
                        </div>
                        <div class="schedule-actions">
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