<?php
$pageTitle = "Data Migration - Property Management System";
$currentPage = "migration";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-exchange-alt"></i> Data Migration</h1>
            <p>Import and export data between systems</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openImportModal()">
                <i class="fas fa-upload"></i> Import Data
            </button>
            <button class="btn btn-secondary" onclick="openExportModal()">
                <i class="fas fa-download"></i> Export Data
            </button>
        </div>
    </div>

    <div class="migration-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-upload"></i>
                </div>
                <div class="stat-content">
                    <h3>12</h3>
                    <p>Imports This Month</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-download"></i>
                </div>
                <div class="stat-content">
                    <h3>8</h3>
                    <p>Exports This Month</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>95%</h3>
                    <p>Success Rate</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-database"></i>
                </div>
                <div class="stat-content">
                    <h3>1,247</h3>
                    <p>Records Migrated</p>
                </div>
            </div>
        </div>
    </div>

    <div class="migration-sections">
        <div class="section-tabs">
            <button class="tab-btn active" onclick="showTab('history')">Migration History</button>
            <button class="tab-btn" onclick="showTab('templates')">Templates</button>
            <button class="tab-btn" onclick="showTab('scheduled')">Scheduled Jobs</button>
        </div>

        <div class="tab-content">
            <div id="history" class="tab-pane active">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Job ID</th>
                                <th>Type</th>
                                <th>Data Type</th>
                                <th>Records</th>
                                <th>Status</th>
                                <th>Started</th>
                                <th>Duration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#MIG001</td>
                                <td><span class="badge badge-info">Import</span></td>
                                <td>Customers</td>
                                <td>150</td>
                                <td><span class="badge badge-success">Completed</span></td>
                                <td>2024-01-20 10:30</td>
                                <td>2m 15s</td>
                                <td>
                                    <button class="btn-icon" onclick="viewMigrationDetails('MIG001')" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn-icon" onclick="downloadLog('MIG001')" title="Download Log">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>#MIG002</td>
                                <td><span class="badge badge-warning">Export</span></td>
                                <td>Properties</td>
                                <td>89</td>
                                <td><span class="badge badge-success">Completed</span></td>
                                <td>2024-01-19 14:45</td>
                                <td>1m 42s</td>
                                <td>
                                    <button class="btn-icon" onclick="viewMigrationDetails('MIG002')" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn-icon" onclick="downloadLog('MIG002')" title="Download Log">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>#MIG003</td>
                                <td><span class="badge badge-info">Import</span></td>
                                <td>Payments</td>
                                <td>245</td>
                                <td><span class="badge badge-danger">Failed</span></td>
                                <td>2024-01-18 09:15</td>
                                <td>0m 45s</td>
                                <td>
                                    <button class="btn-icon" onclick="viewMigrationDetails('MIG003')" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn-icon" onclick="retryMigration('MIG003')" title="Retry">
                                        <i class="fas fa-redo"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="templates" class="tab-pane">
                <div class="templates-grid">
                    <div class="template-card">
                        <div class="template-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="template-content">
                            <h4>Customer Import</h4>
                            <p>Import customer data from CSV/Excel files</p>
                            <div class="template-actions">
                                <button class="btn btn-primary" onclick="useTemplate('customers')">
                                    <i class="fas fa-play"></i> Use Template
                                </button>
                                <button class="btn btn-outline" onclick="downloadTemplate('customers')">
                                    <i class="fas fa-download"></i> Download
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="template-card">
                        <div class="template-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="template-content">
                            <h4>Property Import</h4>
                            <p>Import property and unit data</p>
                            <div class="template-actions">
                                <button class="btn btn-primary" onclick="useTemplate('properties')">
                                    <i class="fas fa-play"></i> Use Template
                                </button>
                                <button class="btn btn-outline" onclick="downloadTemplate('properties')">
                                    <i class="fas fa-download"></i> Download
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="template-card">
                        <div class="template-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="template-content">
                            <h4>Payment Import</h4>
                            <p>Import payment and transaction data</p>
                            <div class="template-actions">
                                <button class="btn btn-primary" onclick="useTemplate('payments')">
                                    <i class="fas fa-play"></i> Use Template
                                </button>
                                <button class="btn btn-outline" onclick="downloadTemplate('payments')">
                                    <i class="fas fa-download"></i> Download
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="template-card">
                        <div class="template-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="template-content">
                            <h4>Booking Import</h4>
                            <p>Import booking and reservation data</p>
                            <div class="template-actions">
                                <button class="btn btn-primary" onclick="useTemplate('bookings')">
                                    <i class="fas fa-play"></i> Use Template
                                </button>
                                <button class="btn btn-outline" onclick="downloadTemplate('bookings')">
                                    <i class="fas fa-download"></i> Download
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="scheduled" class="tab-pane">
                <div class="scheduled-jobs">
                    <div class="job-item">
                        <div class="job-info">
                            <h4>Daily Customer Export</h4>
                            <p>Export customer data to backup system</p>
                            <div class="job-schedule">
                                <i class="fas fa-clock"></i> Daily at 2:00 AM
                            </div>
                        </div>
                        <div class="job-status">
                            <span class="badge badge-success">Active</span>
                        </div>
                        <div class="job-actions">
                            <button class="btn-icon" onclick="editScheduledJob('daily-export')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-icon" onclick="runScheduledJob('daily-export')" title="Run Now">
                                <i class="fas fa-play"></i>
                            </button>
                            <button class="btn-icon danger" onclick="deleteScheduledJob('daily-export')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="job-item">
                        <div class="job-info">
                            <h4>Weekly Property Sync</h4>
                            <p>Sync property data with external system</p>
                            <div class="job-schedule">
                                <i class="fas fa-clock"></i> Weekly on Sunday at 1:00 AM
                            </div>
                        </div>
                        <div class="job-status">
                            <span class="badge badge-warning">Paused</span>
                        </div>
                        <div class="job-actions">
                            <button class="btn-icon" onclick="editScheduledJob('weekly-sync')" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-icon" onclick="runScheduledJob('weekly-sync')" title="Run Now">
                                <i class="fas fa-play"></i>
                            </button>
                            <button class="btn-icon danger" onclick="deleteScheduledJob('weekly-sync')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary" onclick="openScheduleModal()">
                    <i class="fas fa-plus"></i> Schedule New Job
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal" id="importModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Import Data</h3>
            <button class="modal-close" onclick="closeImportModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Data Type</label>
                <select class="form-control" id="importDataType">
                    <option value="customers">Customers</option>
                    <option value="properties">Properties</option>
                    <option value="payments">Payments</option>
                    <option value="bookings">Bookings</option>
                </select>
            </div>
            <div class="form-group">
                <label>File Format</label>
                <select class="form-control" id="importFormat">
                    <option value="csv">CSV</option>
                    <option value="excel">Excel (XLSX)</option>
                    <option value="json">JSON</option>
                </select>
            </div>
            <div class="form-group">
                <label>Import File</label>
                <div class="file-upload-area">
                    <input type="file" id="importFile" accept=".csv,.xlsx,.json">
                    <div class="upload-text">
                        <i class="fas fa-upload"></i>
                        <span>Choose file or drag here</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="validateData"> Validate data before import
                </label>
            </div>
            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="skipDuplicates"> Skip duplicate records
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeImportModal()">Cancel</button>
            <button class="btn btn-primary" onclick="startImport()">Start Import</button>
        </div>
    </div>
</div>

<!-- Export Modal -->
<div class="modal" id="exportModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Export Data</h3>
            <button class="modal-close" onclick="closeExportModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Data Type</label>
                <select class="form-control" id="exportDataType">
                    <option value="customers">Customers</option>
                    <option value="properties">Properties</option>
                    <option value="payments">Payments</option>
                    <option value="bookings">Bookings</option>
                </select>
            </div>
            <div class="form-group">
                <label>Export Format</label>
                <select class="form-control" id="exportFormat">
                    <option value="csv">CSV</option>
                    <option value="excel">Excel (XLSX)</option>
                    <option value="json">JSON</option>
                    <option value="pdf">PDF Report</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date Range</label>
                <div class="date-range">
                    <input type="date" class="form-control" id="exportDateFrom">
                    <span>to</span>
                    <input type="date" class="form-control" id="exportDateTo">
                </div>
            </div>
            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="includeDeleted"> Include deleted records
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeExportModal()">Cancel</button>
            <button class="btn btn-primary" onclick="startExport()">Start Export</button>
        </div>
    </div>
</div>

<style>
.migration-dashboard {
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

.migration-sections {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.section-tabs {
    display: flex;
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.tab-btn {
    padding: 1rem 1.5rem;
    border: none;
    background: none;
    cursor: pointer;
    font-weight: 500;
    color: #666;
    transition: all 0.3s ease;
}

.tab-btn.active {
    background: white;
    color: var(--primary-color);
    border-bottom: 2px solid var(--primary-color);
}

.tab-content {
    padding: 2rem;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

.templates-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.template-card {
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 1.5rem;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.template-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.template-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: var(--primary-color);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto 1rem auto;
}

.template-content h4 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
}

.template-content p {
    color: #666;
    margin: 0 0 1.5rem 0;
}

.template-actions {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
}

.scheduled-jobs {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 2rem;
}

.job-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    border: 1px solid #eee;
    border-radius: 8px;
    background: #f8f9fa;
}

.job-info h4 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
}

.job-info p {
    margin: 0 0 0.5rem 0;
    color: #666;
    font-size: 0.9rem;
}

.job-schedule {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #666;
    font-size: 0.85rem;
}

.job-actions {
    display: flex;
    gap: 0.5rem;
}

.file-upload-area {
    border: 2px dashed #ddd;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.3s ease;
}

.file-upload-area:hover {
    border-color: var(--primary-color);
}

.upload-text {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    color: #666;
}

.upload-text i {
    font-size: 2rem;
    color: var(--primary-color);
}

.date-range {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.date-range span {
    color: #666;
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
    
    .templates-grid {
        grid-template-columns: 1fr;
    }
    
    .job-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .job-actions {
        align-self: stretch;
        justify-content: center;
    }
    
    .date-range {
        flex-direction: column;
        align-items: stretch;
    }
}
</style>

<script>
function showTab(tabName) {
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('active');
    });
    
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    document.getElementById(tabName).classList.add('active');
    event.target.classList.add('active');
}

function openImportModal() {
    document.getElementById('importModal').style.display = 'flex';
}

function closeImportModal() {
    document.getElementById('importModal').style.display = 'none';
}

function openExportModal() {
    document.getElementById('exportModal').style.display = 'flex';
}

function closeExportModal() {
    document.getElementById('exportModal').style.display = 'none';
}

function openScheduleModal() {
    // Implement schedule modal
    console.log('Opening schedule modal');
}

function startImport() {
    const dataType = document.getElementById('importDataType').value;
    const format = document.getElementById('importFormat').value;
    const file = document.getElementById('importFile').files[0];
    
    if (!file) {
        alert('Please select a file to import');
        return;
    }
    
    console.log('Starting import:', { dataType, format, file: file.name });
    closeImportModal();
}

function startExport() {
    const dataType = document.getElementById('exportDataType').value;
    const format = document.getElementById('exportFormat').value;
    const dateFrom = document.getElementById('exportDateFrom').value;
    const dateTo = document.getElementById('exportDateTo').value;
    
    console.log('Starting export:', { dataType, format, dateFrom, dateTo });
    closeExportModal();
}

function viewMigrationDetails(jobId) {
    console.log('Viewing details for job:', jobId);
}

function downloadLog(jobId) {
    console.log('Downloading log for job:', jobId);
}

function retryMigration(jobId) {
    if (confirm('Are you sure you want to retry this migration?')) {
        console.log('Retrying migration:', jobId);
    }
}

function useTemplate(templateType) {
    console.log('Using template:', templateType);
    openImportModal();
    document.getElementById('importDataType').value = templateType;
}

function downloadTemplate(templateType) {
    console.log('Downloading template:', templateType);
}

function editScheduledJob(jobId) {
    console.log('Editing scheduled job:', jobId);
}

function runScheduledJob(jobId) {
    if (confirm('Are you sure you want to run this job now?')) {
        console.log('Running scheduled job:', jobId);
    }
}

function deleteScheduledJob(jobId) {
    if (confirm('Are you sure you want to delete this scheduled job?')) {
        console.log('Deleting scheduled job:', jobId);
    }
}
</script>

<?php include '../includes/footer.php'; ?>