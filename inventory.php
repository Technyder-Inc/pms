<?php
// Inventory Page
$pageTitle = 'Inventory';
$currentPage = 'inventory';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Property Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="content">
        <!-- Horizontal Sub-Navigation -->
        <nav class="subnav" id="moduleSubnav" aria-label="Section navigation">
            <ul role="tablist">
                <li><a href="#projects" role="tab" aria-selected="true" class="subnav-pill active">Projects</a></li>
                <li><a href="#phases" role="tab" aria-selected="false" class="subnav-pill" data-feature="phases">Phases</a></li>
                <li><a href="#blocks" role="tab" aria-selected="false" class="subnav-pill">Blocks/Sectors</a></li>
                <li><a href="#units" role="tab" aria-selected="false" class="subnav-pill">Units</a></li>
            </ul>
        </nav>

        <!-- Content Area -->
        <div class="content" id="pageContent">
            <!-- Projects Section -->
            <section id="projects-section" class="content-section" role="tabpanel" aria-labelledby="projects-tab">
                <div class="section-header">
                    <h2>Projects & Schemes</h2>
                    <button class="btn btn-primary" onclick="openProjectModal()">Add New Project</button>
                </div>
                
                <div class="projects-grid">
                    <div class="project-card">
                        <div class="project-header">
                            <h3>Sunset Residences</h3>
                            <span class="project-status status-active">Active</span>
                        </div>
                        <div class="project-details">
                            <p><strong>Location:</strong> Downtown District</p>
                            <p><strong>Total Units:</strong> 150</p>
                            <p><strong>Available:</strong> 45</p>
                            <p><strong>Sold:</strong> 105</p>
                        </div>
                        <div class="project-actions">
                            <button class="btn btn-sm btn-primary">View Details</button>
                            <button class="btn btn-sm btn-secondary">Edit</button>
                        </div>
                    </div>
                    
                    <div class="project-card">
                        <div class="project-header">
                            <h3>Green Valley Homes</h3>
                            <span class="project-status status-planning">Planning</span>
                        </div>
                        <div class="project-details">
                            <p><strong>Location:</strong> Suburban Area</p>
                            <p><strong>Total Units:</strong> 200</p>
                            <p><strong>Available:</strong> 200</p>
                            <p><strong>Sold:</strong> 0</p>
                        </div>
                        <div class="project-actions">
                            <button class="btn btn-sm btn-primary">View Details</button>
                            <button class="btn btn-sm btn-secondary">Edit</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Phases Section -->
            <section id="phases-section" class="content-section hidden" role="tabpanel" aria-labelledby="phases-tab">
                <div class="section-header">
                    <h2>Project Phases</h2>
                    <button class="btn btn-primary" onclick="openPhaseModal()">Add New Phase</button>
                </div>
                
                <div class="phases-content">
                    <p>Project phases management will be implemented here.</p>
                </div>
            </section>

            <!-- Blocks Section -->
            <section id="blocks-section" class="content-section hidden" role="tabpanel" aria-labelledby="blocks-tab">
                <div class="section-header">
                    <h2>Blocks & Sectors</h2>
                    <button class="btn btn-primary" onclick="openBlockModal()">Add New Block</button>
                </div>
                
                <div class="blocks-content">
                    <p>Blocks and sectors management will be implemented here.</p>
                </div>
            </section>

            <!-- Units Section -->
            <section id="units-section" class="content-section hidden" role="tabpanel" aria-labelledby="units-tab">
                <div class="section-header">
                    <h2>Units Management</h2>
                    <button class="btn btn-primary" onclick="openUnitModal()">Add New Unit</button>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Unit ID</th>
                                <th>Project</th>
                                <th>Block</th>
                                <th>Type</th>
                                <th>Size (sq ft)</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="unitsTableBody">
                            <!-- Unit data will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html>