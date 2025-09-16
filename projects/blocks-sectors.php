<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

$pageTitle = "Blocks/Sectors - Property Management System";
$currentPage = "blocks-sectors";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-th-large"></i> Blocks/Sectors</h1>
            <p>Manage project blocks and sectors</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openBlockModal()">
                <i class="fas fa-plus"></i> Add Block/Sector
            </button>
            <button class="btn btn-secondary" onclick="exportBlocks()">
                <i class="fas fa-download"></i> Export
            </button>
        </div>
    </div>

    <div class="blocks-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-th-large"></i>
                </div>
                <div class="stat-content">
                    <h3>12</h3>
                    <p>Total Blocks</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon active">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>8</h3>
                    <p>Active Blocks</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-cube"></i>
                </div>
                <div class="stat-content">
                    <h3>156</h3>
                    <p>Total Units</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <h3>78%</h3>
                    <p>Occupancy Rate</p>
                </div>
            </div>
        </div>
    </div>

    <div class="blocks-container">
        <div class="filters-section">
            <div class="search-filters">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search blocks/sectors..." id="searchInput">
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
                        <option value="active">Active</option>
                        <option value="under-construction">Under Construction</option>
                        <option value="planned">Planned</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="typeFilter">
                        <option value="">All Types</option>
                        <option value="residential">Residential</option>
                        <option value="commercial">Commercial</option>
                        <option value="mixed">Mixed Use</option>
                    </select>
                </div>
                <button class="btn btn-outline" onclick="resetFilters()">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </div>

        <div class="blocks-content">
            <div class="blocks-grid">
                <div class="block-card active">
                    <div class="block-header">
                        <div class="block-info">
                            <h3>Block A</h3>
                            <span class="project-name">Sunset Heights</span>
                        </div>
                        <div class="block-status">
                            <span class="status active">Active</span>
                        </div>
                    </div>
                    
                    <div class="block-details">
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Total Units</label>
                                <span>24</span>
                            </div>
                            <div class="detail-item">
                                <label>Occupied</label>
                                <span>18</span>
                            </div>
                            <div class="detail-item">
                                <label>Available</label>
                                <span>6</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Block Type</label>
                                <span>Residential</span>
                            </div>
                            <div class="detail-item">
                                <label>Floors</label>
                                <span>6</span>
                            </div>
                            <div class="detail-item">
                                <label>Units/Floor</label>
                                <span>4</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="occupancy-bar">
                        <div class="occupancy-label">
                            <span>Occupancy: 75%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 75%"></div>
                        </div>
                    </div>
                    
                    <div class="block-actions">
                        <button class="btn btn-primary btn-small" onclick="viewBlock('block-a')">
                            <i class="fas fa-eye"></i> View Units
                        </button>
                        <button class="btn btn-outline btn-small" onclick="editBlock('block-a')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-outline btn-small" onclick="manageUnits('block-a')">
                            <i class="fas fa-cog"></i> Manage
                        </button>
                    </div>
                </div>

                <div class="block-card under-construction">
                    <div class="block-header">
                        <div class="block-info">
                            <h3>Block B</h3>
                            <span class="project-name">Sunset Heights</span>
                        </div>
                        <div class="block-status">
                            <span class="status under-construction">Under Construction</span>
                        </div>
                    </div>
                    
                    <div class="block-details">
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Total Units</label>
                                <span>20</span>
                            </div>
                            <div class="detail-item">
                                <label>Pre-booked</label>
                                <span>12</span>
                            </div>
                            <div class="detail-item">
                                <label>Available</label>
                                <span>8</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Block Type</label>
                                <span>Residential</span>
                            </div>
                            <div class="detail-item">
                                <label>Floors</label>
                                <span>5</span>
                            </div>
                            <div class="detail-item">
                                <label>Units/Floor</label>
                                <span>4</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="construction-progress">
                        <div class="progress-label">
                            <span>Construction Progress: 65%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill construction" style="width: 65%"></div>
                        </div>
                    </div>
                    
                    <div class="block-actions">
                        <button class="btn btn-primary btn-small" onclick="viewBlock('block-b')">
                            <i class="fas fa-eye"></i> View Units
                        </button>
                        <button class="btn btn-outline btn-small" onclick="editBlock('block-b')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-outline btn-small" onclick="updateProgress('block-b')">
                            <i class="fas fa-chart-line"></i> Progress
                        </button>
                    </div>
                </div>

                <div class="block-card active">
                    <div class="block-header">
                        <div class="block-info">
                            <h3>Sector 1</h3>
                            <span class="project-name">Green Valley</span>
                        </div>
                        <div class="block-status">
                            <span class="status active">Active</span>
                        </div>
                    </div>
                    
                    <div class="block-details">
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Total Units</label>
                                <span>32</span>
                            </div>
                            <div class="detail-item">
                                <label>Occupied</label>
                                <span>28</span>
                            </div>
                            <div class="detail-item">
                                <label>Available</label>
                                <span>4</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Block Type</label>
                                <span>Mixed Use</span>
                            </div>
                            <div class="detail-item">
                                <label>Floors</label>
                                <span>8</span>
                            </div>
                            <div class="detail-item">
                                <label>Units/Floor</label>
                                <span>4</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="occupancy-bar">
                        <div class="occupancy-label">
                            <span>Occupancy: 87.5%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 87.5%"></div>
                        </div>
                    </div>
                    
                    <div class="block-actions">
                        <button class="btn btn-primary btn-small" onclick="viewBlock('sector-1')">
                            <i class="fas fa-eye"></i> View Units
                        </button>
                        <button class="btn btn-outline btn-small" onclick="editBlock('sector-1')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-outline btn-small" onclick="manageUnits('sector-1')">
                            <i class="fas fa-cog"></i> Manage
                        </button>
                    </div>
                </div>

                <div class="block-card planned">
                    <div class="block-header">
                        <div class="block-info">
                            <h3>Block C</h3>
                            <span class="project-name">Royal Gardens</span>
                        </div>
                        <div class="block-status">
                            <span class="status planned">Planned</span>
                        </div>
                    </div>
                    
                    <div class="block-details">
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Planned Units</label>
                                <span>28</span>
                            </div>
                            <div class="detail-item">
                                <label>Pre-launch</label>
                                <span>15</span>
                            </div>
                            <div class="detail-item">
                                <label>Available</label>
                                <span>13</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Block Type</label>
                                <span>Commercial</span>
                            </div>
                            <div class="detail-item">
                                <label>Floors</label>
                                <span>7</span>
                            </div>
                            <div class="detail-item">
                                <label>Units/Floor</label>
                                <span>4</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="planning-status">
                        <div class="status-label">
                            <span>Launch Date: Q2 2024</span>
                        </div>
                        <div class="status-indicator planned">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                    
                    <div class="block-actions">
                        <button class="btn btn-primary btn-small" onclick="viewBlock('block-c')">
                            <i class="fas fa-eye"></i> View Plans
                        </button>
                        <button class="btn btn-outline btn-small" onclick="editBlock('block-c')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-success btn-small" onclick="launchBlock('block-c')">
                            <i class="fas fa-rocket"></i> Launch
                        </button>
                    </div>
                </div>

                <div class="block-card completed">
                    <div class="block-header">
                        <div class="block-info">
                            <h3>Tower A</h3>
                            <span class="project-name">Ocean View</span>
                        </div>
                        <div class="block-status">
                            <span class="status completed">Completed</span>
                        </div>
                    </div>
                    
                    <div class="block-details">
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Total Units</label>
                                <span>40</span>
                            </div>
                            <div class="detail-item">
                                <label>Sold</label>
                                <span>38</span>
                            </div>
                            <div class="detail-item">
                                <label>Available</label>
                                <span>2</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Block Type</label>
                                <span>Residential</span>
                            </div>
                            <div class="detail-item">
                                <label>Floors</label>
                                <span>10</span>
                            </div>
                            <div class="detail-item">
                                <label>Units/Floor</label>
                                <span>4</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="completion-status">
                        <div class="status-label">
                            <span>Completed: Dec 2023</span>
                        </div>
                        <div class="status-indicator completed">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    
                    <div class="block-actions">
                        <button class="btn btn-primary btn-small" onclick="viewBlock('tower-a')">
                            <i class="fas fa-eye"></i> View Units
                        </button>
                        <button class="btn btn-outline btn-small" onclick="generateReport('tower-a')">
                            <i class="fas fa-chart-bar"></i> Report
                        </button>
                        <button class="btn btn-outline btn-small" onclick="manageUnits('tower-a')">
                            <i class="fas fa-cog"></i> Manage
                        </button>
                    </div>
                </div>

                <div class="block-card active">
                    <div class="block-header">
                        <div class="block-info">
                            <h3>Sector 2</h3>
                            <span class="project-name">Green Valley</span>
                        </div>
                        <div class="block-status">
                            <span class="status active">Active</span>
                        </div>
                    </div>
                    
                    <div class="block-details">
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Total Units</label>
                                <span>16</span>
                            </div>
                            <div class="detail-item">
                                <label>Occupied</label>
                                <span>12</span>
                            </div>
                            <div class="detail-item">
                                <label>Available</label>
                                <span>4</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-item">
                                <label>Block Type</label>
                                <span>Residential</span>
                            </div>
                            <div class="detail-item">
                                <label>Floors</label>
                                <span>4</span>
                            </div>
                            <div class="detail-item">
                                <label>Units/Floor</label>
                                <span>4</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="occupancy-bar">
                        <div class="occupancy-label">
                            <span>Occupancy: 75%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 75%"></div>
                        </div>
                    </div>
                    
                    <div class="block-actions">
                        <button class="btn btn-primary btn-small" onclick="viewBlock('sector-2')">
                            <i class="fas fa-eye"></i> View Units
                        </button>
                        <button class="btn btn-outline btn-small" onclick="editBlock('sector-2')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-outline btn-small" onclick="manageUnits('sector-2')">
                            <i class="fas fa-cog"></i> Manage
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Block Modal -->
<div class="modal" id="blockModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>Add New Block/Sector</h3>
            <button class="modal-close" onclick="closeBlockModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="block-form">
                <div class="form-section">
                    <h4>Basic Information</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Block/Sector Name *</label>
                            <input type="text" class="form-control" id="blockName" placeholder="Enter block/sector name" required>
                        </div>
                        <div class="form-group">
                            <label>Project *</label>
                            <select class="form-control" id="blockProject" required>
                                <option value="">Select Project</option>
                                <option value="sunset-heights">Sunset Heights</option>
                                <option value="green-valley">Green Valley</option>
                                <option value="royal-gardens">Royal Gardens</option>
                                <option value="ocean-view">Ocean View</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Block Type *</label>
                            <select class="form-control" id="blockType" required>
                                <option value="">Select Type</option>
                                <option value="residential">Residential</option>
                                <option value="commercial">Commercial</option>
                                <option value="mixed">Mixed Use</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Status *</label>
                            <select class="form-control" id="blockStatus" required>
                                <option value="">Select Status</option>
                                <option value="planned">Planned</option>
                                <option value="under-construction">Under Construction</option>
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Total Floors *</label>
                            <input type="number" class="form-control" id="totalFloors" placeholder="Enter number of floors" required>
                        </div>
                        <div class="form-group">
                            <label>Units per Floor *</label>
                            <input type="number" class="form-control" id="unitsPerFloor" placeholder="Enter units per floor" required>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4>Construction Details</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Construction Start Date</label>
                            <input type="date" class="form-control" id="constructionStart">
                        </div>
                        <div class="form-group">
                            <label>Expected Completion Date</label>
                            <input type="date" class="form-control" id="expectedCompletion">
                        </div>
                        <div class="form-group">
                            <label>Construction Progress (%)</label>
                            <input type="number" class="form-control" id="constructionProgress" min="0" max="100" placeholder="0-100">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4>Unit Configuration</h4>
                    <div class="unit-types-container">
                        <div class="unit-type-row">
                            <div class="form-group">
                                <label>Unit Type</label>
                                <select class="form-control">
                                    <option value="1bhk">1 BHK</option>
                                    <option value="2bhk">2 BHK</option>
                                    <option value="3bhk">3 BHK</option>
                                    <option value="4bhk">4 BHK</option>
                                    <option value="studio">Studio</option>
                                    <option value="commercial">Commercial</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Area (sq ft)</label>
                                <input type="number" class="form-control" placeholder="Enter area">
                            </div>
                            <div class="form-group">
                                <label>Count</label>
                                <input type="number" class="form-control" placeholder="Number of units">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-outline btn-small" onclick="removeUnitType(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline" onclick="addUnitType()">
                        <i class="fas fa-plus"></i> Add Unit Type
                    </button>
                </div>

                <div class="form-section">
                    <h4>Amenities & Features</h4>
                    <div class="amenities-grid">
                        <label class="checkbox-label">
                            <input type="checkbox" value="parking"> Parking
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="elevator"> Elevator
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="security"> 24/7 Security
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="power-backup"> Power Backup
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="water-supply"> Water Supply
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="garden"> Garden/Landscaping
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="gym"> Gymnasium
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="swimming-pool"> Swimming Pool
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="clubhouse"> Clubhouse
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" value="playground"> Children's Playground
                        </label>
                    </div>
                </div>

                <div class="form-section">
                    <h4>Additional Information</h4>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label>Description</label>
                            <textarea class="form-control" id="blockDescription" rows="3" placeholder="Enter block/sector description"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group full-width">
                            <label>Special Notes</label>
                            <textarea class="form-control" id="blockNotes" rows="2" placeholder="Any special notes or instructions"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeBlockModal()">Cancel</button>
            <button class="btn btn-secondary" onclick="saveDraft()">Save as Draft</button>
            <button class="btn btn-primary" onclick="saveBlock()">Save Block/Sector</button>
        </div>
    </div>
</div>

<style>
.blocks-dashboard {
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

.stat-icon.active {
    background: #28a745;
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

.blocks-container {
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

.blocks-content {
    padding: 1.5rem;
}

.blocks-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
}

.block-card {
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 1.5rem;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.block-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.block-card.active {
    border-left: 4px solid #28a745;
}

.block-card.under-construction {
    border-left: 4px solid #ffc107;
}

.block-card.planned {
    border-left: 4px solid #17a2b8;
}

.block-card.completed {
    border-left: 4px solid var(--primary-color);
}

.block-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.block-info h3 {
    margin: 0 0 0.25rem 0;
    color: var(--secondary-color);
    font-size: 1.2rem;
}

.project-name {
    color: #666;
    font-size: 0.9rem;
}

.block-status .status {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status.active {
    background: #d4edda;
    color: #155724;
}

.status.under-construction {
    background: #fff3cd;
    color: #856404;
}

.status.planned {
    background: #d1ecf1;
    color: #0c5460;
}

.status.completed {
    background: #f8d7da;
    color: #721c24;
}

.block-details {
    margin-bottom: 1.5rem;
}

.detail-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-bottom: 1rem;
}

.detail-item {
    text-align: center;
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
    font-size: 1.1rem;
}

.occupancy-bar, .construction-progress {
    margin-bottom: 1.5rem;
}

.occupancy-label, .progress-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #666;
}

.progress-bar {
    height: 8px;
    background: #e9ecef;
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: #28a745;
    transition: width 0.3s ease;
}

.progress-fill.construction {
    background: #ffc107;
}

.planning-status, .completion-status {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 6px;
}

.status-label {
    font-size: 0.9rem;
    color: #666;
}

.status-indicator {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.status-indicator.planned {
    background: #17a2b8;
}

.status-indicator.completed {
    background: var(--primary-color);
}

.block-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-small {
    padding: 0.375rem 0.75rem;
    font-size: 0.8rem;
    border-radius: 4px;
}

.block-form {
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

.unit-types-container {
    margin-bottom: 1rem;
}

.unit-type-row {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr auto;
    gap: 1rem;
    align-items: end;
    margin-bottom: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 6px;
}

.amenities-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 4px;
    transition: background 0.2s ease;
}

.checkbox-label:hover {
    background: #f8f9fa;
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
    
    .blocks-grid {
        grid-template-columns: 1fr;
    }
    
    .detail-row {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .block-actions {
        justify-content: center;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .unit-type-row {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .amenities-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function openBlockModal() {
    document.getElementById('blockModal').style.display = 'flex';
}

function closeBlockModal() {
    document.getElementById('blockModal').style.display = 'none';
}

function saveBlock() {
    const blockName = document.getElementById('blockName').value;
    const project = document.getElementById('blockProject').value;
    const blockType = document.getElementById('blockType').value;
    const status = document.getElementById('blockStatus').value;
    const floors = document.getElementById('totalFloors').value;
    const unitsPerFloor = document.getElementById('unitsPerFloor').value;
    
    if (!blockName || !project || !blockType || !status || !floors || !unitsPerFloor) {
        alert('Please fill all required fields');
        return;
    }
    
    console.log('Saving block:', {
        blockName, project, blockType, status, floors, unitsPerFloor
    });
    
    closeBlockModal();
}

function saveDraft() {
    console.log('Saving block as draft');
    closeBlockModal();
}

function viewBlock(blockId) {
    console.log('Viewing block:', blockId);
}

function editBlock(blockId) {
    console.log('Editing block:', blockId);
}

function manageUnits(blockId) {
    console.log('Managing units for block:', blockId);
}

function updateProgress(blockId) {
    console.log('Updating construction progress for:', blockId);
}

function launchBlock(blockId) {
    if (confirm('Launch this block for sales?')) {
        console.log('Launching block:', blockId);
    }
}

function generateReport(blockId) {
    console.log('Generating report for:', blockId);
}

function exportBlocks() {
    console.log('Exporting blocks data');
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('projectFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('typeFilter').value = '';
    console.log('Filters reset');
}

function addUnitType() {
    const container = document.querySelector('.unit-types-container');
    const newRow = document.createElement('div');
    newRow.className = 'unit-type-row';
    newRow.innerHTML = `
        <div class="form-group">
            <label>Unit Type</label>
            <select class="form-control">
                <option value="1bhk">1 BHK</option>
                <option value="2bhk">2 BHK</option>
                <option value="3bhk">3 BHK</option>
                <option value="4bhk">4 BHK</option>
                <option value="studio">Studio</option>
                <option value="commercial">Commercial</option>
            </select>
        </div>
        <div class="form-group">
            <label>Area (sq ft)</label>
            <input type="number" class="form-control" placeholder="Enter area">
        </div>
        <div class="form-group">
            <label>Count</label>
            <input type="number" class="form-control" placeholder="Number of units">
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-outline btn-small" onclick="removeUnitType(this)">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
    container.appendChild(newRow);
}

function removeUnitType(button) {
    button.closest('.unit-type-row').remove();
}
</script>

<?php include '../includes/footer.php'; ?>