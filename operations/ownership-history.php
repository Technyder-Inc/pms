<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

$pageTitle = "Ownership History - Property Management System";
$currentPage = "ownership-history";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-history"></i> Ownership History</h1>
            <p>Track property ownership changes and transfers</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openTransferModal()">
                <i class="fas fa-exchange-alt"></i> Record Transfer
            </button>
            <button class="btn btn-secondary" onclick="exportHistory()">
                <i class="fas fa-download"></i> Export History
            </button>
        </div>
    </div>

    <div class="ownership-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div class="stat-content">
                    <h3>156</h3>
                    <p>Total Transfers</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon pending">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>8</h3>
                    <p>Pending Transfers</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="stat-content">
                    <h3>12</h3>
                    <p>This Month</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="stat-content">
                    <h3>89</h3>
                    <p>Active Properties</p>
                </div>
            </div>
        </div>
    </div>

    <div class="ownership-container">
        <div class="filters-section">
            <div class="search-filters">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search by property, owner, or transfer ID..." id="searchInput">
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
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="dateFilter">
                        <option value="">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="quarter">This Quarter</option>
                        <option value="year">This Year</option>
                    </select>
                </div>
                <button class="btn btn-outline" onclick="resetFilters()">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </div>

        <div class="ownership-content">
            <div class="content-header">
                <div class="view-options">
                    <button class="view-btn active" onclick="switchView('timeline')">
                        <i class="fas fa-timeline"></i> Timeline View
                    </button>
                    <button class="view-btn" onclick="switchView('table')">
                        <i class="fas fa-table"></i> Table View
                    </button>
                    <button class="view-btn" onclick="switchView('property')">
                        <i class="fas fa-building"></i> By Property
                    </button>
                </div>
                <div class="sort-options">
                    <select class="form-control" id="sortBy">
                        <option value="date-desc">Latest First</option>
                        <option value="date-asc">Oldest First</option>
                        <option value="property">By Property</option>
                        <option value="owner">By Owner</option>
                        <option value="status">By Status</option>
                    </select>
                </div>
            </div>

            <!-- Timeline View -->
            <div class="timeline-view" id="timelineView">
                <div class="timeline">
                    <div class="timeline-item completed">
                        <div class="timeline-marker">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <h4>Unit A-101 - Sunset Heights</h4>
                                <div class="timeline-meta">
                                    <span class="status completed">Completed</span>
                                    <span class="date">Dec 15, 2023</span>
                                </div>
                            </div>
                            <div class="transfer-details">
                                <div class="transfer-parties">
                                    <div class="party from">
                                        <label>From:</label>
                                        <div class="party-info">
                                            <strong>John Smith</strong>
                                            <span>john.smith@email.com</span>
                                        </div>
                                    </div>
                                    <div class="transfer-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <div class="party to">
                                        <label>To:</label>
                                        <div class="party-info">
                                            <strong>Sarah Johnson</strong>
                                            <span>sarah.johnson@email.com</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="transfer-info">
                                    <div class="info-item">
                                        <label>Transfer ID:</label>
                                        <span>TRF-2023-001</span>
                                    </div>
                                    <div class="info-item">
                                        <label>Transfer Value:</label>
                                        <span>₹45,00,000</span>
                                    </div>
                                    <div class="info-item">
                                        <label>Transfer Type:</label>
                                        <span>Sale</span>
                                    </div>
                                    <div class="info-item">
                                        <label>Legal Status:</label>
                                        <span class="status-badge verified">Verified</span>
                                    </div>
                                </div>
                                <div class="transfer-actions">
                                    <button class="btn-small btn-primary" onclick="viewTransferDetails('TRF-2023-001')">
                                        View Details
                                    </button>
                                    <button class="btn-small btn-outline" onclick="downloadDocuments('TRF-2023-001')">
                                        Documents
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item pending">
                        <div class="timeline-marker">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <h4>Unit B-205 - Green Valley</h4>
                                <div class="timeline-meta">
                                    <span class="status pending">Pending</span>
                                    <span class="date">Dec 20, 2023</span>
                                </div>
                            </div>
                            <div class="transfer-details">
                                <div class="transfer-parties">
                                    <div class="party from">
                                        <label>From:</label>
                                        <div class="party-info">
                                            <strong>Mike Wilson</strong>
                                            <span>mike.wilson@email.com</span>
                                        </div>
                                    </div>
                                    <div class="transfer-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <div class="party to">
                                        <label>To:</label>
                                        <div class="party-info">
                                            <strong>David Brown</strong>
                                            <span>david.brown@email.com</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="transfer-info">
                                    <div class="info-item">
                                        <label>Transfer ID:</label>
                                        <span>TRF-2023-002</span>
                                    </div>
                                    <div class="info-item">
                                        <label>Transfer Value:</label>
                                        <span>₹52,00,000</span>
                                    </div>
                                    <div class="info-item">
                                        <label>Transfer Type:</label>
                                        <span>Sale</span>
                                    </div>
                                    <div class="info-item">
                                        <label>Legal Status:</label>
                                        <span class="status-badge pending">Pending Verification</span>
                                    </div>
                                </div>
                                <div class="transfer-actions">
                                    <button class="btn-small btn-primary" onclick="viewTransferDetails('TRF-2023-002')">
                                        View Details
                                    </button>
                                    <button class="btn-small btn-success" onclick="approveTransfer('TRF-2023-002')">
                                        Approve
                                    </button>
                                    <button class="btn-small btn-outline" onclick="downloadDocuments('TRF-2023-002')">
                                        Documents
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item in-progress">
                        <div class="timeline-marker">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <h4>Unit C-301 - Royal Gardens</h4>
                                <div class="timeline-meta">
                                    <span class="status in-progress">In Progress</span>
                                    <span class="date">Dec 18, 2023</span>
                                </div>
                            </div>
                            <div class="transfer-details">
                                <div class="transfer-parties">
                                    <div class="party from">
                                        <label>From:</label>
                                        <div class="party-info">
                                            <strong>Lisa Davis</strong>
                                            <span>lisa.davis@email.com</span>
                                        </div>
                                    </div>
                                    <div class="transfer-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <div class="party to">
                                        <label>To:</label>
                                        <div class="party-info">
                                            <strong>Robert Taylor</strong>
                                            <span>robert.taylor@email.com</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="transfer-info">
                                    <div class="info-item">
                                        <label>Transfer ID:</label>
                                        <span>TRF-2023-003</span>
                                    </div>
                                    <div class="info-item">
                                        <label>Transfer Value:</label>
                                        <span>₹48,50,000</span>
                                    </div>
                                    <div class="info-item">
                                        <label>Transfer Type:</label>
                                        <span>Inheritance</span>
                                    </div>
                                    <div class="info-item">
                                        <label>Legal Status:</label>
                                        <span class="status-badge in-progress">Documentation Review</span>
                                    </div>
                                </div>
                                <div class="transfer-actions">
                                    <button class="btn-small btn-primary" onclick="viewTransferDetails('TRF-2023-003')">
                                        View Details
                                    </button>
                                    <button class="btn-small btn-outline" onclick="downloadDocuments('TRF-2023-003')">
                                        Documents
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table View -->
            <div class="table-view" id="tableView" style="display: none;">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Transfer ID</th>
                                <th>Property</th>
                                <th>From Owner</th>
                                <th>To Owner</th>
                                <th>Transfer Type</th>
                                <th>Value</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>TRF-2023-001</td>
                                <td>Unit A-101, Sunset Heights</td>
                                <td>John Smith</td>
                                <td>Sarah Johnson</td>
                                <td>Sale</td>
                                <td>₹45,00,000</td>
                                <td>Dec 15, 2023</td>
                                <td><span class="status-badge completed">Completed</span></td>
                                <td>
                                    <button class="btn-icon" onclick="viewTransferDetails('TRF-2023-001')" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn-icon" onclick="downloadDocuments('TRF-2023-001')" title="Documents">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>TRF-2023-002</td>
                                <td>Unit B-205, Green Valley</td>
                                <td>Mike Wilson</td>
                                <td>David Brown</td>
                                <td>Sale</td>
                                <td>₹52,00,000</td>
                                <td>Dec 20, 2023</td>
                                <td><span class="status-badge pending">Pending</span></td>
                                <td>
                                    <button class="btn-icon" onclick="viewTransferDetails('TRF-2023-002')" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn-icon" onclick="approveTransfer('TRF-2023-002')" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn-icon" onclick="downloadDocuments('TRF-2023-002')" title="Documents">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>TRF-2023-003</td>
                                <td>Unit C-301, Royal Gardens</td>
                                <td>Lisa Davis</td>
                                <td>Robert Taylor</td>
                                <td>Inheritance</td>
                                <td>₹48,50,000</td>
                                <td>Dec 18, 2023</td>
                                <td><span class="status-badge in-progress">In Progress</span></td>
                                <td>
                                    <button class="btn-icon" onclick="viewTransferDetails('TRF-2023-003')" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn-icon" onclick="downloadDocuments('TRF-2023-003')" title="Documents">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Property View -->
            <div class="property-view" id="propertyView" style="display: none;">
                <div class="property-cards">
                    <div class="property-card">
                        <div class="property-header">
                            <h3>Unit A-101 - Sunset Heights</h3>
                            <span class="current-owner">Current Owner: Sarah Johnson</span>
                        </div>
                        <div class="ownership-timeline">
                            <div class="ownership-entry">
                                <div class="entry-date">Dec 15, 2023</div>
                                <div class="entry-details">
                                    <strong>Sarah Johnson</strong> (Current Owner)
                                    <span>Purchased from John Smith - ₹45,00,000</span>
                                </div>
                            </div>
                            <div class="ownership-entry">
                                <div class="entry-date">Mar 10, 2021</div>
                                <div class="entry-details">
                                    <strong>John Smith</strong>
                                    <span>Original Purchase - ₹38,00,000</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="property-card">
                        <div class="property-header">
                            <h3>Unit B-205 - Green Valley</h3>
                            <span class="current-owner">Current Owner: Mike Wilson (Transfer Pending)</span>
                        </div>
                        <div class="ownership-timeline">
                            <div class="ownership-entry pending">
                                <div class="entry-date">Dec 20, 2023</div>
                                <div class="entry-details">
                                    <strong>David Brown</strong> (Pending Transfer)
                                    <span>Purchase from Mike Wilson - ₹52,00,000</span>
                                </div>
                            </div>
                            <div class="ownership-entry">
                                <div class="entry-date">Aug 15, 2020</div>
                                <div class="entry-details">
                                    <strong>Mike Wilson</strong> (Current Owner)
                                    <span>Original Purchase - ₹42,00,000</span>
                                </div>
                            </div>
                        </div>
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
            <h3>Record Property Transfer</h3>
            <button class="modal-close" onclick="closeTransferModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="transfer-form">
                <div class="form-section">
                    <h4>Property Information</h4>
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
                    <h4>Transfer Details</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Transfer Type *</label>
                            <select class="form-control" id="transferType" required>
                                <option value="">Select Type</option>
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
                </div>

                <div class="form-section">
                    <h4>Current Owner</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Current Owner *</label>
                            <input type="text" class="form-control" id="currentOwner" placeholder="Current owner name" readonly>
                        </div>
                        <div class="form-group">
                            <label>Owner Contact</label>
                            <input type="text" class="form-control" id="currentOwnerContact" placeholder="Contact information" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4>New Owner</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>New Owner Name *</label>
                            <input type="text" class="form-control" id="newOwnerName" placeholder="Enter new owner name" required>
                        </div>
                        <div class="form-group">
                            <label>New Owner Email *</label>
                            <input type="email" class="form-control" id="newOwnerEmail" placeholder="Enter email address" required>
                        </div>
                        <div class="form-group">
                            <label>New Owner Phone *</label>
                            <input type="tel" class="form-control" id="newOwnerPhone" placeholder="Enter phone number" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label>New Owner Address</label>
                            <textarea class="form-control" id="newOwnerAddress" rows="3" placeholder="Enter complete address"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4>Legal Documentation</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Legal Document Type *</label>
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
                    <h4>Additional Information</h4>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label>Transfer Notes</label>
                            <textarea class="form-control" id="transferNotes" rows="3" placeholder="Enter any additional notes or comments"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="verifyDocuments"> Documents verified and authentic
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="legalCompliance"> Transfer complies with legal requirements
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeTransferModal()">Cancel</button>
            <button class="btn btn-secondary" onclick="saveDraft()">Save as Draft</button>
            <button class="btn btn-primary" onclick="recordTransfer()">Record Transfer</button>
        </div>
    </div>
</div>

<style>
.ownership-dashboard {
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

.ownership-container {
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

.ownership-content {
    padding: 1.5rem;
}

.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    gap: 1rem;
}

.view-options {
    display: flex;
    gap: 0.5rem;
}

.view-btn {
    padding: 0.5rem 1rem;
    border: 1px solid #ddd;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

.view-btn:hover {
    background: #f8f9fa;
}

.view-btn.active {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.timeline {
    position: relative;
    padding-left: 2rem;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 1rem;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #ddd;
}

.timeline-item {
    position: relative;
    margin-bottom: 2rem;
    padding-left: 2rem;
}

.timeline-marker {
    position: absolute;
    left: -2rem;
    top: 0;
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    background: var(--primary-color);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.timeline-item.pending .timeline-marker {
    background: #ffc107;
}

.timeline-item.in-progress .timeline-marker {
    background: #17a2b8;
}

.timeline-item.completed .timeline-marker {
    background: #28a745;
}

.timeline-content {
    background: white;
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.timeline-header h4 {
    margin: 0;
    color: var(--secondary-color);
    font-size: 1.1rem;
}

.timeline-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.status {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status.completed {
    background: #d4edda;
    color: #155724;
}

.status.pending {
    background: #fff3cd;
    color: #856404;
}

.status.in-progress {
    background: #d1ecf1;
    color: #0c5460;
}

.date {
    color: #666;
    font-size: 0.9rem;
}

.transfer-details {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.transfer-parties {
    display: flex;
    align-items: center;
    gap: 2rem;
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
    margin-bottom: 0.25rem;
    font-weight: 600;
}

.party-info strong {
    display: block;
    color: var(--secondary-color);
    margin-bottom: 0.25rem;
}

.party-info span {
    color: #666;
    font-size: 0.9rem;
}

.transfer-arrow {
    color: var(--primary-color);
    font-size: 1.5rem;
}

.transfer-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.info-item label {
    font-size: 0.8rem;
    color: #666;
    font-weight: 600;
}

.info-item span {
    color: var(--secondary-color);
    font-weight: 500;
}

.status-badge {
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge.verified {
    background: #d4edda;
    color: #155724;
}

.status-badge.pending {
    background: #fff3cd;
    color: #856404;
}

.status-badge.in-progress {
    background: #d1ecf1;
    color: #0c5460;
}

.status-badge.completed {
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

.table-container {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
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
}

.data-table tr:hover {
    background: #f8f9fa;
}

.property-cards {
    display: grid;
    gap: 1.5rem;
}

.property-card {
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 1.5rem;
    background: white;
}

.property-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.property-header h3 {
    margin: 0;
    color: var(--secondary-color);
}

.current-owner {
    color: #666;
    font-size: 0.9rem;
}

.ownership-timeline {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.ownership-entry {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    border-left: 3px solid var(--primary-color);
    background: #f8f9fa;
    border-radius: 0 6px 6px 0;
}

.ownership-entry.pending {
    border-left-color: #ffc107;
    background: #fff9e6;
}

.entry-date {
    min-width: 120px;
    font-weight: 600;
    color: var(--secondary-color);
}

.entry-details strong {
    display: block;
    margin-bottom: 0.25rem;
    color: var(--secondary-color);
}

.entry-details span {
    color: #666;
    font-size: 0.9rem;
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
    
    .content-header {
        flex-direction: column;
        align-items: stretch;
    }
    
    .view-options {
        justify-content: center;
    }
    
    .timeline {
        padding-left: 1rem;
    }
    
    .timeline-item {
        padding-left: 1.5rem;
    }
    
    .timeline-marker {
        left: -1.5rem;
    }
    
    .transfer-parties {
        flex-direction: column;
        gap: 1rem;
    }
    
    .transfer-arrow {
        transform: rotate(90deg);
    }
    
    .transfer-info {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .table-container {
        font-size: 0.8rem;
    }
    
    .data-table th,
    .data-table td {
        padding: 0.5rem;
    }
}
</style>

<script>
function switchView(viewType) {
    // Hide all views
    document.getElementById('timelineView').style.display = 'none';
    document.getElementById('tableView').style.display = 'none';
    document.getElementById('propertyView').style.display = 'none';
    
    // Remove active class from all buttons
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected view and activate button
    document.getElementById(viewType + 'View').style.display = 'block';
    event.target.classList.add('active');
}

function openTransferModal() {
    document.getElementById('transferModal').style.display = 'flex';
}

function closeTransferModal() {
    document.getElementById('transferModal').style.display = 'none';
}

function recordTransfer() {
    const project = document.getElementById('transferProject').value;
    const unit = document.getElementById('transferUnit').value;
    const transferType = document.getElementById('transferType').value;
    const transferValue = document.getElementById('transferValue').value;
    const transferDate = document.getElementById('transferDate').value;
    const newOwnerName = document.getElementById('newOwnerName').value;
    const newOwnerEmail = document.getElementById('newOwnerEmail').value;
    const newOwnerPhone = document.getElementById('newOwnerPhone').value;
    
    if (!project || !unit || !transferType || !transferValue || !transferDate || !newOwnerName || !newOwnerEmail || !newOwnerPhone) {
        alert('Please fill all required fields');
        return;
    }
    
    console.log('Recording transfer:', {
        project, unit, transferType, transferValue, transferDate,
        newOwnerName, newOwnerEmail, newOwnerPhone
    });
    
    closeTransferModal();
}

function saveDraft() {
    console.log('Saving transfer as draft');
    closeTransferModal();
}

function viewTransferDetails(transferId) {
    console.log('Viewing transfer details:', transferId);
}

function downloadDocuments(transferId) {
    console.log('Downloading documents for:', transferId);
}

function approveTransfer(transferId) {
    if (confirm('Approve this transfer?')) {
        console.log('Approving transfer:', transferId);
    }
}

function exportHistory() {
    console.log('Exporting ownership history');
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('projectFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('dateFilter').value = '';
    console.log('Filters reset');
}

// Project and unit dependency
document.addEventListener('DOMContentLoaded', function() {
    const projectSelect = document.getElementById('transferProject');
    const unitSelect = document.getElementById('transferUnit');
    
    if (projectSelect && unitSelect) {
        projectSelect.addEventListener('change', function() {
            const project = this.value;
            unitSelect.innerHTML = '<option value="">Select Unit</option>';
            
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
    }
});
</script>

<?php include '../includes/footer.php'; ?>