<?php
// System Settings Page
$pageTitle = 'System Settings';
$currentPage = 'system-settings';
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
                <h2 class="card-title">General Settings</h2>
            </div>
            <div class="card-content">
                <form class="form-grid">
                    <div class="form-group">
                        <label for="systemName">System Name</label>
                        <input type="text" id="systemName" class="form-input" value="Property Management System">
                    </div>
                    <div class="form-group">
                        <label for="systemVersion">System Version</label>
                        <input type="text" id="systemVersion" class="form-input" value="v2.1.0" readonly>
                    </div>
                    <div class="form-group">
                        <label for="timezone">Default Timezone</label>
                        <select id="timezone" class="form-select">
                            <option value="UTC">UTC</option>
                            <option value="America/New_York" selected>Eastern Time</option>
                            <option value="America/Chicago">Central Time</option>
                            <option value="America/Denver">Mountain Time</option>
                            <option value="America/Los_Angeles">Pacific Time</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dateFormat">Date Format</label>
                        <select id="dateFormat" class="form-select">
                            <option value="MM/DD/YYYY" selected>MM/DD/YYYY</option>
                            <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                            <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="currency">Default Currency</label>
                        <select id="currency" class="form-select">
                            <option value="USD" selected>USD ($)</option>
                            <option value="EUR">EUR (€)</option>
                            <option value="GBP">GBP (£)</option>
                            <option value="CAD">CAD (C$)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">Default Language</label>
                        <select id="language" class="form-select">
                            <option value="en" selected>English</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Security Settings</h2>
            </div>
            <div class="card-content">
                <form class="form-grid">
                    <div class="form-group">
                        <label for="sessionTimeout">Session Timeout (minutes)</label>
                        <input type="number" id="sessionTimeout" class="form-input" value="30" min="5" max="480">
                    </div>
                    <div class="form-group">
                        <label for="maxLoginAttempts">Max Login Attempts</label>
                        <input type="number" id="maxLoginAttempts" class="form-input" value="5" min="3" max="10">
                    </div>
                    <div class="form-group">
                        <label for="passwordMinLength">Minimum Password Length</label>
                        <input type="number" id="passwordMinLength" class="form-input" value="8" min="6" max="20">
                    </div>
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="requireSpecialChars" checked>
                            <label for="requireSpecialChars">Require Special Characters</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="requireNumbers" checked>
                            <label for="requireNumbers">Require Numbers</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="requireUppercase" checked>
                            <label for="requireUppercase">Require Uppercase Letters</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="enableTwoFactor">
                            <label for="enableTwoFactor">Enable Two-Factor Authentication</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="enableAuditLog" checked>
                            <label for="enableAuditLog">Enable Audit Logging</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Email Settings</h2>
            </div>
            <div class="card-content">
                <form class="form-grid">
                    <div class="form-group">
                        <label for="smtpHost">SMTP Host</label>
                        <input type="text" id="smtpHost" class="form-input" placeholder="smtp.gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="smtpPort">SMTP Port</label>
                        <input type="number" id="smtpPort" class="form-input" value="587">
                    </div>
                    <div class="form-group">
                        <label for="smtpUsername">SMTP Username</label>
                        <input type="email" id="smtpUsername" class="form-input" placeholder="your-email@company.com">
                    </div>
                    <div class="form-group">
                        <label for="smtpPassword">SMTP Password</label>
                        <input type="password" id="smtpPassword" class="form-input" placeholder="••••••••">
                    </div>
                    <div class="form-group">
                        <label for="fromEmail">From Email</label>
                        <input type="email" id="fromEmail" class="form-input" placeholder="noreply@company.com">
                    </div>
                    <div class="form-group">
                        <label for="fromName">From Name</label>
                        <input type="text" id="fromName" class="form-input" placeholder="Property Management System">
                    </div>
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="enableSsl" checked>
                            <label for="enableSsl">Enable SSL/TLS</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary">Test Email Configuration</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Backup & Maintenance</h2>
            </div>
            <div class="card-content">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="backupFrequency">Automatic Backup Frequency</label>
                        <select id="backupFrequency" class="form-select">
                            <option value="daily" selected>Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="disabled">Disabled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="backupRetention">Backup Retention (days)</label>
                        <input type="number" id="backupRetention" class="form-input" value="30" min="7" max="365">
                    </div>
                    <div class="form-group">
                        <label>Manual Backup</label>
                        <button type="button" class="btn btn-primary">Create Backup Now</button>
                    </div>
                    <div class="form-group">
                        <label>System Maintenance</label>
                        <div class="button-group">
                            <button type="button" class="btn btn-secondary">Clear Cache</button>
                            <button type="button" class="btn btn-secondary">Optimize Database</button>
                            <button type="button" class="btn btn-warning">Restart System</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="button" class="btn btn-secondary">Reset to Defaults</button>
            <button type="button" class="btn btn-primary">Save Settings</button>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>