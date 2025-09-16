<?php
// Path variables for navigation and assets
$base_path = '../';
$css_path = '../public/';
$js_path = '../public/';
$assets_path = '../';

$pageTitle = "Notifications - Property Management System";
$currentPage = "notifications";
include '../includes/header.php';
?>

<div class="content">
    <div class="page-header">
        <div class="header-content">
            <h1><i class="fas fa-bell"></i> Notifications</h1>
            <p>Manage system notifications and alerts</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary" onclick="openComposeModal()">
                <i class="fas fa-plus"></i> Send Notification
            </button>
            <button class="btn btn-secondary" onclick="markAllAsRead()">
                <i class="fas fa-check-double"></i> Mark All Read
            </button>
        </div>
    </div>

    <div class="notifications-dashboard">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="stat-content">
                    <h3>24</h3>
                    <p>Total Notifications</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon unread">
                    <i class="fas fa-bell-slash"></i>
                </div>
                <div class="stat-content">
                    <h3>8</h3>
                    <p>Unread</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-content">
                    <h3>3</h3>
                    <p>High Priority</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>5</h3>
                    <p>Today</p>
                </div>
            </div>
        </div>
    </div>

    <div class="notifications-container">
        <div class="notifications-sidebar">
            <div class="notification-filters">
                <h3>Filters</h3>
                <div class="filter-group">
                    <button class="filter-btn active" onclick="filterNotifications('all')">
                        <i class="fas fa-list"></i> All Notifications
                        <span class="count">24</span>
                    </button>
                    <button class="filter-btn" onclick="filterNotifications('unread')">
                        <i class="fas fa-bell"></i> Unread
                        <span class="count">8</span>
                    </button>
                    <button class="filter-btn" onclick="filterNotifications('read')">
                        <i class="fas fa-check"></i> Read
                        <span class="count">16</span>
                    </button>
                    <button class="filter-btn" onclick="filterNotifications('high')">
                        <i class="fas fa-exclamation-triangle"></i> High Priority
                        <span class="count">3</span>
                    </button>
                </div>
                
                <div class="filter-group">
                    <h4>Categories</h4>
                    <button class="filter-btn" onclick="filterNotifications('payments')">
                        <i class="fas fa-credit-card"></i> Payments
                        <span class="count">8</span>
                    </button>
                    <button class="filter-btn" onclick="filterNotifications('bookings')">
                        <i class="fas fa-calendar-check"></i> Bookings
                        <span class="count">6</span>
                    </button>
                    <button class="filter-btn" onclick="filterNotifications('system')">
                        <i class="fas fa-cog"></i> System
                        <span class="count">4</span>
                    </button>
                    <button class="filter-btn" onclick="filterNotifications('reminders')">
                        <i class="fas fa-clock"></i> Reminders
                        <span class="count">6</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="notifications-main">
            <div class="notifications-header">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search notifications..." id="notificationSearch">
                </div>
                <div class="sort-options">
                    <select class="form-control" id="sortBy">
                        <option value="date-desc">Newest First</option>
                        <option value="date-asc">Oldest First</option>
                        <option value="priority">Priority</option>
                        <option value="category">Category</option>
                    </select>
                </div>
            </div>

            <div class="notifications-list">
                <div class="notification-item unread high-priority" data-category="payments">
                    <div class="notification-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <h4>Payment Overdue Alert</h4>
                            <div class="notification-meta">
                                <span class="priority high">High Priority</span>
                                <span class="time">2 hours ago</span>
                            </div>
                        </div>
                        <p>Payment for Unit A-101 in Sunset Heights is overdue by 15 days. Customer: John Doe</p>
                        <div class="notification-actions">
                            <button class="btn-small btn-primary" onclick="viewPaymentDetails('PAY001')">
                                View Details
                            </button>
                            <button class="btn-small btn-outline" onclick="sendReminder('PAY001')">
                                Send Reminder
                            </button>
                        </div>
                    </div>
                    <div class="notification-controls">
                        <button class="btn-icon" onclick="markAsRead('NOT001')" title="Mark as Read">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn-icon" onclick="deleteNotification('NOT001')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="notification-item unread" data-category="bookings">
                    <div class="notification-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <h4>New Booking Request</h4>
                            <div class="notification-meta">
                                <span class="priority medium">Medium Priority</span>
                                <span class="time">4 hours ago</span>
                            </div>
                        </div>
                        <p>New booking request for Unit B-205 in Green Valley. Customer: Jane Smith</p>
                        <div class="notification-actions">
                            <button class="btn-small btn-primary" onclick="viewBookingDetails('BOOK001')">
                                View Booking
                            </button>
                            <button class="btn-small btn-success" onclick="approveBooking('BOOK001')">
                                Approve
                            </button>
                        </div>
                    </div>
                    <div class="notification-controls">
                        <button class="btn-icon" onclick="markAsRead('NOT002')" title="Mark as Read">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn-icon" onclick="deleteNotification('NOT002')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="notification-item read" data-category="system">
                    <div class="notification-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <h4>System Maintenance Completed</h4>
                            <div class="notification-meta">
                                <span class="priority low">Low Priority</span>
                                <span class="time">1 day ago</span>
                            </div>
                        </div>
                        <p>Scheduled system maintenance has been completed successfully. All services are now operational.</p>
                    </div>
                    <div class="notification-controls">
                        <button class="btn-icon" onclick="markAsUnread('NOT003')" title="Mark as Unread">
                            <i class="fas fa-undo"></i>
                        </button>
                        <button class="btn-icon" onclick="deleteNotification('NOT003')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="notification-item unread" data-category="reminders">
                    <div class="notification-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <h4>Payment Due Reminder</h4>
                            <div class="notification-meta">
                                <span class="priority medium">Medium Priority</span>
                                <span class="time">6 hours ago</span>
                            </div>
                        </div>
                        <p>Payment for Unit C-301 in Royal Gardens is due in 3 days. Customer: Mike Johnson</p>
                        <div class="notification-actions">
                            <button class="btn-small btn-primary" onclick="viewPaymentDetails('PAY002')">
                                View Details
                            </button>
                            <button class="btn-small btn-outline" onclick="sendReminder('PAY002')">
                                Send Reminder
                            </button>
                        </div>
                    </div>
                    <div class="notification-controls">
                        <button class="btn-icon" onclick="markAsRead('NOT004')" title="Mark as Read">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn-icon" onclick="deleteNotification('NOT004')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="notification-item read" data-category="payments">
                    <div class="notification-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <h4>Payment Received</h4>
                            <div class="notification-meta">
                                <span class="priority low">Low Priority</span>
                                <span class="time">2 days ago</span>
                            </div>
                        </div>
                        <p>Payment of ₹50,000 received for Unit A-101. Transaction ID: TXN123456</p>
                        <div class="notification-actions">
                            <button class="btn-small btn-primary" onclick="viewPaymentDetails('PAY003')">
                                View Receipt
                            </button>
                        </div>
                    </div>
                    <div class="notification-controls">
                        <button class="btn-icon" onclick="markAsUnread('NOT005')" title="Mark as Unread">
                            <i class="fas fa-undo"></i>
                        </button>
                        <button class="btn-icon" onclick="deleteNotification('NOT005')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="notifications-footer">
                <div class="pagination">
                    <button class="btn btn-outline" onclick="previousPage()">
                        <i class="fas fa-chevron-left"></i> Previous
                    </button>
                    <span class="page-info">Page 1 of 3</span>
                    <button class="btn btn-outline" onclick="nextPage()">
                        Next <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Compose Notification Modal -->
<div class="modal" id="composeModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Send Notification</h3>
            <button class="modal-close" onclick="closeComposeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Recipients *</label>
                <select class="form-control" id="recipients" multiple>
                    <option value="all-users">All Users</option>
                    <option value="all-customers">All Customers</option>
                    <option value="specific-user">Specific User</option>
                    <option value="user-role">By User Role</option>
                </select>
            </div>
            <div class="form-group">
                <label>Category *</label>
                <select class="form-control" id="category" required>
                    <option value="">Select Category</option>
                    <option value="payments">Payments</option>
                    <option value="bookings">Bookings</option>
                    <option value="system">System</option>
                    <option value="reminders">Reminders</option>
                    <option value="announcements">Announcements</option>
                </select>
            </div>
            <div class="form-group">
                <label>Priority *</label>
                <select class="form-control" id="priority" required>
                    <option value="low">Low Priority</option>
                    <option value="medium">Medium Priority</option>
                    <option value="high">High Priority</option>
                </select>
            </div>
            <div class="form-group">
                <label>Title *</label>
                <input type="text" class="form-control" id="notificationTitle" placeholder="Enter notification title" required>
            </div>
            <div class="form-group">
                <label>Message *</label>
                <textarea class="form-control" id="notificationMessage" rows="4" placeholder="Enter notification message" required></textarea>
            </div>
            <div class="form-group">
                <label>Schedule Delivery</label>
                <div class="schedule-options">
                    <label class="radio-label">
                        <input type="radio" name="schedule" value="now" checked> Send Now
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="schedule" value="later"> Schedule for Later
                    </label>
                </div>
                <div class="schedule-datetime" id="scheduleDateTime" style="display: none;">
                    <input type="datetime-local" class="form-control" id="scheduleTime">
                </div>
            </div>
            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="emailNotification"> Send email notification
                </label>
            </div>
            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" id="smsNotification"> Send SMS notification
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeComposeModal()">Cancel</button>
            <button class="btn btn-primary" onclick="sendNotification()">Send Notification</button>
        </div>
    </div>
</div>

<style>
.notifications-dashboard {
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

.stat-icon.unread {
    background: #dc3545;
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

.notifications-container {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 2rem;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.notifications-sidebar {
    background: #f8f9fa;
    padding: 1.5rem;
    border-right: 1px solid #eee;
}

.notification-filters h3 {
    margin: 0 0 1rem 0;
    color: var(--secondary-color);
    font-size: 1.1rem;
}

.filter-group {
    margin-bottom: 2rem;
}

.filter-group h4 {
    margin: 0 0 0.5rem 0;
    color: #666;
    font-size: 0.9rem;
    font-weight: 600;
}

.filter-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: 0.75rem;
    border: none;
    background: none;
    text-align: left;
    cursor: pointer;
    border-radius: 6px;
    margin-bottom: 0.25rem;
    transition: all 0.3s ease;
    color: #666;
}

.filter-btn:hover {
    background: white;
    color: var(--primary-color);
}

.filter-btn.active {
    background: var(--primary-color);
    color: white;
}

.filter-btn i {
    margin-right: 0.5rem;
}

.filter-btn .count {
    background: rgba(255,255,255,0.2);
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.8rem;
}

.filter-btn.active .count {
    background: rgba(255,255,255,0.3);
}

.notifications-main {
    padding: 1.5rem;
}

.notifications-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    gap: 1rem;
}

.search-bar {
    position: relative;
    flex: 1;
    max-width: 400px;
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

.sort-options select {
    min-width: 150px;
}

.notifications-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 2rem;
}

.notification-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    border: 1px solid #eee;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
}

.notification-item.unread {
    background: #f8f9ff;
    border-left: 4px solid var(--primary-color);
}

.notification-item.high-priority {
    border-left-color: #dc3545;
}

.notification-item:hover {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.notification-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--primary-color);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.notification-content {
    flex: 1;
}

.notification-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 0.5rem;
}

.notification-header h4 {
    margin: 0;
    color: var(--secondary-color);
    font-size: 1rem;
}

.notification-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.priority {
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.priority.high {
    background: #fee;
    color: #dc3545;
}

.priority.medium {
    background: #fff3cd;
    color: #856404;
}

.priority.low {
    background: #d1ecf1;
    color: #0c5460;
}

.time {
    color: #666;
    font-size: 0.85rem;
}

.notification-content p {
    margin: 0 0 1rem 0;
    color: #666;
    line-height: 1.5;
}

.notification-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-small {
    padding: 0.375rem 0.75rem;
    font-size: 0.8rem;
    border-radius: 4px;
}

.notification-controls {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.notifications-footer {
    display: flex;
    justify-content: center;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.pagination {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.page-info {
    color: #666;
    font-size: 0.9rem;
}

.schedule-options {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

.radio-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
}

.schedule-datetime {
    margin-top: 0.5rem;
}

@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .notifications-container {
        grid-template-columns: 1fr;
    }
    
    .notifications-sidebar {
        border-right: none;
        border-bottom: 1px solid #eee;
    }
    
    .notifications-header {
        flex-direction: column;
        align-items: stretch;
    }
    
    .notification-item {
        flex-direction: column;
        gap: 1rem;
    }
    
    .notification-header {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .notification-meta {
        justify-content: flex-start;
    }
    
    .notification-controls {
        flex-direction: row;
        justify-content: center;
    }
    
    .schedule-options {
        flex-direction: column;
    }
}
</style>

<script>
function filterNotifications(filter) {
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    event.target.classList.add('active');
    
    console.log('Filtering notifications by:', filter);
}

function openComposeModal() {
    document.getElementById('composeModal').style.display = 'flex';
}

function closeComposeModal() {
    document.getElementById('composeModal').style.display = 'none';
}

function sendNotification() {
    const recipients = document.getElementById('recipients').value;
    const category = document.getElementById('category').value;
    const priority = document.getElementById('priority').value;
    const title = document.getElementById('notificationTitle').value;
    const message = document.getElementById('notificationMessage').value;
    
    if (!category || !priority || !title || !message) {
        alert('Please fill all required fields');
        return;
    }
    
    console.log('Sending notification:', { recipients, category, priority, title, message });
    closeComposeModal();
}

function markAsRead(notificationId) {
    console.log('Marking as read:', notificationId);
}

function markAsUnread(notificationId) {
    console.log('Marking as unread:', notificationId);
}

function deleteNotification(notificationId) {
    if (confirm('Are you sure you want to delete this notification?')) {
        console.log('Deleting notification:', notificationId);
    }
}

function markAllAsRead() {
    if (confirm('Mark all notifications as read?')) {
        console.log('Marking all as read');
    }
}

function viewPaymentDetails(paymentId) {
    console.log('Viewing payment details:', paymentId);
}

function viewBookingDetails(bookingId) {
    console.log('Viewing booking details:', bookingId);
}

function sendReminder(paymentId) {
    console.log('Sending reminder for:', paymentId);
}

function approveBooking(bookingId) {
    if (confirm('Approve this booking?')) {
        console.log('Approving booking:', bookingId);
    }
}

function previousPage() {
    console.log('Previous page');
}

function nextPage() {
    console.log('Next page');
}

// Schedule delivery toggle
document.addEventListener('DOMContentLoaded', function() {
    const scheduleRadios = document.querySelectorAll('input[name="schedule"]');
    const scheduleDateTime = document.getElementById('scheduleDateTime');
    
    scheduleRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'later') {
                scheduleDateTime.style.display = 'block';
            } else {
                scheduleDateTime.style.display = 'none';
            }
        });
    });
});
</script>

<?php include '../includes/footer.php'; ?>