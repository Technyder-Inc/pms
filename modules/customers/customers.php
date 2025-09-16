<?php
// Path variables for navigation and assets
$base_path = '../../';
$css_path = '../../public/';
$js_path = '../../public/';
$assets_path = '../../';

// Customers Page
$pageTitle = 'Customers - Property Management System';
$currentPage = 'customers';
$breadcrumb_section = 'Customer Management';
$breadcrumb_current = 'Customers';

include '../../includes/header.php';
?>
    
    <div class="content">
        <!-- Horizontal Sub-Navigation -->
        <nav class="subnav" id="moduleSubnav" aria-label="Section navigation">
            <ul role="tablist">
                <li><a href="#list" role="tab" aria-selected="true" class="subnav-pill active">List</a></li>
                <li><a href="#new" role="tab" aria-selected="false" class="subnav-pill">New</a></li>
                <li><a href="#view" role="tab" aria-selected="false" class="subnav-pill">View</a></li>
                <li><a href="#kyc" role="tab" aria-selected="false" class="subnav-pill">KYC Status</a></li>
                <li><a href="#attachments" role="tab" aria-selected="false" class="subnav-pill">Attachments</a></li>
                <li><a href="#schedule" role="tab" aria-selected="false" class="subnav-pill">Schedule</a></li>
                <li><a href="#waiver" role="tab" aria-selected="false" class="subnav-pill">Waiver</a></li>
                <li><a href="#reminder" role="tab" aria-selected="false" class="subnav-pill">Reminder</a></li>
            </ul>
        </nav>

        <!-- Clean Empty Content Area -->
        <div class="content" id="pageContent" style="background-color: white; min-height: 80vh; padding: 20px;">
            <!-- Content area is intentionally empty for clean interface -->
        </div>
    </div>
    
<?php include '../../includes/footer.php'; ?>
