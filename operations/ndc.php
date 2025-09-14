<?php
$pageTitle = "No Dues Certificate - Property Management System";
$currentPage = "ndc";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-certificate"></i> No Dues Certificate</h1>
            <p>Generate and manage No Dues Certificates for customers</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openGenerateModal()">
                <i class="fas fa-plus"></i> Generate NDC
            </button>
            <button class="btn btn-secondary" onclick="openBulkModal()">
                <i class="fas fa-layer-group"></i> Bulk Generate
            </button>
        </div>
    </div>

    <div class="ndc-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="stat-content">
                    <h3>45</h3>
                    <p>NDCs Generated</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>38</h3>
                    <p>Approved</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>7</h3>
                    <p>Pending</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-download"></i>
                </div>
                <div class="stat-content">
                    <h3>42</h3>
                    <p>Downloaded</p>
                </div>
            </div>
        </div>
    </div>

    <div class="filters-section">
        <div class="filters-row">
            <div class="filter-group">
                <label>Customer</label>
                <select class="form-control" id="customerFilter">
                    <option value="">All Customers</option>
                    <option value="john-doe">John Doe</option>
                    <option value="jane-smith">Jane Smith</option>
                    <option value="mike-johnson">Mike Johnson</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Project</label>
                <select class="form-control" id="projectFilter">
                    <option value="">All Projects</option>
                    <option value="sunset-heights">Sunset Heights</option>
                    <option value="green-valley">Green Valley</option>
                    <option value="royal-gardens">Royal Gardens</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Status</label>
                <select class="form-control" id="statusFilter">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Date Range</label>
                <div class="date-range">
                    <input type="date" class="form-control" id="dateFrom">
                    <span>to</span>
                    <input type="date" class="form-control" id="dateTo">
                </div>
            </div>
            <div class="filter-actions">
                <button class="btn btn-outline" onclick="clearFilters()">Clear</button>
                <button class="btn btn-primary" onclick="applyFilters()">Apply</button>
            </div>
        </div>
    </div>

    <div class="ndc-table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                    </th>
                    <th>NDC No.</th>
                    <th>Customer</th>
                    <th>Project</th>
                    <th>Unit</th>
                    <th>Generated Date</th>
                    <th>Status</th>
                    <th>Amount Cleared</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="checkbox" class="row-select" value="NDC001">
                    </td>
                    <td>
                        <span class="ndc-number">#NDC001</span>
                    </td>
                    <td>
                        <div class="customer-info">
                            <strong>John Doe</strong>
                            <small>john.doe@email.com</small>
                        </div>
                    </td>
                    <td>Sunset Heights</td>
                    <td>A-101</td>
                    <td>2024-01-20</td>
                    <td><span class="badge badge-success">Approved</span></td>
                    <td>₹2,50,000</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-icon" onclick="viewNDC('NDC001')" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-icon" onclick="downloadNDC('NDC001')" title="Download">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="btn-icon" onclick="editNDC('NDC001')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-icon danger" onclick="deleteNDC('NDC001')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="row-select" value="NDC002">
                    </td>
                    <td>
                        <span class="ndc-number">#NDC002</span>
                    </td>
                    <td>
                        <div class="customer-info">
                            <strong>Jane Smith</strong>
                            <small>jane.smith@email.com</small>
                        </div>
                    </td>
                    <td>Green Valley</td>
                    <td>B-205</td>
                    <td>2024-01-19</td>
                    <td><span class="badge badge-warning">Pending</span></td>
                    <td>₹1,80,000</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-icon" onclick="viewNDC('NDC002')" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-icon" onclick="approveNDC('NDC002')" title="Approve">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="btn-icon" onclick="editNDC('NDC002')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-icon danger" onclick="rejectNDC('NDC002')" title="Reject">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="row-select" value="NDC003">
                    </td>
                    <td>
                        <span class="ndc-number">#NDC003</span>
                    </td>
                    <td>
                        <div class="customer-info">
                            <strong>Mike Johnson</strong>
                            <small>mike.johnson@email.com</small>
                        </div>
                    </td>
                    <td>Royal Gardens</td>
                    <td>C-301</td>
                    <td>2024-01-18</td>
                    <td><span class="badge badge-success">Approved</span></td>
                    <td>₹3,20,000</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-icon" onclick="viewNDC('NDC003')" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-icon" onclick="downloadNDC('NDC003')" title="Download">
                                <i class="fas fa-download"></i>
                            </button>
                            <button class="btn-icon" onclick="editNDC('NDC003')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-icon danger" onclick="deleteNDC('NDC003')" title="Delete">
                                <i class="fas fa-trash"></i>
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
                <option value="approve">Approve Selected</option>
                <option value="reject">Reject Selected</option>
                <option value="download">Download Selected</option>
                <option value="delete">Delete Selected</option>
            </select>
            <button class="btn btn-outline" onclick="executeBulkAction()">Apply</button>
        </div>
        <div class="pagination">
            <button class="btn btn-outline" onclick="previousPage()">
                <i class="fas fa-chevron-left"></i>
            </button>
            <span class="page-info">Page 1 of 3</span>
            <button class="btn btn-outline" onclick="nextPage()">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>

<!-- Generate NDC Modal -->
<div class="modal" id="generateModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Generate No Dues Certificate</h3>
            <button class="modal-close" onclick="closeGenerateModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Customer *</label>
                <select class="form-control" id="ndcCustomer" required>
                    <option value="">Select Customer</option>
                    <option value="john-doe">John Doe</option>
                    <option value="jane-smith">Jane Smith</option>
                    <option value="mike-johnson">Mike Johnson</option>
                </select>
            </div>
            <div class="form-group">
                <label>Project *</label>
                <select class="form-control" id="ndcProject" required>
                    <option value="">Select Project</option>
                    <option value="sunset-heights">Sunset Heights</option>
                    <option value="green-valley">Green Valley</option>
                    <option value="royal-gardens">Royal Gardens</option>
                </select>
            </div>
            <div class="form-group">
                <label>Unit *</label>
                <select class="form-control" id="ndcUnit" required>
                    <option value="">Select Unit</option>
                    <option value="A-101">A-101</option>
                    <option value="B-205">B-205</option>
                    <option value="C-301">C-301</option>
                </select>
            </div>
            <div class="form-group">
                <label>Total Amount Paid</label>
                <input type="number" class="form-control" id="totalAmount" placeholder="Enter total amount">
            </div>
            <div class="form-group">
                <label>Outstanding Amount</label>
                <input type="number" class="form-control" id="outstandingAmount" placeholder="Enter outstanding amount">
            </div>
            <div class="form-group">
                <label>Clearance Date</label>
                <input type="date" class="form-control" id="clearanceDate">
            </div>
            <div class="form-group">
                <label>Remarks</label>
                <textarea class="form-control" id="ndcRemarks" rows="3" placeholder="Enter any remarks"></textarea>
            </div>
            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="autoApprove"> Auto approve after generation
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeGenerateModal()">Cancel</button>
            <button class="btn btn-primary" onclick="generateNDC()">Generate NDC</button>
        </div>
    </div>
</div>

<!-- Bulk Generate Modal -->
<div class="modal" id="bulkModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Bulk Generate NDCs</h3>
            <button class="modal-close" onclick="closeBulkModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Project *</label>
                <select class="form-control" id="bulkProject" required>
                    <option value="">Select Project</option>
                    <option value="sunset-heights">Sunset Heights</option>
                    <option value="green-valley">Green Valley</option>
                    <option value="royal-gardens">Royal Gardens</option>
                </select>
            </div>
            <div class="form-group">
                <label>Phase</label>
                <select class="form-control" id="bulkPhase">
                    <option value="">All Phases</option>
                    <option value="phase-1">Phase 1</option>
                    <option value="phase-2">Phase 2</option>
                    <option value="phase-3">Phase 3</option>
                </select>
            </div>
            <div class="form-group">
                <label>Block/Sector</label>
                <select class="form-control" id="bulkBlock">
                    <option value="">All Blocks</option>
                    <option value="block-a">Block A</option>
                    <option value="block-b">Block B</option>
                    <option value="block-c">Block C</option>
                </select>
            </div>
            <div class="form-group">
                <label>Payment Status</label>
                <select class="form-control" id="paymentStatus">
                    <option value="fully-paid">Fully Paid</option>
                    <option value="partial-paid">Partial Paid</option>
                    <option value="overdue">Overdue</option>
                </select>
            </div>
            <div class="form-group">
                <label>Clearance Date</label>
                <input type="date" class="form-control" id="bulkClearanceDate">
            </div>
            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="bulkAutoApprove"> Auto approve all generated NDCs
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeBulkModal()">Cancel</button>
            <button class="btn btn-primary" onclick="bulkGenerateNDC()">Generate NDCs</button>
        </div>
    </div>
</div>

<!-- View NDC Modal -->
<div class="modal" id="viewModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>No Dues Certificate - #NDC001</h3>
            <button class="modal-close" onclick="closeViewModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="ndc-preview">
                <div class="ndc-header">
                    <div class="company-logo">
                        <img src="../assets/logo.svg" alt="Company Logo">
                    </div>
                    <div class="company-info">
                        <h2>ABC Properties Ltd.</h2>
                        <p>123 Business Street, City, State - 123456</p>
                        <p>Phone: +91 98765 43210 | Email: info@abcproperties.com</p>
                    </div>
                </div>
                
                <div class="certificate-title">
                    <h1>NO DUES CERTIFICATE</h1>
                    <p>Certificate No: NDC001</p>
                    <p>Date: January 20, 2024</p>
                </div>
                
                <div class="certificate-content">
                    <p>This is to certify that <strong>Mr./Ms. John Doe</strong> has cleared all outstanding dues related to the property:</p>
                    
                    <div class="property-details">
                        <table>
                            <tr>
                                <td><strong>Project:</strong></td>
                                <td>Sunset Heights</td>
                            </tr>
                            <tr>
                                <td><strong>Unit No:</strong></td>
                                <td>A-101</td>
                            </tr>
                            <tr>
                                <td><strong>Total Amount:</strong></td>
                                <td>₹2,50,000</td>
                            </tr>
                            <tr>
                                <td><strong>Amount Paid:</strong></td>
                                <td>₹2,50,000</td>
                            </tr>
                            <tr>
                                <td><strong>Outstanding:</strong></td>
                                <td>₹0</td>
                            </tr>
                            <tr>
                                <td><strong>Clearance Date:</strong></td>
                                <td>January 20, 2024</td>
                            </tr>
                        </table>
                    </div>
                    
                    <p>The customer has no pending dues as of the date mentioned above.</p>
                </div>
                
                <div class="certificate-footer">
                    <div class="signature-section">
                        <div class="signature">
                            <p>_________________________</p>
                            <p><strong>Authorized Signatory</strong></p>
                            <p>ABC Properties Ltd.</p>
                        </div>
                        <div class="seal">
                            <p>[Company Seal]</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeViewModal()">Close</button>
            <button class="btn btn-secondary" onclick="printNDC()">Print</button>
            <button class="btn btn-primary" onclick="downloadNDC('NDC001')">Download PDF</button>
        </div>
    </div>
</div>

<style>
.ndc-dashboard {
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

.filters-section {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.filters-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    align-items: end;
}

.filter-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--secondary-color);
}

.date-range {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.date-range span {
    color: #666;
    font-size: 0.9rem;
}

.filter-actions {
    display: flex;
    gap: 0.5rem;
}

.ndc-table-container {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.ndc-number {
    font-weight: 600;
    color: var(--primary-color);
}

.customer-info strong {
    display: block;
    color: var(--secondary-color);
}

.customer-info small {
    color: #666;
    font-size: 0.85rem;
}

.action-buttons {
    display: flex;
    gap: 0.25rem;
}

.table-footer {
    background: white;
    padding: 1rem 1.5rem;
    border-top: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.bulk-actions {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.pagination {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.page-info {
    color: #666;
    font-size: 0.9rem;
}

.ndc-preview {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
    background: white;
    border: 1px solid #ddd;
}

.ndc-header {
    display: flex;
    align-items: center;
    gap: 2rem;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--primary-color);
}

.company-logo img {
    width: 80px;
    height: 80px;
}

.company-info h2 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
}

.company-info p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

.certificate-title {
    text-align: center;
    margin-bottom: 2rem;
}

.certificate-title h1 {
    margin: 0 0 1rem 0;
    color: var(--secondary-color);
    font-size: 2.5rem;
    font-weight: 700;
}

.certificate-title p {
    margin: 0.25rem 0;
    color: #666;
}

.certificate-content {
    margin-bottom: 3rem;
    line-height: 1.6;
}

.property-details {
    margin: 2rem 0;
}

.property-details table {
    width: 100%;
    border-collapse: collapse;
}

.property-details td {
    padding: 0.5rem 0;
    border-bottom: 1px solid #eee;
}

.property-details td:first-child {
    width: 200px;
}

.certificate-footer {
    margin-top: 3rem;
}

.signature-section {
    display: flex;
    justify-content: space-between;
    align-items: end;
}

.signature {
    text-align: center;
}

.signature p {
    margin: 0.5rem 0;
}

.seal {
    text-align: center;
    border: 2px solid #ddd;
    padding: 2rem;
    border-radius: 50%;
    width: 120px;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content.large {
    max-width: 900px;
    width: 90vw;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .filters-row {
        grid-template-columns: 1fr;
    }
    
    .filter-actions {
        justify-content: stretch;
    }
    
    .filter-actions button {
        flex: 1;
    }
    
    .table-footer {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .bulk-actions {
        justify-content: center;
    }
    
    .ndc-header {
        flex-direction: column;
        text-align: center;
    }
    
    .signature-section {
        flex-direction: column;
        gap: 2rem;
        align-items: center;
    }
    
    .date-range {
        flex-direction: column;
        align-items: stretch;
    }
}
</style>

<script>
function openGenerateModal() {
    document.getElementById('generateModal').style.display = 'flex';
}

function closeGenerateModal() {
    document.getElementById('generateModal').style.display = 'none';
}

function openBulkModal() {
    document.getElementById('bulkModal').style.display = 'flex';
}

function closeBulkModal() {
    document.getElementById('bulkModal').style.display = 'none';
}

function openViewModal() {
    document.getElementById('viewModal').style.display = 'flex';
}

function closeViewModal() {
    document.getElementById('viewModal').style.display = 'none';
}

function generateNDC() {
    const customer = document.getElementById('ndcCustomer').value;
    const project = document.getElementById('ndcProject').value;
    const unit = document.getElementById('ndcUnit').value;
    
    if (!customer || !project || !unit) {
        alert('Please fill all required fields');
        return;
    }
    
    console.log('Generating NDC for:', { customer, project, unit });
    closeGenerateModal();
}

function bulkGenerateNDC() {
    const project = document.getElementById('bulkProject').value;
    
    if (!project) {
        alert('Please select a project');
        return;
    }
    
    console.log('Bulk generating NDCs for project:', project);
    closeBulkModal();
}

function viewNDC(ndcId) {
    console.log('Viewing NDC:', ndcId);
    openViewModal();
}

function downloadNDC(ndcId) {
    console.log('Downloading NDC:', ndcId);
}

function editNDC(ndcId) {
    console.log('Editing NDC:', ndcId);
}

function deleteNDC(ndcId) {
    if (confirm('Are you sure you want to delete this NDC?')) {
        console.log('Deleting NDC:', ndcId);
    }
}

function approveNDC(ndcId) {
    if (confirm('Are you sure you want to approve this NDC?')) {
        console.log('Approving NDC:', ndcId);
    }
}

function rejectNDC(ndcId) {
    if (confirm('Are you sure you want to reject this NDC?')) {
        console.log('Rejecting NDC:', ndcId);
    }
}

function printNDC() {
    window.print();
}

function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.row-select');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}

function executeBulkAction() {
    const action = document.getElementById('bulkAction').value;
    const selected = Array.from(document.querySelectorAll('.row-select:checked')).map(cb => cb.value);
    
    if (!action) {
        alert('Please select an action');
        return;
    }
    
    if (selected.length === 0) {
        alert('Please select at least one NDC');
        return;
    }
    
    console.log('Executing bulk action:', action, 'on:', selected);
}

function clearFilters() {
    document.getElementById('customerFilter').value = '';
    document.getElementById('projectFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('dateFrom').value = '';
    document.getElementById('dateTo').value = '';
}

function applyFilters() {
    const filters = {
        customer: document.getElementById('customerFilter').value,
        project: document.getElementById('projectFilter').value,
        status: document.getElementById('statusFilter').value,
        dateFrom: document.getElementById('dateFrom').value,
        dateTo: document.getElementById('dateTo').value
    };
    
    console.log('Applying filters:', filters);
}

function previousPage() {
    console.log('Previous page');
}

function nextPage() {
    console.log('Next page');
}
</script>

<?php include '../includes/footer.php'; ?>