<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

$pageTitle = "Projects - Property Management System";
$currentPage = "projects";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-building"></i> Projects</h1>
            <p>Manage all your property development projects</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openNewProjectModal()">
                <i class="fas fa-plus"></i> New Project
            </button>
            <button class="btn btn-outline" onclick="exportProjectsReport()">
                <i class="fas fa-download"></i> Export Report
            </button>
        </div>
    </div>

    <div class="projects-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="stat-content">
                    <h3>8</h3>
                    <p>Total Projects</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>5</h3>
                    <p>Active Projects</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>2</h3>
                    <p>Completed Projects</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>1</h3>
                    <p>Planned Projects</p>
                </div>
            </div>
        </div>
    </div>

    <div class="projects-container">
        <div class="filters-section">
            <div class="search-filters">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search projects..." id="searchInput">
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
                    <select class="form-control" id="typeFilter">
                        <option value="">All Types</option>
                        <option value="residential">Residential</option>
                        <option value="commercial">Commercial</option>
                        <option value="mixed-use">Mixed Use</option>
                        <option value="industrial">Industrial</option>
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

        <div class="projects-content">
            <div class="view-controls">
                <div class="view-toggle">
                    <button class="view-btn active" onclick="switchView('cards')">
                        <i class="fas fa-th"></i> Cards View
                    </button>
                    <button class="view-btn" onclick="switchView('list')">
                        <i class="fas fa-list"></i> List View
                    </button>
                    <button class="view-btn" onclick="switchView('map')">
                        <i class="fas fa-map"></i> Map View
                    </button>
                </div>
            </div>

            <div class="projects-grid" id="projectsGrid">
                <div class="project-card active" data-id="PRJ001">
                    <div class="card-header">
                        <div class="project-info">
                            <h3>Sunset Heights</h3>
                            <p class="project-type">Residential Complex</p>
                        </div>
                        <div class="project-status">
                            <span class="status-badge active">Active</span>
                        </div>
                    </div>
                    
                    <div class="project-image">
                        <img src="../assets/project-1.jpg" alt="Sunset Heights" onerror="this.src='../assets/placeholder-project.jpg'">
                        <div class="image-overlay">
                            <button class="btn btn-small btn-outline" onclick="viewProjectGallery('PRJ001')">
                                <i class="fas fa-images"></i> Gallery
                            </button>
                        </div>
                    </div>
                    
                    <div class="project-details">
                        <div class="progress-section">
                            <div class="progress-header">
                                <span class="progress-label">Overall Progress</span>
                                <span class="progress-percentage">68%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 68%"></div>
                            </div>
                        </div>
                        
                        <div class="project-stats">
                            <div class="stat-item">
                                <span class="stat-value">450</span>
                                <span class="stat-label">Total Units</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">12</span>
                                <span class="stat-label">Phases</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">8</span>
                                <span class="stat-label">Blocks</span>
                            </div>
                        </div>
                        
                        <div class="project-timeline">
                            <div class="timeline-item">
                                <label>Start Date</label>
                                <span>Jan 15, 2023</span>
                            </div>
                            <div class="timeline-item">
                                <label>Expected Completion</label>
                                <span>Dec 30, 2025</span>
                            </div>
                            <div class="timeline-item">
                                <label>Location</label>
                                <span>North District, City</span>
                            </div>
                        </div>
                        
                        <div class="project-description">
                            <p>Premium residential complex featuring modern amenities, green spaces, and sustainable living solutions.</p>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-outline btn-small" onclick="viewProjectDetails('PRJ001')">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-primary btn-small" onclick="editProject('PRJ001')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-secondary btn-small" onclick="managePhases('PRJ001')">
                            <i class="fas fa-layer-group"></i> Phases
                        </button>
                    </div>
                </div>

                <div class="project-card completed" data-id="PRJ002">
                    <div class="card-header">
                        <div class="project-info">
                            <h3>Green Valley</h3>
                            <p class="project-type">Eco-Friendly Homes</p>
                        </div>
                        <div class="project-status">
                            <span class="status-badge completed">Completed</span>
                        </div>
                    </div>
                    
                    <div class="project-image">
                        <img src="../assets/project-2.jpg" alt="Green Valley" onerror="this.src='../assets/placeholder-project.jpg'">
                        <div class="image-overlay">
                            <button class="btn btn-small btn-outline" onclick="viewProjectGallery('PRJ002')">
                                <i class="fas fa-images"></i> Gallery
                            </button>
                        </div>
                    </div>
                    
                    <div class="project-details">
                        <div class="progress-section">
                            <div class="progress-header">
                                <span class="progress-label">Overall Progress</span>
                                <span class="progress-percentage">100%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill completed" style="width: 100%"></div>
                            </div>
                        </div>
                        
                        <div class="project-stats">
                            <div class="stat-item">
                                <span class="stat-value">180</span>
                                <span class="stat-label">Total Units</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">6</span>
                                <span class="stat-label">Phases</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">4</span>
                                <span class="stat-label">Blocks</span>
                            </div>
                        </div>
                        
                        <div class="project-timeline">
                            <div class="timeline-item">
                                <label>Start Date</label>
                                <span>Mar 1, 2022</span>
                            </div>
                            <div class="timeline-item">
                                <label>Completion Date</label>
                                <span>Nov 15, 2023</span>
                            </div>
                            <div class="timeline-item">
                                <label>Location</label>
                                <span>South District, City</span>
                            </div>
                        </div>
                        
                        <div class="project-description">
                            <p>Sustainable housing project with solar panels, rainwater harvesting, and energy-efficient designs.</p>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-outline btn-small" onclick="viewProjectDetails('PRJ002')">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-success btn-small" onclick="generateProjectReport('PRJ002')">
                            <i class="fas fa-file-alt"></i> Report
                        </button>
                        <button class="btn btn-secondary btn-small" onclick="viewPhases('PRJ002')">
                            <i class="fas fa-layer-group"></i> View Phases
                        </button>
                    </div>
                </div>

                <div class="project-card planned" data-id="PRJ003">
                    <div class="card-header">
                        <div class="project-info">
                            <h3>Royal Gardens</h3>
                            <p class="project-type">Luxury Apartments</p>
                        </div>
                        <div class="project-status">
                            <span class="status-badge planned">Planned</span>
                        </div>
                    </div>
                    
                    <div class="project-image">
                        <img src="../assets/project-3.jpg" alt="Royal Gardens" onerror="this.src='../assets/placeholder-project.jpg'">
                        <div class="image-overlay">
                            <button class="btn btn-small btn-outline" onclick="viewProjectGallery('PRJ003')">
                                <i class="fas fa-images"></i> Gallery
                            </button>
                        </div>
                    </div>
                    
                    <div class="project-details">
                        <div class="progress-section">
                            <div class="progress-header">
                                <span class="progress-label">Overall Progress</span>
                                <span class="progress-percentage">0%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                        </div>
                        
                        <div class="project-stats">
                            <div class="stat-item">
                                <span class="stat-value">320</span>
                                <span class="stat-label">Total Units</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">8</span>
                                <span class="stat-label">Phases</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">6</span>
                                <span class="stat-label">Blocks</span>
                            </div>
                        </div>
                        
                        <div class="project-timeline">
                            <div class="timeline-item">
                                <label>Planned Start</label>
                                <span>Apr 1, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>Expected Completion</label>
                                <span>Mar 31, 2027</span>
                            </div>
                            <div class="timeline-item">
                                <label>Location</label>
                                <span>Central District, City</span>
                            </div>
                        </div>
                        
                        <div class="project-description">
                            <p>High-end luxury apartment complex with premium amenities, concierge services, and panoramic city views.</p>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-outline btn-small" onclick="viewProjectDetails('PRJ003')">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-warning btn-small" onclick="startProject('PRJ003')">
                            <i class="fas fa-play"></i> Start Project
                        </button>
                        <button class="btn btn-primary btn-small" onclick="editProject('PRJ003')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </div>
                </div>

                <div class="project-card on-hold" data-id="PRJ004">
                    <div class="card-header">
                        <div class="project-info">
                            <h3>Ocean View</h3>
                            <p class="project-type">Beachfront Villas</p>
                        </div>
                        <div class="project-status">
                            <span class="status-badge on-hold">On Hold</span>
                        </div>
                    </div>
                    
                    <div class="project-image">
                        <img src="../assets/project-4.jpg" alt="Ocean View" onerror="this.src='../assets/placeholder-project.jpg'">
                        <div class="image-overlay">
                            <button class="btn btn-small btn-outline" onclick="viewProjectGallery('PRJ004')">
                                <i class="fas fa-images"></i> Gallery
                            </button>
                        </div>
                    </div>
                    
                    <div class="project-details">
                        <div class="progress-section">
                            <div class="progress-header">
                                <span class="progress-label">Overall Progress</span>
                                <span class="progress-percentage">35%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill on-hold" style="width: 35%"></div>
                            </div>
                        </div>
                        
                        <div class="project-stats">
                            <div class="stat-item">
                                <span class="stat-value">85</span>
                                <span class="stat-label">Total Units</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">4</span>
                                <span class="stat-label">Phases</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value">3</span>
                                <span class="stat-label">Blocks</span>
                            </div>
                        </div>
                        
                        <div class="project-timeline">
                            <div class="timeline-item">
                                <label>Start Date</label>
                                <span>Jun 1, 2023</span>
                            </div>
                            <div class="timeline-item">
                                <label>Expected Completion</label>
                                <span>May 31, 2025</span>
                            </div>
                            <div class="timeline-item">
                                <label>Location</label>
                                <span>Coastal Area, City</span>
                            </div>
                        </div>
                        
                        <div class="project-description">
                            <p>Exclusive beachfront villa development with private beach access, marina, and resort-style amenities.</p>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-outline btn-small" onclick="viewProjectDetails('PRJ004')">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-success btn-small" onclick="resumeProject('PRJ004')">
                            <i class="fas fa-play"></i> Resume
                        </button>
                        <button class="btn btn-primary btn-small" onclick="editProject('PRJ004')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Project Modal -->
<div class="modal" id="newProjectModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>Create New Project</h3>
            <button class="modal-close" onclick="closeNewProjectModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="project-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>Project Name *</label>
                        <input type="text" class="form-control" id="projectName" placeholder="Enter project name" required>
                    </div>
                    <div class="form-group">
                        <label>Project Type *</label>
                        <select class="form-control" id="projectType" required>
                            <option value="">Select project type</option>
                            <option value="residential">Residential</option>
                            <option value="commercial">Commercial</option>
                            <option value="mixed-use">Mixed Use</option>
                            <option value="industrial">Industrial</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Start Date *</label>
                        <input type="date" class="form-control" id="projectStartDate" required>
                    </div>
                    <div class="form-group">
                        <label>Expected Completion *</label>
                        <input type="date" class="form-control" id="projectEndDate" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Location *</label>
                        <input type="text" class="form-control" id="projectLocation" placeholder="Enter project location" required>
                    </div>
                    <div class="form-group">
                        <label>Total Budget</label>
                        <input type="number" class="form-control" id="projectBudget" placeholder="Enter total budget">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Total Units *</label>
                        <input type="number" class="form-control" id="projectUnits" placeholder="Enter total units" required>
                    </div>
                    <div class="form-group">
                        <label>Status *</label>
                        <select class="form-control" id="projectStatus" required>
                            <option value="">Select status</option>
                            <option value="planned">Planned</option>
                            <option value="active">Active</option>
                            <option value="on-hold">On Hold</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="projectDescription" rows="4" placeholder="Enter project description"></textarea>
                </div>
                
                <div class="form-group">
                    <label>Project Image</label>
                    <input type="file" class="form-control" id="projectImage" accept="image/*">
                    <small class="form-text">Upload a representative image for the project</small>
                </div>
                
                <div class="amenities-section">
                    <h4>Amenities</h4>
                    <div class="amenities-grid">
                        <div class="amenity-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="amenities[]" value="swimming-pool"> Swimming Pool
                            </label>
                        </div>
                        <div class="amenity-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="amenities[]" value="gym"> Gym/Fitness Center
                            </label>
                        </div>
                        <div class="amenity-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="amenities[]" value="clubhouse"> Clubhouse
                            </label>
                        </div>
                        <div class="amenity-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="amenities[]" value="playground"> Children's Playground
                            </label>
                        </div>
                        <div class="amenity-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="amenities[]" value="parking"> Covered Parking
                            </label>
                        </div>
                        <div class="amenity-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="amenities[]" value="security"> 24/7 Security
                            </label>
                        </div>
                        <div class="amenity-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="amenities[]" value="garden"> Landscaped Gardens
                            </label>
                        </div>
                        <div class="amenity-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="amenities[]" value="elevator"> Elevator Access
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeNewProjectModal()">Cancel</button>
            <button class="btn btn-primary" onclick="createProject()">Create Project</button>
        </div>
    </div>
</div>

<style>
.projects-dashboard {
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

.projects-container {
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

.projects-content {
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

.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 1.5rem;
}

.project-card {
    border: 1px solid #eee;
    border-radius: 8px;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    overflow: hidden;
}

.project-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.project-card.active {
    border-left: 4px solid #28a745;
}

.project-card.completed {
    border-left: 4px solid var(--primary-color);
}

.project-card.planned {
    border-left: 4px solid #6c757d;
}

.project-card.on-hold {
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

.project-info h3 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
    font-size: 1.3rem;
}

.project-type {
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

.project-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.project-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.project-card:hover .project-image img {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.project-card:hover .image-overlay {
    opacity: 1;
}

.project-details {
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

.project-stats {
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

.project-timeline {
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

.project-description {
    margin-bottom: 1rem;
}

.project-description p {
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

.amenities-section {
    margin: 2rem 0;
    padding: 1.5rem;
    border: 1px solid #eee;
    border-radius: 6px;
    background: #f8f9fa;
}

.amenities-section h4 {
    margin: 0 0 1rem 0;
    color: var(--secondary-color);
    font-size: 1.1rem;
}

.amenities-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.amenity-item {
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
    
    .view-controls {
        flex-direction: column;
        align-items: stretch;
    }
    
    .projects-grid {
        grid-template-columns: 1fr;
    }
    
    .project-stats {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .amenities-grid {
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
    
    const grid = document.getElementById('projectsGrid');
    if (viewType === 'list') {
        grid.classList.add('list-view');
    } else if (viewType === 'map') {
        grid.classList.add('map-view');
    } else {
        grid.classList.remove('list-view', 'map-view');
    }
}

function openNewProjectModal() {
    document.getElementById('newProjectModal').style.display = 'flex';
}

function closeNewProjectModal() {
    document.getElementById('newProjectModal').style.display = 'none';
    resetProjectForm();
}

function resetProjectForm() {
    document.getElementById('projectName').value = '';
    document.getElementById('projectType').value = '';
    document.getElementById('projectStartDate').value = '';
    document.getElementById('projectEndDate').value = '';
    document.getElementById('projectLocation').value = '';
    document.getElementById('projectBudget').value = '';
    document.getElementById('projectUnits').value = '';
    document.getElementById('projectStatus').value = '';
    document.getElementById('projectDescription').value = '';
    document.getElementById('projectImage').value = '';
    
    // Reset checkboxes
    const checkboxes = document.querySelectorAll('input[name="amenities[]"]');
    checkboxes.forEach(checkbox => checkbox.checked = false);
}

function createProject() {
    const name = document.getElementById('projectName').value;
    const type = document.getElementById('projectType').value;
    const startDate = document.getElementById('projectStartDate').value;
    const endDate = document.getElementById('projectEndDate').value;
    const location = document.getElementById('projectLocation').value;
    const units = document.getElementById('projectUnits').value;
    const status = document.getElementById('projectStatus').value;
    
    if (!name || !type || !startDate || !endDate || !location || !units || !status) {
        alert('Please fill in all required fields');
        return;
    }
    
    const selectedAmenities = [];
    const checkboxes = document.querySelectorAll('input[name="amenities[]"]:checked');
    checkboxes.forEach(checkbox => selectedAmenities.push(checkbox.value));
    
    console.log('Creating project:', {
        name, type, startDate, endDate, location, units, status, amenities: selectedAmenities
    });
    
    closeNewProjectModal();
}

function viewProjectDetails(projectId) {
    console.log('Viewing project details:', projectId);
}

function editProject(projectId) {
    console.log('Editing project:', projectId);
}

function managePhases(projectId) {
    console.log('Managing phases for project:', projectId);
}

function viewPhases(projectId) {
    console.log('Viewing phases for project:', projectId);
}

function generateProjectReport(projectId) {
    console.log('Generating report for project:', projectId);
}

function startProject(projectId) {
    if (confirm('Are you sure you want to start this project?')) {
        console.log('Starting project:', projectId);
    }
}

function resumeProject(projectId) {
    if (confirm('Are you sure you want to resume this project?')) {
        console.log('Resuming project:', projectId);
    }
}

function viewProjectGallery(projectId) {
    console.log('Viewing gallery for project:', projectId);
}

function exportProjectsReport() {
    console.log('Exporting projects report');
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