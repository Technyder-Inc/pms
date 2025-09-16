<?php
// Path variables for navigation and assets
$base_path = '../../';
$css_path = '../../public/';
$js_path = '../../public/';
$assets_path = '../../';

// Finance Page
$pageTitle = 'Finance - Property Management System';
$currentPage = 'finance';
$breadcrumb_section = 'Finance';
$breadcrumb_current = 'Overview';

include '../../includes/header.php';
?>
    
    <div class="content">
        <!-- Horizontal Sub-Navigation -->
        <nav class="subnav" id="moduleSubnav" aria-label="Section navigation">
            <ul role="tablist">
                <li><a href="#receipts" role="tab" aria-selected="true" class="subnav-pill active">Receipts</a></li>
                <li><a href="#ledger" role="tab" aria-selected="false" class="subnav-pill">Customer Ledger</a></li>
            </ul>
        </nav>

        <!-- Clean Empty Content Area -->
        <div class="main-content" style="background-color: white; min-height: 80vh; padding: 20px;">
            <!-- Content area is intentionally empty for clean interface -->
        </div>
    </div>
    
<?php include '../../includes/footer.php'; ?>
