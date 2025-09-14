<?php
$pageTitle = "Holds & Reservations - Property Management System";
$currentPage = "holds-reservations";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-calendar-alt"></i> Holds & Reservations</h1>
            <p>Manage unit holds and customer reservations</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openNewHoldModal()">
                <i class="fas fa-plus"></i> New Hold
            </button>
            <button class="btn btn-secondary" onclick="openNewReservationModal()">
                <i class="fas fa-calendar-plus"></i> New Reservation
            </button>
            <button class="btn btn-outline" onclick="exportHoldsReport()">
                <i class="fas fa-download"></i> Export Report
            </button>
        </div>
    </div>

    <div class="holds-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-pause-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>18</h3>
                    <p>Active Holds</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <h3>12</h3>
                    <p>Active Reservations</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>5</h3>
                    <p>Expiring Soon</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>3</h3>
                    <p>Expired Today</p>
                </div>
            </div>
        </div>
    </div>

    <div class="holds-container">
        <div class="filters-section">
            <div class="search-filters">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search holds/reservations..." id="searchInput">
                </div>
                <div class="filter-group">
                    <select class="form-control" id="typeFilter">
                        <option value="">All Types</option>
                        <option value="hold">Holds</option>
                        <option value="reservation">Reservations</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="expired">Expired</option>
                        <option value="converted">Converted</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
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
                    <select class="form-control" id="dateFilter">
                        <option value="">All Dates</option>
                        <option value="today">Today</option>
                        <option value="this-week">This Week</option>
                        <option value="this-month">This Month</option>
                        <option value="expiring-soon">Expiring Soon</option>
                    </select>
                </div>
                <button class="btn btn-outline" onclick="resetFilters()">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </div>

        <div class="holds-content">
            <div class="view-controls">
                <div class="view-toggle">
                    <button class="view-btn active" onclick="switchView('cards')">
                        <i class="fas fa-th"></i> Cards View
                    </button>
                    <button class="view-btn" onclick="switchView('table')">
                        <i class="fas fa-table"></i> Table View
                    </button>
                    <button class="view-btn" onclick="switchView('timeline')">
                        <i class="fas fa-calendar"></i> Timeline View
                    </button>
                </div>
                <div class="sort-controls">
                    <select class="form-control" id="sortBy">
                        <option value="created-desc">Newest First</option>
                        <option value="created-asc">Oldest First</option>
                        <option value="expiry-asc">Expiring Soon</option>
                        <option value="unit-asc">Unit Number</option>
                        <option value="customer-asc">Customer Name</option>
                    </select>
                </div>
            </div>

            <div class="holds-grid" id="holdsGrid">
                <div class="hold-card active hold" data-id="H001">
                    <div class="card-header">
                        <div class="hold-type">
                            <span class="type-badge hold">Hold</span>
                            <span class="status-badge active">Active</span>
                        </div>
                        <div class="hold-actions">
                            <button class="btn-icon" onclick="editHold('H001')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-icon" onclick="deleteHold('H001')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="hold-info">
                        <div class="unit-details">
                            <h4>Unit A-101</h4>
                            <p class="project-name">Sunset Heights - Block A</p>
                            <p class="unit-specs">2 BHK • 1,200 sq ft • ₹45,00,000</p>
                        </div>
                        
                        <div class="customer-details">
                            <div class="customer-info">
                                <h5>John Smith</h5>
                                <p>+91 98765 43210</p>
                                <p>john.smith@email.com</p>
                            </div>
                        </div>
                        
                        <div class="hold-timeline">
                            <div class="timeline-item">
                                <label>Hold Date</label>
                                <span>Jan 15, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>Expiry Date</label>
                                <span class="expiry-date">Jan 22, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>Days Remaining</label>
                                <span class="days-remaining warning">2 days</span>
                            </div>
                        </div>
                        
                        <div class="hold-notes">
                            <label>Notes:</label>
                            <p>Customer interested in this unit. Waiting for loan approval.</p>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-success btn-small" onclick="convertToReservation('H001')">
                            <i class="fas fa-arrow-right"></i> Convert to Reservation
                        </button>
                        <button class="btn btn-outline btn-small" onclick="extendHold('H001')">
                            <i class="fas fa-clock"></i> Extend Hold
                        </button>
                        <button class="btn btn-danger btn-small" onclick="cancelHold('H001')">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </div>

                <div class="hold-card active reservation" data-id="R001">
                    <div class="card-header">
                        <div class="hold-type">
                            <span class="type-badge reservation">Reservation</span>
                            <span class="status-badge active">Active</span>
                        </div>
                        <div class="hold-actions">
                            <button class="btn-icon" onclick="editReservation('R001')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-icon" onclick="deleteReservation('R001')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="hold-info">
                        <div class="unit-details">
                            <h4>Unit B-205</h4>
                            <p class="project-name">Green Valley - Block B</p>
                            <p class="unit-specs">3 BHK • 1,450 sq ft • ₹58,00,000</p>
                        </div>
                        
                        <div class="customer-details">
                            <div class="customer-info">
                                <h5>Sarah Johnson</h5>
                                <p>+91 87654 32109</p>
                                <p>sarah.johnson@email.com</p>
                            </div>
                        </div>
                        
                        <div class="reservation-details">
                            <div class="timeline-item">
                                <label>Reservation Date</label>
                                <span>Jan 10, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>Token Amount</label>
                                <span class="amount">₹2,00,000</span>
                            </div>
                            <div class="timeline-item">
                                <label>Payment Due</label>
                                <span class="due-date">Feb 10, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>Days to Payment</label>
                                <span class="days-remaining safe">25 days</span>
                            </div>
                        </div>
                        
                        <div class="hold-notes">
                            <label>Notes:</label>
                            <p>Token amount received. Customer will complete payment by due date.</p>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-primary btn-small" onclick="convertToBooking('R001')">
                            <i class="fas fa-handshake"></i> Convert to Booking
                        </button>
                        <button class="btn btn-outline btn-small" onclick="recordPayment('R001')">
                            <i class="fas fa-credit-card"></i> Record Payment
                        </button>
                        <button class="btn btn-danger btn-small" onclick="cancelReservation('R001')">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </div>

                <div class="hold-card expired hold" data-id="H002">
                    <div class="card-header">
                        <div class="hold-type">
                            <span class="type-badge hold">Hold</span>
                            <span class="status-badge expired">Expired</span>
                        </div>
                        <div class="hold-actions">
                            <button class="btn-icon" onclick="renewHold('H002')" title="Renew">
                                <i class="fas fa-redo"></i>
                            </button>
                            <button class="btn-icon" onclick="deleteHold('H002')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="hold-info">
                        <div class="unit-details">
                            <h4>Unit C-302</h4>
                            <p class="project-name">Royal Gardens - Block C</p>
                            <p class="unit-specs">4 BHK • 2,100 sq ft • ₹85,00,000</p>
                        </div>
                        
                        <div class="customer-details">
                            <div class="customer-info">
                                <h5>Michael Brown</h5>
                                <p>+91 76543 21098</p>
                                <p>michael.brown@email.com</p>
                            </div>
                        </div>
                        
                        <div class="hold-timeline">
                            <div class="timeline-item">
                                <label>Hold Date</label>
                                <span>Jan 5, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>Expired On</label>
                                <span class="expiry-date expired">Jan 12, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>Days Overdue</label>
                                <span class="days-remaining expired">8 days</span>
                            </div>
                        </div>
                        
                        <div class="hold-notes">
                            <label>Notes:</label>
                            <p>Customer did not respond. Hold expired automatically.</p>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-warning btn-small" onclick="renewHold('H002')">
                            <i class="fas fa-redo"></i> Renew Hold
                        </button>
                        <button class="btn btn-outline btn-small" onclick="contactCustomer('H002')">
                            <i class="fas fa-phone"></i> Contact Customer
                        </button>
                        <button class="btn btn-danger btn-small" onclick="archiveHold('H002')">
                            <i class="fas fa-archive"></i> Archive
                        </button>
                    </div>
                </div>

                <div class="hold-card converted reservation" data-id="R002">
                    <div class="card-header">
                        <div class="hold-type">
                            <span class="type-badge reservation">Reservation</span>
                            <span class="status-badge converted">Converted</span>
                        </div>
                        <div class="hold-actions">
                            <button class="btn-icon" onclick="viewBookingDetails('R002')" title="View Booking">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="hold-info">
                        <div class="unit-details">
                            <h4>Unit A-205</h4>
                            <p class="project-name">Sunset Heights - Block A</p>
                            <p class="unit-specs">2 BHK • 1,200 sq ft • ₹45,00,000</p>
                        </div>
                        
                        <div class="customer-details">
                            <div class="customer-info">
                                <h5>Emma Wilson</h5>
                                <p>+91 65432 10987</p>
                                <p>emma.wilson@email.com</p>
                            </div>
                        </div>
                        
                        <div class="conversion-details">
                            <div class="timeline-item">
                                <label>Reservation Date</label>
                                <span>Dec 20, 2023</span>
                            </div>
                            <div class="timeline-item">
                                <label>Converted On</label>
                                <span class="conversion-date">Jan 8, 2024</span>
                            </div>
                            <div class="timeline-item">
                                <label>Booking ID</label>
                                <span class="booking-id">BK-2024-001</span>
                            </div>
                        </div>
                        
                        <div class="hold-notes">
                            <label>Notes:</label>
                            <p>Successfully converted to booking. Full payment completed.</p>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button class="btn btn-primary btn-small" onclick="viewBookingDetails('R002')">
                            <i class="fas fa-handshake"></i> View Booking
                        </button>
                        <button class="btn btn-outline btn-small" onclick="generateInvoice('R002')">
                            <i class="fas fa-file-invoice"></i> Generate Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Hold Modal -->
<div class="modal" id="newHoldModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>Create New Hold</h3>
            <button class="modal-close" onclick="closeNewHoldModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="hold-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>Project *</label>
                        <select class="form-control" id="holdProject" required>
                            <option value="">Select project</option>
                            <option value="sunset-heights">Sunset Heights</option>
                            <option value="green-valley">Green Valley</option>
                            <option value="royal-gardens">Royal Gardens</option>
                            <option value="ocean-view">Ocean View</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Block/Sector *</label>
                        <select class="form-control" id="holdBlock" required>
                            <option value="">Select block</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Unit *</label>
                        <select class="form-control" id="holdUnit" required>
                            <option value="">Select unit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hold Duration *</label>
                        <select class="form-control" id="holdDuration" required>
                            <option value="">Select duration</option>
                            <option value="3">3 days</option>
                            <option value="7">7 days</option>
                            <option value="14">14 days</option>
                            <option value="30">30 days</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row" id="customDurationRow" style="display: none;">
                    <div class="form-group">
                        <label>Custom Expiry Date *</label>
                        <input type="date" class="form-control" id="customExpiryDate">
                    </div>
                </div>
                
                <div class="customer-section">
                    <h4>Customer Information</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Customer *</label>
                            <select class="form-control" id="holdCustomer" required>
                                <option value="">Select existing customer</option>
                                <option value="new">+ Add New Customer</option>
                            </select>
                        </div>
                    </div>
                    
                    <div id="newCustomerFields" style="display: none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Full Name *</label>
                                <input type="text" class="form-control" id="customerName" placeholder="Enter customer name">
                            </div>
                            <div class="form-group">
                                <label>Phone Number *</label>
                                <input type="tel" class="form-control" id="customerPhone" placeholder="Enter phone number">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" id="customerEmail" placeholder="Enter email address">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" id="customerAddress" placeholder="Enter address">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Notes</label>
                    <textarea class="form-control" id="holdNotes" rows="3" placeholder="Enter any additional notes"></textarea>
                </div>
                
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="notifyCustomer"> Send notification to customer
                    </label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeNewHoldModal()">Cancel</button>
            <button class="btn btn-primary" onclick="createHold()">Create Hold</button>
        </div>
    </div>
</div>

<!-- New Reservation Modal -->
<div class="modal" id="newReservationModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3>Create New Reservation</h3>
            <button class="modal-close" onclick="closeNewReservationModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="reservation-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>Project *</label>
                        <select class="form-control" id="reservationProject" required>
                            <option value="">Select project</option>
                            <option value="sunset-heights">Sunset Heights</option>
                            <option value="green-valley">Green Valley</option>
                            <option value="royal-gardens">Royal Gardens</option>
                            <option value="ocean-view">Ocean View</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Block/Sector *</label>
                        <select class="form-control" id="reservationBlock" required>
                            <option value="">Select block</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Unit *</label>
                        <select class="form-control" id="reservationUnit" required>
                            <option value="">Select unit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Unit Price</label>
                        <input type="text" class="form-control" id="unitPrice" readonly>
                    </div>
                </div>
                
                <div class="payment-section">
                    <h4>Payment Information</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Token Amount *</label>
                            <input type="number" class="form-control" id="tokenAmount" placeholder="Enter token amount" required>
                        </div>
                        <div class="form-group">
                            <label>Payment Due Date *</label>
                            <input type="date" class="form-control" id="paymentDueDate" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Payment Method *</label>
                            <select class="form-control" id="paymentMethod" required>
                                <option value="">Select payment method</option>
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                                <option value="bank-transfer">Bank Transfer</option>
                                <option value="online">Online Payment</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Reference Number</label>
                            <input type="text" class="form-control" id="referenceNumber" placeholder="Enter reference number">
                        </div>
                    </div>
                </div>
                
                <div class="customer-section">
                    <h4>Customer Information</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Customer *</label>
                            <select class="form-control" id="reservationCustomer" required>
                                <option value="">Select existing customer</option>
                                <option value="new">+ Add New Customer</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Notes</label>
                    <textarea class="form-control" id="reservationNotes" rows="3" placeholder="Enter any additional notes"></textarea>
                </div>
                
                <div class="form-group">
                    <label class="checkbox-label">
                        <input type="checkbox" id="generateReceipt"> Generate payment receipt
                    </label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeNewReservationModal()">Cancel</button>
            <button class="btn btn-primary" onclick="createReservation()">Create Reservation</button>
        </div>
    </div>
</div>

<style>
.holds-dashboard {
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

.holds-container {
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

.holds-content {
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

.holds-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 1.5rem;
}

.hold-card {
    border: 1px solid #eee;
    border-radius: 8px;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    overflow: hidden;
}

.hold-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.hold-card.active {
    border-left: 4px solid #28a745;
}

.hold-card.expired {
    border-left: 4px solid #dc3545;
    background: #fff5f5;
}

.hold-card.converted {
    border-left: 4px solid var(--primary-color);
    background: #f8f9fa;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #eee;
    background: #f8f9fa;
}

.hold-type {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.type-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
}

.type-badge.hold {
    background: #fff3cd;
    color: #856404;
}

.type-badge.reservation {
    background: #d1ecf1;
    color: #0c5460;
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

.status-badge.expired {
    background: #f8d7da;
    color: #721c24;
}

.status-badge.converted {
    background: #e2e3e5;
    color: #383d41;
}

.hold-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-icon {
    width: 32px;
    height: 32px;
    border: 1px solid #ddd;
    background: white;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-icon:hover {
    background: #f8f9fa;
    border-color: #ccc;
}

.hold-info {
    padding: 1.5rem;
}

.unit-details {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.unit-details h4 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
    font-size: 1.3rem;
}

.project-name {
    color: #666;
    margin: 0 0 0.5rem 0;
    font-size: 0.9rem;
}

.unit-specs {
    color: var(--primary-color);
    font-weight: 600;
    margin: 0;
    font-size: 0.9rem;
}

.customer-details {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.customer-info h5 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
    font-size: 1.1rem;
}

.customer-info p {
    margin: 0 0 0.25rem 0;
    color: #666;
    font-size: 0.9rem;
}

.hold-timeline, .reservation-details, .conversion-details {
    margin-bottom: 1.5rem;
}

.timeline-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
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

.expiry-date.expired {
    color: #dc3545;
}

.days-remaining.warning {
    color: #ffc107;
}

.days-remaining.expired {
    color: #dc3545;
}

.days-remaining.safe {
    color: #28a745;
}

.amount {
    color: var(--primary-color) !important;
    font-weight: 700 !important;
}

.booking-id {
    color: var(--primary-color) !important;
    font-weight: 600 !important;
}

.hold-notes {
    margin-bottom: 1.5rem;
}

.hold-notes label {
    display: block;
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.hold-notes p {
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

.customer-section, .payment-section {
    margin: 2rem 0;
    padding: 1.5rem;
    border: 1px solid #eee;
    border-radius: 6px;
    background: #f8f9fa;
}

.customer-section h4, .payment-section h4 {
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

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
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
    
    .holds-grid {
        grid-template-columns: 1fr;
    }
    
    .form-row {
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
    
    const grid = document.getElementById('holdsGrid');
    if (viewType === 'table') {
        grid.classList.add('table-view');
    } else if (viewType === 'timeline') {
        grid.classList.add('timeline-view');
    } else {
        grid.classList.remove('table-view', 'timeline-view');
    }
}

function openNewHoldModal() {
    document.getElementById('newHoldModal').style.display = 'flex';
}

function closeNewHoldModal() {
    document.getElementById('newHoldModal').style.display = 'none';
    resetHoldForm();
}

function openNewReservationModal() {
    document.getElementById('newReservationModal').style.display = 'flex';
}

function closeNewReservationModal() {
    document.getElementById('newReservationModal').style.display = 'none';
    resetReservationForm();
}

function resetHoldForm() {
    document.getElementById('holdProject').value = '';
    document.getElementById('holdBlock').value = '';
    document.getElementById('holdUnit').value = '';
    document.getElementById('holdDuration').value = '';
    document.getElementById('holdCustomer').value = '';
    document.getElementById('holdNotes').value = '';
    document.getElementById('customDurationRow').style.display = 'none';
    document.getElementById('newCustomerFields').style.display = 'none';
}

function resetReservationForm() {
    document.getElementById('reservationProject').value = '';
    document.getElementById('reservationBlock').value = '';
    document.getElementById('reservationUnit').value = '';
    document.getElementById('tokenAmount').value = '';
    document.getElementById('paymentDueDate').value = '';
    document.getElementById('paymentMethod').value = '';
    document.getElementById('referenceNumber').value = '';
    document.getElementById('reservationCustomer').value = '';
    document.getElementById('reservationNotes').value = '';
}

function createHold() {
    const project = document.getElementById('holdProject').value;
    const unit = document.getElementById('holdUnit').value;
    const duration = document.getElementById('holdDuration').value;
    const customer = document.getElementById('holdCustomer').value;
    
    if (!project || !unit || !duration || !customer) {
        alert('Please fill in all required fields');
        return;
    }
    
    console.log('Creating hold:', {
        project, unit, duration, customer
    });
    
    closeNewHoldModal();
}

function createReservation() {
    const project = document.getElementById('reservationProject').value;
    const unit = document.getElementById('reservationUnit').value;
    const tokenAmount = document.getElementById('tokenAmount').value;
    const paymentDueDate = document.getElementById('paymentDueDate').value;
    const customer = document.getElementById('reservationCustomer').value;
    
    if (!project || !unit || !tokenAmount || !paymentDueDate || !customer) {
        alert('Please fill in all required fields');
        return;
    }
    
    console.log('Creating reservation:', {
        project, unit, tokenAmount, paymentDueDate, customer
    });
    
    closeNewReservationModal();
}

function editHold(holdId) {
    console.log('Editing hold:', holdId);
}

function deleteHold(holdId) {
    if (confirm('Are you sure you want to delete this hold?')) {
        console.log('Deleting hold:', holdId);
    }
}

function editReservation(reservationId) {
    console.log('Editing reservation:', reservationId);
}

function deleteReservation(reservationId) {
    if (confirm('Are you sure you want to delete this reservation?')) {
        console.log('Deleting reservation:', reservationId);
    }
}

function convertToReservation(holdId) {
    console.log('Converting hold to reservation:', holdId);
}

function convertToBooking(reservationId) {
    console.log('Converting reservation to booking:', reservationId);
}

function extendHold(holdId) {
    console.log('Extending hold:', holdId);
}

function cancelHold(holdId) {
    if (confirm('Are you sure you want to cancel this hold?')) {
        console.log('Cancelling hold:', holdId);
    }
}

function cancelReservation(reservationId) {
    if (confirm('Are you sure you want to cancel this reservation?')) {
        console.log('Cancelling reservation:', reservationId);
    }
}

function recordPayment(reservationId) {
    console.log('Recording payment for reservation:', reservationId);
}

function renewHold(holdId) {
    console.log('Renewing hold:', holdId);
}

function contactCustomer(holdId) {
    console.log('Contacting customer for hold:', holdId);
}

function archiveHold(holdId) {
    console.log('Archiving hold:', holdId);
}

function viewBookingDetails(reservationId) {
    console.log('Viewing booking details for reservation:', reservationId);
}

function generateInvoice(reservationId) {
    console.log('Generating invoice for reservation:', reservationId);
}

function exportHoldsReport() {
    console.log('Exporting holds report');
}

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('typeFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('projectFilter').value = '';
    document.getElementById('dateFilter').value = '';
    console.log('Filters reset');
}

// Handle duration selection
document.getElementById('holdDuration').addEventListener('change', function() {
    const customRow = document.getElementById('customDurationRow');
    if (this.value === 'custom') {
        customRow.style.display = 'block';
    } else {
        customRow.style.display = 'none';
    }
});

// Handle customer selection
document.getElementById('holdCustomer').addEventListener('change', function() {
    const newCustomerFields = document.getElementById('newCustomerFields');
    if (this.value === 'new') {
        newCustomerFields.style.display = 'block';
    } else {
        newCustomerFields.style.display = 'none';
    }
});
</script>

<?php include '../includes/footer.php'; ?>