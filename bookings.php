<?php
// Bookings Page
$pageTitle = 'Bookings';
$currentPage = 'bookings';
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
                <li><a href="#allotments" role="tab" aria-selected="true" class="subnav-pill active">Allotments</a></li>
                <li><a href="#payment-plans" role="tab" aria-selected="false" class="subnav-pill">Payment Plans</a></li>
                <li><a href="#schedule-preview" role="tab" aria-selected="false" class="subnav-pill">Schedule Preview</a></li>
            </ul>
        </nav>

        <!-- Content Area -->
        <div class="content" id="pageContent">
            <!-- Allotments Section -->
            <section id="allotments-section" class="content-section" role="tabpanel" aria-labelledby="allotments-tab">
                <div class="section-header">
                    <h2>Unit Allotments</h2>
                    <button class="btn btn-primary" onclick="openAllotmentModal()">Create New Allotment</button>
                </div>
                
                <div class="filters-bar">
                    <select id="projectFilter">
                        <option value="">All Projects</option>
                        <option value="sunset">Sunset Residences</option>
                        <option value="green-valley">Green Valley Homes</option>
                    </select>
                    <select id="statusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <input type="date" id="dateFilter" placeholder="Filter by date">
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Allotment ID</th>
                                <th>Customer</th>
                                <th>Project</th>
                                <th>Unit</th>
                                <th>Allotment Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="allotmentsTableBody">
                            <!-- Allotment data will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Payment Plans Section -->
            <section id="payment-plans-section" class="content-section hidden" role="tabpanel" aria-labelledby="payment-plans-tab">
                <div class="section-header">
                    <h2>Payment Plans</h2>
                    <button class="btn btn-primary" onclick="openPaymentPlanModal()">Create Payment Plan</button>
                </div>
                
                <div class="payment-plans-content">
                    <div class="plans-grid">
                        <div class="plan-card">
                            <div class="plan-header">
                                <h3>Standard Plan</h3>
                                <span class="plan-type">Fixed</span>
                            </div>
                            <div class="plan-details">
                                <p><strong>Down Payment:</strong> 20%</p>
                                <p><strong>Installments:</strong> 24 months</p>
                                <p><strong>Interest Rate:</strong> 8% p.a.</p>
                            </div>
                            <div class="plan-actions">
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-secondary">View Details</button>
                            </div>
                        </div>
                        
                        <div class="plan-card">
                            <div class="plan-header">
                                <h3>Flexible Plan</h3>
                                <span class="plan-type">Variable</span>
                            </div>
                            <div class="plan-details">
                                <p><strong>Down Payment:</strong> 15%</p>
                                <p><strong>Installments:</strong> 36 months</p>
                                <p><strong>Interest Rate:</strong> 9% p.a.</p>
                            </div>
                            <div class="plan-actions">
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-secondary">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Schedule Preview Section -->
            <section id="schedule-preview-section" class="content-section hidden" role="tabpanel" aria-labelledby="schedule-preview-tab">
                <div class="section-header">
                    <h2>Payment Schedule Preview</h2>
                    <div class="schedule-filters">
                        <select id="customerSelect">
                            <option value="">Select Customer</option>
                            <option value="john-smith">John Smith</option>
                            <option value="jane-doe">Jane Doe</option>
                        </select>
                        <select id="allotmentSelect">
                            <option value="">Select Allotment</option>
                        </select>
                        <button class="btn btn-primary" onclick="generateSchedule()">Generate Schedule</button>
                    </div>
                </div>
                
                <div class="schedule-content">
                    <div id="schedulePreview" class="schedule-preview">
                        <p class="placeholder-text">Select a customer and allotment to preview payment schedule.</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>