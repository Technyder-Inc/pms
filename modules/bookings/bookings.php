<?php
// Path variables for navigation and assets
$base_path = '../../';
$css_path = '../../public/';
$js_path = '../../public/';
$assets_path = '../../';

// Bookings Page
$pageTitle = 'Bookings - Property Management System';
$currentPage = 'bookings';
$breadcrumb_section = 'Bookings';
$breadcrumb_current = 'Overview';

include '../../includes/header.php';
?>
    
    <div class="content">
        <!-- Horizontal Sub-Navigation -->
        <nav class="subnav" id="moduleSubnav" aria-label="Section navigation">
            <ul role="tablist">
                <li><a href="#allotments" role="tab" aria-selected="true" class="subnav-pill active">Allotments</a></li>
                <li><a href="#payment-plans" role="tab" aria-selected="false" class="subnav-pill">Payment Plans</a></li>
                <li><a href="#schedule-preview" role="tab" aria-selected="false" class="subnav-pill">Schedule Preview</a></li>
            </ul>
        </nav>

        <!-- Clean Empty Content Area -->
        <div class="main-content" style="background-color: white; min-height: 80vh; padding: 20px;">
            <!-- Content area is intentionally empty for clean interface -->
        </div>
    </div>
    
<?php include '../../includes/footer.php'; ?>
