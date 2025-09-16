<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

// Company Settings Page
$pageTitle = 'Company Settings';
$currentPage = 'company-settings';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Property Management System</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Company Information</h2>
                <button class="btn btn-primary">Edit</button>
            </div>
            <div class="card-content">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Company Name</label>
                        <div class="form-value">Enterprise Real Estate Ltd.</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Registration Number</label>
                        <div class="form-value">REG-2024-001</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <div class="form-value">123 Business District, City Center</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Contact Email</label>
                        <div class="form-value">info@enterpriserealestate.com</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Regional Settings</h2>
                <button class="btn btn-primary">Configure</button>
            </div>
            <div class="card-content">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Default Currency</label>
                        <div class="form-value">USD ($)</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Time Zone</label>
                        <div class="form-value">UTC-5 (Eastern Time)</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date Format</label>
                        <div class="form-value">MM/DD/YYYY</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Language</label>
                        <div class="form-value">English (US)</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Business Settings</h2>
                <button class="btn btn-primary">Manage</button>
            </div>
            <div class="card-content">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Financial Year Start</label>
                        <div class="form-value">January 1st</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Working Days</label>
                        <div class="form-value">Monday - Friday</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Business Hours</label>
                        <div class="form-value">9:00 AM - 6:00 PM</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">System Preferences</h2>
                <button class="btn btn-primary">Settings</button>
            </div>
            <div class="card-content">
                <div class="settings-list">
                    <div class="setting-item">
                        <div class="setting-info">
                            <div class="setting-name">Email Notifications</div>
                            <div class="setting-description">Send system notifications via email</div>
                        </div>
                        <div class="setting-control">
                            <label class="toggle">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="setting-item">
                        <div class="setting-info">
                            <div class="setting-name">Auto Backup</div>
                            <div class="setting-description">Automatically backup data daily</div>
                        </div>
                        <div class="setting-control">
                            <label class="toggle">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>