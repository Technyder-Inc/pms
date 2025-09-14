<?php
// Leads Page
$pageTitle = 'Leads';
$currentPage = 'leads';
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
                <li><a href="#list" role="tab" aria-selected="true" class="subnav-pill active">List</a></li>
                <li><a href="#new" role="tab" aria-selected="false" class="subnav-pill">New</a></li>
                <li><a href="#qualification" role="tab" aria-selected="false" class="subnav-pill">Qualification</a></li>
                <li><a href="#booking-initiation" role="tab" aria-selected="false" class="subnav-pill">Booking Initiation</a></li>
            </ul>
        </nav>

        <!-- Content Area -->
        <div class="content" id="pageContent">
            <!-- List Section -->
            <section id="list-section" class="content-section" role="tabpanel" aria-labelledby="list-tab">
                <div class="section-header">
                    <h2>Lead Management</h2>
                    <button class="btn btn-primary" onclick="showSection('new')">Add New Lead</button>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Source</th>
                                <th>Status</th>
                                <th>Score</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="leadsTableBody">
                            <!-- Lead data will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- New Lead Section -->
            <section id="new-section" class="content-section hidden" role="tabpanel" aria-labelledby="new-tab">
                <div class="section-header">
                    <h2>Add New Lead</h2>
                    <button class="btn btn-secondary" onclick="showSection('list')">Back to List</button>
                </div>
                
                <form id="leadForm" class="form-container">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="leadFirstName">First Name *</label>
                            <input type="text" id="leadFirstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="leadLastName">Last Name *</label>
                            <input type="text" id="leadLastName" name="lastName" required>
                        </div>
                        <div class="form-group">
                            <label for="leadEmail">Email *</label>
                            <input type="email" id="leadEmail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="leadPhone">Phone</label>
                            <input type="tel" id="leadPhone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="leadSource">Lead Source</label>
                            <select id="leadSource" name="source">
                                <option value="">Select Source</option>
                                <option value="website">Website</option>
                                <option value="referral">Referral</option>
                                <option value="social-media">Social Media</option>
                                <option value="advertisement">Advertisement</option>
                                <option value="walk-in">Walk-in</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="leadStatus">Status</label>
                            <select id="leadStatus" name="status">
                                <option value="new">New</option>
                                <option value="contacted">Contacted</option>
                                <option value="qualified">Qualified</option>
                                <option value="proposal">Proposal Sent</option>
                                <option value="negotiation">Negotiation</option>
                                <option value="closed-won">Closed Won</option>
                                <option value="closed-lost">Closed Lost</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save Lead</button>
                        <button type="button" class="btn btn-secondary" onclick="showSection('list')">Cancel</button>
                    </div>
                </form>
            </section>

            <!-- Qualification Section -->
            <section id="qualification-section" class="content-section hidden" role="tabpanel" aria-labelledby="qualification-tab">
                <div class="section-header">
                    <h2>Lead Qualification</h2>
                </div>
                
                <div class="qualification-content">
                    <p>Lead qualification tools and processes will be implemented here.</p>
                </div>
            </section>

            <!-- Booking Initiation Section -->
            <section id="booking-initiation-section" class="content-section hidden" role="tabpanel" aria-labelledby="booking-initiation-tab">
                <div class="section-header">
                    <h2>Booking Initiation</h2>
                </div>
                
                <div class="booking-initiation-content">
                    <p>Booking initiation process will be implemented here.</p>
                </div>
            </section>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>