/* Enterprise PMS - Main JavaScript */
/* Handles sidebar, theme toggle, form interactions, and data rendering */

(function() {
  'use strict';

  // Constants
  const STORAGE_KEYS = {
    SIDEBAR_COLLAPSED: 'pms.sidebar.expanded',
    THEME: 'pms.theme'
  };

  // Configuration for region and feature toggles
  const CONFIG = {
    region: { hasPhase: true },
    modulesEnabled: { ndc: true, transfers: true, migration: true }
  };

  // Function to set active navigation item based on current page
  function setActiveNavItem() {
    const currentPage = window.location.pathname.split('/').pop() || 'index.php';
    const navItems = document.querySelectorAll('.nav-item');
    
    navItems.forEach(item => {
      item.classList.remove('active');
      const href = item.getAttribute('href');
      if (href && (href === currentPage || (currentPage === '' && href === 'index.php'))) {
        item.classList.add('active');
      }
    });
  }

  // Module sub-navigation definitions
  const MODULE_SUBNAV = {
    dashboard: [],
    customers: [
      { id: 'list', label: 'List', href: '#list' },
      { id: 'new', label: 'New', href: '#new' },
      { id: 'view', label: 'View', href: '#view' },
      { id: 'kyc', label: 'KYC Status', href: '#kyc' },
      { id: 'attachments', label: 'Attachments', href: '#attachments' }
    ],
    leads: [
      { id: 'list', label: 'List', href: '#list' },
      { id: 'new', label: 'New', href: '#new' },
      { id: 'qualification', label: 'Qualification', href: '#qualification' },
      { id: 'booking', label: 'Booking Initiation', href: '#booking' }
    ],
    inventory: [
      { id: 'projects', label: 'Projects', href: '#projects' },
      ...(CONFIG.region.hasPhase ? [{ id: 'phases', label: 'Phases', href: '#phases' }] : []),
      { id: 'blocks', label: 'Blocks/Sectors', href: '#blocks' },
      { id: 'units', label: 'Units', href: '#units' }
    ],
    bookings: [
      { id: 'allotments', label: 'Allotments', href: '#allotments' },
      { id: 'payment-plans', label: 'Payment Plans', href: '#payment-plans' },
      { id: 'schedule', label: 'Schedule Preview', href: '#schedule' }
    ],
    finance: [
      { id: 'receipts', label: 'Receipts', href: '#receipts' },
      { id: 'ledger', label: 'Customer Ledger', href: '#ledger' }
    ],
    compliance: [
      { id: 'holds', label: 'Holds/Reservations', href: '#holds' },
      { id: 'blocks', label: 'Blocks/Unblocks', href: '#blocks' },
      ...(CONFIG.modulesEnabled.ndc ? [{ id: 'ndc', label: 'NDC', href: '#ndc' }] : []),
      ...(CONFIG.modulesEnabled.transfers ? [{ id: 'transfers', label: 'Transfers', href: '#transfers' }] : []),
      ...(CONFIG.modulesEnabled.migration ? [{ id: 'migration', label: 'Migration', href: '#migration' }] : []),
      { id: 'ownership', label: 'Ownership History', href: '#ownership' }
    ],
    reports: [
      { id: 'sales', label: 'Sales Reports', href: '#sales' },
      { id: 'financial', label: 'Financial Reports', href: '#financial' },
      { id: 'inventory', label: 'Inventory Reports', href: '#inventory' },
      { id: 'customer', label: 'Customer Reports', href: '#customer' },
      { id: 'compliance', label: 'Compliance Reports', href: '#compliance' }
    ],
    settings: [
      { id: 'company', label: 'Company Branding', href: '#company' },
      { id: 'region', label: 'Region Settings', href: '#region' },
      { id: 'sequences', label: 'Numbering Sequences', href: '#sequences' },
      { id: 'users', label: 'Users & Roles', href: '#users' },
      { id: 'notifications', label: 'Notifications', href: '#notifications' }
    ],
    audit: [
      { id: 'logs', label: 'Audit Log', href: '#logs' }
    ]
  };

  // Sample data for customers
  const SAMPLE_CUSTOMERS = [
    {
      id: 101,
      kind: 'person',
      first_name: 'Ahsan',
      last_name: 'Ul Haq',
      primary_contact: '+92 300 1234567',
      email: 'ahsan@example.com',
      kyc_status: 'pending',
      created_on: '2025-09-10'
    },
    {
      id: 102,
      kind: 'organization',
      org_name: 'Technyder Holdings',
      primary_contact: '+971 50 9876543',
      email: 'ops@technyder.co',
      kyc_status: 'approved',
      created_on: '2025-09-11'
    },
    {
      id: 103,
      kind: 'person',
      first_name: 'Amna',
      last_name: 'Khan',
      primary_contact: '+92 333 7654321',
      email: 'amna.khan@example.com',
      kyc_status: 'rejected',
      created_on: '2025-09-12'
    }
  ];

  // Utility functions
  function getFromStorage(key, defaultValue = null) {
    try {
      const value = localStorage.getItem(key);
      return value ? JSON.parse(value) : defaultValue;
    } catch {
      return defaultValue;
    }
  }

  function setToStorage(key, value) {
    try {
      localStorage.setItem(key, JSON.stringify(value));
    } catch {
      // Silently fail if localStorage is not available
    }
  }

  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'short',
      day: 'numeric'
    });
  }

  function normalizePhone(phone) {
    return phone.replace(/[\s-]/g, '');
  }

  function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  // Sidebar functionality
  function initSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const toggleBtn = document.querySelector('#sidebarToggle');
    const mainContent = document.querySelector('.main-content');
    
    if (!sidebar || !toggleBtn) return;

    // Load saved state
    const isCollapsed = getFromStorage(STORAGE_KEYS.SIDEBAR_COLLAPSED, false);
    if (isCollapsed) {
      sidebar.classList.add('collapsed');
      if (mainContent) {
        mainContent.classList.add('sidebar-collapsed');
      }
      // Set initial icon rotation
      const toggleIcon = toggleBtn.querySelector('.toggle-icon');
      if (toggleIcon) {
        toggleIcon.style.setProperty('transform', 'rotate(180deg)', 'important');
      }
    }

    // Toggle functionality
    function toggleSidebar() {
      const isCurrentlyCollapsed = sidebar.classList.contains('collapsed');
      sidebar.classList.toggle('collapsed');
      
      // Update main content margin
      if (mainContent) {
        if (sidebar.classList.contains('collapsed')) {
          mainContent.classList.add('sidebar-collapsed');
        } else {
          mainContent.classList.remove('sidebar-collapsed');
        }
      }
      
      setToStorage(STORAGE_KEYS.SIDEBAR_COLLAPSED, !isCurrentlyCollapsed);
      
      // Update ARIA
      toggleBtn.setAttribute('aria-expanded', isCurrentlyCollapsed ? 'true' : 'false');
      
      // Update toggle icon rotation
      const toggleIcon = toggleBtn.querySelector('.toggle-icon');
      if (toggleIcon) {
        if (sidebar.classList.contains('collapsed')) {
          toggleIcon.style.setProperty('transform', 'rotate(180deg)', 'important');
        } else {
          toggleIcon.style.setProperty('transform', 'rotate(0deg)', 'important');
        }
      }
    }

    toggleBtn.addEventListener('click', toggleSidebar);

    // Mobile overlay functionality
    function handleMobileMenu() {
      if (window.innerWidth <= 768) {
        sidebar.classList.remove('collapsed');
        
        // Close on outside click
        document.addEventListener('click', function(e) {
          if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
            sidebar.classList.remove('open');
            document.body.classList.remove('sidebar-open');
          }
        });

        toggleBtn.addEventListener('click', function() {
          sidebar.classList.toggle('open');
          document.body.classList.toggle('sidebar-open');
        });
      }
    }

    handleMobileMenu();
    window.addEventListener('resize', handleMobileMenu);
  }

  // Theme functionality
  function initTheme() {
    const themeToggle = document.querySelector('.theme-toggle');
    if (!themeToggle) return;

    // Load saved theme
    const savedTheme = getFromStorage(STORAGE_KEYS.THEME, 'light');
    document.documentElement.setAttribute('data-theme', savedTheme);
    updateThemeToggleIcon(savedTheme);

    themeToggle.addEventListener('click', function() {
      const currentTheme = document.documentElement.getAttribute('data-theme');
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      
      document.documentElement.setAttribute('data-theme', newTheme);
      setToStorage(STORAGE_KEYS.THEME, newTheme);
      updateThemeToggleIcon(newTheme);
    });
  }

  function updateThemeToggleIcon(theme) {
    const themeToggle = document.querySelector('.theme-toggle');
    if (!themeToggle) return;

    const icon = theme === 'dark' 
      ? '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>'
      : '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>';
    
    themeToggle.innerHTML = icon;
  }

  // Keyboard shortcuts
  function initKeyboardShortcuts() {
    document.addEventListener('keydown', function(e) {
      // '[' key to toggle sidebar
      if (e.key === '[' && !e.target.matches('input, textarea, select')) {
        e.preventDefault();
        const toggleBtn = document.querySelector('#sidebarToggle');
        if (toggleBtn) toggleBtn.click();
      }
      
      // '?' key for help (placeholder)
      if (e.key === '?' && !e.target.matches('input, textarea, select')) {
        e.preventDefault();
        alert('Keyboard shortcuts:\n[ - Toggle sidebar\n? - Show this help');
      }
    });
  }

  // Customer list functionality
  function initCustomersList() {
    const tableBody = document.querySelector('#customers-table-body');
    const searchInput = document.querySelector('#search-input');
    const kycFilter = document.querySelector('#kyc-filter');
    const kindFilter = document.querySelector('#kind-filter');
    const emptyState = document.querySelector('.empty-state');
    
    if (!tableBody) return;

    let filteredCustomers = [...SAMPLE_CUSTOMERS];

    function renderCustomers(customers) {
      if (customers.length === 0) {
        tableBody.innerHTML = '';
        if (emptyState) emptyState.style.display = 'block';
        return;
      }

      if (emptyState) emptyState.style.display = 'none';

      tableBody.innerHTML = customers.map(customer => {
        const name = customer.kind === 'person' 
          ? `${customer.first_name} ${customer.last_name}`
          : customer.org_name;
        
        const type = customer.kind === 'person' ? 'Person' : 'Organization';
        
        return `
          <tr>
            <td>
              <div>
                <div class="font-weight-500">${name}</div>
                <div class="text-sm text-muted">${type}</div>
              </div>
            </td>
            <td>
              <div>
                <div>${customer.primary_contact}</div>
                <div class="text-sm text-muted">${customer.email}</div>
              </div>
            </td>
            <td>
              <span class="chip ${customer.kyc_status}">
                ${customer.kyc_status.charAt(0).toUpperCase() + customer.kyc_status.slice(1)}
              </span>
            </td>
            <td>${formatDate(customer.created_on)}</td>
            <td>
              <div class="flex gap-2">
                <a href="customers-view.html?id=${customer.id}" class="btn btn-sm btn-ghost">View</a>
                <a href="customers-form.html?id=${customer.id}&state=edit" class="btn btn-sm btn-ghost">Edit</a>
              </div>
            </td>
          </tr>
        `;
      }).join('');
    }

    function filterCustomers() {
      const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
      const kycStatus = kycFilter ? kycFilter.value : 'all';
      const kindValue = kindFilter ? kindFilter.value : 'all';

      filteredCustomers = SAMPLE_CUSTOMERS.filter(customer => {
        const name = customer.kind === 'person' 
          ? `${customer.first_name} ${customer.last_name}`.toLowerCase()
          : customer.org_name.toLowerCase();
        
        const matchesSearch = !searchTerm || 
          name.includes(searchTerm) ||
          customer.primary_contact.includes(searchTerm) ||
          customer.email.toLowerCase().includes(searchTerm) ||
          customer.id.toString().includes(searchTerm);
        
        const matchesKyc = kycStatus === 'all' || customer.kyc_status === kycStatus;
        const matchesKind = kindValue === 'all' || customer.kind === kindValue;
        
        return matchesSearch && matchesKyc && matchesKind;
      });

      renderCustomers(filteredCustomers);
    }

    // Event listeners
    if (searchInput) {
      searchInput.addEventListener('input', filterCustomers);
    }
    
    if (kycFilter) {
      kycFilter.addEventListener('change', filterCustomers);
    }
    
    if (kindFilter) {
      kindFilter.addEventListener('change', filterCustomers);
    }

    // Initial render
    renderCustomers(SAMPLE_CUSTOMERS);
  }

  // Form functionality
  function initCustomersForm() {
    const form = document.querySelector('#customer-form');
    const kindRadios = document.querySelectorAll('input[name="kind"]');
    const personFields = document.querySelector('.person-fields');
    const organizationFields = document.querySelector('.organization-fields');
    const presentAddressCheckbox = document.querySelector('#use-present-as-permanent');
    const permanentAddressPreview = document.querySelector('.permanent-address-preview');
    const mobileInput = document.querySelector('#mobile');
    const emailInput = document.querySelector('#email');
    const dedupeAlert = document.querySelector('.dedupe-alert');
    
    if (!form) return;

    // Kind toggle functionality
    function toggleKindFields() {
      const selectedKind = document.querySelector('input[name="kind"]:checked')?.value;
      
      if (personFields && organizationFields) {
        if (selectedKind === 'person') {
          personFields.style.display = 'block';
          organizationFields.style.display = 'none';
        } else {
          personFields.style.display = 'none';
          organizationFields.style.display = 'block';
        }
      }
    }

    kindRadios.forEach(radio => {
      radio.addEventListener('change', toggleKindFields);
    });

    // Present address as permanent
    if (presentAddressCheckbox && permanentAddressPreview) {
      presentAddressCheckbox.addEventListener('change', function() {
        if (this.checked) {
          permanentAddressPreview.style.display = 'block';
          updatePermanentAddressPreview();
        } else {
          permanentAddressPreview.style.display = 'none';
        }
      });
    }

    function updatePermanentAddressPreview() {
      const line1 = document.querySelector('#address-line1')?.value || '';
      const line2 = document.querySelector('#address-line2')?.value || '';
      const city = document.querySelector('#city')?.value || '';
      const state = document.querySelector('#state')?.value || '';
      const postal = document.querySelector('#postal-code')?.value || '';
      const country = document.querySelector('#country')?.value || '';
      
      const previewContent = document.querySelector('.permanent-address-content');
      if (previewContent) {
        previewContent.innerHTML = `
          <div>${line1}</div>
          ${line2 ? `<div>${line2}</div>` : ''}
          <div>${city}${state ? `, ${state}` : ''} ${postal}</div>
          <div>${country}</div>
        `;
      }
    }

    // Address field listeners for preview update
    ['#address-line1', '#address-line2', '#city', '#state', '#postal-code', '#country'].forEach(selector => {
      const field = document.querySelector(selector);
      if (field) {
        field.addEventListener('input', updatePermanentAddressPreview);
      }
    });

    // Dedupe checking
    function checkForDuplicates() {
      const mobile = mobileInput?.value;
      const email = emailInput?.value;
      
      if (!mobile && !email) {
        if (dedupeAlert) dedupeAlert.style.display = 'none';
        return;
      }

      const duplicate = SAMPLE_CUSTOMERS.find(customer => {
        return (mobile && normalizePhone(customer.primary_contact) === normalizePhone(mobile)) ||
               (email && customer.email.toLowerCase() === email.toLowerCase());
      });

      if (duplicate && dedupeAlert) {
        const name = duplicate.kind === 'person' 
          ? `${duplicate.first_name} ${duplicate.last_name}`
          : duplicate.org_name;
        
        const alertContent = dedupeAlert.querySelector('.alert-content');
        if (alertContent) {
          alertContent.textContent = `Possible duplicate found (${name} • ${duplicate.primary_contact}). Continue anyway?`;
        }
        dedupeAlert.style.display = 'flex';
      } else if (dedupeAlert) {
        dedupeAlert.style.display = 'none';
      }
    }

    if (mobileInput) {
      mobileInput.addEventListener('input', checkForDuplicates);
    }
    
    if (emailInput) {
      emailInput.addEventListener('input', checkForDuplicates);
    }

    // Form validation
    function validateForm() {
      let isValid = true;
      const requiredFields = form.querySelectorAll('[required]');
      
      requiredFields.forEach(field => {
        const errorElement = field.parentNode.querySelector('.form-error');
        
        if (!field.value.trim()) {
          field.classList.add('error');
          if (errorElement) {
            errorElement.textContent = 'This field is required';
            errorElement.style.display = 'block';
          }
          isValid = false;
        } else {
          field.classList.remove('error');
          if (errorElement) {
            errorElement.style.display = 'none';
          }
        }
      });

      // Email validation
      if (emailInput && emailInput.value && !validateEmail(emailInput.value)) {
        emailInput.classList.add('error');
        const errorElement = emailInput.parentNode.querySelector('.form-error');
        if (errorElement) {
          errorElement.textContent = 'Please enter a valid email address';
          errorElement.style.display = 'block';
        }
        isValid = false;
      }

      return isValid;
    }

    // Form submission
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      if (validateForm()) {
        alert('Form submitted successfully! (This is a UI-only demo)');
      }
    });

    // Initialize form state
    toggleKindFields();
  }

  // Customer view functionality
  function initCustomersView() {
    const activityList = document.querySelector('.activity-list');
    
    if (activityList) {
      // Generate sample activity data
      const activities = [
        { action: 'Created by Admin', timestamp: '2025-09-12 10:30' },
        { action: 'KYC Status updated to Pending', timestamp: '2025-09-12 10:31' },
        { action: 'Contact information verified', timestamp: '2025-09-12 14:15' }
      ];

      activityList.innerHTML = activities.map(activity => `
        <div class="activity-item">
          <div class="activity-action">${activity.action}</div>
          <div class="activity-timestamp text-sm text-muted">${activity.timestamp}</div>
        </div>
      `).join('');
    }
  }

  // Enhanced Navigation functionality
  function initNavigation() {
    const navItems = document.querySelectorAll('.nav-item');
    const navSections = document.querySelectorAll('.nav-section');
    
    // Add smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';
    
    // Enhanced navigation click handling
    navItems.forEach(item => {
      item.addEventListener('click', function(e) {
        // Don't prevent default for actual links
        if (this.getAttribute('href') !== '#') {
          // Remove active class from all items
          navItems.forEach(nav => nav.classList.remove('active'));
          
          // Add active class to clicked item
          this.classList.add('active');
          
          // Store active navigation state
          localStorage.setItem('activeNav', this.getAttribute('href'));
          
          // Add loading state
          this.style.opacity = '0.7';
          setTimeout(() => {
            this.style.opacity = '1';
          }, 200);
        }
      });
      
      // Add hover effects
      item.addEventListener('mouseenter', function() {
        if (!this.classList.contains('active')) {
          this.style.transform = 'translateX(4px)';
        }
      });
      
      item.addEventListener('mouseleave', function() {
        if (!this.classList.contains('active')) {
          this.style.transform = 'translateX(0)';
        }
      });
    });
    
    // Restore active navigation state
    const activeNav = localStorage.getItem('activeNav');
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    
    if (activeNav) {
      const activeItem = document.querySelector(`[href="${activeNav}"]`);
      if (activeItem) {
        navItems.forEach(nav => nav.classList.remove('active'));
        activeItem.classList.add('active');
      }
    } else {
      // Set active based on current page
      const currentItem = document.querySelector(`[href="${currentPage}"]`);
      if (currentItem) {
        navItems.forEach(nav => nav.classList.remove('active'));
        currentItem.classList.add('active');
      }
    }
    
    // Add section collapse/expand functionality
    navSections.forEach(section => {
      const title = section.querySelector('.nav-section-title');
      const items = section.querySelectorAll('.nav-item');
      
      if (title) {
        title.style.cursor = 'pointer';
        title.addEventListener('click', function() {
          const isCollapsed = section.classList.contains('collapsed');
          
          if (isCollapsed) {
            section.classList.remove('collapsed');
            items.forEach((item, index) => {
              setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
              }, index * 50);
            });
          } else {
            section.classList.add('collapsed');
            items.forEach(item => {
              item.style.opacity = '0.5';
              item.style.transform = 'translateY(-10px)';
            });
          }
        });
      }
    });
  }

  // Horizontal Sub-Navigation System
  function initSubNavigation() {
    const subnavContainer = document.getElementById('module-subnav');
    const subnavList = document.getElementById('subnav-list');
    const sidebarItems = document.querySelectorAll('.nav-item[data-module]');
    const breadcrumbModule = document.querySelector('.breadcrumb-module');
    const breadcrumbSection = document.querySelector('.breadcrumb-section');
    
    if (!subnavContainer || !subnavList) return;
    
    let currentModule = getCurrentModule();
    let currentSection = getCurrentSection();
    let subnavTimeout;
    
    // Get current module from URL
    function getCurrentModule() {
      const path = window.location.pathname;
      const filename = path.split('/').pop() || 'index.html';
      return filename.replace('.html', '') || 'dashboard';
    }
    
    // Get current section from hash
    function getCurrentSection() {
      return window.location.hash.replace('#', '') || 'list';
    }
    
    // Update breadcrumb
    function updateBreadcrumb(module, section) {
      if (breadcrumbModule) {
        breadcrumbModule.textContent = module.charAt(0).toUpperCase() + module.slice(1);
      }
      if (breadcrumbSection && section) {
        const sectionData = MODULE_SUBNAV[module]?.find(s => s.id === section);
        breadcrumbSection.textContent = sectionData ? sectionData.label : section;
      }
    }
    
    // Update document title
    function updateTitle(module, section) {
      const moduleTitle = module.charAt(0).toUpperCase() + module.slice(1);
      const sectionData = MODULE_SUBNAV[module]?.find(s => s.id === section);
      const sectionTitle = sectionData ? sectionData.label : section;
      document.title = `${moduleTitle} — ${sectionTitle} | PMS`;
    }
    
    // Show sub-navigation for a module
    function showSubNav(module) {
      const sections = MODULE_SUBNAV[module] || [];
      
      if (sections.length === 0) {
        hideSubNav();
        return;
      }
      
      // Clear existing items
      subnavList.innerHTML = '';
      
      // Add sections
      sections.forEach((section, index) => {
        const li = document.createElement('li');
        li.setAttribute('role', 'presentation');
        
        const link = document.createElement('a');
        link.href = section.href;
        link.textContent = section.label;
        link.setAttribute('role', 'tab');
        link.setAttribute('aria-selected', section.id === currentSection ? 'true' : 'false');
        link.setAttribute('tabindex', section.id === currentSection ? '0' : '-1');
        link.dataset.section = section.id;
        
        if (section.id === currentSection) {
          link.classList.add('active');
        }
        
        // Click handler
        link.addEventListener('click', function(e) {
          e.preventDefault();
          switchToSection(module, section.id);
        });
        
        li.appendChild(link);
        subnavList.appendChild(li);
      });
      
      // Show container
      document.body.classList.add('show-subnav');
      
      // Set up keyboard navigation
      setupSubNavKeyboard();
    }
    
    // Hide sub-navigation
    function hideSubNav() {
      document.body.classList.remove('show-subnav');
    }
    
    // Switch to a section
    function switchToSection(module, sectionId) {
      currentSection = sectionId;
      
      // Update URL hash
      window.location.hash = sectionId;
      
      // Update active state in subnav
      const subnavLinks = subnavList.querySelectorAll('a');
      subnavLinks.forEach(link => {
        const isActive = link.dataset.section === sectionId;
        link.classList.toggle('active', isActive);
        link.setAttribute('aria-selected', isActive ? 'true' : 'false');
        link.setAttribute('tabindex', isActive ? '0' : '-1');
      });
      
      // Show/hide content sections
      const contentSections = document.querySelectorAll('.content-section');
      contentSections.forEach(section => {
        // Try both patterns: section-{id} and {id}-section
        const shouldShow = section.id === `section-${sectionId}` || section.id === `${sectionId}-section`;
        section.hidden = !shouldShow;
        section.setAttribute('aria-hidden', shouldShow ? 'false' : 'true');
        
        // Also handle the 'hidden' class for backward compatibility
        if (shouldShow) {
          section.classList.remove('hidden');
        } else {
          section.classList.add('hidden');
        }
      });
      
      // Update breadcrumb and title
      updateBreadcrumb(module, sectionId);
      updateTitle(module, sectionId);
      
      // Save to localStorage
      localStorage.setItem(`pms.nav.${module}.section`, sectionId);
    }
    
    // Setup keyboard navigation for subnav
    function setupSubNavKeyboard() {
      const links = subnavList.querySelectorAll('a');
      
      links.forEach((link, index) => {
        link.addEventListener('keydown', function(e) {
          let targetIndex;
          
          switch(e.key) {
            case 'ArrowLeft':
              e.preventDefault();
              targetIndex = index > 0 ? index - 1 : links.length - 1;
              links[targetIndex].focus();
              break;
            case 'ArrowRight':
              e.preventDefault();
              targetIndex = index < links.length - 1 ? index + 1 : 0;
              links[targetIndex].focus();
              break;
            case 'Home':
              e.preventDefault();
              links[0].focus();
              break;
            case 'End':
              e.preventDefault();
              links[links.length - 1].focus();
              break;
          }
        });
      });
    }
    
    // Initialize sidebar hover/focus handlers
    sidebarItems.forEach(item => {
      const module = item.dataset.module;
      
      // Mouse events
      item.addEventListener('mouseenter', function() {
        clearTimeout(subnavTimeout);
        showSubNav(module);
      });
      
      item.addEventListener('mouseleave', function() {
        if (module !== currentModule) {
          subnavTimeout = setTimeout(() => {
            hideSubNav();
          }, 300);
        }
      });
      
      // Focus events
      item.addEventListener('focus', function() {
        clearTimeout(subnavTimeout);
        showSubNav(module);
      });
    });
    
    // Keep subnav visible when hovering over it
    subnavContainer.addEventListener('mouseenter', function() {
      clearTimeout(subnavTimeout);
    });
    
    subnavContainer.addEventListener('mouseleave', function() {
      if (currentModule !== getCurrentModule()) {
        subnavTimeout = setTimeout(() => {
          hideSubNav();
        }, 300);
      }
    });
    
    // Handle hash changes
    window.addEventListener('hashchange', function() {
      const newSection = getCurrentSection();
      if (newSection !== currentSection) {
        switchToSection(currentModule, newSection);
      }
    });
    
    // Initialize on page load
    function initializeSubNav() {
      currentModule = getCurrentModule();
      
      // Restore last visited section from localStorage
      const savedSection = localStorage.getItem(`pms.nav.${currentModule}.section`);
      currentSection = savedSection || getCurrentSection() || 'list';
      
      // Show subnav for current module
      if (MODULE_SUBNAV[currentModule] && MODULE_SUBNAV[currentModule].length > 0) {
        showSubNav(currentModule);
        
        // If no hash, set to current section
        if (!window.location.hash) {
          window.location.hash = currentSection;
        }
        
        // Switch to current section
        switchToSection(currentModule, currentSection);
      } else {
        // Update breadcrumb for modules without subnav
        updateBreadcrumb(currentModule, '');
        updateTitle(currentModule, '');
      }
    }
    
    // Initialize
    initializeSubNav();
  }
  
  // Initialize everything when DOM is ready
  function init() {
    initSidebar();
    initTheme();
    initKeyboardShortcuts();
    initNavigation();
    initSubNavigation();
    setActiveNavItem();
    
    // Page-specific initialization
    if (document.querySelector('#customers-table-body')) {
      initCustomersList();
    }
    
    if (document.querySelector('#customer-form')) {
      initCustomersForm();
    }
    
    if (document.querySelector('.activity-list')) {
      initCustomersView();
    }
  }

  // Wait for DOM to be ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();