<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

$pageTitle = "Block/Unblock Units - Property Management System";
$currentPage = "blocks-unblocks";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-ban"></i> Block/Unblock Units</h1>
            <p>Manage unit availability and blocking status</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openBulkActionModal()">
                <i class="fas fa-tasks"></i> Bulk Actions
            </button>
            <button class="btn btn-secondary" onclick="exportBlockingReport()">
                <i class="fas fa-download"></i> Export Report
            </button>
        </div>
    </div>

    <div class="blocking-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-cube"></i>
                </div>
                <div class="stat-content">
                    <h3>156</h3>
                    <p>Total Units</p>
                </div>
            </div>
            <div class="stat-card available">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>98</h3>
                    <p>Available Units</p>
                </div>
            </div>
            <div class="stat-card blocked">
                <div class="stat-icon">
                    <i class="fas fa-ban"></i>
                </div>
                <div class="stat-content">
                    <h3>24</h3>
                    <p>Blocked Units</p>
                </div>
            </div>
            <div class="stat-card sold">
                <div class="stat-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="stat-content">
                    <h3>34</h3>
                    <p>Sold Units</p>
                </div>
            </div>
        </div>
    </div>

    <div class="blocking-container">
        <div class="filters-section">
            <div class="search-filters">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search units..." id="searchInput">
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
                    <select class="form-control" id="blockFilter">
                        <option value="">All Blocks</option>
                        <option value="block-a">Block A</option>
                        <option value="block-b">Block B</option>
                        <option value="sector-1">Sector 1</option>
                        <option value="tower-a">Tower A</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="available">Available</option>
                        <option value="blocked">Blocked</option>
                        <option value="sold">Sold</option>
                        <option value="reserved">Reserved</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="typeFilter">
                        <option value="">All Types</option>
                        <option value="1bhk">1 BHK</option>
                        <option value="2bhk">2 BHK</option>
                        <option value="3bhk">3 BHK</option>
                        <option value="4bhk">4 BHK</option>
                        <option value="studio">Studio</option>
                    </select>
                </div>
                <button class="btn btn-outline" onclick="resetFilters()">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </div>

        <div class="units-content">
            <div class="view-controls">
                <div class="view-toggle">
                    <button class="view-btn active" onclick="switchView('grid')">
                        <i class="fas fa-th"></i> Grid View
                    </button>
                    <button class="view-btn" onclick="switchView('list')">
                        <i class="fas fa-list"></i> List View
                    </button>
                </div>
                <div class="bulk-select">
                    <label class="checkbox-label">
                        <input type="checkbox" id="selectAll" onchange="toggleSelectAll()"> Select All
                    </label>
                    <button class="btn btn-outline btn-small" onclick="blockSelected()" id="blockBtn" disabled>
                        <i class="fas fa-ban"></i> Block Selected
                    </button>
                    <button class="btn btn-success btn-small" onclick="unblockSelected()" id="unblockBtn" disabled>
                        <i class="fas fa-check"></i> Unblock Selected
                    </button>
                </div>
            </div>

            <div class="units-grid" id="unitsGrid">
                <div class="unit-card available" data-unit="A-101">
                    <div class="unit-header">
                        <div class="unit-select">
                            <input type="checkbox" class="unit-checkbox" value="A-101" onchange="updateBulkActions()">
                        </div>
                        <div class="unit-info">
                            <h4>A-101</h4>
                            <span class="unit-type">2 BHK</span>
                        </div>
                        <div class="unit-status">
                            <span class="status available">Available</span>
                        </div>
                    </div>
                    
                    <div class="unit-details">
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Project</label>
                                <span>Sunset Heights</span>
                            </div>
                            <div class="detail-item">
                                <label>Block</label>
                                <span>Block A</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Floor</label>
                                <span>1st Floor</span>
                            </div>
                            <div class="detail-item">
                                <label>Area</label>
                                <span>1,200 sq ft</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Price</label>
                                <span>₹45,00,000</span>
                            </div>
                            <div class="detail-item">
                                <label>Last Updated</label>
                                <span>2 days ago</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="unit-actions">
                        <button class="btn btn-danger btn-small" onclick="blockUnit('A-101')">
                            <i class="fas fa-ban"></i> Block
                        </button>
                        <button class="btn btn-outline btn-small" onclick="viewUnitDetails('A-101')">
                            <i class="fas fa-eye"></i> Details
                        </button>
                        <button class="btn btn-outline btn-small" onclick="editUnit('A-101')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </div>
                </div>

                <div class="unit-card blocked" data-unit="A-102">
                    <div class="unit-header">
                        <div class="unit-select">
                            <input type="checkbox" class="unit-checkbox" value="A-102" onchange="updateBulkActions()">
                        </div>
                        <div class="unit-info">
                            <h4>A-102</h4>
                            <span class="unit-type">2 BHK</span>
                        </div>
                        <div class="unit-status">
                            <span class="status blocked">Blocked</span>
                        </div>
                    </div>
                    
                    <div class="unit-details">
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Project</label>
                                <span>Sunset Heights</span>
                            </div>
                            <div class="detail-item">
                                <label>Block</label>
                                <span>Block A</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Floor</label>
                                <span>1st Floor</span>
                            </div>
                            <div class="detail-item">
                                <label>Area</label>
                                <span>1,200 sq ft</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Blocked By</label>
                                <span>Admin User</span>
                            </div>
                            <div class="detail-item">
                                <label>Blocked Date</label>
                                <span>Jan 15, 2024</span>
                            </div>
                        </div>
                        <div class="blocking-reason">
                            <label>Reason:</label>
                            <span>Maintenance work in progress</span>
                        </div>
                    </div>
                    
                    <div class="unit-actions">
                        <button class="btn btn-success btn-small" onclick="unblockUnit('A-102')">
                            <i class="fas fa-check"></i> Unblock
                        </button>
                        <button class="btn btn-outline btn-small" onclick="viewUnitDetails('A-102')">
                            <i class="fas fa-eye"></i> Details
                        </button>
                        <button class="btn btn-outline btn-small" onclick="editBlockReason('A-102')">
                            <i class="fas fa-edit"></i> Edit Reason
                        </button>
                    </div>
                </div>

                <div class="unit-card sold" data-unit="A-103">
                    <div class="unit-header">
                        <div class="unit-select">
                            <input type="checkbox" class="unit-checkbox" value="A-103" disabled>
                        </div>
                        <div class="unit-info">
                            <h4>A-103</h4>
                            <span class="unit-type">3 BHK</span>
                        </div>
                        <div class="unit-status">
                            <span class="status sold">Sold</span>
                        </div>
                    </div>
                    
                    <div class="unit-details">
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Project</label>
                                <span>Sunset Heights</span>
                            </div>
                            <div class="detail-item">
                                <label>Block</label>
                                <span>Block A</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Floor</label>
                                <span>1st Floor</span>
                            </div>
                            <div class="detail-item">
                                <label>Area</label>
                                <span>1,450 sq ft</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Customer</label>
                                <span>John Smith</span>
                            </div>
                            <div class="detail-item">
                                <label>Sale Date</label>
                                <span>Dec 20, 2023</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="unit-actions">
                        <button class="btn btn-outline btn-small" onclick="viewUnitDetails('A-103')">
                            <i class="fas fa-eye"></i> Details
                        </button>
                        <button class="btn btn-outline btn-small" onclick="viewSaleDetails('A-103')">
                            <i class="fas fa-handshake"></i> Sale Info
                        </button>
                    </div>
                </div>

                <div class="unit-card available" data-unit="B-201">
                    <div class="unit-header">
                        <div class="unit-select">
                            <input type="checkbox" class="unit-checkbox" value="B-201" onchange="updateBulkActions()">
                        </div>
                        <div class="unit-info">
                            <h4>B-201</h4>
                            <span class="unit-type">1 BHK</span>
                        </div>
                        <div class="unit-status">
                            <span class="status available">Available</span>
                        </div>
                    </div>
                    
                    <div class="unit-details">
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Project</label>
                                <span>Green Valley</span>
                            </div>
                            <div class="detail-item">
                                <label>Block</label>
                                <span>Block B</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Floor</label>
                                <span>2nd Floor</span>
                            </div>
                            <div class="detail-item">
                                <label>Area</label>
                                <span>850 sq ft</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Price</label>
                                <span>₹28,50,000</span>
                            </div>
                            <div class="detail-item">
                                <label>Last Updated</label>
                                <span>1 week ago</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="unit-actions">
                        <button class="btn btn-danger btn-small" onclick="blockUnit('B-201')">
                            <i class="fas fa-ban"></i> Block
                        </button>
                        <button class="btn btn-outline btn-small" onclick="viewUnitDetails('B-201')">
                            <i class="fas fa-eye"></i> Details
                        </button>
                        <button class="btn btn-outline btn-small" onclick="editUnit('B-201')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </div>
                </div>

                <div class="unit-card blocked" data-unit="B-202">
                    <div class="unit-header">
                        <div class="unit-select">
                            <input type="checkbox" class="unit-checkbox" value="B-202" onchange="updateBulkActions()">
                        </div>
                        <div class="unit-info">
                            <h4>B-202</h4>
                            <span class="unit-type">1 BHK</span>
                        </div>
                        <div class="unit-status">
                            <span class="status blocked">Blocked</span>
                        </div>
                    </div>
                    
                    <div class="unit-details">
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Project</label>
                                <span>Green Valley</span>
                            </div>
                            <div class="detail-item">
                                <label>Block</label>
                                <span>Block B</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Floor</label>
                                <span>2nd Floor</span>
                            </div>
                            <div class="detail-item">
                                <label>Area</label>
                                <span>850 sq ft</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Blocked By</label>
                                <span>Sales Manager</span>
                            </div>
                            <div class="detail-item">
                                <label>Blocked Date</label>
                                <span>Jan 10, 2024</span>
                            </div>
                        </div>
                        <div class="blocking-reason">
                            <label>Reason:</label>
                            <span>Reserved for VIP customer</span>
                        </div>
                    </div>
                    
                    <div class="unit-actions">
                        <button class="btn btn-success btn-small" onclick="unblockUnit('B-202')">
                            <i class="fas fa-check"></i> Unblock
                        </button>
                        <button class="btn btn-outline btn-small" onclick="viewUnitDetails('B-202')">
                            <i class="fas fa-eye"></i> Details
                        </button>
                        <button class="btn btn-outline btn-small" onclick="editBlockReason('B-202')">
                            <i class="fas fa-edit"></i> Edit Reason
                        </button>
                    </div>
                </div>

                <div class="unit-card reserved" data-unit="C-301">
                    <div class="unit-header">
                        <div class="unit-select">
                            <input type="checkbox" class="unit-checkbox" value="C-301" disabled>
                        </div>
                        <div class="unit-info">
                            <h4>C-301</h4>
                            <span class="unit-type">4 BHK</span>
                        </div>
                        <div class="unit-status">
                            <span class="status reserved">Reserved</span>
                        </div>
                    </div>
                    
                    <div class="unit-details">
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Project</label>
                                <span>Royal Gardens</span>
                            </div>
                            <div class="detail-item">
                                <label>Block</label>
                                <span>Block C</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Floor</label>
                                <span>3rd Floor</span>
                            </div>
                            <div class="detail-item">
                                <label>Area</label>
                                <span>2,100 sq ft</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Reserved For</label>
                                <span>Sarah Johnson</span>
                            </div>
                            <div class="detail-item">
                                <label>Reserved Date</label>
                                <span>Jan 18, 2024</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="unit-actions">
                        <button class="btn btn-outline btn-small" onclick="viewUnitDetails('C-301')">
                            <i class="fas fa-eye"></i> Details
                        </button>
                        <button class="btn btn-outline btn-small" onclick="viewReservationDetails('C-301')">
                            <i class="fas fa-calendar"></i> Reservation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Block Unit Modal -->
<div class="modal" id="blockModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Block Unit</h3>
            <button class="modal-close" onclick="closeBlockModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="block-form">
                <div class="form-group">
                    <label>Unit Number</label>
                    <input type="text" class="form-control" id="blockUnitNumber" readonly>
                </div>
                <div class="form-group">
                    <label>Blocking Reason *</label>
                    <select class="form-control" id="blockReason" required>
                        <option value="">Select reason</option>
                        <option value="maintenance">Maintenance Work</option>
                        <option value="renovation">Renovation</option>
                        <option value="inspection">Inspection</option>
                        <option value="legal-issues">Legal Issues</option>
                        <option value="vip-reservation">VIP Reservation</option>
                        <option value="pricing-review">Pricing Review</option>
                        <option value="documentation">Documentation Issues</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group" id="customReasonGroup" style="display: none;">
                    <label>Custom Reason *</label>
                    <input type="text" class="form-control" id="customReason" placeholder="Enter custom reason">
                </div>
                <div class="form-group">
                    <label>Additional Notes</label>
                    <textarea class="form-control" id="blockNotes" rows="3" placeholder="Enter any additional notes"></textarea>
                </div>
                <div class="form-group">
                    <label>Expected Unblock Date</label>
                    <input type="date" class="form-control" id="expectedUnblockDate">
                </div>
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="notifyTeam"> Notify sales team
                    </label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeBlockModal()">Cancel</button>
            <button class="btn btn-danger" onclick="confirmBlockUnit()">Block Unit</button>
        </div>
    </div>
</div>

<!-- Bulk Action Modal -->
<div class="modal" id="bulkActionModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Bulk Actions</h3>
            <button class="modal-close" onclick="closeBulkActionModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="bulk-action-form">
                <div class="form-group">
                    <label>Action Type *</label>
                    <select class="form-control" id="bulkActionType" required>
                        <option value="">Select action</option>
                        <option value="block">Block Units</option>
                        <option value="unblock">Unblock Units</option>
                        <option value="update-price">Update Pricing</option>
                        <option value="change-status">Change Status</option>
                    </select>
                </div>
                <div class="form-group" id="bulkBlockReasonGroup" style="display: none;">
                    <label>Blocking Reason *</label>
                    <select class="form-control" id="bulkBlockReason">
                        <option value="">Select reason</option>
                        <option value="maintenance">Maintenance Work</option>
                        <option value="renovation">Renovation</option>
                        <option value="inspection">Inspection</option>
                        <option value="legal-issues">Legal Issues</option>
                        <option value="pricing-review">Pricing Review</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Additional Notes</label>
                    <textarea class="form-control" id="bulkNotes" rows="3" placeholder="Enter notes for this bulk action"></textarea>
                </div>
                <div class="selected-units">
                    <h4>Selected Units (<span id="selectedCount">0</span>)</h4>
                    <div class="units-list" id="selectedUnitsList">
                        <!-- Selected units will be populated here -->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeBulkActionModal()">Cancel</button>
            <button class="btn btn-primary" onclick="executeBulkAction()">Execute Action</button>
        </div>
    </div>
</div>

<style>
.blocking-dashboard {
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

.stat-card.available .stat-icon {
    background: #28a745;
}

.stat-card.blocked .stat-icon {
    background: #dc3545;
}

.stat-card.sold .stat-icon {
    background: var(--primary-color);
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

.blocking-container {
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

.units-content {
    padding: 1.5rem;
}

.view-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.view-toggle {
    display: flex;
    gap: 0.5rem;
}

.view-btn {
    padding: 0.5rem 1rem;
    border: 1px solid #ddd;
    background: white;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.view-btn.active {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.bulk-select {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.units-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
}

.unit-card {
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 1.5rem;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.unit-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.unit-card.available {
    border-left: 4px solid #28a745;
}

.unit-card.blocked {
    border-left: 4px solid #dc3545;
    background: #fff5f5;
}

.unit-card.sold {
    border-left: 4px solid var(--primary-color);
    background: #f8f9fa;
}

.unit-card.reserved {
    border-left: 4px solid #ffc107;
    background: #fffbf0;
}

.unit-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.unit-select {
    margin-right: 1rem;
}

.unit-info {
    flex: 1;
}

.unit-info h4 {
    margin: 0 0 0.25rem 0;
    color: var(--secondary-color);
    font-size: 1.2rem;
}

.unit-type {
    color: #666;
    font-size: 0.9rem;
}

.unit-status .status {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status.available {
    background: #d4edda;
    color: #155724;
}

.status.blocked {
    background: #f8d7da;
    color: #721c24;
}

.status.sold {
    background: #e2e3e5;
    color: #383d41;
}

.status.reserved {
    background: #fff3cd;
    color: #856404;
}

.unit-details {
    margin-bottom: 1.5rem;
}

.detail-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.detail-item {
    text-align: left;
}

.detail-item label {
    display: block;
    font-size: 0.8rem;
    color: #666;
    margin-bottom: 0.25rem;
}

.detail-item span {
    font-weight: 600;
    color: var(--secondary-color);
    font-size: 0.9rem;
}

.blocking-reason {
    margin-top: 1rem;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 6px;
    border-left: 3px solid #dc3545;
}

.blocking-reason label {
    font-size: 0.8rem;
    color: #666;
    margin-bottom: 0.25rem;
    display: block;
}

.blocking-reason span {
    font-weight: 500;
    color: var(--secondary-color);
}

.unit-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-small {
    padding: 0.375rem 0.75rem;
    font-size: 0.8rem;
    border-radius: 4px;
}

.block-form, .bulk-action-form {
    max-height: 60vh;
    overflow-y: auto;
}

.selected-units {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eee;
}

.units-list {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #eee;
    border-radius: 6px;
    padding: 1rem;
    background: #f8f9fa;
}

.unit-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem;
    margin-bottom: 0.5rem;
    background: white;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
}

#customReasonGroup {
    display: none;
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
    
    .view-controls {
        flex-direction: column;
        align-items: stretch;
    }
    
    .bulk-select {
        justify-content: center;
    }
    
    .units-grid {
        grid-template-columns: 1fr;
    }
    
    .detail-row {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .unit-actions {
        justify-content: center;
    }
}
</style>

<script>
let selectedUnits = [];

function switchView(viewType) {
    const buttons = document.querySelectorAll('.view-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    const grid = document.getElementById('unitsGrid');
    if (viewType === 'list') {
        grid.classList.add('list-view');
    } else {
        grid.classList.remove('list-view');
    }
}

function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.unit-checkbox:not(:disabled)');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateBulkActions();
}

function updateBulkActions() {
    const checkboxes = document.querySelectorAll('.unit-checkbox:checked');
    const blockBtn = document.getElementById('blockBtn');
    const unblockBtn = document.getElementById('unblockBtn');
    
    selectedUnits = Array.from(checkboxes).map(cb => cb.value);
    
    if (selectedUnits.length > 0) {
        blockBtn.disabled = false;
        unblockBtn.disabled = false;
    } else {
        blockBtn.disabled = true;
        unblockBtn.disabled = true;
    }
}

function blockUnit(unitNumber) {
    document.getElementById('blockUnitNumber').value = unitNumber;
    document.getElementById('blockModal').style.display = 'flex';
}

function unblockUnit(unitNumber) {
    if (confirm(`Are you sure you want to unblock unit ${unitNumber}?`)) {
        console.log('Unblocking unit:', unitNumber);
        // Update UI to reflect unblocked status
    }
}

function closeBlockModal() {
    document.getElementById('blockModal').style.display = 'none';
    document.getElementById('blockReason').value = '';
    document.getElementById('customReason').value = '';
    document.getElementById('blockNotes').value = '';
    document.getElementById('customReasonGroup').style.display = 'none';
}

function confirmBlockUnit() {
    const unitNumber = document.getElementById('blockUnitNumber').value;
    const reason = document.getElementById('blockReason').value;
    const customReason = document.getElementById('customReason').value;
    const notes = document.getElementById('blockNotes').value;
    
    if (!reason) {
        alert('Please select a blocking reason');
        return;
    }
    
    if (reason === 'other' && !customReason) {
        alert('Please enter a custom reason');
        return;
    }
    
    console.log('Blocking unit:', {
        unitNumber, reason, customReason, notes
    });
    
    closeBlockModal();
}

function blockSelected() {
    if (selectedUnits.length === 0) return;
    
    document.getElementById('bulkActionType').value = 'block';
    document.getElementById('selectedCount').textContent = selectedUnits.length;
    updateSelectedUnitsList();
    document.getElementById('bulkActionModal').style.display = 'flex';
}

function unblockSelected() {
    if (selectedUnits.length === 0) return;
    
    if (confirm(`Are you sure you want to unblock ${selectedUnits.length} selected units?`)) {
        console.log('Unblocking units:', selectedUnits);
        selectedUnits = [];
        updateBulkActions();
    }
}

function openBulkActionModal() {
    document.getElementById('bulkActionModal').style.display = 'flex';
}

function closeBulkActionModal() {
    document.getElementById('bulkActionModal').style.display = 'none';
}

function updateSelectedUnitsList() {
    const container = document.getElementById('selectedUnitsList');
    container.innerHTML = '';
    
    selectedUnits.forEach(unit => {
        const item = document.createElement('div');
        item.className = 'unit-item';
        item.innerHTML = `
            <span>${unit}</span>
            <button class="btn btn-outline btn-small" onclick="removeFromSelection('${unit}')">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(item);
    });
}

function removeFromSelection(unitNumber) {
    selectedUnits = selectedUnits.filter(unit => unit !== unitNumber);
    document.querySelector(`input[value="${unitNumber}"]`).checked = false;
    document.getElementById('selectedCount').textContent = selectedUnits.length;
    updateSelectedUnitsList();
    updateBulkActions();
}

function executeBulkAction() {
    const actionType = document.getElementById('bulkActionType').value;
    const notes = document.getElementById('bulkNotes').value;
    
    if (!actionType) {
        alert('Please select an action type');
        return;
    }
    
    console.log('Executing bulk action:', {
        actionType, units: selectedUnits, notes
    });
    
    closeBulkActionModal();
    selectedUnits = [];
    updateBulkActions();
}

function viewUnitDetails(unitNumber) {
    console.log('Viewing details for unit:', unitNumber);
}

function editUnit(unitNumber) {
    console.log('Editing unit:', unitNumber);
}

function editBlockReason(unitNumber) {
    console.log('Editing block reason for unit:', unitNumber);
}

function viewSaleDetails(unitNumber) {
    console.log('Viewing sale details for unit:', unitNumber);
}

function viewReservationDetails(unitNumber) {
    console.log('Viewing reservation details for unit:', unitNumber);
}

function exportBlockingReport() {
    console.log('Exporting blocking report');
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('projectFilter').value = '';
    document.getElementById('blockFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('typeFilter').value = '';
    console.log('Filters reset');
}

// Handle custom reason visibility
document.getElementById('blockReason').addEventListener('change', function() {
    const customGroup = document.getElementById('customReasonGroup');
    if (this.value === 'other') {
        customGroup.style.display = 'block';
    } else {
        customGroup.style.display = 'none';
    }
});

// Handle bulk action type changes
document.getElementById('bulkActionType').addEventListener('change', function() {
    const blockReasonGroup = document.getElementById('bulkBlockReasonGroup');
    if (this.value === 'block') {
        blockReasonGroup.style.display = 'block';
    } else {
        blockReasonGroup.style.display = 'none';
    }
});
</script>

<?php include '../includes/footer.php'; ?>