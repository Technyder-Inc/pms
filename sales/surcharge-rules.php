<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

$pageTitle = "Surcharge Rules - Property Management System";
$currentPage = "surcharge-rules";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-percentage"></i> Surcharge Rules Management</h1>
            <p>Configure and manage surcharge rules for late payments and penalties</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openNewRuleModal()">
                <i class="fas fa-plus"></i> Add Rule
            </button>
            <button class="btn btn-outline" onclick="importRules()">
                <i class="fas fa-upload"></i> Import
            </button>
            <button class="btn btn-outline" onclick="exportRules()">
                <i class="fas fa-download"></i> Export
            </button>
        </div>
    </div>

    <div class="surcharge-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-percentage"></i>
                </div>
                <div class="stat-content">
                    <h3>12</h3>
                    <p>Active Rules</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-content">
                    <h3>45</h3>
                    <p>Applied This Month</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-content">
                    <h3>$8,750</h3>
                    <p>Total Collected</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>3</h3>
                    <p>Pending Review</p>
                </div>
            </div>
        </div>
    </div>

    <div class="surcharge-container">
        <div class="filters-section">
            <div class="search-filters">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search rules by name, type, or description..." id="searchInput">
                </div>
                <div class="filter-group">
                    <select class="form-control" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="typeFilter">
                        <option value="">All Types</option>
                        <option value="late-payment">Late Payment</option>
                        <option value="penalty">Penalty</option>
                        <option value="interest">Interest</option>
                        <option value="processing-fee">Processing Fee</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="sortBy">
                        <option value="name-asc">Name A-Z</option>
                        <option value="name-desc">Name Z-A</option>
                        <option value="created-desc">Newest First</option>
                        <option value="created-asc">Oldest First</option>
                        <option value="priority-desc">High Priority</option>
                    </select>
                </div>
                <button class="btn btn-outline" onclick="resetFilters()">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </div>

        <div class="rules-content">
            <div class="rules-grid">
                <div class="rule-card active">
                    <div class="rule-header">
                        <div class="rule-info">
                            <h3>Late Payment Fee</h3>
                            <span class="rule-type late-payment">Late Payment</span>
                        </div>
                        <div class="rule-status">
                            <span class="status-badge active">Active</span>
                        </div>
                    </div>
                    
                    <div class="rule-details">
                        <div class="rule-description">
                            <p>Applied when payment is overdue by more than 7 days</p>
                        </div>
                        
                        <div class="rule-config">
                            <div class="config-item">
                                <label>Calculation Method:</label>
                                <span>Percentage of Outstanding Amount</span>
                            </div>
                            <div class="config-item">
                                <label>Rate:</label>
                                <span>2.5% per month</span>
                            </div>
                            <div class="config-item">
                                <label>Grace Period:</label>
                                <span>7 days</span>
                            </div>
                            <div class="config-item">
                                <label>Maximum Amount:</label>
                                <span>$500</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="rule-actions">
                        <button class="btn btn-outline btn-small" onclick="editRule('rule-001')" title="Edit Rule">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-success btn-small" onclick="duplicateRule('rule-001')" title="Duplicate Rule">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button class="btn btn-warning btn-small" onclick="toggleRuleStatus('rule-001')" title="Deactivate Rule">
                            <i class="fas fa-pause"></i>
                        </button>
                        <button class="btn btn-danger btn-small" onclick="deleteRule('rule-001')" title="Delete Rule">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                
                <div class="rule-card active">
                    <div class="rule-header">
                        <div class="rule-info">
                            <h3>Processing Fee</h3>
                            <span class="rule-type processing-fee">Processing Fee</span>
                        </div>
                        <div class="rule-status">
                            <span class="status-badge active">Active</span>
                        </div>
                    </div>
                    
                    <div class="rule-details">
                        <div class="rule-description">
                            <p>Fixed processing fee for all payment transactions</p>
                        </div>
                        
                        <div class="rule-config">
                            <div class="config-item">
                                <label>Calculation Method:</label>
                                <span>Fixed Amount</span>
                            </div>
                            <div class="config-item">
                                <label>Amount:</label>
                                <span>$25.00</span>
                            </div>
                            <div class="config-item">
                                <label>Applied To:</label>
                                <span>All Payments</span>
                            </div>
                            <div class="config-item">
                                <label>Frequency:</label>
                                <span>Per Transaction</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="rule-actions">
                        <button class="btn btn-outline btn-small" onclick="editRule('rule-002')" title="Edit Rule">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-success btn-small" onclick="duplicateRule('rule-002')" title="Duplicate Rule">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button class="btn btn-warning btn-small" onclick="toggleRuleStatus('rule-002')" title="Deactivate Rule">
                            <i class="fas fa-pause"></i>
                        </button>
                        <button class="btn btn-danger btn-small" onclick="deleteRule('rule-002')" title="Delete Rule">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                
                <div class="rule-card inactive">
                    <div class="rule-header">
                        <div class="rule-info">
                            <h3>Interest on Overdue</h3>
                            <span class="rule-type interest">Interest</span>
                        </div>
                        <div class="rule-status">
                            <span class="status-badge inactive">Inactive</span>
                        </div>
                    </div>
                    
                    <div class="rule-details">
                        <div class="rule-description">
                            <p>Compound interest on overdue amounts after 30 days</p>
                        </div>
                        
                        <div class="rule-config">
                            <div class="config-item">
                                <label>Calculation Method:</label>
                                <span>Compound Interest</span>
                            </div>
                            <div class="config-item">
                                <label>Rate:</label>
                                <span>1.5% per month</span>
                            </div>
                            <div class="config-item">
                                <label>Grace Period:</label>
                                <span>30 days</span>
                            </div>
                            <div class="config-item">
                                <label>Compounding:</label>
                                <span>Monthly</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="rule-actions">
                        <button class="btn btn-outline btn-small" onclick="editRule('rule-003')" title="Edit Rule">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-success btn-small" onclick="duplicateRule('rule-003')" title="Duplicate Rule">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button class="btn btn-success btn-small" onclick="toggleRuleStatus('rule-003')" title="Activate Rule">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="btn btn-danger btn-small" onclick="deleteRule('rule-003')" title="Delete Rule">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                
                <div class="rule-card draft">
                    <div class="rule-header">
                        <div class="rule-info">
                            <h3>Early Payment Discount</h3>
                            <span class="rule-type penalty">Discount</span>
                        </div>
                        <div class="rule-status">
                            <span class="status-badge draft">Draft</span>
                        </div>
                    </div>
                    
                    <div class="rule-details">
                        <div class="rule-description">
                            <p>Discount for payments made before due date</p>
                        </div>
                        
                        <div class="rule-config">
                            <div class="config-item">
                                <label>Calculation Method:</label>
                                <span>Percentage Discount</span>
                            </div>
                            <div class="config-item">
                                <label>Rate:</label>
                                <span>1% discount</span>
                            </div>
                            <div class="config-item">
                                <label>Early Period:</label>
                                <span>15 days before due</span>
                            </div>
                            <div class="config-item">
                                <label>Maximum Discount:</label>
                                <span>$200</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="rule-actions">
                        <button class="btn btn-outline btn-small" onclick="editRule('rule-004')" title="Edit Rule">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-primary btn-small" onclick="activateRule('rule-004')" title="Activate Rule">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn btn-danger btn-small" onclick="deleteRule('rule-004')" title="Delete Rule">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Rule Modal -->
<div class="modal" id="newRuleModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>Create New Surcharge Rule</h3>
            <button class="modal-close" onclick="closeNewRuleModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="rule-form">
                <div class="form-section">
                    <h4>Basic Information</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Rule Name *</label>
                            <input type="text" class="form-control" id="ruleName" placeholder="Enter rule name" required>
                        </div>
                        <div class="form-group">
                            <label>Rule Type *</label>
                            <select class="form-control" id="ruleType" required>
                                <option value="">Select rule type</option>
                                <option value="late-payment">Late Payment Fee</option>
                                <option value="penalty">Penalty</option>
                                <option value="interest">Interest</option>
                                <option value="processing-fee">Processing Fee</option>
                                <option value="discount">Discount</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" id="ruleDescription" rows="3" placeholder="Describe when and how this rule applies"></textarea>
                    </div>
                </div>
                
                <div class="form-section">
                    <h4>Calculation Settings</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Calculation Method *</label>
                            <select class="form-control" id="calculationMethod" required>
                                <option value="">Select calculation method</option>
                                <option value="percentage">Percentage of Amount</option>
                                <option value="fixed">Fixed Amount</option>
                                <option value="tiered">Tiered Structure</option>
                                <option value="compound">Compound Interest</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Rate/Amount *</label>
                            <input type="number" class="form-control" id="rateAmount" placeholder="Enter rate or amount" min="0" step="0.01" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Minimum Amount</label>
                            <input type="number" class="form-control" id="minAmount" placeholder="0.00" min="0" step="0.01">
                        </div>
                        <div class="form-group">
                            <label>Maximum Amount</label>
                            <input type="number" class="form-control" id="maxAmount" placeholder="No limit" min="0" step="0.01">
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h4>Timing & Conditions</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Grace Period (Days)</label>
                            <input type="number" class="form-control" id="gracePeriod" placeholder="0" min="0">
                        </div>
                        <div class="form-group">
                            <label>Frequency</label>
                            <select class="form-control" id="frequency">
                                <option value="once">One Time</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                                <option value="quarterly">Quarterly</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Effective Date</label>
                            <input type="date" class="form-control" id="effectiveDate">
                        </div>
                        <div class="form-group">
                            <label>Expiry Date</label>
                            <input type="date" class="form-control" id="expiryDate">
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h4>Application Rules</h4>
                    <div class="form-group">
                        <label>Apply To</label>
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="applyToBookings" checked> Booking Payments
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" id="applyToInstallments" checked> Installment Payments
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" id="applyToMaintenance"> Maintenance Fees
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" id="applyToOther"> Other Payments
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Customer Type</label>
                            <select class="form-control" id="customerType">
                                <option value="all">All Customers</option>
                                <option value="individual">Individual</option>
                                <option value="corporate">Corporate</option>
                                <option value="vip">VIP Customers</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Priority Level</label>
                            <select class="form-control" id="priorityLevel">
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                                <option value="critical">Critical</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h4>Notifications & Automation</h4>
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="autoApply" checked> Automatically apply this rule
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="notifyCustomer"> Notify customer when applied
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="requireApproval"> Require manager approval
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="generateReceipt"> Generate receipt automatically
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeNewRuleModal()">Cancel</button>
            <button class="btn btn-secondary" onclick="saveRuleAsDraft()">Save as Draft</button>
            <button class="btn btn-primary" onclick="createRule()">Create Rule</button>
        </div>
    </div>
</div>

<!-- Edit Rule Modal -->
<div class="modal" id="editRuleModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>Edit Surcharge Rule</h3>
            <button class="modal-close" onclick="closeEditRuleModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div id="editRuleForm">
                <!-- Edit form content will be loaded here -->
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeEditRuleModal()">Cancel</button>
            <button class="btn btn-primary" onclick="updateRule()">Update Rule</button>
        </div>
    </div>
</div>

<style>
.surcharge-dashboard {
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

.surcharge-container {
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

.rules-content {
    padding: 1.5rem;
}

.rules-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 1.5rem;
}

.rule-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 1.5rem;
    transition: all 0.3s ease;
    position: relative;
}

.rule-card:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.rule-card.active {
    border-left: 4px solid #28a745;
}

.rule-card.inactive {
    border-left: 4px solid #6c757d;
    opacity: 0.7;
}

.rule-card.draft {
    border-left: 4px solid #ffc107;
}

.rule-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.rule-info h3 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
    font-size: 1.2rem;
}

.rule-type {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.rule-type.late-payment {
    background: #ffebee;
    color: #c62828;
}

.rule-type.penalty {
    background: #fff3e0;
    color: #ef6c00;
}

.rule-type.interest {
    background: #f3e5f5;
    color: #7b1fa2;
}

.rule-type.processing-fee {
    background: #e3f2fd;
    color: #1565c0;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-badge.active {
    background: #d4edda;
    color: #155724;
}

.status-badge.inactive {
    background: #e2e3e5;
    color: #383d41;
}

.status-badge.draft {
    background: #fff3cd;
    color: #856404;
}

.rule-details {
    margin-bottom: 1.5rem;
}

.rule-description {
    margin-bottom: 1rem;
}

.rule-description p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
    line-height: 1.5;
}

.rule-config {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
}

.config-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.config-item label {
    font-size: 0.8rem;
    color: #666;
    font-weight: 500;
}

.config-item span {
    font-size: 0.9rem;
    color: var(--secondary-color);
    font-weight: 600;
}

.rule-actions {
    display: flex;
    gap: 0.5rem;
    justify-content: flex-end;
}

.btn-small {
    padding: 0.375rem 0.75rem;
    font-size: 0.8rem;
    border-radius: 4px;
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

.checkbox-group {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.5rem;
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
    
    .rules-grid {
        grid-template-columns: 1fr;
    }
    
    .rule-config {
        grid-template-columns: 1fr;
    }
    
    .rule-actions {
        flex-wrap: wrap;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .checkbox-group {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function openNewRuleModal() {
    document.getElementById('newRuleModal').style.display = 'flex';
    // Set current date as effective date
    document.getElementById('effectiveDate').value = new Date().toISOString().split('T')[0];
}

function closeNewRuleModal() {
    document.getElementById('newRuleModal').style.display = 'none';
    resetRuleForm();
}

function closeEditRuleModal() {
    document.getElementById('editRuleModal').style.display = 'none';
}

function resetRuleForm() {
    document.getElementById('ruleName').value = '';
    document.getElementById('ruleType').value = '';
    document.getElementById('ruleDescription').value = '';
    document.getElementById('calculationMethod').value = '';
    document.getElementById('rateAmount').value = '';
    document.getElementById('minAmount').value = '';
    document.getElementById('maxAmount').value = '';
    document.getElementById('gracePeriod').value = '';
    document.getElementById('frequency').value = 'once';
    document.getElementById('effectiveDate').value = '';
    document.getElementById('expiryDate').value = '';
    document.getElementById('customerType').value = 'all';
    document.getElementById('priorityLevel').value = 'medium';
    
    // Reset checkboxes
    document.getElementById('applyToBookings').checked = true;
    document.getElementById('applyToInstallments').checked = true;
    document.getElementById('applyToMaintenance').checked = false;
    document.getElementById('applyToOther').checked = false;
    document.getElementById('autoApply').checked = true;
    document.getElementById('notifyCustomer').checked = false;
    document.getElementById('requireApproval').checked = false;
    document.getElementById('generateReceipt').checked = false;
}

function createRule() {
    const ruleName = document.getElementById('ruleName').value;
    const ruleType = document.getElementById('ruleType').value;
    const calculationMethod = document.getElementById('calculationMethod').value;
    const rateAmount = document.getElementById('rateAmount').value;
    
    if (!ruleName || !ruleType || !calculationMethod || !rateAmount) {
        alert('Please fill in all required fields');
        return;
    }
    
    console.log('Creating rule:', {
        name: ruleName,
        type: ruleType,
        method: calculationMethod,
        rate: rateAmount
    });
    
    closeNewRuleModal();
}

function saveRuleAsDraft() {
    const ruleName = document.getElementById('ruleName').value;
    const ruleType = document.getElementById('ruleType').value;
    
    if (!ruleName || !ruleType) {
        alert('Please provide at least rule name and type');
        return;
    }
    
    console.log('Saving rule as draft');
    closeNewRuleModal();
}

function editRule(ruleId) {
    console.log('Editing rule:', ruleId);
    document.getElementById('editRuleModal').style.display = 'flex';
    
    // Load rule data into edit form
    const editForm = document.getElementById('editRuleForm');
    editForm.innerHTML = `
        <div class="form-section">
            <h4>Edit Rule: Late Payment Fee</h4>
            <div class="form-row">
                <div class="form-group">
                    <label>Rule Name *</label>
                    <input type="text" class="form-control" value="Late Payment Fee" required>
                </div>
                <div class="form-group">
                    <label>Rule Type *</label>
                    <select class="form-control" required>
                        <option value="late-payment" selected>Late Payment Fee</option>
                        <option value="penalty">Penalty</option>
                        <option value="interest">Interest</option>
                        <option value="processing-fee">Processing Fee</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="3">Applied when payment is overdue by more than 7 days</textarea>
            </div>
        </div>
    `;
}

function updateRule() {
    console.log('Updating rule');
    closeEditRuleModal();
}

function duplicateRule(ruleId) {
    if (confirm('Create a copy of this rule?')) {
        console.log('Duplicating rule:', ruleId);
    }
}

function toggleRuleStatus(ruleId) {
    if (confirm('Change the status of this rule?')) {
        console.log('Toggling rule status:', ruleId);
    }
}

function activateRule(ruleId) {
    if (confirm('Activate this rule?')) {
        console.log('Activating rule:', ruleId);
    }
}

function deleteRule(ruleId) {
    if (confirm('Are you sure you want to delete this rule? This action cannot be undone.')) {
        console.log('Deleting rule:', ruleId);
    }
}

function importRules() {
    console.log('Opening import dialog');
}

function exportRules() {
    console.log('Exporting rules');
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('typeFilter').value = '';
    document.getElementById('sortBy').value = 'name-asc';
    console.log('Filters reset');
}

// Form validation and dynamic updates
document.addEventListener('DOMContentLoaded', function() {
    const calculationMethod = document.getElementById('calculationMethod');
    const rateAmount = document.getElementById('rateAmount');
    
    if (calculationMethod) {
        calculationMethod.addEventListener('change', function() {
            const method = this.value;
            const rateLabel = rateAmount.previousElementSibling;
            
            switch(method) {
                case 'percentage':
                    rateLabel.textContent = 'Percentage Rate *';
                    rateAmount.placeholder = 'e.g., 2.5 for 2.5%';
                    break;
                case 'fixed':
                    rateLabel.textContent = 'Fixed Amount *';
                    rateAmount.placeholder = 'e.g., 25.00';
                    break;
                case 'tiered':
                    rateLabel.textContent = 'Base Rate *';
                    rateAmount.placeholder = 'Base rate or amount';
                    break;
                case 'compound':
                    rateLabel.textContent = 'Interest Rate *';
                    rateAmount.placeholder = 'e.g., 1.5 for 1.5%';
                    break;
                default:
                    rateLabel.textContent = 'Rate/Amount *';
                    rateAmount.placeholder = 'Enter rate or amount';
            }
        });
    }
});
</script>

<?php include '../includes/footer.php'; ?>