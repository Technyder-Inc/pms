<?php
$currentPage = 'ai-assistance';
$pageTitle = 'AI Assistance - PMS';
$breadcrumb_section = 'AI Assistance';
$breadcrumb_current = 'Dashboard';
include 'includes/header.php';
?>

<div class="page-header">
    <div class="page-title-section">
        <h1 class="page-title">AI Assistance</h1>
        <p class="page-description">Intelligent insights and automated assistance for property management</p>
    </div>
    <div class="page-actions">
        <button class="btn btn-outline">View History</button>
        <button class="btn btn-primary">New Chat</button>
    </div>
</div>

<!-- AI Features Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-robot"></i>
        </div>
        <div class="stat-content">
            <h3>24/7</h3>
            <p>AI Support</p>
            <span class="stat-trend positive">Always available</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-chart-bar"></i>
        </div>
        <div class="stat-content">
            <h3>156</h3>
            <p>Insights Generated</p>
            <span class="stat-trend positive">+23 this week</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-lightbulb"></i>
        </div>
        <div class="stat-content">
            <h3>89%</h3>
            <p>Accuracy Rate</p>
            <span class="stat-trend positive">Continuously improving</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-content">
            <h3>2.3s</h3>
            <p>Avg Response Time</p>
            <span class="stat-trend positive">Lightning fast</span>
        </div>
    </div>
</div>

<!-- AI Chat Interface -->
<div class="content-section">
    <div class="section-header">
        <h2>AI Assistant Chat</h2>
        <div class="chat-status">
            <span class="status-indicator online"></span>
            <span>AI Assistant Online</span>
        </div>
    </div>
    <div class="chat-container">
        <div class="chat-messages" id="chatMessages">
            <div class="message ai-message">
                <div class="message-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="message-content">
                    <p>Hello! I'm your AI assistant for property management. How can I help you today?</p>
                    <span class="message-time">Just now</span>
                </div>
            </div>
        </div>
        <div class="chat-input-container">
            <div class="quick-actions">
                <button class="quick-action-btn" onclick="sendQuickMessage('Show me property analytics')">📊 Analytics</button>
                <button class="quick-action-btn" onclick="sendQuickMessage('Generate financial report')">💰 Finance</button>
                <button class="quick-action-btn" onclick="sendQuickMessage('Check compliance status')">✅ Compliance</button>
                <button class="quick-action-btn" onclick="sendQuickMessage('Property recommendations')">🏠 Insights</button>
            </div>
            <div class="chat-input">
                <input type="text" id="messageInput" placeholder="Ask me anything about your property management..." onkeypress="handleKeyPress(event)">
                <button class="send-btn" onclick="sendMessage()">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- AI Insights Section -->
<div class="content-section">
    <div class="section-header">
        <h2>AI-Generated Insights</h2>
        <button class="btn btn-secondary">Refresh Insights</button>
    </div>
    <div class="insights-grid">
        <div class="insight-card">
            <div class="insight-header">
                <i class="fas fa-trending-up"></i>
                <h4>Revenue Optimization</h4>
            </div>
            <p>Based on market analysis, increasing rent by 3-5% for units A-101 to A-105 could generate an additional $2,400 monthly revenue.</p>
            <div class="insight-actions">
                <button class="btn btn-sm btn-primary">Apply Suggestion</button>
                <button class="btn btn-sm btn-outline">Learn More</button>
            </div>
        </div>
        <div class="insight-card">
            <div class="insight-header">
                <i class="fas fa-exclamation-triangle"></i>
                <h4>Maintenance Alert</h4>
            </div>
            <p>Predictive analysis suggests HVAC systems in Building B may require maintenance within the next 30 days to prevent failures.</p>
            <div class="insight-actions">
                <button class="btn btn-sm btn-primary">Schedule Maintenance</button>
                <button class="btn btn-sm btn-outline">View Details</button>
            </div>
        </div>
        <div class="insight-card">
            <div class="insight-header">
                <i class="fas fa-users"></i>
                <h4>Tenant Satisfaction</h4>
            </div>
            <p>AI analysis of feedback shows 92% satisfaction rate. Consider implementing suggested amenity improvements to reach 95%.</p>
            <div class="insight-actions">
                <button class="btn btn-sm btn-primary">View Suggestions</button>
                <button class="btn btn-sm btn-outline">Feedback Report</button>
            </div>
        </div>
    </div>
</div>

<script>
function sendMessage() {
    const input = document.getElementById('messageInput');
    const message = input.value.trim();
    if (message) {
        addUserMessage(message);
        input.value = '';
        // Simulate AI response
        setTimeout(() => {
            addAIResponse(generateAIResponse(message));
        }, 1000);
    }
}

function sendQuickMessage(message) {
    addUserMessage(message);
    setTimeout(() => {
        addAIResponse(generateAIResponse(message));
    }, 1000);
}

function addUserMessage(message) {
    const chatMessages = document.getElementById('chatMessages');
    const messageDiv = document.createElement('div');
    messageDiv.className = 'message user-message';
    messageDiv.innerHTML = `
        <div class="message-content">
            <p>${message}</p>
            <span class="message-time">Just now</span>
        </div>
        <div class="message-avatar">
            <i class="fas fa-user"></i>
        </div>
    `;
    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function addAIResponse(response) {
    const chatMessages = document.getElementById('chatMessages');
    const messageDiv = document.createElement('div');
    messageDiv.className = 'message ai-message';
    messageDiv.innerHTML = `
        <div class="message-avatar">
            <i class="fas fa-robot"></i>
        </div>
        <div class="message-content">
            <p>${response}</p>
            <span class="message-time">Just now</span>
        </div>
    `;
    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function generateAIResponse(message) {
    const responses = {
        'Show me property analytics': 'Here are your key property analytics: Occupancy rate is 94%, average rent is $1,250, and revenue growth is 8% YoY. Would you like me to generate a detailed report?',
        'Generate financial report': 'I can generate a comprehensive financial report for you. This will include revenue analysis, expense breakdown, and profit margins. Shall I proceed with the current month or a specific period?',
        'Check compliance status': 'Your compliance status is excellent! 98% compliance rate with only 3 minor pending items. All major regulatory requirements are met. Would you like details on the pending items?',
        'Property recommendations': 'Based on market trends and your portfolio, I recommend: 1) Upgrading amenities in Building A, 2) Implementing smart home features, 3) Optimizing rent pricing for units with low occupancy. Shall I elaborate on any of these?'
    };
    
    return responses[message] || 'I understand your question. Let me analyze your property data and provide you with relevant insights. This feature is currently being enhanced to provide more detailed responses.';
}

function handleKeyPress(event) {
    if (event.key === 'Enter') {
        sendMessage();
    }
}
</script>

<?php include 'includes/footer.php'; ?>