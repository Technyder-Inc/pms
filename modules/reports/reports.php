<?php
// Path variables for navigation and assets
$base_path = '../../';
$css_path = '../../public/';
$js_path = '../../public/';
$assets_path = '../../';

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
    <link rel="stylesheet" href="../../public/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../../includes/header.php'; ?>
    
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

        <!-- Clean Empty Content Area -->
        <div class="main-content" style="background-color: white; min-height: 80vh; padding: 20px;">
            <!-- Content area is intentionally empty for clean interface -->
        </div>
    </div>
    
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
