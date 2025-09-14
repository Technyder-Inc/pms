<?php
$pageTitle = "Units - Property Management System";
$currentPage = "units";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-cube"></i> Units Management</h1>
            <p>Manage all property units across projects</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openNewUnitModal()">
                <i class="fas fa-plus"></i> Add Unit
            </button>
            <button class="btn btn-outline" onclick="bulkImportUnits()">
                <i class="fas fa-upload"></i> Bulk Import
            </button>
            <button class="btn btn-outline" onclick="exportUnitsReport()">
                <i class="fas fa-download"></i> Export
            </button>
        </div>
    </div>

    <div class="units-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-cube"></i>
                </div>
                <div class="stat-content">
                    <h3>1,247</h3>
                    <p>Total Units</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>856</h3>
                    <p>Available Units</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="stat-content">
                    <h3>312</h3>
                    <p>Sold Units</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>79</h3>
                    <p>Reserved Units</p>
                </div>
            </div>
        </div>
    </div>

    <div class="units-container">
        <div class="filters-section">
            <div class="search-filters">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search units by number, type, or project..." id="searchInput">
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
                        <option value="available">Available</option>
                        <option value="sold">Sold</option>
                        <option value="reserved">Reserved</option>
                        <option value="blocked">Blocked</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="typeFilter">
                        <option value="">All Types</option>
                        <option value="studio">Studio</option>
                        <option value="1-bedroom">1 Bedroom</option>
                        <option value="2-bedroom">2 Bedroom</option>
                        <option value="3-bedroom">3 Bedroom</option>
                        <option value="penthouse">Penthouse</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="sortBy">
                        <option value="unit-number-asc">Unit Number A-Z</option>
                        <option value="unit-number-desc">Unit Number Z-A</option>
                        <option value="price-asc">Price Low to High</option>
                        <option value="price-desc">Price High to Low</option>
                        <option value="size-asc">Size Small to Large</option>
                        <option value="size-desc">Size Large to Small</option>
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
                    <button class="view-btn" onclick="switchView('floor-plan')">
                        <i class="fas fa-building"></i> Floor Plan
                    </button>
                </div>
                <div class="bulk-actions">
                    <button class="btn btn-outline btn-small" onclick="selectAllUnits()">
                        <i class="fas fa-check-square"></i> Select All
                    </button>
                    <button class="btn btn-warning btn-small" onclick="bulkBlockUnits()" disabled id="bulkBlockBtn">
                        <i class="fas fa-ban"></i> Block Selected
                    </button>
                    <button class="btn btn-success btn-small" onclick="bulkUnblockUnits()" disabled id="bulkUnblockBtn">
                        <i class="fas fa-check"></i> Unblock Selected
                    </button>
                </div>
            </div>

            <div class="units-grid" id="unitsGrid">
                <div class="unit-card available" data-id="SH-A-101">
                    <div class="unit-checkbox">
                        <input type="checkbox" class="unit-select" value="SH-A-101">
                    </div>
                    <div class="unit-header">
                        <div class="unit-number">SH-A-101</div>
                        <div class="unit-status">
                            <span class="status-badge available">Available</span>
                        </div>
                    </div>
                    
                    <div class="unit-image">
                        <img src="../assets/unit-1.jpg" alt="Unit SH-A-101" onerror="this.src='../assets/placeholder-unit.jpg'">
                        <div class="image-overlay">
                            <button class="btn btn-small btn-outline" onclick="viewUnitGallery('SH-A-101')">
                                <i class="fas fa-images"></i> Gallery
                            </button>
                        </div>
                    </div>
                    
                    <div class="unit-details">
                        <div class="unit-info">
                            <h4>2 Bedroom Apartment</h4>
                            <p class="project-name">Sunset Heights - Block A</p>
                        </div>
                        
                        <div class="unit-specs">
                            <div class="spec-item">
                                <i class="fas fa-expand-arrows-alt"></i>
                                <span>1,250 sq ft</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-bed"></i>
                                <span>2 Bedrooms</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-bath"></i>
                                <span>2 Bathrooms</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-car"></i>
                                <span>1 Parking</span>
                            </div>
                        </div>
                        
                        <div class="unit-pricing">
                            <div class="price-main">$285,000</div>
                            <div class="price-per-sqft">$228 per sq ft</div>
                        </div>
                        
                        <div class="unit-features">
                            <span class="feature-tag">Balcony</span>
                            <span class="feature-tag">City View</span>
                            <span class="feature-tag">Modern Kitchen</span>
                        </div>
                    </div>
                    
                    <div class="unit-actions">
                        <button class="btn btn-outline btn-small" onclick="viewUnitDetails('SH-A-101')">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-primary btn-small" onclick="editUnit('SH-A-101')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-success btn-small" onclick="sellUnit('SH-A-101')">
                            <i class="fas fa-handshake"></i> Sell
                        </button>
                    </div>
                </div>

                <div class="unit-card sold" data-id="SH-A-102">
                    <div class="unit-checkbox">
                        <input type="checkbox" class="unit-select" value="SH-A-102">
                    </div>
                    <div class="unit-header">
                        <div class="unit-number">SH-A-102</div>
                        <div class="unit-status">
                            <span class="status-badge sold">Sold</span>
                        </div>
                    </div>
                    
                    <div class="unit-image">
                        <img src="../assets/unit-2.jpg" alt="Unit SH-A-102" onerror="this.src='../assets/placeholder-unit.jpg'">
                        <div class="sold-overlay">
                            <div class="sold-badge">
                                <i class="fas fa-check-circle"></i>
                                <span>SOLD</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="unit-details">
                        <div class="unit-info">
                            <h4>3 Bedroom Apartment</h4>
                            <p class="project-name">Sunset Heights - Block A</p>
                        </div>
                        
                        <div class="unit-specs">
                            <div class="spec-item">
                                <i class="fas fa-expand-arrows-alt"></i>
                                <span>1,450 sq ft</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-bed"></i>
                                <span>3 Bedrooms</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-bath"></i>
                                <span>2 Bathrooms</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-car"></i>
                                <span>1 Parking</span>
                            </div>
                        </div>
                        
                        <div class="unit-pricing">
                            <div class="price-main">$325,000</div>
                            <div class="price-per-sqft">$224 per sq ft</div>
                        </div>
                        
                        <div class="customer-info">
                            <div class="customer-name">
                                <i class="fas fa-user"></i>
                                <span>John & Sarah Miller</span>
                            </div>
                            <div class="sale-date">
                                <i class="fas fa-calendar"></i>
                                <span>Sold on Dec 15, 2023</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="unit-actions">
                        <button class="btn btn-outline btn-small" onclick="viewUnitDetails('SH-A-102')">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-info btn-small" onclick="viewSaleDetails('SH-A-102')">
                            <i class="fas fa-file-contract"></i> Sale Details
                        </button>
                        <button class="btn btn-secondary btn-small" onclick="viewCustomer('SH-A-102')">
                            <i class="fas fa-user"></i> Customer
                        </button>
                    </div>
                </div>

                <div class="unit-card reserved" data-id="SH-A-103">
                    <div class="unit-checkbox">
                        <input type="checkbox" class="unit-select" value="SH-A-103">
                    </div>
                    <div class="unit-header">
                        <div class="unit-number">SH-A-103</div>
                        <div class="unit-status">
                            <span class="status-badge reserved">Reserved</span>
                        </div>
                    </div>
                    
                    <div class="unit-image">
                        <img src="../assets/unit-3.jpg" alt="Unit SH-A-103" onerror="this.src='../assets/placeholder-unit.jpg'">
                        <div class="reserved-overlay">
                            <div class="reserved-badge">
                                <i class="fas fa-clock"></i>
                                <span>RESERVED</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="unit-details">
                        <div class="unit-info">
                            <h4>1 Bedroom Apartment</h4>
                            <p class="project-name">Sunset Heights - Block A</p>
                        </div>
                        
                        <div class="unit-specs">
                            <div class="spec-item">
                                <i class="fas fa-expand-arrows-alt"></i>
                                <span>850 sq ft</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-bed"></i>
                                <span>1 Bedroom</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-bath"></i>
                                <span>1 Bathroom</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-car"></i>
                                <span>1 Parking</span>
                            </div>
                        </div>
                        
                        <div class="unit-pricing">
                            <div class="price-main">$195,000</div>
                            <div class="price-per-sqft">$229 per sq ft</div>
                        </div>
                        
                        <div class="reservation-info">
                            <div class="customer-name">
                                <i class="fas fa-user"></i>
                                <span>Emily Johnson</span>
                            </div>
                            <div class="reservation-date">
                                <i class="fas fa-calendar"></i>
                                <span>Reserved until Jan 30, 2024</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="unit-actions">
                        <button class="btn btn-outline btn-small" onclick="viewUnitDetails('SH-A-103')">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-warning btn-small" onclick="extendReservation('SH-A-103')">
                            <i class="fas fa-clock"></i> Extend
                        </button>
                        <button class="btn btn-success btn-small" onclick="convertToSale('SH-A-103')">
                            <i class="fas fa-handshake"></i> Convert Sale
                        </button>
                    </div>
                </div>

                <div class="unit-card blocked" data-id="SH-A-104">
                    <div class="unit-checkbox">
                        <input type="checkbox" class="unit-select" value="SH-A-104">
                    </div>
                    <div class="unit-header">
                        <div class="unit-number">SH-A-104</div>
                        <div class="unit-status">
                            <span class="status-badge blocked">Blocked</span>
                        </div>
                    </div>
                    
                    <div class="unit-image">
                        <img src="../assets/unit-4.jpg" alt="Unit SH-A-104" onerror="this.src='../assets/placeholder-unit.jpg'">
                        <div class="blocked-overlay">
                            <div class="blocked-badge">
                                <i class="fas fa-ban"></i>
                                <span>BLOCKED</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="unit-details">
                        <div class="unit-info">
                            <h4>Studio Apartment</h4>
                            <p class="project-name">Sunset Heights - Block A</p>
                        </div>
                        
                        <div class="unit-specs">
                            <div class="spec-item">
                                <i class="fas fa-expand-arrows-alt"></i>
                                <span>650 sq ft</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-bed"></i>
                                <span>Studio</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-bath"></i>
                                <span>1 Bathroom</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-car"></i>
                                <span>1 Parking</span>
                            </div>
                        </div>
                        
                        <div class="unit-pricing">
                            <div class="price-main">$165,000</div>
                            <div class="price-per-sqft">$254 per sq ft</div>
                        </div>
                        
                        <div class="block-info">
                            <div class="block-reason">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>Maintenance Required</span>
                            </div>
                            <div class="block-date">
                                <i class="fas fa-calendar"></i>
                                <span>Blocked since Dec 20, 2023</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="unit-actions">
                        <button class="btn btn-outline btn-small" onclick="viewUnitDetails('SH-A-104')">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-success btn-small" onclick="unblockUnit('SH-A-104')">
                            <i class="fas fa-check"></i> Unblock
                        </button>
                        <button class="btn btn-primary btn-small" onclick="editUnit('SH-A-104')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Unit Modal -->
<div class="modal" id="newUnitModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>Add New Unit</h3>
            <button class="modal-close" onclick="closeNewUnitModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="unit-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>Unit Number *</label>
                        <input type="text" class="form-control" id="unitNumber" placeholder="e.g., A-101" required>
                    </div>
                    <div class="form-group">
                        <label>Project *</label>
                        <select class="form-control" id="unitProject" required>
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
                        <label>Block/Sector *</label>
                        <select class="form-control" id="unitBlock" required>
                            <option value="">Select block</option>
                            <option value="block-a">Block A</option>
                            <option value="block-b">Block B</option>
                            <option value="block-c">Block C</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Floor *</label>
                        <select class="form-control" id="unitFloor" required>
                            <option value="">Select floor</option>
                            <option value="ground">Ground Floor</option>
                            <option value="1">1st Floor</option>
                            <option value="2">2nd Floor</option>
                            <option value="3">3rd Floor</option>
                            <option value="4">4th Floor</option>
                            <option value="5">5th Floor</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Unit Type *</label>
                        <select class="form-control" id="unitType" required>
                            <option value="">Select unit type</option>
                            <option value="studio">Studio</option>
                            <option value="1-bedroom">1 Bedroom</option>
                            <option value="2-bedroom">2 Bedroom</option>
                            <option value="3-bedroom">3 Bedroom</option>
                            <option value="penthouse">Penthouse</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Area (sq ft) *</label>
                        <input type="number" class="form-control" id="unitArea" placeholder="e.g., 1250" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Bedrooms</label>
                        <input type="number" class="form-control" id="unitBedrooms" placeholder="Number of bedrooms">
                    </div>
                    <div class="form-group">
                        <label>Bathrooms</label>
                        <input type="number" class="form-control" id="unitBathrooms" placeholder="Number of bathrooms">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Parking Spaces</label>
                        <input type="number" class="form-control" id="unitParking" placeholder="Number of parking spaces">
                    </div>
                    <div class="form-group">
                        <label>Price *</label>
                        <input type="number" class="form-control" id="unitPrice" placeholder="Unit price" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Features</label>
                    <div class="features-grid">
                        <div class="feature-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="features[]" value="balcony"> Balcony
                            </label>
                        </div>
                        <div class="feature-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="features[]" value="city-view"> City View
                            </label>
                        </div>
                        <div class="feature-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="features[]" value="garden-view"> Garden View
                            </label>
                        </div>
                        <div class="feature-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="features[]" value="modern-kitchen"> Modern Kitchen
                            </label>
                        </div>
                        <div class="feature-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="features[]" value="walk-in-closet"> Walk-in Closet
                            </label>
                        </div>
                        <div class="feature-item">
                            <label class="checkbox-label">
                                <input type="checkbox" name="features[]" value="en-suite"> En-suite Bathroom
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="unitDescription" rows="3" placeholder="Unit description and additional details"></textarea>
                </div>
                
                <div class="form-group">
                    <label>Unit Images</label>
                    <input type="file" class="form-control" id="unitImages" accept="image/*" multiple>
                    <small class="form-text">Upload multiple images for the unit</small>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeNewUnitModal()">Cancel</button>
            <button class="btn btn-primary" onclick="createUnit()">Create Unit</button>
        </div>
    </div>
</div>

<style>
.units-dashboard {
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

.units-container {
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

.bulk-actions {
    display: flex;
    gap: 0.5rem;
}

.units-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
}

.unit-card {
    border: 1px solid #eee;
    border-radius: 8px;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
}

.unit-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.unit-card.available {
    border-left: 4px solid #28a745;
}

.unit-card.sold {
    border-left: 4px solid var(--primary-color);
}

.unit-card.reserved {
    border-left: 4px solid #ffc107;
}

.unit-card.blocked {
    border-left: 4px solid #dc3545;
}

.unit-checkbox {
    position: absolute;
    top: 1rem;
    left: 1rem;
    z-index: 10;
}

.unit-checkbox input {
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.unit-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #eee;
    background: #f8f9fa;
}

.unit-number {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--secondary-color);
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-badge.available {
    background: #d4edda;
    color: #155724;
}

.status-badge.sold {
    background: #e2e3e5;
    color: #383d41;
}

.status-badge.reserved {
    background: #fff3cd;
    color: #856404;
}

.status-badge.blocked {
    background: #f8d7da;
    color: #721c24;
}

.unit-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.unit-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.unit-card:hover .unit-image img {
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

.unit-card:hover .image-overlay {
    opacity: 1;
}

.sold-overlay, .reserved-overlay, .blocked-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
}

.sold-badge, .reserved-badge, .blocked-badge {
    background: white;
    padding: 1rem 2rem;
    border-radius: 8px;
    text-align: center;
    font-weight: 700;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

.sold-badge {
    color: var(--primary-color);
}

.reserved-badge {
    color: #ffc107;
}

.blocked-badge {
    color: #dc3545;
}

.sold-badge i, .reserved-badge i, .blocked-badge i {
    display: block;
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.unit-details {
    padding: 1.5rem;
}

.unit-info h4 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
    font-size: 1.1rem;
}

.project-name {
    color: #666;
    margin: 0 0 1rem 0;
    font-size: 0.9rem;
}

.unit-specs {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.spec-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: #666;
}

.spec-item i {
    color: var(--primary-color);
    width: 16px;
}

.unit-pricing {
    text-align: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.price-main {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.25rem;
}

.price-per-sqft {
    font-size: 0.9rem;
    color: #666;
}

.unit-features {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.feature-tag {
    padding: 0.25rem 0.5rem;
    background: #e9ecef;
    border-radius: 12px;
    font-size: 0.8rem;
    color: #495057;
}

.customer-info, .reservation-info, .block-info {
    margin-bottom: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 6px;
}

.customer-name, .reservation-date, .sale-date, .block-reason, .block-date {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.customer-name i, .reservation-date i, .sale-date i, .block-reason i, .block-date i {
    color: var(--primary-color);
    width: 16px;
}

.unit-actions {
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

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.feature-item {
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
    
    .units-grid {
        grid-template-columns: 1fr;
    }
    
    .unit-specs {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
    
    .unit-actions {
        justify-content: center;
    }
    
    .bulk-actions {
        flex-direction: column;
    }
}
</style>

<script>
function switchView(viewType) {
    const buttons = document.querySelectorAll('.view-btn');
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    const grid = document.getElementById('unitsGrid');
    if (viewType === 'list') {
        grid.classList.add('list-view');
    } else if (viewType === 'floor-plan') {
        grid.classList.add('floor-plan-view');
    } else {
        grid.classList.remove('list-view', 'floor-plan-view');
    }
}

function selectAllUnits() {
    const checkboxes = document.querySelectorAll('.unit-select');
    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = !allChecked;
    });
    
    updateBulkActionButtons();
}

function updateBulkActionButtons() {
    const checkedBoxes = document.querySelectorAll('.unit-select:checked');
    const bulkBlockBtn = document.getElementById('bulkBlockBtn');
    const bulkUnblockBtn = document.getElementById('bulkUnblockBtn');
    
    if (checkedBoxes.length > 0) {
        bulkBlockBtn.disabled = false;
        bulkUnblockBtn.disabled = false;
    } else {
        bulkBlockBtn.disabled = true;
        bulkUnblockBtn.disabled = true;
    }
}

// Add event listeners to checkboxes
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.unit-select');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActionButtons);
    });
});

function bulkBlockUnits() {
    const checkedBoxes = document.querySelectorAll('.unit-select:checked');
    const unitIds = Array.from(checkedBoxes).map(cb => cb.value);
    
    if (confirm(`Are you sure you want to block ${unitIds.length} selected units?`)) {
        console.log('Blocking units:', unitIds);
    }
}

function bulkUnblockUnits() {
    const checkedBoxes = document.querySelectorAll('.unit-select:checked');
    const unitIds = Array.from(checkedBoxes).map(cb => cb.value);
    
    if (confirm(`Are you sure you want to unblock ${unitIds.length} selected units?`)) {
        console.log('Unblocking units:', unitIds);
    }
}

function openNewUnitModal() {
    document.getElementById('newUnitModal').style.display = 'flex';
}

function closeNewUnitModal() {
    document.getElementById('newUnitModal').style.display = 'none';
    resetUnitForm();
}

function resetUnitForm() {
    document.getElementById('unitNumber').value = '';
    document.getElementById('unitProject').value = '';
    document.getElementById('unitBlock').value = '';
    document.getElementById('unitFloor').value = '';
    document.getElementById('unitType').value = '';
    document.getElementById('unitArea').value = '';
    document.getElementById('unitBedrooms').value = '';
    document.getElementById('unitBathrooms').value = '';
    document.getElementById('unitParking').value = '';
    document.getElementById('unitPrice').value = '';
    document.getElementById('unitDescription').value = '';
    document.getElementById('unitImages').value = '';
    
    // Reset checkboxes
    const checkboxes = document.querySelectorAll('input[name="features[]"]');
    checkboxes.forEach(checkbox => checkbox.checked = false);
}

function createUnit() {
    const unitNumber = document.getElementById('unitNumber').value;
    const project = document.getElementById('unitProject').value;
    const block = document.getElementById('unitBlock').value;
    const floor = document.getElementById('unitFloor').value;
    const type = document.getElementById('unitType').value;
    const area = document.getElementById('unitArea').value;
    const price = document.getElementById('unitPrice').value;
    
    if (!unitNumber || !project || !block || !floor || !type || !area || !price) {
        alert('Please fill in all required fields');
        return;
    }
    
    const selectedFeatures = [];
    const checkboxes = document.querySelectorAll('input[name="features[]"]:checked');
    checkboxes.forEach(checkbox => selectedFeatures.push(checkbox.value));
    
    console.log('Creating unit:', {
        unitNumber, project, block, floor, type, area, price, features: selectedFeatures
    });
    
    closeNewUnitModal();
}

function viewUnitDetails(unitId) {
    console.log('Viewing unit details:', unitId);
}

function editUnit(unitId) {
    console.log('Editing unit:', unitId);
}

function sellUnit(unitId) {
    console.log('Selling unit:', unitId);
}

function viewSaleDetails(unitId) {
    console.log('Viewing sale details for unit:', unitId);
}

function viewCustomer(unitId) {
    console.log('Viewing customer for unit:', unitId);
}

function extendReservation(unitId) {
    console.log('Extending reservation for unit:', unitId);
}

function convertToSale(unitId) {
    if (confirm('Are you sure you want to convert this reservation to a sale?')) {
        console.log('Converting reservation to sale for unit:', unitId);
    }
}

function unblockUnit(unitId) {
    if (confirm('Are you sure you want to unblock this unit?')) {
        console.log('Unblocking unit:', unitId);
    }
}

function viewUnitGallery(unitId) {
    console.log('Viewing gallery for unit:', unitId);
}

function bulkImportUnits() {
    console.log('Opening bulk import dialog');
}

function exportUnitsReport() {
    console.log('Exporting units report');
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('projectFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('typeFilter').value = '';
    document.getElementById('sortBy').value = 'unit-number-asc';
    console.log('Filters reset');
}
</script>

<?php include '../includes/footer.php'; ?>