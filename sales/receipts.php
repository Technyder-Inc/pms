<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

$pageTitle = "Receipts - Property Management System";
$currentPage = "receipts";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-receipt"></i> Receipts Management</h1>
            <p>Generate, track and manage payment receipts</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openNewReceiptModal()">
                <i class="fas fa-plus"></i> Generate Receipt
            </button>
            <button class="btn btn-outline" onclick="importReceipts()">
                <i class="fas fa-upload"></i> Import
            </button>
            <button class="btn btn-outline" onclick="exportReceiptsReport()">
                <i class="fas fa-download"></i> Export
            </button>
        </div>
    </div>

    <div class="receipts-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-receipt"></i>
                </div>
                <div class="stat-content">
                    <h3>1,247</h3>
                    <p>Total Receipts</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-content">
                    <h3>$3.2M</h3>
                    <p>Total Amount</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-content">
                    <h3>89</h3>
                    <p>This Month</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>12</h3>
                    <p>Pending</p>
                </div>
            </div>
        </div>
    </div>

    <div class="receipts-container">
        <div class="filters-section">
            <div class="search-filters">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search receipts by number, customer, or amount..." id="searchInput">
                </div>
                <div class="filter-group">
                    <select class="form-control" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="paid">Paid</option>
                        <option value="pending">Pending</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="refunded">Refunded</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="typeFilter">
                        <option value="">All Types</option>
                        <option value="booking">Booking Payment</option>
                        <option value="installment">Installment</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="penalty">Penalty</option>
                    </select>
                </div>
                <div class="filter-group">
                    <input type="date" class="form-control" id="dateFrom" placeholder="From Date">
                </div>
                <div class="filter-group">
                    <input type="date" class="form-control" id="dateTo" placeholder="To Date">
                </div>
                <div class="filter-group">
                    <select class="form-control" id="sortBy">
                        <option value="date-desc">Latest First</option>
                        <option value="date-asc">Oldest First</option>
                        <option value="amount-desc">Highest Amount</option>
                        <option value="amount-asc">Lowest Amount</option>
                        <option value="customer-asc">Customer A-Z</option>
                    </select>
                </div>
                <button class="btn btn-outline" onclick="resetFilters()">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </div>

        <div class="receipts-content">
            <div class="receipts-table">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAll"></th>
                            <th>Receipt #</th>
                            <th>Customer</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" class="receipt-checkbox" data-receipt-id="RCP-2024-001"></td>
                            <td>
                                <div class="receipt-number">
                                    <strong>RCP-2024-001</strong>
                                    <small>Booking Payment</small>
                                </div>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <strong>John Smith</strong>
                                    <small>john.smith@email.com</small>
                                </div>
                            </td>
                            <td>
                                <span class="type-badge booking">Booking Payment</span>
                            </td>
                            <td>
                                <div class="amount-info">
                                    <strong>$25,000</strong>
                                    <small>Down Payment</small>
                                </div>
                            </td>
                            <td>
                                <div class="date-info">
                                    <strong>Jan 15, 2024</strong>
                                    <small>10:30 AM</small>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge paid">Paid</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-outline btn-small" onclick="viewReceipt('RCP-2024-001')" title="View Receipt">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-primary btn-small" onclick="downloadReceipt('RCP-2024-001')" title="Download PDF">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-success btn-small" onclick="emailReceipt('RCP-2024-001')" title="Email Receipt">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td><input type="checkbox" class="receipt-checkbox" data-receipt-id="RCP-2024-002"></td>
                            <td>
                                <div class="receipt-number">
                                    <strong>RCP-2024-002</strong>
                                    <small>Installment Payment</small>
                                </div>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <strong>Sarah Johnson</strong>
                                    <small>sarah.j@email.com</small>
                                </div>
                            </td>
                            <td>
                                <span class="type-badge installment">Installment</span>
                            </td>
                            <td>
                                <div class="amount-info">
                                    <strong>$5,000</strong>
                                    <small>Monthly Payment</small>
                                </div>
                            </td>
                            <td>
                                <div class="date-info">
                                    <strong>Jan 14, 2024</strong>
                                    <small>2:15 PM</small>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge paid">Paid</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-outline btn-small" onclick="viewReceipt('RCP-2024-002')" title="View Receipt">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-primary btn-small" onclick="downloadReceipt('RCP-2024-002')" title="Download PDF">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-success btn-small" onclick="emailReceipt('RCP-2024-002')" title="Email Receipt">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td><input type="checkbox" class="receipt-checkbox" data-receipt-id="RCP-2024-003"></td>
                            <td>
                                <div class="receipt-number">
                                    <strong>RCP-2024-003</strong>
                                    <small>Maintenance Fee</small>
                                </div>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <strong>Michael Brown</strong>
                                    <small>m.brown@email.com</small>
                                </div>
                            </td>
                            <td>
                                <span class="type-badge maintenance">Maintenance</span>
                            </td>
                            <td>
                                <div class="amount-info">
                                    <strong>$500</strong>
                                    <small>Monthly Fee</small>
                                </div>
                            </td>
                            <td>
                                <div class="date-info">
                                    <strong>Jan 13, 2024</strong>
                                    <small>9:45 AM</small>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge pending">Pending</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-outline btn-small" onclick="viewReceipt('RCP-2024-003')" title="View Receipt">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-small" onclick="markAsPaid('RCP-2024-003')" title="Mark as Paid">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-danger btn-small" onclick="cancelReceipt('RCP-2024-003')" title="Cancel Receipt">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td><input type="checkbox" class="receipt-checkbox" data-receipt-id="RCP-2024-004"></td>
                            <td>
                                <div class="receipt-number">
                                    <strong>RCP-2024-004</strong>
                                    <small>Late Payment Penalty</small>
                                </div>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <strong>Emily Davis</strong>
                                    <small>emily.davis@email.com</small>
                                </div>
                            </td>
                            <td>
                                <span class="type-badge penalty">Penalty</span>
                            </td>
                            <td>
                                <div class="amount-info">
                                    <strong>$150</strong>
                                    <small>Late Fee</small>
                                </div>
                            </td>
                            <td>
                                <div class="date-info">
                                    <strong>Jan 12, 2024</strong>
                                    <small>4:20 PM</small>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge cancelled">Cancelled</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-outline btn-small" onclick="viewReceipt('RCP-2024-004')" title="View Receipt">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-secondary btn-small" onclick="restoreReceipt('RCP-2024-004')" title="Restore Receipt">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="table-footer">
                <div class="bulk-actions">
                    <select class="form-control" id="bulkAction">
                        <option value="">Bulk Actions</option>
                        <option value="download">Download Selected</option>
                        <option value="email">Email Selected</option>
                        <option value="mark-paid">Mark as Paid</option>
                        <option value="cancel">Cancel Selected</option>
                    </select>
                    <button class="btn btn-outline" onclick="executeBulkAction()">Apply</button>
                </div>
                
                <div class="pagination">
                    <button class="btn btn-outline btn-small" onclick="previousPage()">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <span class="page-info">Page 1 of 25</span>
                    <button class="btn btn-outline btn-small" onclick="nextPage()">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Receipt Modal -->
<div class="modal" id="newReceiptModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>Generate New Receipt</h3>
            <button class="modal-close" onclick="closeNewReceiptModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="receipt-form">
                <div class="form-section">
                    <h4>Receipt Information</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Receipt Number *</label>
                            <input type="text" class="form-control" id="receiptNumber" value="RCP-2024-005" readonly>
                        </div>
                        <div class="form-group">
                            <label>Receipt Date *</label>
                            <input type="date" class="form-control" id="receiptDate" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Receipt Type *</label>
                            <select class="form-control" id="receiptType" required>
                                <option value="">Select receipt type</option>
                                <option value="booking">Booking Payment</option>
                                <option value="installment">Installment Payment</option>
                                <option value="maintenance">Maintenance Fee</option>
                                <option value="penalty">Late Payment Penalty</option>
                                <option value="refund">Refund</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Payment Method *</label>
                            <select class="form-control" id="paymentMethod" required>
                                <option value="">Select payment method</option>
                                <option value="cash">Cash</option>
                                <option value="check">Check</option>
                                <option value="bank-transfer">Bank Transfer</option>
                                <option value="credit-card">Credit Card</option>
                                <option value="online">Online Payment</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h4>Customer Information</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Customer *</label>
                            <select class="form-control" id="customerId" required>
                                <option value="">Select customer</option>
                                <option value="1">John Smith - john.smith@email.com</option>
                                <option value="2">Sarah Johnson - sarah.j@email.com</option>
                                <option value="3">Michael Brown - m.brown@email.com</option>
                                <option value="4">Emily Davis - emily.davis@email.com</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Unit/Property</label>
                            <select class="form-control" id="unitId">
                                <option value="">Select unit (optional)</option>
                                <option value="1">Unit A-101 - Sunrise Towers</option>
                                <option value="2">Unit B-205 - Garden View</option>
                                <option value="3">Unit C-301 - City Heights</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h4>Payment Details</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Amount *</label>
                            <input type="number" class="form-control" id="receiptAmount" placeholder="0.00" min="0" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label>Tax Amount</label>
                            <input type="number" class="form-control" id="taxAmount" placeholder="0.00" min="0" step="0.01">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Description/Notes</label>
                        <textarea class="form-control" id="receiptDescription" rows="3" placeholder="Payment description or additional notes"></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Reference Number</label>
                            <input type="text" class="form-control" id="referenceNumber" placeholder="Transaction/Check number">
                        </div>
                        <div class="form-group">
                            <label>Due Date</label>
                            <input type="date" class="form-control" id="dueDate">
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h4>Additional Options</h4>
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="sendEmail"> Send receipt via email
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="markAsPaid" checked> Mark as paid immediately
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="generatePDF" checked> Generate PDF receipt
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeNewReceiptModal()">Cancel</button>
            <button class="btn btn-secondary" onclick="saveReceiptAsDraft()">Save as Draft</button>
            <button class="btn btn-primary" onclick="generateReceipt()">Generate Receipt</button>
        </div>
    </div>
</div>

<!-- Receipt View Modal -->
<div class="modal" id="receiptViewModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>Receipt Details</h3>
            <button class="modal-close" onclick="closeReceiptViewModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="receipt-preview" id="receiptPreview">
                <!-- Receipt content will be loaded here -->
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeReceiptViewModal()">Close</button>
            <button class="btn btn-primary" onclick="downloadCurrentReceipt()">
                <i class="fas fa-download"></i> Download PDF
            </button>
            <button class="btn btn-success" onclick="emailCurrentReceipt()">
                <i class="fas fa-envelope"></i> Email Receipt
            </button>
        </div>
    </div>
</div>

<style>
.receipts-dashboard {
    margin-bottom: 2rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--primary-color);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stat-content h3 {
    margin: 0;
    font-size: 2rem;
    color: var(--secondary-color);
}

.stat-content p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

.receipts-container {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.filters-section {
    padding: 1.5rem;
    border-bottom: 1px solid #eee;
    background: #f8f9fa;
}

.search-filters {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}

.search-bar {
    position: relative;
    flex: 1;
    min-width: 300px;
}

.search-bar i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #666;
}

.search-bar input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.9rem;
}

.filter-group {
    min-width: 150px;
}

.receipts-content {
    padding: 1.5rem;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1.5rem;
}

.data-table th,
.data-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.data-table th {
    background: #f8f9fa;
    font-weight: 600;
    color: var(--secondary-color);
    position: sticky;
    top: 0;
}

.data-table tr:hover {
    background: #f8f9fa;
}

.receipt-number strong {
    color: var(--secondary-color);
    font-size: 0.95rem;
}

.receipt-number small {
    display: block;
    color: #666;
    font-size: 0.8rem;
}

.customer-info strong {
    color: var(--secondary-color);
    font-size: 0.95rem;
}

.customer-info small {
    display: block;
    color: #666;
    font-size: 0.8rem;
}

.amount-info strong {
    color: var(--secondary-color);
    font-size: 1rem;
    font-weight: 600;
}

.amount-info small {
    display: block;
    color: #666;
    font-size: 0.8rem;
}

.date-info strong {
    color: var(--secondary-color);
    font-size: 0.9rem;
}

.date-info small {
    display: block;
    color: #666;
    font-size: 0.8rem;
}

.type-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.type-badge.booking {
    background: #e3f2fd;
    color: #1565c0;
}

.type-badge.installment {
    background: #f3e5f5;
    color: #7b1fa2;
}

.type-badge.maintenance {
    background: #fff3e0;
    color: #ef6c00;
}

.type-badge.penalty {
    background: #ffebee;
    color: #c62828;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-badge.paid {
    background: #d4edda;
    color: #155724;
}

.status-badge.pending {
    background: #fff3cd;
    color: #856404;
}

.status-badge.cancelled {
    background: #f8d7da;
    color: #721c24;
}

.status-badge.refunded {
    background: #e2e3e5;
    color: #383d41;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-small {
    padding: 0.375rem 0.75rem;
    font-size: 0.8rem;
    border-radius: 4px;
}

.table-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.bulk-actions {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.pagination {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.page-info {
    padding: 0 1rem;
    color: #666;
    font-size: 0.9rem;
}

.form-section {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #eee;
}

.form-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.form-section h4 {
    margin: 0 0 1rem 0;
    color: var(--secondary-color);
    font-size: 1.1rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    margin: 0;
}

.modal-content.large {
    max-width: 900px;
    max-height: 90vh;
    overflow-y: auto;
}

.receipt-preview {
    background: white;
    padding: 2rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-family: 'Lexend', sans-serif;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .search-filters {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-bar {
        min-width: auto;
    }
    
    .data-table {
        font-size: 0.8rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .table-footer {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function openNewReceiptModal() {
    document.getElementById('newReceiptModal').style.display = 'flex';
    // Set current date
    document.getElementById('receiptDate').value = new Date().toISOString().split('T')[0];
}

function closeNewReceiptModal() {
    document.getElementById('newReceiptModal').style.display = 'none';
    resetReceiptForm();
}

function closeReceiptViewModal() {
    document.getElementById('receiptViewModal').style.display = 'none';
}

function resetReceiptForm() {
    document.getElementById('receiptType').value = '';
    document.getElementById('paymentMethod').value = '';
    document.getElementById('customerId').value = '';
    document.getElementById('unitId').value = '';
    document.getElementById('receiptAmount').value = '';
    document.getElementById('taxAmount').value = '';
    document.getElementById('receiptDescription').value = '';
    document.getElementById('referenceNumber').value = '';
    document.getElementById('dueDate').value = '';
    document.getElementById('sendEmail').checked = false;
    document.getElementById('markAsPaid').checked = true;
    document.getElementById('generatePDF').checked = true;
}

function generateReceipt() {
    const receiptType = document.getElementById('receiptType').value;
    const customerId = document.getElementById('customerId').value;
    const amount = document.getElementById('receiptAmount').value;
    
    if (!receiptType || !customerId || !amount) {
        alert('Please fill in all required fields');
        return;
    }
    
    console.log('Generating receipt:', {
        type: receiptType,
        customer: customerId,
        amount: amount,
        status: document.getElementById('markAsPaid').checked ? 'paid' : 'pending'
    });
    
    closeNewReceiptModal();
}

function saveReceiptAsDraft() {
    const receiptType = document.getElementById('receiptType').value;
    const customerId = document.getElementById('customerId').value;
    
    if (!receiptType || !customerId) {
        alert('Please provide at least receipt type and customer');
        return;
    }
    
    console.log('Saving receipt as draft');
    closeNewReceiptModal();
}

function viewReceipt(receiptId) {
    console.log('Viewing receipt:', receiptId);
    document.getElementById('receiptViewModal').style.display = 'flex';
    
    // Load receipt details
    const receiptPreview = document.getElementById('receiptPreview');
    receiptPreview.innerHTML = `
        <div style="text-align: center; margin-bottom: 2rem;">
            <h2 style="color: var(--secondary-color); margin: 0;">Payment Receipt</h2>
            <p style="margin: 0.5rem 0; color: #666;">${receiptId}</p>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
            <div>
                <h4 style="color: var(--secondary-color); margin-bottom: 0.5rem;">From:</h4>
                <p style="margin: 0; line-height: 1.5;">Property Management System<br>123 Business Street<br>City, State 12345</p>
            </div>
            <div>
                <h4 style="color: var(--secondary-color); margin-bottom: 0.5rem;">To:</h4>
                <p style="margin: 0; line-height: 1.5;">John Smith<br>john.smith@email.com<br>456 Customer Ave</p>
            </div>
        </div>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 2rem;">
            <tr style="background: #f8f9fa;">
                <th style="padding: 1rem; text-align: left; border: 1px solid #ddd;">Description</th>
                <th style="padding: 1rem; text-align: right; border: 1px solid #ddd;">Amount</th>
            </tr>
            <tr>
                <td style="padding: 1rem; border: 1px solid #ddd;">Booking Payment - Down Payment</td>
                <td style="padding: 1rem; text-align: right; border: 1px solid #ddd;">$25,000.00</td>
            </tr>
            <tr style="background: #f8f9fa; font-weight: bold;">
                <td style="padding: 1rem; border: 1px solid #ddd;">Total</td>
                <td style="padding: 1rem; text-align: right; border: 1px solid #ddd;">$25,000.00</td>
            </tr>
        </table>
        <div style="text-align: center; color: #666; font-size: 0.9rem;">
            <p>Thank you for your payment!</p>
            <p>Receipt generated on: January 15, 2024</p>
        </div>
    `;
}

function downloadReceipt(receiptId) {
    console.log('Downloading receipt:', receiptId);
}

function downloadCurrentReceipt() {
    console.log('Downloading current receipt');
}

function emailReceipt(receiptId) {
    console.log('Emailing receipt:', receiptId);
}

function emailCurrentReceipt() {
    console.log('Emailing current receipt');
}

function markAsPaid(receiptId) {
    if (confirm('Mark this receipt as paid?')) {
        console.log('Marking as paid:', receiptId);
    }
}

function cancelReceipt(receiptId) {
    if (confirm('Are you sure you want to cancel this receipt?')) {
        console.log('Cancelling receipt:', receiptId);
    }
}

function restoreReceipt(receiptId) {
    if (confirm('Restore this cancelled receipt?')) {
        console.log('Restoring receipt:', receiptId);
    }
}

function importReceipts() {
    console.log('Opening import dialog');
}

function exportReceiptsReport() {
    console.log('Exporting receipts report');
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('typeFilter').value = '';
    document.getElementById('dateFrom').value = '';
    document.getElementById('dateTo').value = '';
    document.getElementById('sortBy').value = 'date-desc';
    console.log('Filters reset');
}

function executeBulkAction() {
    const action = document.getElementById('bulkAction').value;
    const selectedReceipts = document.querySelectorAll('.receipt-checkbox:checked');
    
    if (!action) {
        alert('Please select an action');
        return;
    }
    
    if (selectedReceipts.length === 0) {
        alert('Please select at least one receipt');
        return;
    }
    
    console.log('Executing bulk action:', action, 'on', selectedReceipts.length, 'receipts');
}

function previousPage() {
    console.log('Previous page');
}

function nextPage() {
    console.log('Next page');
}

// Select all functionality
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAll');
    const receiptCheckboxes = document.querySelectorAll('.receipt-checkbox');
    
    selectAllCheckbox.addEventListener('change', function() {
        receiptCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    receiptCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedCount = document.querySelectorAll('.receipt-checkbox:checked').length;
            selectAllCheckbox.checked = checkedCount === receiptCheckboxes.length;
            selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < receiptCheckboxes.length;
        });
    });
});
</script>

<?php include '../includes/footer.php'; ?>