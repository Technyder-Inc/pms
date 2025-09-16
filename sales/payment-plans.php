<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

$pageTitle = "Payment Plans - Property Management System";
$currentPage = "payment-plans";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-credit-card"></i> Payment Plans Management</h1>
            <p>Create and manage flexible payment plans for customers</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openNewPlanModal()">
                <i class="fas fa-plus"></i> Create Plan
            </button>
            <button class="btn btn-outline" onclick="importPlans()">
                <i class="fas fa-upload"></i> Import Plans
            </button>
            <button class="btn btn-outline" onclick="exportPlansReport()">
                <i class="fas fa-download"></i> Export
            </button>
        </div>
    </div>

    <div class="plans-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="stat-content">
                    <h3>24</h3>
                    <p>Active Plans</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>156</h3>
                    <p>Customers Enrolled</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-content">
                    <h3>$2.4M</h3>
                    <p>Total Value</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <h3>89%</h3>
                    <p>On-time Payments</p>
                </div>
            </div>
        </div>
    </div>

    <div class="plans-container">
        <div class="filters-section">
            <div class="search-filters">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search payment plans..." id="searchInput">
                </div>
                <div class="filter-group">
                    <select class="form-control" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="draft">Draft</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="typeFilter">
                        <option value="">All Types</option>
                        <option value="installment">Installment</option>
                        <option value="milestone">Milestone</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="sortBy">
                        <option value="name-asc">Name A-Z</option>
                        <option value="name-desc">Name Z-A</option>
                        <option value="created-desc">Newest First</option>
                        <option value="created-asc">Oldest First</option>
                        <option value="customers-desc">Most Customers</option>
                    </select>
                </div>
                <button class="btn btn-outline" onclick="resetFilters()">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </div>

        <div class="plans-content">
            <div class="plans-grid">
                <div class="plan-card active">
                    <div class="plan-header">
                        <div class="plan-title">
                            <h3>Standard Installment Plan</h3>
                            <span class="plan-type">Installment</span>
                        </div>
                        <div class="plan-status">
                            <span class="status-badge active">Active</span>
                        </div>
                    </div>
                    
                    <div class="plan-details">
                        <div class="plan-summary">
                            <div class="summary-item">
                                <span class="label">Down Payment:</span>
                                <span class="value">20%</span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Installments:</span>
                                <span class="value">24 months</span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Interest Rate:</span>
                                <span class="value">8% p.a.</span>
                            </div>
                        </div>
                        
                        <div class="plan-description">
                            <p>Standard 24-month installment plan with 20% down payment. Perfect for most residential units.</p>
                        </div>
                        
                        <div class="plan-stats">
                            <div class="stat-item">
                                <i class="fas fa-users"></i>
                                <span>42 Customers</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-dollar-sign"></i>
                                <span>$850K Total</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-calendar"></i>
                                <span>Created: Jan 15, 2024</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="plan-actions">
                        <button class="btn btn-outline btn-small" onclick="viewPlanDetails('plan-1')">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-primary btn-small" onclick="editPlan('plan-1')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-success btn-small" onclick="duplicatePlan('plan-1')">
                            <i class="fas fa-copy"></i> Duplicate
                        </button>
                    </div>
                </div>

                <div class="plan-card active">
                    <div class="plan-header">
                        <div class="plan-title">
                            <h3>Premium Milestone Plan</h3>
                            <span class="plan-type">Milestone</span>
                        </div>
                        <div class="plan-status">
                            <span class="status-badge active">Active</span>
                        </div>
                    </div>
                    
                    <div class="plan-details">
                        <div class="plan-summary">
                            <div class="summary-item">
                                <span class="label">Down Payment:</span>
                                <span class="value">30%</span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Milestones:</span>
                                <span class="value">5 stages</span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Interest Rate:</span>
                                <span class="value">6% p.a.</span>
                            </div>
                        </div>
                        
                        <div class="plan-description">
                            <p>Construction milestone-based payment plan with reduced interest rates for premium units.</p>
                        </div>
                        
                        <div class="plan-stats">
                            <div class="stat-item">
                                <i class="fas fa-users"></i>
                                <span>18 Customers</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-dollar-sign"></i>
                                <span>$1.2M Total</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-calendar"></i>
                                <span>Created: Dec 10, 2023</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="plan-actions">
                        <button class="btn btn-outline btn-small" onclick="viewPlanDetails('plan-2')">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-primary btn-small" onclick="editPlan('plan-2')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-success btn-small" onclick="duplicatePlan('plan-2')">
                            <i class="fas fa-copy"></i> Duplicate
                        </button>
                    </div>
                </div>

                <div class="plan-card draft">
                    <div class="plan-header">
                        <div class="plan-title">
                            <h3>Flexible Custom Plan</h3>
                            <span class="plan-type">Custom</span>
                        </div>
                        <div class="plan-status">
                            <span class="status-badge draft">Draft</span>
                        </div>
                    </div>
                    
                    <div class="plan-details">
                        <div class="plan-summary">
                            <div class="summary-item">
                                <span class="label">Down Payment:</span>
                                <span class="value">Variable</span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Duration:</span>
                                <span class="value">12-36 months</span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Interest Rate:</span>
                                <span class="value">5-10% p.a.</span>
                            </div>
                        </div>
                        
                        <div class="plan-description">
                            <p>Customizable payment plan with flexible terms based on customer requirements and unit type.</p>
                        </div>
                        
                        <div class="plan-stats">
                            <div class="stat-item">
                                <i class="fas fa-users"></i>
                                <span>0 Customers</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-dollar-sign"></i>
                                <span>$0 Total</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-calendar"></i>
                                <span>Created: Jan 20, 2024</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="plan-actions">
                        <button class="btn btn-outline btn-small" onclick="viewPlanDetails('plan-3')">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-primary btn-small" onclick="editPlan('plan-3')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-warning btn-small" onclick="activatePlan('plan-3')">
                            <i class="fas fa-play"></i> Activate
                        </button>
                    </div>
                </div>

                <div class="plan-card archived">
                    <div class="plan-header">
                        <div class="plan-title">
                            <h3>Legacy 36-Month Plan</h3>
                            <span class="plan-type">Installment</span>
                        </div>
                        <div class="plan-status">
                            <span class="status-badge archived">Archived</span>
                        </div>
                    </div>
                    
                    <div class="plan-details">
                        <div class="plan-summary">
                            <div class="summary-item">
                                <span class="label">Down Payment:</span>
                                <span class="value">15%</span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Installments:</span>
                                <span class="value">36 months</span>
                            </div>
                            <div class="summary-item">
                                <span class="label">Interest Rate:</span>
                                <span class="value">12% p.a.</span>
                            </div>
                        </div>
                        
                        <div class="plan-description">
                            <p>Legacy payment plan with extended duration. No longer offered to new customers.</p>
                        </div>
                        
                        <div class="plan-stats">
                            <div class="stat-item">
                                <i class="fas fa-users"></i>
                                <span>8 Customers</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-dollar-sign"></i>
                                <span>$320K Total</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-calendar"></i>
                                <span>Archived: Nov 30, 2023</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="plan-actions">
                        <button class="btn btn-outline btn-small" onclick="viewPlanDetails('plan-4')">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-secondary btn-small" onclick="restorePlan('plan-4')">
                            <i class="fas fa-undo"></i> Restore
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Payment Plan Modal -->
<div class="modal" id="newPlanModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>Create New Payment Plan</h3>
            <button class="modal-close" onclick="closeNewPlanModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="plan-form">
                <div class="form-section">
                    <h4>Basic Information</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Plan Name *</label>
                            <input type="text" class="form-control" id="planName" placeholder="e.g., Standard 24-Month Plan" required>
                        </div>
                        <div class="form-group">
                            <label>Plan Type *</label>
                            <select class="form-control" id="planType" required>
                                <option value="">Select plan type</option>
                                <option value="installment">Installment Plan</option>
                                <option value="milestone">Milestone Plan</option>
                                <option value="custom">Custom Plan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" id="planDescription" rows="3" placeholder="Plan description and terms"></textarea>
                    </div>
                </div>
                
                <div class="form-section">
                    <h4>Payment Terms</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Down Payment (%) *</label>
                            <input type="number" class="form-control" id="downPayment" placeholder="e.g., 20" min="0" max="100" required>
                        </div>
                        <div class="form-group">
                            <label>Interest Rate (% p.a.) *</label>
                            <input type="number" class="form-control" id="interestRate" placeholder="e.g., 8" min="0" step="0.1" required>
                        </div>
                    </div>
                    
                    <div class="installment-section" id="installmentSection">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Number of Installments *</label>
                                <input type="number" class="form-control" id="installmentCount" placeholder="e.g., 24" min="1">
                            </div>
                            <div class="form-group">
                                <label>Installment Frequency *</label>
                                <select class="form-control" id="installmentFrequency">
                                    <option value="monthly">Monthly</option>
                                    <option value="quarterly">Quarterly</option>
                                    <option value="semi-annual">Semi-Annual</option>
                                    <option value="annual">Annual</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="milestone-section" id="milestoneSection" style="display: none;">
                        <div class="milestones-container">
                            <div class="milestone-item">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Milestone 1</label>
                                        <input type="text" class="form-control" placeholder="e.g., Foundation Complete">
                                    </div>
                                    <div class="form-group">
                                        <label>Payment (%)</label>
                                        <input type="number" class="form-control" placeholder="e.g., 20" min="0" max="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline btn-small" onclick="addMilestone()">
                            <i class="fas fa-plus"></i> Add Milestone
                        </button>
                    </div>
                </div>
                
                <div class="form-section">
                    <h4>Additional Settings</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Late Payment Fee (%)</label>
                            <input type="number" class="form-control" id="lateFee" placeholder="e.g., 2" min="0" step="0.1">
                        </div>
                        <div class="form-group">
                            <label>Grace Period (days)</label>
                            <input type="number" class="form-control" id="gracePeriod" placeholder="e.g., 7" min="0">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="allowEarlyPayment"> Allow early payment with discount
                        </label>
                    </div>
                    
                    <div class="form-group" id="earlyPaymentSection" style="display: none;">
                        <label>Early Payment Discount (%)</label>
                        <input type="number" class="form-control" id="earlyPaymentDiscount" placeholder="e.g., 1" min="0" step="0.1">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeNewPlanModal()">Cancel</button>
            <button class="btn btn-secondary" onclick="savePlanAsDraft()">Save as Draft</button>
            <button class="btn btn-primary" onclick="createPlan()">Create & Activate</button>
        </div>
    </div>
</div>

<style>
.plans-dashboard {
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

.plans-container {
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

.plans-content {
    padding: 1.5rem;
}

.plans-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 1.5rem;
}

.plan-card {
    border: 1px solid #eee;
    border-radius: 8px;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    overflow: hidden;
}

.plan-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.plan-card.active {
    border-left: 4px solid #28a745;
}

.plan-card.draft {
    border-left: 4px solid #ffc107;
}

.plan-card.archived {
    border-left: 4px solid #6c757d;
    opacity: 0.8;
}

.plan-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 1.5rem;
    border-bottom: 1px solid #eee;
    background: #f8f9fa;
}

.plan-title h3 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
    font-size: 1.2rem;
}

.plan-type {
    padding: 0.25rem 0.75rem;
    background: #e9ecef;
    border-radius: 12px;
    font-size: 0.8rem;
    color: #495057;
    font-weight: 500;
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

.status-badge.draft {
    background: #fff3cd;
    color: #856404;
}

.status-badge.archived {
    background: #e2e3e5;
    color: #383d41;
}

.plan-details {
    padding: 1.5rem;
}

.plan-summary {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem;
    background: #f8f9fa;
    border-radius: 4px;
}

.summary-item .label {
    font-size: 0.9rem;
    color: #666;
}

.summary-item .value {
    font-weight: 600;
    color: var(--secondary-color);
}

.plan-description {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.plan-description p {
    margin: 0;
    color: #666;
    line-height: 1.5;
}

.plan-stats {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: #666;
}

.stat-item i {
    color: var(--primary-color);
    width: 16px;
}

.plan-actions {
    padding: 1rem 1.5rem;
    border-top: 1px solid #eee;
    background: #f8f9fa;
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
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

.milestone-item {
    margin-bottom: 1rem;
    padding: 1rem;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: #f8f9fa;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    margin: 0;
}

.modal-content.large {
    max-width: 800px;
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
    
    .plans-grid {
        grid-template-columns: 1fr;
    }
    
    .plan-summary {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .plan-actions {
        justify-content: center;
    }
}
</style>

<script>
function openNewPlanModal() {
    document.getElementById('newPlanModal').style.display = 'flex';
}

function closeNewPlanModal() {
    document.getElementById('newPlanModal').style.display = 'none';
    resetPlanForm();
}

function resetPlanForm() {
    document.getElementById('planName').value = '';
    document.getElementById('planType').value = '';
    document.getElementById('planDescription').value = '';
    document.getElementById('downPayment').value = '';
    document.getElementById('interestRate').value = '';
    document.getElementById('installmentCount').value = '';
    document.getElementById('installmentFrequency').value = 'monthly';
    document.getElementById('lateFee').value = '';
    document.getElementById('gracePeriod').value = '';
    document.getElementById('allowEarlyPayment').checked = false;
    document.getElementById('earlyPaymentDiscount').value = '';
    
    // Hide conditional sections
    document.getElementById('earlyPaymentSection').style.display = 'none';
    document.getElementById('installmentSection').style.display = 'block';
    document.getElementById('milestoneSection').style.display = 'none';
}

// Plan type change handler
document.addEventListener('DOMContentLoaded', function() {
    const planTypeSelect = document.getElementById('planType');
    const installmentSection = document.getElementById('installmentSection');
    const milestoneSection = document.getElementById('milestoneSection');
    
    planTypeSelect.addEventListener('change', function() {
        if (this.value === 'milestone') {
            installmentSection.style.display = 'none';
            milestoneSection.style.display = 'block';
        } else {
            installmentSection.style.display = 'block';
            milestoneSection.style.display = 'none';
        }
    });
    
    // Early payment checkbox handler
    const earlyPaymentCheckbox = document.getElementById('allowEarlyPayment');
    const earlyPaymentSection = document.getElementById('earlyPaymentSection');
    
    earlyPaymentCheckbox.addEventListener('change', function() {
        earlyPaymentSection.style.display = this.checked ? 'block' : 'none';
    });
});

function addMilestone() {
    const container = document.querySelector('.milestones-container');
    const milestoneCount = container.children.length + 1;
    
    const milestoneItem = document.createElement('div');
    milestoneItem.className = 'milestone-item';
    milestoneItem.innerHTML = `
        <div class="form-row">
            <div class="form-group">
                <label>Milestone ${milestoneCount}</label>
                <input type="text" class="form-control" placeholder="e.g., Structure Complete">
            </div>
            <div class="form-group">
                <label>Payment (%)</label>
                <input type="number" class="form-control" placeholder="e.g., 25" min="0" max="100">
            </div>
        </div>
        <button type="button" class="btn btn-outline btn-small" onclick="removeMilestone(this)">
            <i class="fas fa-trash"></i> Remove
        </button>
    `;
    
    container.appendChild(milestoneItem);
}

function removeMilestone(button) {
    button.parentElement.remove();
}

function createPlan() {
    const planName = document.getElementById('planName').value;
    const planType = document.getElementById('planType').value;
    const downPayment = document.getElementById('downPayment').value;
    const interestRate = document.getElementById('interestRate').value;
    
    if (!planName || !planType || !downPayment || !interestRate) {
        alert('Please fill in all required fields');
        return;
    }
    
    console.log('Creating payment plan:', {
        name: planName,
        type: planType,
        downPayment: downPayment,
        interestRate: interestRate,
        status: 'active'
    });
    
    closeNewPlanModal();
}

function savePlanAsDraft() {
    const planName = document.getElementById('planName').value;
    const planType = document.getElementById('planType').value;
    
    if (!planName || !planType) {
        alert('Please provide at least plan name and type');
        return;
    }
    
    console.log('Saving plan as draft:', {
        name: planName,
        type: planType,
        status: 'draft'
    });
    
    closeNewPlanModal();
}

function viewPlanDetails(planId) {
    console.log('Viewing plan details:', planId);
}

function editPlan(planId) {
    console.log('Editing plan:', planId);
}

function duplicatePlan(planId) {
    if (confirm('Are you sure you want to duplicate this payment plan?')) {
        console.log('Duplicating plan:', planId);
    }
}

function activatePlan(planId) {
    if (confirm('Are you sure you want to activate this payment plan?')) {
        console.log('Activating plan:', planId);
    }
}

function restorePlan(planId) {
    if (confirm('Are you sure you want to restore this payment plan?')) {
        console.log('Restoring plan:', planId);
    }
}

function importPlans() {
    console.log('Opening import dialog');
}

function exportPlansReport() {
    console.log('Exporting plans report');
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('typeFilter').value = '';
    document.getElementById('sortBy').value = 'name-asc';
    console.log('Filters reset');
}
</script>

<?php include '../includes/footer.php'; ?>