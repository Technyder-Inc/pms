<?php
// PHP Configuration
$pageTitle = "Compliance";
$currentPage = "compliance";
$breadcrumb_section = "Compliance";
$breadcrumb_current = "Holds";
$show_subnav = true;
$subnav_items = [
    ['href' => '#holds', 'label' => 'Holds', 'onclick' => "showSection('holds')"],
    ['href' => '#blocks', 'label' => 'Blocks', 'onclick' => "showSection('blocks')"],
    ['href' => '#ndc', 'label' => 'NDC', 'onclick' => "showSection('ndc')"],
    ['href' => '#transfers', 'label' => 'Transfers', 'onclick' => "showSection('transfers')"],
    ['href' => '#migration', 'label' => 'Migration', 'onclick' => "showSection('migration')"],
    ['href' => '#ownership', 'label' => 'Ownership', 'onclick' => "showSection('ownership')"]
];
include 'includes/header.php';
?>

        <!-- Content Area -->
        <div class="content" id="pageContent">
            <!-- Holds Section -->
            <section id="holds-section" class="content-section" role="tabpanel" aria-labelledby="holds-tab">
                <div class="section-header">
                    <h2>Unit Holds & Reservations</h2>
                    <button class="btn btn-primary" onclick="openHoldModal()">Create New Hold</button>
                </div>
                
                <div class="filters-bar">
                    <select id="holdStatusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="expired">Expired</option>
                        <option value="released">Released</option>
                    </select>
                    <select id="projectFilter">
                        <option value="">All Projects</option>
                        <option value="sunset">Sunset Residences</option>
                        <option value="green-valley">Green Valley Homes</option>
                    </select>
                    <input type="date" id="holdFromDate" placeholder="From Date">
                    <input type="date" id="holdToDate" placeholder="To Date">
                    <button class="btn btn-primary" onclick="applyHoldFilters()">Apply Filters</button>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Hold ID</th>
                                <th>Unit</th>
                                <th>Customer</th>
                                <th>Hold Date</th>
                                <th>Expiry Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="holdsTableBody">
                            <!-- Table content will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Blocks Section -->
            <section id="blocks-section" class="content-section hidden" role="tabpanel" aria-labelledby="blocks-tab">
                <div class="section-header">
                    <h2>Unit Blocks</h2>
                    <button class="btn btn-primary" onclick="openBlockModal()">Create New Block</button>
                </div>
                
                <div class="filters-bar">
                    <select id="blockStatusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <select id="blockProjectFilter">
                        <option value="">All Projects</option>
                        <option value="sunset">Sunset Residences</option>
                        <option value="green-valley">Green Valley Homes</option>
                    </select>
                    <button class="btn btn-primary" onclick="applyBlockFilters()">Apply Filters</button>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Block ID</th>
                                <th>Unit</th>
                                <th>Reason</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="blocksTableBody">
                            <!-- Table content will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- NDC Section -->
            <section id="ndc-section" class="content-section hidden" role="tabpanel" aria-labelledby="ndc-tab">
                <div class="section-header">
                    <h2>No Dues Certificate (NDC)</h2>
                    <button class="btn btn-primary" onclick="generateNDC()">Generate NDC</button>
                </div>
                
                <div class="filters-bar">
                    <select id="ndcCustomerFilter">
                        <option value="">All Customers</option>
                        <option value="john-smith">John Smith</option>
                        <option value="jane-doe">Jane Doe</option>
                    </select>
                    <select id="ndcStatusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <button class="btn btn-primary" onclick="applyNDCFilters()">Apply Filters</button>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>NDC ID</th>
                                <th>Customer</th>
                                <th>Unit</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="ndcTableBody">
                            <!-- Table content will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Transfers Section -->
            <section id="transfers-section" class="content-section hidden" role="tabpanel" aria-labelledby="transfers-tab">
                <div class="section-header">
                    <h2>Unit Transfers</h2>
                    <button class="btn btn-primary" onclick="initiateTransfer()">Initiate Transfer</button>
                </div>
                
                <div class="filters-bar">
                    <select id="transferStatusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="completed">Completed</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <button class="btn btn-primary" onclick="applyTransferFilters()">Apply Filters</button>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Transfer ID</th>
                                <th>Unit</th>
                                <th>From Customer</th>
                                <th>To Customer</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="transfersTableBody">
                            <!-- Table content will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Migration Section -->
            <section id="migration-section" class="content-section hidden" role="tabpanel" aria-labelledby="migration-tab">
                <div class="section-header">
                    <h2>Unit Migration</h2>
                    <button class="btn btn-primary" onclick="initiateMigration()">Initiate Migration</button>
                </div>
                
                <div class="filters-bar">
                    <select id="migrationStatusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                    <button class="btn btn-primary" onclick="applyMigrationFilters()">Apply Filters</button>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Migration ID</th>
                                <th>Customer</th>
                                <th>From Unit</th>
                                <th>To Unit</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="migrationTableBody">
                            <!-- Table content will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Ownership History Section -->
            <section id="ownership-section" class="content-section hidden" role="tabpanel" aria-labelledby="ownership-tab">
                <div class="section-header">
                    <h2>Ownership History</h2>
                    <button class="btn btn-secondary" onclick="exportOwnershipHistory()">Export History</button>
                </div>
                
                <div class="filters-bar">
                    <select id="ownershipUnitFilter">
                        <option value="">All Units</option>
                        <option value="a-101">A-101</option>
                        <option value="a-102">A-102</option>
                        <option value="b-201">B-201</option>
                    </select>
                    <input type="date" id="ownershipFromDate" placeholder="From Date">
                    <input type="date" id="ownershipToDate" placeholder="To Date">
                    <button class="btn btn-primary" onclick="applyOwnershipFilters()">Apply Filters</button>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Unit</th>
                                <th>Previous Owner</th>
                                <th>Current Owner</th>
                                <th>Transfer Date</th>
                                <th>Transfer Type</th>
                                <th>Documents</th>
                            </tr>
                        </thead>
                        <tbody id="ownershipTableBody">
                            <!-- Table content will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="app.js"></script>
    <script>
        // Show specific section and hide others
        function showSection(sectionId) {
            console.log('showSection called with:', sectionId);
            
            // Hide all sections
            const sections = document.querySelectorAll('.content-section');
            console.log('Found sections:', sections.length);
            sections.forEach(section => {
                section.classList.add('hidden');
                section.setAttribute('aria-hidden', 'true');
            });
            
            // Show the selected section
            const targetSection = document.getElementById(sectionId + '-section');
            console.log('Target section:', targetSection);
            if (targetSection) {
                targetSection.classList.remove('hidden');
                targetSection.setAttribute('aria-hidden', 'false');
                console.log('Showing section:', sectionId + '-section');
            } else {
                console.error('Section not found:', sectionId + '-section');
            }
            
            // Update active tab
            const tabs = document.querySelectorAll('.subnav-pill');
            tabs.forEach(tab => {
                tab.classList.remove('active');
                tab.setAttribute('aria-selected', 'false');
            });
            
            // Set active tab
            const activeTab = document.querySelector(`a[href="#${sectionId}"]`);
            if (activeTab) {
                activeTab.classList.add('active');
                activeTab.setAttribute('aria-selected', 'true');
                console.log('Set active tab:', sectionId);
            } else {
                console.error('Tab not found:', sectionId);
            }
            
            // Update URL hash
            window.location.hash = sectionId;
            
            // Update breadcrumb
            const currentSection = document.getElementById('currentSection');
            if (currentSection) {
                const sectionNames = {
                    'holds': 'Holds',
                    'blocks': 'Blocks',
                    'ndc': 'NDC',
                    'transfers': 'Transfers',
                    'migration': 'Migration',
                    'ownership': 'Ownership History'
                };
                currentSection.textContent = sectionNames[sectionId] || sectionId;
            }
        }

        // Initialize compliance functionality
        function initCompliance() {
            loadHoldsData();
            loadBlocksData();
            loadNDCData();
            loadTransfersData();
            loadMigrationData();
            loadOwnershipData();
            
            // Handle initial hash
            const hash = window.location.hash.substring(1);
            if (hash && ['holds', 'blocks', 'ndc', 'transfers', 'migration', 'ownership'].includes(hash)) {
                showSection(hash);
            } else {
                showSection('holds'); // Default to holds section
            }
        }

        // Load holds data
        function loadHoldsData() {
            // Implementation for loading holds data
            console.log('Loading holds data...');
        }

        // Load blocks data
        function loadBlocksData() {
            // Implementation for loading blocks data
            console.log('Loading blocks data...');
        }

        // Load NDC data
        function loadNDCData() {
            // Implementation for loading NDC data
            console.log('Loading NDC data...');
        }

        // Load transfers data
        function loadTransfersData() {
            // Implementation for loading transfers data
            console.log('Loading transfers data...');
        }

        // Load migration data
        function loadMigrationData() {
            // Implementation for loading migration data
            console.log('Loading migration data...');
        }

        // Load ownership data
        function loadOwnershipData() {
            // Implementation for loading ownership data
            console.log('Loading ownership data...');
        }

        // Apply filters
        function applyFilters(section) {
            console.log('Applying filters for section:', section);
        }

        // Export data
        function exportData(section) {
            console.log('Exporting data for section:', section);
        }

        // Handle hash changes
        window.addEventListener('hashchange', function() {
            const hash = window.location.hash.substring(1);
            if (hash && ['holds', 'blocks', 'ndc', 'transfers', 'migration', 'ownership'].includes(hash)) {
                showSection(hash);
            }
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initCompliance();
        });

        function openHoldModal() {
            console.log('Opening hold modal...');
        }

        function applyHoldFilters() {
            console.log('Applying hold filters...');
        }

        function openBlockModal() {
            console.log('Opening block modal...');
        }

        function applyBlockFilters() {
            console.log('Applying block filters...');
        }

        function generateNDC() {
            console.log('Generating NDC...');
        }

        function applyNDCFilters() {
            console.log('Applying NDC filters...');
        }

        function initiateTransfer() {
            console.log('Initiating transfer...');
        }

        function applyTransferFilters() {
            console.log('Applying transfer filters...');
        }

        function initiateMigration() {
            console.log('Initiating migration...');
        }

        function applyMigrationFilters() {
            console.log('Applying migration filters...');
        }

        function exportOwnershipHistory() {
            console.log('Exporting ownership history...');
        }

        function applyOwnershipFilters() {
            console.log('Applying ownership filters...');
        }
    </script>
</body>
</html>