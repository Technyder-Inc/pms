<?php
// Finance Page
$pageTitle = 'Finance';
$currentPage = 'finance';
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
                <li><a href="#receipts" role="tab" aria-selected="true" class="subnav-pill active">Receipts</a></li>
                <li><a href="#ledger" role="tab" aria-selected="false" class="subnav-pill">Customer Ledger</a></li>
            </ul>
        </nav>

        <!-- Content Area -->
        <div class="content" id="pageContent">
            <!-- Receipts Section -->
            <section id="receipts-section" class="content-section" role="tabpanel" aria-labelledby="receipts-tab">
                <div class="section-header">
                    <h2>Payment Receipts</h2>
                    <button class="btn btn-primary" onclick="openReceiptModal()">Record New Payment</button>
                </div>
                
                <div class="finance-summary">
                    <div class="summary-cards">
                        <div class="summary-card">
                            <div class="card-icon">💰</div>
                            <div class="card-content">
                                <h3>Today's Collections</h3>
                                <p class="amount">$125,000</p>
                                <span class="change positive">+12% from yesterday</span>
                            </div>
                        </div>
                        <div class="summary-card">
                            <div class="card-icon">📊</div>
                            <div class="card-content">
                                <h3>This Month</h3>
                                <p class="amount">$2,450,000</p>
                                <span class="change positive">+8% from last month</span>
                            </div>
                        </div>
                        <div class="summary-card">
                            <div class="card-icon">⏰</div>
                            <div class="card-content">
                                <h3>Pending Collections</h3>
                                <p class="amount">$380,000</p>
                                <span class="change neutral">15 customers</span>
                            </div>
                        </div>
                        <div class="summary-card">
                            <div class="card-icon">🏦</div>
                            <div class="card-content">
                                <h3>Total Outstanding</h3>
                                <p class="amount">$1,250,000</p>
                                <span class="change negative">Requires follow-up</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="filters-bar">
                    <input type="date" id="fromDate" placeholder="From Date">
                    <input type="date" id="toDate" placeholder="To Date">
                    <select id="paymentModeFilter">
                        <option value="">All Payment Modes</option>
                        <option value="cash">Cash</option>
                        <option value="cheque">Cheque</option>
                        <option value="bank-transfer">Bank Transfer</option>
                        <option value="online">Online Payment</option>
                    </select>
                    <select id="statusFilter">
                        <option value="">All Status</option>
                        <option value="cleared">Cleared</option>
                        <option value="pending">Pending</option>
                        <option value="bounced">Bounced</option>
                    </select>
                    <button class="btn btn-secondary" onclick="applyFilters()">Apply Filters</button>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Receipt No.</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Project</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="receiptsTableBody">
                            <!-- Receipt data will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Customer Ledger Section -->
            <section id="ledger-section" class="content-section hidden" role="tabpanel" aria-labelledby="ledger-tab">
                <div class="section-header">
                    <h2>Customer Ledger</h2>
                    <div class="ledger-controls">
                        <select id="customerSelect">
                            <option value="">Select Customer</option>
                            <option value="john-smith">John Smith</option>
                            <option value="sarah-johnson">Sarah Johnson</option>
                            <option value="michael-brown">Michael Brown</option>
                        </select>
                        <button class="btn btn-primary" onclick="generateLedger()">Generate Ledger</button>
                        <button class="btn btn-secondary" onclick="exportLedger()">Export PDF</button>
                    </div>
                </div>
                
                <div class="ledger-content">
                    <div id="customerLedger" class="customer-ledger">
                        <div class="ledger-header">
                            <div class="customer-info">
                                <h3 id="ledgerCustomerName">Select a customer to view ledger</h3>
                                <p id="ledgerCustomerDetails"></p>
                            </div>
                            <div class="ledger-summary">
                                <div class="summary-item">
                                    <span class="label">Total Allotment:</span>
                                    <span class="value" id="totalAllotment">-</span>
                                </div>
                                <div class="summary-item">
                                    <span class="label">Total Paid:</span>
                                    <span class="value" id="totalPaid">-</span>
                                </div>
                                <div class="summary-item">
                                    <span class="label">Outstanding:</span>
                                    <span class="value" id="totalOutstanding">-</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="ledger-transactions">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                        <th>Receipt No.</th>
                                    </tr>
                                </thead>
                                <tbody id="ledgerTableBody">
                                    <tr>
                                        <td colspan="6" class="no-data">Select a customer to view transactions</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>