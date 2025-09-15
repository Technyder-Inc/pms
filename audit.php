<?php
$currentPage = 'audit';
$pageTitle = 'Audit Management - PMS';
$breadcrumb_section = 'Audit';
$breadcrumb_current = 'Overview';
include 'includes/header.php';
?>

<div class="page-header">
    <div class="page-title-section">
        <h1 class="page-title">Audit Management</h1>
        <p class="page-description">Track audit activities, manage findings, and monitor compliance status</p>
    </div>
    <div class="page-actions">
        <button class="btn btn-outline">Generate Report</button>
        <button class="btn btn-primary">Schedule Audit</button>
    </div>
</div>

<!-- Audit Overview Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-search"></i>
        </div>
        <div class="stat-content">
            <h3>15</h3>
            <p>Active Audits</p>
            <span class="stat-trend positive">3 completed this month</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-flag"></i>
        </div>
        <div class="stat-content">
            <h3>8</h3>
            <p>Open Findings</p>
            <span class="stat-trend warning">2 critical issues</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-chart-line"></i>
        </div>
        <div class="stat-content">
            <h3>92%</h3>
            <p>Audit Score</p>
            <span class="stat-trend positive">+5% improvement</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-content">
            <h3>4</h3>
            <p>Scheduled Audits</p>
            <span class="stat-trend neutral">Next: Property Inspection</span>
        </div>
    </div>
</div>

<!-- Recent Audit Activities -->
<div class="content-section">
    <div class="section-header">
        <h2>Recent Audit Activities</h2>
        <button class="btn btn-secondary">View All</button>
    </div>
    <div class="activity-list">
        <div class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="activity-content">
                <h4>Financial Audit Completed</h4>
                <p>Q4 2024 financial audit completed with minor findings</p>
                <span class="activity-time">2 hours ago</span>
            </div>
        </div>
        <div class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="activity-content">
                <h4>Compliance Issue Identified</h4>
                <p>Documentation gap found in property transfer records</p>
                <span class="activity-time">1 day ago</span>
            </div>
        </div>
        <div class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-calendar-plus"></i>
            </div>
            <div class="activity-content">
                <h4>New Audit Scheduled</h4>
                <p>Property maintenance audit scheduled for next week</p>
                <span class="activity-time">3 days ago</span>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>