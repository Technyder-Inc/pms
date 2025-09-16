<?php
/**
 * Standardized Page Template for PMS
 * 
 * This template provides a consistent structure for all module pages.
 * Copy this template and customize the content section for each module.
 * 
 * Required variables to set before including this template:
 * - $pageTitle: Page title for browser tab
 * - $currentPage: Current page identifier for navigation highlighting
 * - $breadcrumb_section: Main section name for breadcrumbs
 * - $breadcrumb_current: Current page name for breadcrumbs
 * - $base_path: Relative path to project root
 * - $css_path: Path to CSS files
 * - $js_path: Path to JavaScript files
 * - $assets_path: Path to assets
 */

// Ensure required variables are set
if (!isset($pageTitle)) $pageTitle = 'Property Management System';
if (!isset($currentPage)) $currentPage = 'dashboard';
if (!isset($breadcrumb_section)) $breadcrumb_section = 'Dashboard';
if (!isset($breadcrumb_current)) $breadcrumb_current = 'Overview';

// Include header
include $base_path . 'includes/header.php';
?>

<!-- Page Header Section -->
<div class="page-header">
    <div class="header-content">
        <h1 class="page-title"><?php echo $breadcrumb_current; ?></h1>
        <p class="page-description"><?php echo isset($page_description) ? $page_description : 'Manage and monitor your property management operations'; ?></p>
    </div>
    <?php if (isset($header_actions)): ?>
    <div class="header-actions">
        <?php echo $header_actions; ?>
    </div>
    <?php endif; ?>
</div>

<!-- Main Content Area -->
<div class="main-content">
    <?php
    // Content will be inserted here by individual pages
    // Each page should define its content in a variable called $page_content
    if (isset($page_content)) {
        echo $page_content;
    }
    ?>
</div>

<?php
// Include footer
include $base_path . 'includes/footer.php';
?>