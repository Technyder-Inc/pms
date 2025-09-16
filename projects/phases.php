<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

$pageTitle = "Phases - Property Management System";
$currentPage = "phases";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-layer-group"></i> Phases</h1>
            <p>Manage project phases and development stages</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openNewPhaseModal()">
                <i class="fas fa-plus"></i> New Phase
            </button>
            <button class="btn btn-outline" onclick="exportPhasesReport()">
                <i class="fas fa-download"></i> Export Report
            </button>
        </div>
    </div>

    <div class="phases-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="stat-content">
                    <h3>12</h3>
                    <p>Total Phases</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>8</h3>
                    <p>Active Phases</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>3</h3>
                    <p>Completed Phases</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>1</h3>
                    <p>Planned Phases</p>
                </div>
            </div>
        </div>
    </div>

    <div class="phases-container">
        <div class="filters-section">
            <div class="search-filters">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search phases..." id="searchInput">
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
                        <option value="planned">Planned</option>
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                        <option value="on-hold">On Hold</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="sortBy">
                        <option value="name-asc">Name A-Z</option>
                        <option value="name-desc">Name Z-A</option>
                        <option value="start-date-asc">Start Date</option>
                        <option value="end-date-asc">End Date</option>
                        <option value="progress-desc">Progress</option>
                    </select>
                </div>
                <button class="btn btn-outline" onclick="resetFilters()">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </div>

        <div class="phases-content">
            <div class="view-controls">
                <div class="view-toggle">
                    <button class="view-btn active" onclick="switchView('cards')">
                        <i class="fas fa-th"></i> Cards View
                    </button>
                    <button class="view-btn" onclick="switchView('timeline')">
                        <i class="fas fa-calendar-alt"></i> Timeline View
                    </button>
                    <button class="view-btn" onclick="switchView('table')">
                        <i class="fas fa-table"></i> Table View
                    </button>
                </div>
            </div>

            <div class="phases-grid" id="phasesGrid">
                <div class="phase-card active" data-id="PH001">
                    <div class="card-header">
                        <div class="phase-info">
                            <h3>Phase 1 - Foundation</h3>
                            <p class="project-name">Sunset Heights</p>
                        </div>
                        <div class="phase-status">
                            <span class="status-badge active">Active</span>
                        </div>
                    </div>
                    
                    <div class="phase-details">
                        <div class="progress-section">
                            <div class="progress-header">
                                <span class="progress-label">Progress</span>
                                <span class="progress-percentage">75%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 75%"></div>
                            </div>
                        </div>
                        
                        <div class="phase-timeline">
                            <div class="timeline-item">
                                <label>Start Date</label>
                                <span>Jan 1, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>End Date</label>
                                <span>Mar 31, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>Duration</label>
                                <span>90 days</span>
                            </div>
                            <div class="timeline-item">
                                <label>Blocks</label>
                                <span>3 blocks</span>
                            </div>
                        </div>
                        
                        <div class="phase-stats">
                            <div class="stat-item">
                                <span class="stat-value">120</span>
                                <span class="stat-label">Total Units</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">85</span>
                                <span class="stat-label">Completed</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">35</span>
                                <span class="stat-label">Remaining</span>
                            </div>
                        </div>
                        
                        <div class="phase-description">
                            <p>Foundation work including excavation, concrete pouring, and structural framework for all blocks in Phase 1.</p>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-outline btn-small" onclick="viewPhaseDetails('PH001')">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-primary btn-small" onclick="editPhase('PH001')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-secondary btn-small" onclick="manageBlocks('PH001')">
                            <i class="fas fa-th-large"></i> Manage Blocks
                        </button>
                    </div>
                </div>

                <div class="phase-card completed" data-id="PH002">
                    <div class="card-header">
                        <div class="phase-info">
                            <h3>Phase 2 - Structure</h3>
                            <p class="project-name">Green Valley</p>
                        </div>
                        <div class="phase-status">
                            <span class="status-badge completed">Completed</span>
                        </div>
                    </div>
                    
                    <div class="phase-details">
                        <div class="progress-section">
                            <div class="progress-header">
                                <span class="progress-label">Progress</span>
                                <span class="progress-percentage">100%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill completed" style="width: 100%"></div>
                            </div>
                        </div>
                        
                        <div class="phase-timeline">
                            <div class="timeline-item">
                                <label>Start Date</label>
                                <span>Oct 1, 2023</span>
                            </div>
                            <div class="timeline-item">
                                <label>End Date</label>
                                <span>Dec 31, 2023</span>
                            </div>
                            <div class="timeline-item">
                                <label>Duration</label>
                                <span>92 days</span>
                            </div>
                            <div class="timeline-item">
                                <label>Blocks</label>
                                <span>2 blocks</span>
                            </div>
                        </div>
                        
                        <div class="phase-stats">
                            <div class="stat-item">
                                <span class="stat-value">80</span>
                                <span class="stat-label">Total Units</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">80</span>
                                <span class="stat-label">Completed</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">0</span>
                                <span class="stat-label">Remaining</span>
                            </div>
                        </div>
                        
                        <div class="phase-description">
                            <p>Structural work including walls, roofing, and basic infrastructure for residential blocks.</p>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-outline btn-small" onclick="viewPhaseDetails('PH002')">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-success btn-small" onclick="generateReport('PH002')">
                            <i class="fas fa-file-alt"></i> Generate Report
                        </button>
                        <button class="btn btn-secondary btn-small" onclick="viewBlocks('PH002')">
                            <i class="fas fa-th-large"></i> View Blocks
                        </button>
                    </div>
                </div>

                <div class="phase-card planned" data-id="PH003">
                    <div class="card-header">
                        <div class="phase-info">
                            <h3>Phase 3 - Finishing</h3>
                            <p class="project-name">Royal Gardens</p>
                        </div>
                        <div class="phase-status">
                            <span class="status-badge planned">Planned</span>
                        </div>
                    </div>
                    
                    <div class="phase-details">
                        <div class="progress-section">
                            <div class="progress-header">
                                <span class="progress-label">Progress</span>
                                <span class="progress-percentage">0%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                        </div>
                        
                        <div class="phase-timeline">
                            <div class="timeline-item">
                                <label>Start Date</label>
                                <span>Apr 1, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>End Date</label>
                                <span>Jun 30, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>Duration</label>
                                <span>91 days</span>
                            </div>
                            <div class="timeline-item">
                                <label>Blocks</label>
                                <span>4 blocks</span>
                            </div>
                        </div>
                        
                        <div class="phase-stats">
                            <div class="stat-item">
                                <span class="stat-value">200</span>
                                <span class="stat-label">Total Units</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">0</span>
                                <span class="stat-label">Completed</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">200</span>
                                <span class="stat-label">Remaining</span>
                            </div>
                        </div>
                        
                        <div class="phase-description">
                            <p>Interior finishing, electrical work, plumbing, and final touches for all units in the phase.</p>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-outline btn-small" onclick="viewPhaseDetails('PH003')">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-warning btn-small" onclick="startPhase('PH003')">
                            <i class="fas fa-play"></i> Start Phase
                        </button>
                        <button class="btn btn-primary btn-small" onclick="editPhase('PH003')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </div>
                </div>

                <div class="phase-card on-hold" data-id="PH004">
                    <div class="card-header">
                        <div class="phase-info">
                            <h3>Phase 4 - Amenities</h3>
                            <p class="project-name">Ocean View</p>
                        </div>
                        <div class="phase-status">
                            <span class="status-badge on-hold">On Hold</span>
                        </div>
                    </div>
                    
                    <div class="phase-details">
                        <div class="progress-section">
                            <div class="progress-header">
                                <span class="progress-label">Progress</span>
                                <span class="progress-percentage">25%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill on-hold" style="width: 25%"></div>
                            </div>
                        </div>
                        
                        <div class="phase-timeline">
                            <div class="timeline-item">
                                <label>Start Date</label>
                                <span>Feb 1, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>End Date</label>
                                <span>May 31, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>Duration</label>
                                <span>120 days</span>
                            </div>
                            <div class="timeline-item">
                                <label>Blocks</label>
                                <span>1 block</span>
                            </div>
                        </div>
                        
                        <div class="phase-stats">
                            <div class="stat-item">
                                <span class="stat-value">50</span>
                                <span class="stat-label">Total Units</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">12</span>
                                <span class="stat-label">Completed</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">38</span>
                                <span class="stat-label">Remaining</span>
                            </div>
                        </div>
                        
                        <div class="phase-description">
                            <p>Community amenities including clubhouse, swimming pool, gym, and landscaping work.</p>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-outline btn-small" onclick="viewPhaseDetails('PH004')">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-success btn-small" onclick="resumePhase('PH004')">
                            <i class="fas fa-play"></i> Resume
                        </button>
                        <button class="btn btn-primary btn-small" onclick="editPhase('PH004')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Phase Modal -->
<div class="modal" id="newPhaseModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>Create New Phase</h3>
            <button class="modal-close" onclick="closeNewPhaseModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="phase-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>Phase Name *</label>
                        <input type="text" class="form-control" id="phaseName" placeholder="Enter phase name" required>
                    </div>
                    <div class="form-group">
                        <label>Project *</label>
                        <select class="form-control" id="phaseProject" required>
                            <option value="">Select project</option>
                            <option value="sunset-heights">Sunset Heights</option>
                            <option value="green-valley">Green Valley</option>
                            <option value="royal-gardens">Royal Gardens</option>
                            <option value="ocean-view">Ocean View</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Start Date *</label>
                        <input type="date" class="form-control" id="phaseStartDate" required>
                    </div>
                    <div class="form-group">
                        <label>End Date *</label>
                        <input type="date" class="form-control" id="phaseEndDate" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Status *</label>
                        <select class="form-control" id="phaseStatus" required>
                            <option value="">Select status</option>
                            <option value="planned">Planned</option>
                            <option value="active">Active</option>
                            <option value="on-hold">On Hold</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Priority</label>
                        <select class="form-control" id="phasePriority">
                            <option value="">Select priority</option>
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="phaseDescription" rows="4" placeholder="Enter phase description"></textarea>
                </div>
                
                <div class="blocks-section">
                    <h4>Associated Blocks</h4>
                    <div class="blocks-grid" id="blocksGrid">
                        <div class="block-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="blocks[]" value="block-a"> Block A
                            </label>
                        </div>
                        <div class="block-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="blocks[]" value="block-b"> Block B
                            </label>
                        </div>
                        <div class="block-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="blocks[]" value="block-c"> Block C
                            </label>
                        </div>
                        <div class="block-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="blocks[]" value="block-d"> Block D
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="autoStartPhase"> Auto-start phase on creation
                    </label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeNewPhaseModal()">Cancel</button>
            <button class="btn btn-primary" onclick="createPhase()">Create Phase</button>
        </div>
    </div>
</div>

<style>
.phases-dashboard {
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

.phases-container {
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

.phases-content {
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

.phases-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 1.5rem;
}

.phase-card {
    border: 1px solid #eee;
    border-radius: 8px;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    overflow: hidden;
}

.phase-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.phase-card.active {
    border-left: 4px solid #28a745;
}

.phase-card.completed {
    border-left: 4px solid var(--primary-color);
}

.phase-card.planned {
    border-left: 4px solid #6c757d;
}

.phase-card.on-hold {
    border-left: 4px solid #ffc107;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid #eee;
    background: #f8f9fa;
}

.phase-info h3 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
    font-size: 1.3rem;
}

.project-name {
    color: #666;
    margin: 0;
    font-size: 0.9rem;
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

.status-badge.completed {
    background: #e2e3e5;
    color: #383d41;
}

.status-badge.planned {
    background: #d1ecf1;
    color: #0c5460;
}

.status-badge.on-hold {
    background: #fff3cd;
    color: #856404;
}

.phase-details {
    padding: 1.5rem;
}

.progress-section {
    margin-bottom: 1.5rem;
}

.progress-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.progress-label {
    font-size: 0.9rem;
    color: #666;
}

.progress-percentage {
    font-weight: 600;
    color: var(--secondary-color);
    font-size: 0.9rem;
}

.progress-bar {
    width: 100%;
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

.progress-fill.completed {
    background: var(--primary-color);
}

.progress-fill.on-hold {
    background: #ffc107;
}

.phase-timeline {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.timeline-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.timeline-item label {
    font-size: 0.9rem;
    color: #666;
    margin: 0;
}

.timeline-item span {
    font-weight: 600;
    color: var(--secondary-color);
    font-size: 0.9rem;
}

.phase-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.stat-item {
    text-align: center;
}

.stat-value {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.8rem;
    color: #666;
}

.phase-description {
    margin-bottom: 1rem;
}

.phase-description p {
    margin: 0;
    color: var(--secondary-color);
    font-size: 0.9rem;
    line-height: 1.4;
}

.card-footer {
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

.blocks-section {
    margin: 2rem 0;
    padding: 1.5rem;
    border: 1px solid #eee;
    border-radius: 6px;
    background: #f8f9fa;
}

.blocks-section h4 {
    margin: 0 0 1rem 0;
    color: var(--secondary-color);
    font-size: 1.1rem;
}

.blocks-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.block-item {
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    background: white;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    margin: 0;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
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
    
    .view-controls {
        flex-direction: column;
        align-items: stretch;
    }
    
    .phases-grid {
        grid-template-columns: 1fr;
    }
    
    .phase-stats {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .blocks-grid {
        grid-template-columns: 1fr;
    }
    
    .card-footer {
        justify-content: center;
    }
}
</style>

<script>
function switchView(viewType) {
    const buttons = document.querySelectorAll('.view-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    const grid = document.getElementById('phasesGrid');
    if (viewType === 'table') {
        grid.classList.add('table-view');
    } else if (viewType === 'timeline') {
        grid.classList.add('timeline-view');
    } else {
        grid.classList.remove('table-view', 'timeline-view');
    }
}

function openNewPhaseModal() {
    document.getElementById('newPhaseModal').style.display = 'flex';
}

function closeNewPhaseModal() {
    document.getElementById('newPhaseModal').style.display = 'none';
    resetPhaseForm();
}

function resetPhaseForm() {
    document.getElementById('phaseName').value = '';
    document.getElementById('phaseProject').value = '';
    document.getElementById('phaseStartDate').value = '';
    document.getElementById('phaseEndDate').value = '';
    document.getElementById('phaseStatus').value = '';
    document.getElementById('phasePriority').value = '';
    document.getElementById('phaseDescription').value = '';
    
    // Reset checkboxes
    const checkboxes = document.querySelectorAll('input[name="blocks[]"]');
    checkboxes.forEach(checkbox => checkbox.checked = false);
    document.getElementById('autoStartPhase').checked = false;
}

function createPhase() {
    const name = document.getElementById('phaseName').value;
    const project = document.getElementById('phaseProject').value;
    const startDate = document.getElementById('phaseStartDate').value;
    const endDate = document.getElementById('phaseEndDate').value;
    const status = document.getElementById('phaseStatus').value;
    
    if (!name || !project || !startDate || !endDate || !status) {
        alert('Please fill in all required fields');
        return;
    }
    
    const selectedBlocks = [];
    const checkboxes = document.querySelectorAll('input[name="blocks[]"]:checked');
    checkboxes.forEach(checkbox => selectedBlocks.push(checkbox.value));
    
    console.log('Creating phase:', {
        name, project, startDate, endDate, status, blocks: selectedBlocks
    });
    
    closeNewPhaseModal();
}

function viewPhaseDetails(phaseId) {
    console.log('Viewing phase details:', phaseId);
}

function editPhase(phaseId) {
    console.log('Editing phase:', phaseId);
}

function manageBlocks(phaseId) {
    console.log('Managing blocks for phase:', phaseId);
}

function viewBlocks(phaseId) {
    console.log('Viewing blocks for phase:', phaseId);
}

function generateReport(phaseId) {
    console.log('Generating report for phase:', phaseId);
}

function startPhase(phaseId) {
    if (confirm('Are you sure you want to start this phase?')) {
        console.log('Starting phase:', phaseId);
    }
}

function resumePhase(phaseId) {
    if (confirm('Are you sure you want to resume this phase?')) {
        console.log('Resuming phase:', phaseId);
    }
}

function exportPhasesReport() {
    console.log('Exporting phases report');
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('projectFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('sortBy').value = 'name-asc';
    console.log('Filters reset');
}

// Handle project selection to load blocks
document.getElementById('phaseProject').addEventListener('change', function() {
    const project = this.value;
    const blocksGrid = document.getElementById('blocksGrid');
    
    // Clear existing blocks
    blocksGrid.innerHTML = '';
    
    if (project) {
        // Load blocks for selected project
        const blocks = getBlocksForProject(project);
        blocks.forEach(block => {
            const blockItem = document.createElement('div');
            blockItem.className = 'block-item';
            blockItem.innerHTML = `
                <label class="checkbox-label">
                    <input type="checkbox" name="blocks[]" value="${block.id}"> ${block.name}
                </label>
            `;
            blocksGrid.appendChild(blockItem);
        });
    }
});

function getBlocksForProject(projectId) {
    // Mock data - replace with actual API call
    const projectBlocks = {
        'sunset-heights': [
            { id: 'block-a', name: 'Block A' },
            { id: 'block-b', name: 'Block B' },
            { id: 'block-c', name: 'Block C' }
        ],
        'green-valley': [
            { id: 'block-d', name: 'Block D' },
            { id: 'block-e', name: 'Block E' }
        ],
        'royal-gardens': [
            { id: 'block-f', name: 'Block F' },
            { id: 'block-g', name: 'Block G' },
            { id: 'block-h', name: 'Block H' },
            { id: 'block-i', name: 'Block I' }
        ],
        'ocean-view': [
            { id: 'block-j', name: 'Block J' }
        ]
    };
    
    return projectBlocks[projectId] || [];
}
</script>

<?php include '../includes/footer.php'; ?>