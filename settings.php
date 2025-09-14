<?php
// Settings Page
$pageTitle = 'Settings';
$currentPage = 'settings';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Property Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="content">
        <!-- Horizontal Sub-Navigation -->
        <nav class="subnav" id="moduleSubnav" aria-label="Section navigation">
            <ul role="tablist">
                <li><a href="#company" role="tab" aria-selected="true" class="subnav-pill active">Company</a></li>
                <li><a href="#region" role="tab" aria-selected="false" class="subnav-pill">Region</a></li>
                <li><a href="#sequences" role="tab" aria-selected="false" class="subnav-pill">Sequences</a></li>
                <li><a href="#users" role="tab" aria-selected="false" class="subnav-pill">Users & Roles</a></li>
                <li><a href="#notifications" role="tab" aria-selected="false" class="subnav-pill">Notifications</a></li>
            </ul>
        </nav>

        <!-- Content Area -->
        <div class="content" id="pageContent">
            <!-- Company Branding Section -->
            <section id="company-section" class="content-section" role="tabpanel" aria-labelledby="company-tab">
                <div class="section-header">
                    <h2>Company Branding</h2>
                    <button class="btn btn-primary" onclick="saveCompanySettings()">Save Changes</button>
                </div>
                
                <div class="settings-grid">
                    <div class="settings-card">
                        <h3>Basic Information</h3>
                        <div class="form-group">
                            <label for="companyName">Company Name</label>
                            <input type="text" id="companyName" value="ABC Properties Ltd." class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="companyAddress">Address</label>
                            <textarea id="companyAddress" class="form-control" rows="3">123 Business District, City Center, State 12345</textarea>
                        </div>
                        <div class="form-group">
                            <label for="companyPhone">Phone</label>
                            <input type="tel" id="companyPhone" value="+1 (555) 123-4567" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="companyEmail">Email</label>
                            <input type="email" id="companyEmail" value="info@abcproperties.com" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="companyWebsite">Website</label>
                            <input type="url" id="companyWebsite" value="https://www.abcproperties.com" class="form-control">
                        </div>
                    </div>
                    
                    <div class="settings-card">
                        <h3>Branding</h3>
                        <div class="form-group">
                            <label for="companyLogo">Company Logo</label>
                            <div class="logo-upload">
                                <img src="assets/logo.svg" alt="Current Logo" class="current-logo">
                                <input type="file" id="companyLogo" accept="image/*" class="form-control">
                                <p class="help-text">Recommended: 200x60px, PNG or SVG format</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="primaryColor">Primary Color</label>
                            <div class="color-input">
                                <input type="color" id="primaryColor" value="#dd9c6b" class="form-control">
                                <span class="color-value">#dd9c6b</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="secondaryColor">Secondary Color</label>
                            <div class="color-input">
                                <input type="color" id="secondaryColor" value="#00234C" class="form-control">
                                <span class="color-value">#00234C</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Region Settings Section -->
            <section id="region-section" class="content-section hidden" role="tabpanel" aria-labelledby="region-tab">
                <div class="section-header">
                    <h2>Regional Settings</h2>
                    <button class="btn btn-primary" onclick="saveRegionSettings()">Save Changes</button>
                </div>
                
                <div class="settings-grid">
                    <div class="settings-card">
                        <h3>Location & Currency</h3>
                        <div class="form-group">
                            <label for="timezone">Timezone</label>
                            <select id="timezone" class="form-control">
                                <option value="UTC-5">Eastern Time (UTC-5)</option>
                                <option value="UTC-6">Central Time (UTC-6)</option>
                                <option value="UTC-7">Mountain Time (UTC-7)</option>
                                <option value="UTC-8">Pacific Time (UTC-8)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="currency">Currency</label>
                            <select id="currency" class="form-control">
                                <option value="USD">US Dollar (USD)</option>
                                <option value="EUR">Euro (EUR)</option>
                                <option value="GBP">British Pound (GBP)</option>
                                <option value="INR">Indian Rupee (INR)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dateFormat">Date Format</label>
                            <select id="dateFormat" class="form-control">
                                <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                                <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                                <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="language">Language</label>
                            <select id="language" class="form-control">
                                <option value="en">English</option>
                                <option value="es">Spanish</option>
                                <option value="fr">French</option>
                                <option value="de">German</option>
                            </select>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sequences Section -->
            <section id="sequences-section" class="content-section hidden" role="tabpanel" aria-labelledby="sequences-tab">
                <div class="section-header">
                    <h2>Number Sequences</h2>
                    <button class="btn btn-primary" onclick="saveSequenceSettings()">Save Changes</button>
                </div>
                
                <div class="settings-grid">
                    <div class="settings-card">
                        <h3>Document Sequences</h3>
                        <div class="form-group">
                            <label for="customerSequence">Customer ID Sequence</label>
                            <div class="sequence-input">
                                <input type="text" id="customerPrefix" value="CUST" class="form-control sequence-prefix" placeholder="Prefix">
                                <input type="number" id="customerNext" value="1001" class="form-control sequence-number" placeholder="Next Number">
                            </div>
                            <p class="help-text">Next ID: CUST1001</p>
                        </div>
                        <div class="form-group">
                            <label for="leadSequence">Lead ID Sequence</label>
                            <div class="sequence-input">
                                <input type="text" id="leadPrefix" value="LEAD" class="form-control sequence-prefix" placeholder="Prefix">
                                <input type="number" id="leadNext" value="2001" class="form-control sequence-number" placeholder="Next Number">
                            </div>
                            <p class="help-text">Next ID: LEAD2001</p>
                        </div>
                        <div class="form-group">
                            <label for="bookingSequence">Booking ID Sequence</label>
                            <div class="sequence-input">
                                <input type="text" id="bookingPrefix" value="BOOK" class="form-control sequence-prefix" placeholder="Prefix">
                                <input type="number" id="bookingNext" value="3001" class="form-control sequence-number" placeholder="Next Number">
                            </div>
                            <p class="help-text">Next ID: BOOK3001</p>
                        </div>
                        <div class="form-group">
                            <label for="receiptSequence">Receipt ID Sequence</label>
                            <div class="sequence-input">
                                <input type="text" id="receiptPrefix" value="RCP" class="form-control sequence-prefix" placeholder="Prefix">
                                <input type="number" id="receiptNext" value="4001" class="form-control sequence-number" placeholder="Next Number">
                            </div>
                            <p class="help-text">Next ID: RCP4001</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Users & Roles Section -->
            <section id="users-section" class="content-section hidden" role="tabpanel" aria-labelledby="users-tab">
                <div class="section-header">
                    <h2>Users & Roles</h2>
                    <button class="btn btn-primary" onclick="addNewUser()">Add New User</button>
                </div>
                
                <div class="users-table">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody">
                            <tr>
                                <td>Admin User</td>
                                <td>admin@abcproperties.com</td>
                                <td>Administrator</td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>2024-01-15 09:30 AM</td>
                                <td>
                                    <button class="btn btn-sm" onclick="editUser('admin')">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="deactivateUser('admin')">Deactivate</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Sales Manager</td>
                                <td>sales@abcproperties.com</td>
                                <td>Sales Manager</td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>2024-01-15 08:45 AM</td>
                                <td>
                                    <button class="btn btn-sm" onclick="editUser('sales')">Edit</button>
                                    <button class="btn btn-sm btn-danger" onclick="deactivateUser('sales')">Deactivate</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Notifications Section -->
            <section id="notifications-section" class="content-section hidden" role="tabpanel" aria-labelledby="notifications-tab">
                <div class="section-header">
                    <h2>Notification Settings</h2>
                    <button class="btn btn-primary" onclick="saveNotificationSettings()">Save Changes</button>
                </div>
                
                <div class="settings-grid">
                    <div class="settings-card">
                        <h3>Email Notifications</h3>
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="emailNewLead" checked>
                                <span class="checkmark"></span>
                                New Lead Notifications
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="emailBookingConfirm" checked>
                                <span class="checkmark"></span>
                                Booking Confirmations
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="emailPaymentReminder" checked>
                                <span class="checkmark"></span>
                                Payment Reminders
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="emailSystemAlerts">
                                <span class="checkmark"></span>
                                System Alerts
                            </label>
                        </div>
                    </div>
                    
                    <div class="settings-card">
                        <h3>SMS Notifications</h3>
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="smsBookingConfirm" checked>
                                <span class="checkmark"></span>
                                Booking Confirmations
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="smsPaymentReminder">
                                <span class="checkmark"></span>
                                Payment Reminders
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="smsUrgentAlerts" checked>
                                <span class="checkmark"></span>
                                Urgent Alerts
                            </label>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>