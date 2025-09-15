<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Property Management System'; ?></title>
    <link rel="stylesheet" href="<?php echo isset($css_path) ? $css_path : ''; ?>styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for clean white icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php if(isset($additional_css)) echo $additional_css; ?>
</head>
<body>
    <!-- Sidebar Navigation -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <img src="<?php echo isset($assets_path) ? $assets_path : ''; ?>assets/logo.svg" alt="PMS Logo" class="logo">
                <div class="brand-text">
                    <h2>PMS</h2>
                    <span class="brand-subtitle">Property Management</span>
                </div>
            </div>
        </div>
        
        <div class="nav-content">
            <ul class="nav-menu">
                <li><a href="index.php" class="nav-item<?php echo ($currentPage === 'dashboard') ? ' active' : ''; ?>"><i class="nav-icon fas fa-home"></i><span class="nav-text">Dashboard</span></a></li>
                <li><a href="customers.php" class="nav-item<?php echo ($currentPage === 'customers') ? ' active' : ''; ?>"><i class="nav-icon fas fa-users"></i><span class="nav-text">Members</span></a></li>
                <li><a href="schedule.php" class="nav-item<?php echo ($currentPage === 'schedule') ? ' active' : ''; ?>"><i class="nav-icon fas fa-calendar"></i><span class="nav-text">Schedule</span></a></li>
                <li><a href="finance.php" class="nav-item<?php echo ($currentPage === 'finance') ? ' active' : ''; ?>"><i class="nav-icon fas fa-dollar-sign"></i><span class="nav-text">Payment</span></a></li>
                <li><a href="inventory.php" class="nav-item<?php echo ($currentPage === 'inventory') ? ' active' : ''; ?>"><i class="nav-icon fas fa-boxes"></i><span class="nav-text">Inventory</span></a></li>
                <li><a href="possession.php" class="nav-item<?php echo ($currentPage === 'possession') ? ' active' : ''; ?>"><i class="nav-icon fas fa-key"></i><span class="nav-text">Possession</span></a></li>
                <li><a href="migration.php" class="nav-item<?php echo ($currentPage === 'migration') ? ' active' : ''; ?>"><i class="nav-icon fas fa-arrow-right"></i><span class="nav-text">Migration</span></a></li>
                <li><a href="cancellation.php" class="nav-item<?php echo ($currentPage === 'cancellation') ? ' active' : ''; ?>"><i class="nav-icon fas fa-times-circle"></i><span class="nav-text">Cancellation</span></a></li>
                <li><a href="waiver.php" class="nav-item<?php echo ($currentPage === 'waiver') ? ' active' : ''; ?>"><i class="nav-icon fas fa-file-signature"></i><span class="nav-text">Waiver</span></a></li>
                <li><a href="transfer.php" class="nav-item<?php echo ($currentPage === 'transfer') ? ' active' : ''; ?>"><i class="nav-icon fas fa-exchange-alt"></i><span class="nav-text">Transfer</span></a></li>
                <li><a href="reminder.php" class="nav-item<?php echo ($currentPage === 'reminder') ? ' active' : ''; ?>"><i class="nav-icon fas fa-bell"></i><span class="nav-text">Reminder</span></a></li>
                <li><a href="reports.php" class="nav-item<?php echo ($currentPage === 'reports') ? ' active' : ''; ?>"><i class="nav-icon fas fa-file-alt"></i><span class="nav-text">Reports</span></a></li>
                <li><a href="compliance.php" class="nav-item<?php echo ($currentPage === 'compliance') ? ' active' : ''; ?>"><i class="nav-icon fas fa-shield-alt"></i><span class="nav-text">Compliance</span></a></li>
                <li><a href="audit.php" class="nav-item<?php echo ($currentPage === 'audit') ? ' active' : ''; ?>"><i class="nav-icon fas fa-search"></i><span class="nav-text">Audit</span></a></li>
                <li><a href="ai-assistance.php" class="nav-item<?php echo ($currentPage === 'ai-assistance') ? ' active' : ''; ?>"><i class="nav-icon fas fa-robot"></i><span class="nav-text">AI Assistance</span></a></li>
                <li><a href="settings.php" class="nav-item<?php echo ($currentPage === 'settings') ? ' active' : ''; ?>"><i class="nav-icon fas fa-cog"></i><span class="nav-text">Settings</span></a></li>
                <li><a href="acl-users.php" class="nav-item<?php echo ($currentPage === 'acl-users') ? ' active' : ''; ?>"><i class="nav-icon fas fa-users"></i><span class="nav-text">User Management</span></a></li>
            </ul>
        </div>
        
        <!-- Sidebar Toggle at Bottom -->
        <div class="sidebar-footer">
            <button class="sidebar-toggle-btn" id="sidebarToggle">
                <span class="toggle-icon">‹</span>
            </button>
        </div>
    </nav>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                    <span class="menu-icon">☰</span>
                    <span class="menu-text">Menu</span>
                </button>
                <div class="breadcrumb">
                    <span>Company</span>
                    <span class="breadcrumb-separator">›</span>
                    <span><?php echo isset($breadcrumb_section) ? $breadcrumb_section : 'Dashboard'; ?></span>
                    <span class="breadcrumb-separator">›</span>
                    <span id="currentSection"><?php echo isset($breadcrumb_current) ? $breadcrumb_current : 'Overview'; ?></span>
                </div>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <input type="text" placeholder="Search properties, members, bookings..." id="globalSearch">
                </div>
                <div class="header-actions">
                    <button class="header-btn" title="Notifications">
                        <span>Notifications</span>
                        <span class="notification-badge">3</span>
                    </button>
                    <button class="header-btn" title="Settings">
                        <span>Settings</span>
                    </button>
                </div>
                <div class="user-menu">
                    <img src="<?php echo isset($assets_path) ? $assets_path : ''; ?>assets/sample-avatar.png" alt="User" class="user-avatar">
                    <div class="user-info">
                        <span class="user-name">Admin User</span>
                        <span class="user-role">Administrator</span>
                    </div>
                    <span class="dropdown-arrow">▼</span>
                </div>
            </div>
        </header>

        <?php if(isset($show_subnav) && $show_subnav): ?>
        <!-- Horizontal Sub-Navigation -->
        <nav class="subnav" id="moduleSubnav" aria-label="Section navigation">
            <ul role="tablist">
                <?php if(isset($subnav_items) && is_array($subnav_items)): ?>
                    <?php foreach($subnav_items as $index => $item): ?>
                        <li><a href="<?php echo $item['href']; ?>" role="tab" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>" class="subnav-pill <?php echo $index === 0 ? 'active' : ''; ?>"<?php echo isset($item['onclick']) ? ' onclick="' . $item['onclick'] . '"' : ''; ?>><?php echo $item['label']; ?></a></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li><a href="#overview" role="tab" aria-selected="true" class="subnav-pill active">Overview</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php endif; ?>

        <!-- Page Content Container -->
        <div class="page-content" id="pageContent">