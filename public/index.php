<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

// Dashboard Page
$pageTitle = 'Dashboard - Property Management System';
$currentPage = 'dashboard';
$breadcrumb_section = 'Dashboard';
$breadcrumb_current = 'Overview';
$page_description = 'Monitor your property management operations and key performance metrics';

// Header actions for dashboard
$header_actions = '
    <button class="btn btn-primary">
        <i class="fas fa-plus"></i>
        Quick Add
    </button>
    <button class="btn btn-secondary">
        <i class="fas fa-download"></i>
        Export Report
    </button>
';

include '../includes/header.php';
?>

<!-- Clean Empty Content Area -->
<div class="main-content" style="background-color: white; min-height: 80vh; padding: 20px;">
    <!-- Content area is intentionally empty for clean interface -->
</div>
    
<?php include '../includes/footer.php'; ?>