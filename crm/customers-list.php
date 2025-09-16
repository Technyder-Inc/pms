<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

$pageTitle = "Customers List - Property Management System";
$currentPage = "customers-list";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <h1><i class="fas fa-users"></i> Customers</h1>
        <p>Manage your customer database</p>
    </div>

    <div class="page-actions">
        <div class="search-filters">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="customerSearch" placeholder="Search customers...">
            </div>
            <select id="statusFilter" class="filter-select">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="prospect">Prospect</option>
            </select>
            <select id="typeFilter" class="filter-select">
                <option value="">All Types</option>
                <option value="individual">Individual</option>
                <option value="corporate">Corporate</option>
            </select>
        </div>
        <a href="customers-form.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Customer
        </a>
    </div>

    <div class="table-container">
        <table class="data-table" id="customersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="customersTableBody">
                <!-- Sample data - replace with dynamic content -->
                <tr>
                    <td>#001</td>
                    <td>
                        <div class="customer-info">
                            <div class="customer-avatar">JD</div>
                            <div>
                                <div class="customer-name">John Doe</div>
                                <div class="customer-id">CNIC: 12345-6789012-3</div>
                            </div>
                        </div>
                    </td>
                    <td>john.doe@email.com</td>
                    <td>+92 300 1234567</td>
                    <td><span class="badge badge-info">Individual</span></td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td>2024-01-15</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-icon" onclick="viewCustomer('001')" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-icon" onclick="editCustomer('001')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-icon btn-danger" onclick="deleteCustomer('001')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>#002</td>
                    <td>
                        <div class="customer-info">
                            <div class="customer-avatar">AS</div>
                            <div>
                                <div class="customer-name">ABC Solutions Ltd</div>
                                <div class="customer-id">NTN: 1234567-8</div>
                            </div>
                        </div>
                    </td>
                    <td>contact@abcsolutions.com</td>
                    <td>+92 21 1234567</td>
                    <td><span class="badge badge-warning">Corporate</span></td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td>2024-01-10</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-icon" onclick="viewCustomer('002')" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-icon" onclick="editCustomer('002')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-icon btn-danger" onclick="deleteCustomer('002')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>#003</td>
                    <td>
                        <div class="customer-info">
                            <div class="customer-avatar">SA</div>
                            <div>
                                <div class="customer-name">Sarah Ahmed</div>
                                <div class="customer-id">CNIC: 54321-0987654-1</div>
                            </div>
                        </div>
                    </td>
                    <td>sarah.ahmed@email.com</td>
                    <td>+92 333 9876543</td>
                    <td><span class="badge badge-info">Individual</span></td>
                    <td><span class="badge badge-secondary">Prospect</span></td>
                    <td>2024-01-08</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-icon" onclick="viewCustomer('003')" title="View">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-icon" onclick="editCustomer('003')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-icon btn-danger" onclick="deleteCustomer('003')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <button class="btn btn-secondary" disabled>Previous</button>
        <span class="pagination-info">Page 1 of 1 (3 customers)</span>
        <button class="btn btn-secondary" disabled>Next</button>
    </div>
</div>

<style>
.page-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    gap: 1rem;
}

.search-filters {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.search-box {
    position: relative;
    min-width: 300px;
}

.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #666;
}

.search-box input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
}

.filter-select {
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
    min-width: 120px;
}

.table-container {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 2rem;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th {
    background-color: #f8f9fa;
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: var(--secondary-color);
    border-bottom: 2px solid #dee2e6;
}

.data-table td {
    padding: 1rem;
    border-bottom: 1px solid #dee2e6;
    vertical-align: middle;
}

.customer-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.customer-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--primary-color);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.9rem;
}

.customer-name {
    font-weight: 600;
    color: var(--secondary-color);
}

.customer-id {
    font-size: 0.85rem;
    color: #666;
}

.badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 500;
}

.badge-success {
    background-color: #d4edda;
    color: #155724;
}

.badge-info {
    background-color: #d1ecf1;
    color: #0c5460;
}

.badge-warning {
    background-color: #fff3cd;
    color: #856404;
}

.badge-secondary {
    background-color: #e2e3e5;
    color: #383d41;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-icon {
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 4px;
    background-color: #f8f9fa;
    color: #666;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-icon:hover {
    background-color: var(--primary-color);
    color: white;
}

.btn-icon.btn-danger:hover {
    background-color: #dc3545;
    color: white;
}

.pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.pagination-info {
    color: #666;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .page-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-filters {
        flex-direction: column;
    }
    
    .search-box {
        min-width: auto;
    }
    
    .data-table {
        font-size: 0.9rem;
    }
    
    .data-table th,
    .data-table td {
        padding: 0.5rem;
    }
    
    .customer-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}
</style>

<script>
// Search functionality
document.getElementById('customerSearch').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#customersTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Filter functionality
document.getElementById('statusFilter').addEventListener('change', function() {
    filterTable('status', this.value);
});

document.getElementById('typeFilter').addEventListener('change', function() {
    filterTable('type', this.value);
});

function filterTable(filterType, filterValue) {
    const rows = document.querySelectorAll('#customersTableBody tr');
    
    rows.forEach(row => {
        if (!filterValue) {
            row.style.display = '';
            return;
        }
        
        let cellIndex;
        if (filterType === 'status') cellIndex = 5;
        if (filterType === 'type') cellIndex = 4;
        
        const cellText = row.cells[cellIndex].textContent.toLowerCase();
        row.style.display = cellText.includes(filterValue.toLowerCase()) ? '' : 'none';
    });
}

// Action functions
function viewCustomer(id) {
    window.location.href = `customers-view.php?id=${id}`;
}

function editCustomer(id) {
    window.location.href = `customers-form.php?id=${id}`;
}

function deleteCustomer(id) {
    if (confirm('Are you sure you want to delete this customer?')) {
        // Simulate API call
        console.log('Deleting customer:', id);
        alert('Customer deleted successfully!');
        location.reload();
    }
}
</script>

<?php include '../includes/footer.php'; ?>