<?php
$currentPage = 'compliance';
$pageTitle = 'Compliance Management - PMS';
$breadcrumb_section = 'Compliance';
$breadcrumb_current = 'Overview';
include 'includes/header.php';
?>

<div class="page-header">
    <div class="page-title-section">
        <h1 class="page-title">Compliance Management</h1>
        <p class="page-description">Monitor regulatory compliance, track requirements, and manage documentation</p>
    </div>
    <div class="page-actions">
        <button class="btn btn-outline">Export Report</button>
        <button class="btn btn-primary">Add Compliance Item</button>
    </div>
</div>

<!-- Compliance Overview Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-shield-check"></i>
        </div>
        <div class="stat-content">
            <h3>98%</h3>
            <p>Compliance Rate</p>
            <span class="stat-trend positive">+2% from last month</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="stat-content">
            <h3>3</h3>
            <p>Pending Issues</p>
            <span class="stat-trend neutral">2 high priority</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-file-contract"></i>
        </div>
        <div class="stat-content">
            <h3>47</h3>
            <p>Active Requirements</p>
            <span class="stat-trend positive">5 updated this week</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div class="stat-content">
            <h3>12</h3>
            <p>Upcoming Deadlines</p>
            <span class="stat-trend warning">3 due this week</span>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>