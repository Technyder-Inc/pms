<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

// AI Assistant Page
$pageTitle = 'AI Assistant';
$currentPage = 'ai-assist';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Property Management System</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">AI Assistant Configuration</h2>
            </div>
            <div class="card-content">
                <form class="form-grid">
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="enableAI" checked>
                            <label for="enableAI">Enable AI Assistant</label>
                        </div>
                        <small class="form-help">Turn on/off the AI assistant functionality across the system</small>
                    </div>
                    <div class="form-group">
                        <label for="aiProvider">AI Provider</label>
                        <select id="aiProvider" class="form-select">
                            <option value="openai" selected>OpenAI GPT</option>
                            <option value="anthropic">Anthropic Claude</option>
                            <option value="google">Google Gemini</option>
                            <option value="azure">Azure OpenAI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="apiKey">API Key</label>
                        <input type="password" id="apiKey" class="form-input" placeholder="Enter your API key">
                        <small class="form-help">Your API key will be encrypted and stored securely</small>
                    </div>
                    <div class="form-group">
                        <label for="model">AI Model</label>
                        <select id="model" class="form-select">
                            <option value="gpt-4" selected>GPT-4</option>
                            <option value="gpt-3.5-turbo">GPT-3.5 Turbo</option>
                            <option value="claude-3">Claude 3</option>
                            <option value="gemini-pro">Gemini Pro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="maxTokens">Max Tokens per Request</label>
                        <input type="number" id="maxTokens" class="form-input" value="2000" min="100" max="8000">
                    </div>
                    <div class="form-group">
                        <label for="temperature">Response Creativity (0-1)</label>
                        <input type="range" id="temperature" class="form-range" min="0" max="1" step="0.1" value="0.7">
                        <small class="form-help">Lower values = more focused, Higher values = more creative</small>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">AI Features</h2>
            </div>
            <div class="card-content">
                <div class="feature-grid">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-comments text-primary"></i>
                        </div>
                        <div class="feature-content">
                            <h3>Smart Chat Assistant</h3>
                            <p>Get instant answers about properties, customers, and system features</p>
                            <div class="checkbox-group">
                                <input type="checkbox" id="enableChat" checked>
                                <label for="enableChat">Enable</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-file-alt text-success"></i>
                        </div>
                        <div class="feature-content">
                            <h3>Document Generation</h3>
                            <p>Auto-generate contracts, reports, and property descriptions</p>
                            <div class="checkbox-group">
                                <input type="checkbox" id="enableDocGen" checked>
                                <label for="enableDocGen">Enable</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line text-warning"></i>
                        </div>
                        <div class="feature-content">
                            <h3>Predictive Analytics</h3>
                            <p>AI-powered insights for market trends and property valuations</p>
                            <div class="checkbox-group">
                                <input type="checkbox" id="enableAnalytics" checked>
                                <label for="enableAnalytics">Enable</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-search text-info"></i>
                        </div>
                        <div class="feature-content">
                            <h3>Smart Search</h3>
                            <p>Natural language search across all system data</p>
                            <div class="checkbox-group">
                                <input type="checkbox" id="enableSmartSearch" checked>
                                <label for="enableSmartSearch">Enable</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-robot text-purple"></i>
                        </div>
                        <div class="feature-content">
                            <h3>Task Automation</h3>
                            <p>Automate routine tasks and workflows with AI</p>
                            <div class="checkbox-group">
                                <input type="checkbox" id="enableAutomation">
                                <label for="enableAutomation">Enable</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-envelope text-secondary"></i>
                        </div>
                        <div class="feature-content">
                            <h3>Email Assistant</h3>
                            <p>AI-powered email composition and response suggestions</p>
                            <div class="checkbox-group">
                                <input type="checkbox" id="enableEmailAI">
                                <label for="enableEmailAI">Enable</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Usage Statistics</h2>
            </div>
            <div class="card-content">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value">1,247</div>
                        <div class="stat-label">AI Requests This Month</div>
                        <div class="stat-change positive">+12% from last month</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">89%</div>
                        <div class="stat-label">User Satisfaction</div>
                        <div class="stat-change positive">+5% from last month</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">2.3s</div>
                        <div class="stat-label">Average Response Time</div>
                        <div class="stat-change negative">+0.2s from last month</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">$127</div>
                        <div class="stat-label">API Costs This Month</div>
                        <div class="stat-change positive">-8% from last month</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Test AI Assistant</h2>
            </div>
            <div class="card-content">
                <div class="ai-test-area">
                    <div class="form-group">
                        <label for="testPrompt">Test Prompt</label>
                        <textarea id="testPrompt" class="form-textarea" rows="3" placeholder="Ask the AI assistant a question about your property management system..."></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-primary">Test AI Response</button>
                        <button type="button" class="btn btn-secondary">Clear</button>
                    </div>
                    <div class="ai-response-area" style="display: none;">
                        <h4>AI Response:</h4>
                        <div class="ai-response-content">
                            <!-- AI response will appear here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="button" class="btn btn-secondary">Reset to Defaults</button>
            <button type="button" class="btn btn-primary">Save AI Settings</button>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>