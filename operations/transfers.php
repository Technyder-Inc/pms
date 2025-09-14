<?php
$pageTitle = "Property Transfers - Property Management System";
$currentPage = "transfers";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-exchange-alt"></i> Property Transfers</h1>
            <p>Manage property ownership transfers and documentation</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openTransferModal()">
                <i class="fas fa-plus"></i> New Transfer
            </button>
            <button class="btn btn-secondary" onclick="exportTransfers()">
                <i class="fas fa-download"></i> Export
            </button>
        </div>
    </div>

    <div class="transfers-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div class="stat-content">
                    <h3>24</h3>
                    <p>Total Transfers</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>6</h3>
                    <p>Pending Approval</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>18</h3>
                    <p>Completed</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="stat-content">
                    <h3>5</h3>
                    <p>This Month</p>
                </div>
            </div>
        </div>
    </div>

    <div class="transfers-container">
        <div class="filters-section">
            <div class="search-filters">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search transfers..." id="searchInput">
                </div>
                <div class="filter-group">
                    <select class="form-control" id="projectFilter">
                        <option value="">All Projects</option>
                        <option value="sunset-heights">Sunset Heights</option>
                        <option value="green-valley">Green Valley</option>
                        <option value="royal-gardens">Royal Gardens</option>
                        <option value="ocean-view">Ocean View</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="typeFilter">
                        <option value="">All Types</option>
                        <option value="sale">Sale</option>
                        <option value="inheritance">Inheritance</option>
                        <option value="gift">Gift</option>
                        <option value="court-order">Court Order</option>
                    </select>
                </div>
                <button class="btn btn-outline" onclick="resetFilters()">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </div>

        <div class="transfers-content">
            <div class="transfers-grid">
                <div class="transfer-card pending">
                    <div class="transfer-header">
                        <div class="transfer-id">
                            <span class="id-label">Transfer ID</span>
                            <span class="id-value">TRF-2023-001</span>
                        </div>
                        <div class="transfer-status">
                            <span class="status pending">Pending Approval</span>
                        </div>
                    </div>
                    
                    <div class="property-info">
                        <h3>Unit A-101 - Sunset Heights</h3>
                        <p class="property-details">2 BHK • 1,200 sq ft • Block A</p>
                    </div>
                    
                    <div class="transfer-parties">
                        <div class="party from">
                            <label>From</label>
                            <div class="party-details">
                                <strong>John Smith</strong>
                                <span>john.smith@email.com</span>
                                <span>+91 98765 43210</span>
                            </div>
                        </div>
                        <div class="transfer-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="party to">
                            <label>To</label>
                            <div class="party-details">
                                <strong>Sarah Johnson</strong>
                                <span>sarah.johnson@email.com</span>
                                <span>+91 87654 32109</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="transfer-details">
                        <div class="detail-item">
                            <label>Transfer Type</label>
                            <span>Sale</span>
                        </div>
                        <div class="detail-item">
                            <label>Transfer Value</label>
                            <span>₹45,00,000</span>
                        </div>
                        <div class="detail-item">
                            <label>Transfer Date</label>
                            <span>Dec 15, 2023</span>
                        </div>
                        <div class="detail-item">
                            <label>Legal Status</label>
                            <span class="legal-status pending">Documentation Pending</span>
                        </div>
                    </div>
                    
                    <div class="transfer-actions">
                        <button class="btn btn-primary btn-small" onclick="viewTransfer('TRF-2023-001')">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-success btn-small" onclick="approveTransfer('TRF-2023-001')">
                            <i class="fas fa-check"></i> Approve
                        </button>
                        <button class="btn btn-outline btn-small" onclick="editTransfer('TRF-2023-001')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </div>
                </div>

                <div class="transfer-card in-progress">
                    <div class="transfer-header">
                        <div class="transfer-id">
                            <span class="id-label">Transfer ID</span>
                            <span class="id-value">TRF-2023-002</span>
                        </div>
                        <div class="transfer-status">
                            <span class="status in-progress">In Progress</span>
                        </div>
                    </div>
                    
                    <div class="property-info">
                        <h3>Unit B-205 - Green Valley</h3>
                        <p class="property-details">3 BHK • 1,500 sq ft • Block B</p>
                    </div>
                    
                    <div class="transfer-parties">
                        <div class="party from">
                            <label>From</label>
                            <div class="party-details">
                                <strong>Mike Wilson</strong>
                                <span>mike.wilson@email.com</span>
                                <span>+91 76543 21098</span>
                            </div>
                        </div>
                        <div class="transfer-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="party to">
                            <label>To</label>
                            <div class="party-details">
                                <strong>David Brown</strong>
                                <span>david.brown@email.com</span>
                                <span>+91 65432 10987</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="transfer-details">
                        <div class="detail-item">
                            <label>Transfer Type</label>
                            <span>Sale</span>
                        </div>
                        <div class="detail-item">
                            <label>Transfer Value</label>
                            <span>₹52,00,000</span>
                        </div>
                        <div class="detail-item">
                            <label>Transfer Date</label>
                            <span>Dec 20, 2023</span>
                        </div>
                        <div class="detail-item">
                            <label>Legal Status</label>
                            <span class="legal-status in-progress">Under Review</span>
                        </div>
                    </div>
                    
                    <div class="transfer-actions">
                        <button class="btn btn-primary btn-small" onclick="viewTransfer('TRF-2023-002')">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-outline btn-small" onclick="editTransfer('TRF-2023-002')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-outline btn-small" onclick="downloadDocuments('TRF-2023-002')">
                            <i class="fas fa-download"></i> Documents
                        </button>
                    </div>
                </div>

                <div class="transfer-card completed">
                    <div class="transfer-header">
                        <div class="transfer-id">
                            <span class="id-label">Transfer ID</span>
                            <span class="id-value">TRF-2023-003</span>
                        </div>
                        <div class="transfer-status">
                            <span class="status completed">Completed</span>
                        </div>
                    </div>
                    
                    <div class="property-info">
                        <h3>Unit C-301 - Royal Gardens</h3>
                        <p class="property-details">4 BHK • 1,800 sq ft • Block C</p>
                    </div>
                    
                    <div class="transfer-parties">
                        <div class="party from">
                            <label>From</label>
                            <div class="party-details">
                                <strong>Lisa Davis</strong>
                                <span>lisa.davis@email.com</span>
                                <span>+91 54321 09876</span>
                            </div>
                        </div>
                        <div class="transfer-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="party to">
                            <label>To</label>
                            <div class="party-details">
                                <strong>Robert Taylor</strong>
                                <span>robert.taylor@email.com</span>
                                <span>+91 43210 98765</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="transfer-details">
                        <div class="detail-item">
                            <label>Transfer Type</label>
                            <span>Inheritance</span>
                        </div>
                        <div class="detail-item">
                            <label>Transfer Value</label>
                            <span>₹48,50,000</span>
                        </div>
                        <div class="detail-item">
                            <label>Transfer Date</label>
                            <span>Dec 10, 2023</span>
                        </div>
                        <div class="detail-item">
                            <label>Legal Status</label>
                            <span class="legal-status completed">Verified & Registered</span>
                        </div>
                    </div>
                    
                    <div class="transfer-actions">
                        <button class="btn btn-primary btn-small" onclick="viewTransfer('TRF-2023-003')">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-outline btn-small" onclick="downloadDocuments('TRF-2023-003')">
                            <i class="fas fa-download"></i> Documents
                        </button>
                        <button class="btn btn-outline btn-small" onclick="printCertificate('TRF-2023-003')">
                            <i class="fas fa-print"></i> Certificate
                        </button>
                    </div>
                </div>

                <div class="transfer-card pending">
                    <div class="transfer-header">
                        <div class="transfer-id">
                            <span class="id-label">Transfer ID</span>
                            <span class="id-value">TRF-2023-004</span>
                        </div>
                        <div class="transfer-status">
                            <span class="status pending">Pending Documentation</span>
                        </div>
                    </div>
                    
                    <div class="property-info">
                        <h3>Unit D-401 - Ocean View</h3>
                        <p class="property-details">3 BHK • 1,400 sq ft • Block D</p>
                    </div>
                    
                    <div class="transfer-parties">
                        <div class="party from">
                            <label>From</label>
                            <div class="party-details">
                                <strong>James Anderson</strong>
                                <span>james.anderson@email.com</span>
                                <span>+91 32109 87654</span>
                            </div>
                        </div>
                        <div class="transfer-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="party to">
                            <label>To</label>
                            <div class="party-details">
                                <strong>Emma Wilson</strong>
                                <span>emma.wilson@email.com</span>
                                <span>+91 21098 76543</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="transfer-details">
                        <div class="detail-item">
                            <label>Transfer Type</label>
                            <span>Gift</span>
                        </div>
                        <div class="detail-item">
                            <label>Transfer Value</label>
                            <span>₹50,00,000</span>
                        </div>
                        <div class="detail-item">
                            <label>Transfer Date</label>
                            <span>Dec 22, 2023</span>
                        </div>
                        <div class="detail-item">
                            <label>Legal Status</label>
                            <span class="legal-status pending">Documents Required</span>
                        </div>
                    </div>
                    
                    <div class="transfer-actions">
                        <button class="btn btn-primary btn-small" onclick="viewTransfer('TRF-2023-004')">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-outline btn-small" onclick="editTransfer('TRF-2023-004')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-warning btn-small" onclick="requestDocuments('TRF-2023-004')">
                            <i class="fas fa-file-upload"></i> Request Docs
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transfer Modal -->
<div class="modal" id="transferModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>New Property Transfer</h3>
            <button class="modal-close" onclick="closeTransferModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="transfer-form">
                <div class="form-section">
                    <h4>Property Selection</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Project *</label>
                            <select class="form-control" id="transferProject" required>
                                <option value="">Select Project</option>
                                <option value="sunset-heights">Sunset Heights</option>
                                <option value="green-valley">Green Valley</option>
                                <option value="royal-gardens">Royal Gardens</option>
                                <option value="ocean-view">Ocean View</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Unit *</label>
                            <select class="form-control" id="transferUnit" required>
                                <option value="">Select Unit</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4>Current Owner Information</h4>
                    <div class="current-owner-info" id="currentOwnerInfo">
                        <p class="info-note">Select a unit to view current owner information</p>
                    </div>
                </div>

                <div class="form-section">
                    <h4>New Owner Information</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name *</label>
                            <input type="text" class="form-control" id="newOwnerName" placeholder="Enter full name" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address *</label>
                            <input type="email" class="form-control" id="newOwnerEmail" placeholder="Enter email address" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number *</label>
                            <input type="tel" class="form-control" id="newOwnerPhone" placeholder="Enter phone number" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label>Address</label>
                            <textarea class="form-control" id="newOwnerAddress" rows="3" placeholder="Enter complete address"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4>Transfer Details</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Transfer Type *</label>
                            <select class="form-control" id="transferType" required>
                                <option value="">Select Transfer Type</option>
                                <option value="sale">Sale</option>
                                <option value="inheritance">Inheritance</option>
                                <option value="gift">Gift</option>
                                <option value="court-order">Court Order</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Transfer Value *</label>
                            <input type="number" class="form-control" id="transferValue" placeholder="Enter transfer value" required>
                        </div>
                        <div class="form-group">
                            <label>Transfer Date *</label>
                            <input type="date" class="form-control" id="transferDate" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label>Transfer Reason/Notes</label>
                            <textarea class="form-control" id="transferNotes" rows="3" placeholder="Enter reason for transfer or additional notes"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4>Legal Documentation</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Document Type *</label>
                            <select class="form-control" id="documentType" required>
                                <option value="">Select Document Type</option>
                                <option value="sale-deed">Sale Deed</option>
                                <option value="gift-deed">Gift Deed</option>
                                <option value="will">Will</option>
                                <option value="court-order">Court Order</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Document Number</label>
                            <input type="text" class="form-control" id="documentNumber" placeholder="Enter document number">
                        </div>
                        <div class="form-group">
                            <label>Registration Date</label>
                            <input type="date" class="form-control" id="registrationDate">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label>Upload Documents</label>
                            <div class="file-upload-area">
                                <input type="file" id="transferDocuments" multiple accept=".pdf,.jpg,.jpeg,.png">
                                <div class="upload-text">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Click to upload or drag and drop</p>
                                    <span>PDF, JPG, PNG files up to 10MB each</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4>Verification & Approval</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="documentsVerified"> All documents are verified and authentic
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="legalCompliance"> Transfer complies with all legal requirements
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="ownerConsent"> Current owner consent obtained
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeTransferModal()">Cancel</button>
            <button class="btn btn-secondary" onclick="saveDraft()">Save as Draft</button>
            <button class="btn btn-primary" onclick="submitTransfer()">Submit Transfer</button>
        </div>
    </div>
</div>

<style>
.transfers-dashboard {
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

.stat-icon.pending {
    background: #ffc107;
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

.transfers-container {
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

.transfers-content {
    padding: 1.5rem;
}

.transfers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 1.5rem;
}

.transfer-card {
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 1.5rem;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.transfer-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.transfer-card.pending {
    border-left: 4px solid #ffc107;
}

.transfer-card.in-progress {
    border-left: 4px solid #17a2b8;
}

.transfer-card.completed {
    border-left: 4px solid #28a745;
}

.transfer-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.transfer-id .id-label {
    display: block;
    font-size: 0.8rem;
    color: #666;
    margin-bottom: 0.25rem;
}

.transfer-id .id-value {
    font-weight: 600;
    color: var(--secondary-color);
    font-size: 1rem;
}

.transfer-status .status {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status.pending {
    background: #fff3cd;
    color: #856404;
}

.status.in-progress {
    background: #d1ecf1;
    color: #0c5460;
}

.status.completed {
    background: #d4edda;
    color: #155724;
}

.property-info {
    margin-bottom: 1.5rem;
}

.property-info h3 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
    font-size: 1.1rem;
}

.property-details {
    color: #666;
    font-size: 0.9rem;
    margin: 0;
}

.transfer-parties {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 6px;
}

.party {
    flex: 1;
}

.party label {
    display: block;
    font-size: 0.8rem;
    color: #666;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.party-details strong {
    display: block;
    color: var(--secondary-color);
    margin-bottom: 0.25rem;
}

.party-details span {
    display: block;
    color: #666;
    font-size: 0.85rem;
}

.transfer-arrow {
    color: var(--primary-color);
    font-size: 1.2rem;
}

.transfer-details {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.detail-item label {
    font-size: 0.8rem;
    color: #666;
    font-weight: 600;
}

.detail-item span {
    color: var(--secondary-color);
    font-weight: 500;
}

.legal-status {
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.legal-status.pending {
    background: #fff3cd;
    color: #856404;
}

.legal-status.in-progress {
    background: #d1ecf1;
    color: #0c5460;
}

.legal-status.completed {
    background: #d4edda;
    color: #155724;
}

.transfer-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-small {
    padding: 0.375rem 0.75rem;
    font-size: 0.8rem;
    border-radius: 4px;
}

.transfer-form {
    max-height: 70vh;
    overflow-y: auto;
    padding-right: 1rem;
}

.form-section {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #eee;
}

.form-section:last-child {
    border-bottom: none;
}

.form-section h4 {
    margin: 0 0 1rem 0;
    color: var(--secondary-color);
    font-size: 1.1rem;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.current-owner-info {
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 6px;
    border: 1px solid #eee;
}

.info-note {
    color: #666;
    font-style: italic;
    margin: 0;
}

.file-upload-area {
    border: 2px dashed #ddd;
    border-radius: 6px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.file-upload-area:hover {
    border-color: var(--primary-color);
    background: #f8f9fa;
}

.upload-text i {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.upload-text p {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
    font-weight: 500;
}

.upload-text span {
    color: #666;
    font-size: 0.9rem;
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
    
    .search-filters {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-bar {
        min-width: auto;
    }
    
    .transfers-grid {
        grid-template-columns: 1fr;
    }
    
    .transfer-parties {
        flex-direction: column;
        gap: 1rem;
    }
    
    .transfer-arrow {
        transform: rotate(90deg);
    }
    
    .transfer-details {
        grid-template-columns: 1fr;
    }
    
    .transfer-actions {
        justify-content: center;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function openTransferModal() {
    document.getElementById('transferModal').style.display = 'flex';
}

function closeTransferModal() {
    document.getElementById('transferModal').style.display = 'none';
}

function submitTransfer() {
    const project = document.getElementById('transferProject').value;
    const unit = document.getElementById('transferUnit').value;
    const newOwnerName = document.getElementById('newOwnerName').value;
    const newOwnerEmail = document.getElementById('newOwnerEmail').value;
    const newOwnerPhone = document.getElementById('newOwnerPhone').value;
    const transferType = document.getElementById('transferType').value;
    const transferValue = document.getElementById('transferValue').value;
    const transferDate = document.getElementById('transferDate').value;
    
    if (!project || !unit || !newOwnerName || !newOwnerEmail || !newOwnerPhone || !transferType || !transferValue || !transferDate) {
        alert('Please fill all required fields');
        return;
    }
    
    console.log('Submitting transfer:', {
        project, unit, newOwnerName, newOwnerEmail, newOwnerPhone,
        transferType, transferValue, transferDate
    });
    
    closeTransferModal();
}

function saveDraft() {
    console.log('Saving transfer as draft');
    closeTransferModal();
}

function viewTransfer(transferId) {
    console.log('Viewing transfer:', transferId);
}

function editTransfer(transferId) {
    console.log('Editing transfer:', transferId);
}

function approveTransfer(transferId) {
    if (confirm('Approve this transfer?')) {
        console.log('Approving transfer:', transferId);
    }
}

function downloadDocuments(transferId) {
    console.log('Downloading documents for:', transferId);
}

function printCertificate(transferId) {
    console.log('Printing certificate for:', transferId);
}

function requestDocuments(transferId) {
    console.log('Requesting documents for:', transferId);
}

function exportTransfers() {
    console.log('Exporting transfers');
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('projectFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('typeFilter').value = '';
    console.log('Filters reset');
}

// Project and unit dependency
document.addEventListener('DOMContentLoaded', function() {
    const projectSelect = document.getElementById('transferProject');
    const unitSelect = document.getElementById('transferUnit');
    const currentOwnerInfo = document.getElementById('currentOwnerInfo');
    
    if (projectSelect && unitSelect) {
        projectSelect.addEventListener('change', function() {
            const project = this.value;
            unitSelect.innerHTML = '<option value="">Select Unit</option>';
            currentOwnerInfo.innerHTML = '<p class="info-note">Select a unit to view current owner information</p>';
            
            if (project) {
                // Simulate loading units based on project
                const units = {
                    'sunset-heights': ['A-101', 'A-102', 'B-201', 'B-202'],
                    'green-valley': ['B-205', 'C-301', 'C-302', 'D-401'],
                    'royal-gardens': ['C-301', 'D-401', 'E-501', 'F-601'],
                    'ocean-view': ['G-701', 'H-801', 'I-901', 'J-1001']
                };
                
                if (units[project]) {
                    units[project].forEach(unit => {
                        const option = document.createElement('option');
                        option.value = unit.toLowerCase();
                        option.textContent = unit;
                        unitSelect.appendChild(option);
                    });
                }
            }
        });
        
        unitSelect.addEventListener('change', function() {
            const unit = this.value;
            
            if (unit) {
                // Simulate loading current owner info
                const ownerInfo = {
                    'a-101': { name: 'John Smith', email: 'john.smith@email.com', phone: '+91 98765 43210' },
                    'b-205': { name: 'Mike Wilson', email: 'mike.wilson@email.com', phone: '+91 76543 21098' },
                    'c-301': { name: 'Lisa Davis', email: 'lisa.davis@email.com', phone: '+91 54321 09876' },
                    'd-401': { name: 'James Anderson', email: 'james.anderson@email.com', phone: '+91 32109 87654' }
                };
                
                if (ownerInfo[unit]) {
                    const owner = ownerInfo[unit];
                    currentOwnerInfo.innerHTML = `
                        <div class="owner-details">
                            <h5>Current Owner</h5>
                            <p><strong>Name:</strong> ${owner.name}</p>
                            <p><strong>Email:</strong> ${owner.email}</p>
                            <p><strong>Phone:</strong> ${owner.phone}</p>
                        </div>
                    `;
                } else {
                    currentOwnerInfo.innerHTML = '<p class="info-note">No current owner information available</p>';
                }
            } else {
                currentOwnerInfo.innerHTML = '<p class="info-note">Select a unit to view current owner information</p>';
            }
        });
    }
});
</script>

<?php include '../includes/footer.php'; ?>