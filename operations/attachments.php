<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

$pageTitle = "Attachments - Property Management System";
$currentPage = "attachments";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-paperclip"></i> Attachments</h1>
            <p>Manage document attachments and files</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openUploadModal()">
                <i class="fas fa-upload"></i> Upload Files
            </button>
        </div>
    </div>

    <div class="filters-section">
        <div class="filters-row">
            <div class="filter-group">
                <label>File Type</label>
                <select class="form-control" id="fileTypeFilter">
                    <option value="">All Types</option>
                    <option value="pdf">PDF</option>
                    <option value="image">Images</option>
                    <option value="document">Documents</option>
                    <option value="spreadsheet">Spreadsheets</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Category</label>
                <select class="form-control" id="categoryFilter">
                    <option value="">All Categories</option>
                    <option value="contracts">Contracts</option>
                    <option value="invoices">Invoices</option>
                    <option value="receipts">Receipts</option>
                    <option value="legal">Legal Documents</option>
                    <option value="photos">Property Photos</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Date Range</label>
                <input type="date" class="form-control" id="dateFrom" placeholder="From">
                <input type="date" class="form-control" id="dateTo" placeholder="To">
            </div>
            <div class="filter-group">
                <button class="btn btn-secondary" onclick="applyFilters()">
                    <i class="fas fa-filter"></i> Apply Filters
                </button>
                <button class="btn btn-outline" onclick="clearFilters()">
                    <i class="fas fa-times"></i> Clear
                </button>
            </div>
        </div>
    </div>

    <div class="attachments-grid">
        <div class="attachment-item" data-type="pdf" data-category="contracts">
            <div class="attachment-preview">
                <i class="fas fa-file-pdf"></i>
            </div>
            <div class="attachment-info">
                <h4>Property Purchase Agreement</h4>
                <p class="file-details">PDF • 2.5 MB • Jan 15, 2024</p>
                <div class="attachment-tags">
                    <span class="tag">Contract</span>
                    <span class="tag">Legal</span>
                </div>
            </div>
            <div class="attachment-actions">
                <button class="btn-icon" onclick="previewFile('contract-001.pdf')" title="Preview">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn-icon" onclick="downloadFile('contract-001.pdf')" title="Download">
                    <i class="fas fa-download"></i>
                </button>
                <button class="btn-icon" onclick="shareFile('contract-001.pdf')" title="Share">
                    <i class="fas fa-share"></i>
                </button>
                <button class="btn-icon danger" onclick="deleteFile('contract-001.pdf')" title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>

        <div class="attachment-item" data-type="image" data-category="photos">
            <div class="attachment-preview">
                <img src="../assets/property-sample.jpg" alt="Property Photo">
            </div>
            <div class="attachment-info">
                <h4>Unit A-101 Interior</h4>
                <p class="file-details">JPG • 1.8 MB • Jan 12, 2024</p>
                <div class="attachment-tags">
                    <span class="tag">Photo</span>
                    <span class="tag">Interior</span>
                </div>
            </div>
            <div class="attachment-actions">
                <button class="btn-icon" onclick="previewFile('unit-a101-interior.jpg')" title="Preview">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn-icon" onclick="downloadFile('unit-a101-interior.jpg')" title="Download">
                    <i class="fas fa-download"></i>
                </button>
                <button class="btn-icon" onclick="shareFile('unit-a101-interior.jpg')" title="Share">
                    <i class="fas fa-share"></i>
                </button>
                <button class="btn-icon danger" onclick="deleteFile('unit-a101-interior.jpg')" title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>

        <div class="attachment-item" data-type="document" data-category="invoices">
            <div class="attachment-preview">
                <i class="fas fa-file-invoice"></i>
            </div>
            <div class="attachment-info">
                <h4>Invoice #INV-2024-001</h4>
                <p class="file-details">PDF • 856 KB • Jan 10, 2024</p>
                <div class="attachment-tags">
                    <span class="tag">Invoice</span>
                    <span class="tag">Payment</span>
                </div>
            </div>
            <div class="attachment-actions">
                <button class="btn-icon" onclick="previewFile('invoice-001.pdf')" title="Preview">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn-icon" onclick="downloadFile('invoice-001.pdf')" title="Download">
                    <i class="fas fa-download"></i>
                </button>
                <button class="btn-icon" onclick="shareFile('invoice-001.pdf')" title="Share">
                    <i class="fas fa-share"></i>
                </button>
                <button class="btn-icon danger" onclick="deleteFile('invoice-001.pdf')" title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>

        <div class="attachment-item" data-type="spreadsheet" data-category="reports">
            <div class="attachment-preview">
                <i class="fas fa-file-excel"></i>
            </div>
            <div class="attachment-info">
                <h4>Monthly Sales Report</h4>
                <p class="file-details">XLSX • 1.2 MB • Jan 8, 2024</p>
                <div class="attachment-tags">
                    <span class="tag">Report</span>
                    <span class="tag">Sales</span>
                </div>
            </div>
            <div class="attachment-actions">
                <button class="btn-icon" onclick="previewFile('sales-report-jan.xlsx')" title="Preview">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn-icon" onclick="downloadFile('sales-report-jan.xlsx')" title="Download">
                    <i class="fas fa-download"></i>
                </button>
                <button class="btn-icon" onclick="shareFile('sales-report-jan.xlsx')" title="Share">
                    <i class="fas fa-share"></i>
                </button>
                <button class="btn-icon danger" onclick="deleteFile('sales-report-jan.xlsx')" title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="pagination-container">
        <div class="pagination-info">
            Showing 1-4 of 24 attachments
        </div>
        <div class="pagination">
            <button class="btn btn-outline" disabled>
                <i class="fas fa-chevron-left"></i> Previous
            </button>
            <button class="btn btn-primary">1</button>
            <button class="btn btn-outline">2</button>
            <button class="btn btn-outline">3</button>
            <button class="btn btn-outline">
                Next <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal" id="uploadModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Upload Files</h3>
            <button class="modal-close" onclick="closeUploadModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="upload-area" id="uploadArea">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <h4>Drag & Drop Files Here</h4>
                <p>or click to browse files</p>
                <input type="file" id="fileInput" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx">
            </div>
            <div class="upload-options">
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" id="uploadCategory">
                        <option value="contracts">Contracts</option>
                        <option value="invoices">Invoices</option>
                        <option value="receipts">Receipts</option>
                        <option value="legal">Legal Documents</option>
                        <option value="photos">Property Photos</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tags (comma separated)</label>
                    <input type="text" class="form-control" id="uploadTags" placeholder="e.g., contract, legal, important">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeUploadModal()">Cancel</button>
            <button class="btn btn-primary" onclick="uploadFiles()">Upload Files</button>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal" id="previewModal">
    <div class="modal-content large">
        <div class="modal-header">
            <h3 id="previewTitle">File Preview</h3>
            <button class="modal-close" onclick="closePreviewModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="preview-container" id="previewContainer">
                <!-- Preview content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<style>
.filters-section {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.filters-row {
    display: flex;
    gap: 1rem;
    align-items: end;
    flex-wrap: wrap;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    min-width: 150px;
}

.filter-group label {
    font-weight: 500;
    color: var(--secondary-color);
    font-size: 0.9rem;
}

.attachments-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.attachment-item {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.attachment-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.attachment-preview {
    height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    position: relative;
}

.attachment-preview i {
    font-size: 3rem;
    color: var(--primary-color);
}

.attachment-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.attachment-info {
    padding: 1rem;
}

.attachment-info h4 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
    font-size: 1rem;
}

.file-details {
    color: #666;
    font-size: 0.85rem;
    margin: 0 0 1rem 0;
}

.attachment-tags {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    margin-bottom: 1rem;
}

.tag {
    background: var(--primary-color);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}

.attachment-actions {
    display: flex;
    gap: 0.5rem;
    padding: 0 1rem 1rem 1rem;
}

.btn-icon {
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 4px;
    background: #f8f9fa;
    color: #666;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-icon:hover {
    background: var(--primary-color);
    color: white;
}

.btn-icon.danger:hover {
    background: #dc3545;
    color: white;
}

.upload-area {
    border: 2px dashed #ddd;
    border-radius: 8px;
    padding: 3rem;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.3s ease;
    margin-bottom: 2rem;
}

.upload-area:hover {
    border-color: var(--primary-color);
}

.upload-area.dragover {
    border-color: var(--primary-color);
    background: rgba(221, 156, 107, 0.1);
}

.upload-icon i {
    font-size: 3rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.upload-area h4 {
    margin: 0 0 0.5rem 0;
    color: var(--secondary-color);
}

.upload-area p {
    color: #666;
    margin: 0;
}

#fileInput {
    display: none;
}

.upload-options {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.preview-container {
    min-height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border-radius: 8px;
}

.modal.large .modal-content {
    max-width: 80vw;
    max-height: 80vh;
}

@media (max-width: 768px) {
    .filters-row {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-group {
        min-width: auto;
    }
    
    .attachments-grid {
        grid-template-columns: 1fr;
    }
    
    .upload-options {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function openUploadModal() {
    document.getElementById('uploadModal').style.display = 'flex';
}

function closeUploadModal() {
    document.getElementById('uploadModal').style.display = 'none';
}

function openPreviewModal() {
    document.getElementById('previewModal').style.display = 'flex';
}

function closePreviewModal() {
    document.getElementById('previewModal').style.display = 'none';
}

function previewFile(filename) {
    document.getElementById('previewTitle').textContent = filename;
    openPreviewModal();
    // Load file preview content here
}

function downloadFile(filename) {
    // Implement download functionality
    console.log('Downloading:', filename);
}

function shareFile(filename) {
    // Implement share functionality
    console.log('Sharing:', filename);
}

function deleteFile(filename) {
    if (confirm('Are you sure you want to delete this file?')) {
        // Implement delete functionality
        console.log('Deleting:', filename);
    }
}

function applyFilters() {
    const fileType = document.getElementById('fileTypeFilter').value;
    const category = document.getElementById('categoryFilter').value;
    const dateFrom = document.getElementById('dateFrom').value;
    const dateTo = document.getElementById('dateTo').value;
    
    // Implement filter logic
    console.log('Applying filters:', { fileType, category, dateFrom, dateTo });
}

function clearFilters() {
    document.getElementById('fileTypeFilter').value = '';
    document.getElementById('categoryFilter').value = '';
    document.getElementById('dateFrom').value = '';
    document.getElementById('dateTo').value = '';
    
    // Reset grid display
    document.querySelectorAll('.attachment-item').forEach(item => {
        item.style.display = 'block';
    });
}

function uploadFiles() {
    const files = document.getElementById('fileInput').files;
    const category = document.getElementById('uploadCategory').value;
    const tags = document.getElementById('uploadTags').value;
    
    if (files.length === 0) {
        alert('Please select files to upload');
        return;
    }
    
    // Implement upload functionality
    console.log('Uploading files:', { files, category, tags });
    closeUploadModal();
}

// Drag and drop functionality
const uploadArea = document.getElementById('uploadArea');
const fileInput = document.getElementById('fileInput');

uploadArea.addEventListener('click', () => fileInput.click());

uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('dragover');
});

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    fileInput.files = e.dataTransfer.files;
});
</script>

<?php include '../includes/footer.php'; ?>