import React, { useEffect, useMemo, useState } from 'react';
import styled from 'styled-components';
import { NavLink, useLocation } from 'react-router-dom';
import { IoChevronDown, IoChevronForward } from 'react-icons/io5';

const SidebarContainer = styled.div`
  width: 280px; /* widened sidebar for improved readability */
  height: 100vh; /* stretch fully with no extra spacing around */
  background-color: ${props => props.theme.colors.secondary};
  color: white;
  padding: 1.25rem 1rem; /* inner padding for readability */
  border-radius: 0; /* no rounded edges; flush layout */
  font-family: 'Lexend', sans-serif;
`;

const Logo = styled.div`
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 2rem;
  color: ${props => props.theme.colors.primary};
`;

const NavList = styled.ul`
  list-style: none;
  padding: 0;
`;

const NavItem = styled.li`
  margin-bottom: 0.5rem;
`;

const ModuleHeader = styled.div.withConfig({
  shouldForwardProp: (prop) => !['isActive'].includes(prop),
})`
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.75rem 1rem;
  color: white;
  cursor: pointer;
  border-radius: 4px;
  transition: background-color 0.2s;

  &:hover {
    background-color: rgba(255, 255, 255, 0.1);
  }

  ${props => props.isActive && `
    background-color: rgba(255, 255, 255, 0.1);
  `}
`;

const SubMenu = styled.ul.withConfig({
  shouldForwardProp: (prop) => !['isOpen'].includes(prop),
})`
  list-style: none;
  padding-left: 1.5rem;
  margin-top: 0.5rem;
  display: ${props => props.isOpen ? 'block' : 'none'};
`;

const StyledNavLink = styled(NavLink)`
  color: white;
  text-decoration: none;
  padding: 0.5rem 1rem;
  display: block;
  border-radius: 4px;
  font-size: 0.85rem; /* slightly reduced link font size */

  &:hover {
    background-color: rgba(255, 255, 255, 0.1);
    text-decoration: none;
  }

  &.active {
    background-color: ${props => props.theme.colors.primary};
    color: white;
  }
`;

/**
 * ModuleItem
 * Purpose: Render a top-level sidebar module with collapsible sublinks.
 * Inputs:
 *  - label: display string (e.g., '📋 CUSTOMERS')
 *  - slug: base path for routing (e.g., 'customers')
 *  - sublinks: array of { label, path } items
 * Outputs: Collapsible section with NavLink items; auto-opens when the current route is within the module.
 */
const ModuleItem = ({ label, slug, sublinks }) => {
  const location = useLocation();
  const isInModule = useMemo(() => location.pathname.startsWith(`/${slug}`), [location.pathname, slug]);
  const [isOpen, setIsOpen] = useState(isInModule);

  useEffect(() => {
    // Keep module expanded while navigating inside it
    if (isInModule) setIsOpen(true);
  }, [isInModule]);

  return (
    <NavItem>
      <ModuleHeader onClick={() => setIsOpen(!isOpen)} isActive={isOpen}>
        <span>{label}</span>
        {isOpen ? <IoChevronDown /> : <IoChevronForward />}
      </ModuleHeader>
      <SubMenu isOpen={isOpen}>
        {sublinks.map((link, index) => (
          <NavItem key={index}>
            <StyledNavLink to={`/${slug}${link.path ? `/${link.path}` : ''}`}>
              {link.label}
            </StyledNavLink>
          </NavItem>
        ))}
      </SubMenu>
    </NavItem>
  );
};

/**
 * Sidebar
 * Purpose: Render the side links bar with module navigation aligned to PMS.
 * Inputs: None.
 * Outputs: Sidebar navigation with groups and branded styling.
 */
const Sidebar = () => {
  const modules = [
    {
      label: '🏠 DASHBOARD',
      slug: 'dashboard',
      sublinks: [
        { label: 'Home Overview', path: '' },
      ],
    },
    {
      label: '📋 CUSTOMERS',
      slug: 'customers',
      sublinks: [
        { label: 'All Customers', path: 'all-customers' },
        { label: 'Active Customers', path: 'active-customers' },
        { label: 'Blocked Customers', path: 'blocked-customers' },
        { label: 'Member Directory', path: 'member-directory' },
        { label: 'Member Segments', path: 'member-segments' },
        { label: 'Member Import/Bulk Actions', path: 'member-import-bulk-actions' },
      ],
    },
    {
      label: '🏘️ PROPERTY',
      slug: 'property',
      sublinks: [
        { label: 'Projects', path: 'projects' },
        { label: 'Inventory Status', path: 'inventory-status' },
        { label: 'Price Management', path: 'price-management' },
        { label: 'Availability Matrix', path: 'availability-matrix' },
      ],
    },
    {
      label: '💳 PAYMENTS',
      slug: 'payments',
      sublinks: [
        { label: 'Collections', path: 'collections' },
        { label: 'Dues & Defaulters', path: 'dues-defaulters' },
        { label: 'Waivers & Adjustments', path: 'waivers-adjustments' },
        { label: 'NDC Management', path: 'ndc-management' },
        { label: 'Refunds', path: 'refunds' },
        { label: 'Financial Ledger', path: 'financial-ledger' },
      ],
    },
    {
      label: '📅 SCHEDULE',
      slug: 'schedule',
      sublinks: [
        { label: 'Bookings', path: 'bookings' },
        { label: 'Holds Management', path: 'holds-management' },
        { label: 'Possession', path: 'possession' },
        { label: 'Booking Approvals', path: 'booking-approvals' },
        { label: 'Payment Schedule Editor', path: 'payment-schedule-editor' },
      ],
    },
    {
      label: '🔄 TRANSFER',
      slug: 'transfer',
      sublinks: [
        { label: 'Transfer Requests', path: 'transfer-requests' },
        { label: 'Transfer Approvals', path: 'transfer-approvals' },
      ],
    },
    {
      label: '📊 REPORTS',
      slug: 'reports',
      sublinks: [
        { label: 'Sales Analytics', path: 'sales-analytics' },
        { label: 'Collections Analytics', path: 'collections-analytics' },
        { label: 'Dues Analysis', path: 'dues-analysis' },
        { label: 'Possession Status', path: 'possession-status' },
        { label: 'Transfer Summary', path: 'transfer-summary' },
        { label: 'Custom Reports', path: 'custom-reports' },
      ],
    },
    {
      label: '🤖 AI & AUTOMATION (NEW)',
      slug: 'ai-automation',
      sublinks: [
        { label: 'Lead Scoring', path: 'lead-scoring' },
        { label: 'Collection Prediction', path: 'collection-prediction' },
        { label: 'Anomaly Detection', path: 'anomaly-detection' },
        { label: 'Automated Reminders', path: 'automated-reminders' },
        { label: 'Smart Recommendations', path: 'smart-recommendations' },
        { label: 'Audit Trail (AI Actions)', path: 'audit-trail-ai-actions' },
      ],
    },
    {
      label: '⚙️ SETTINGS',
      slug: 'settings',
      sublinks: [
        { label: 'Company Settings', path: 'company-settings' },
        { label: 'Business Rules', path: 'business-rules' },
        { label: 'Payment Configuration', path: 'payment-configuration' },
        { label: 'Notification Rules', path: 'notification-rules' },
        { label: 'Users & Roles', path: 'users-roles' },
        { label: 'Approval Workflows', path: 'approval-workflows' },
        { label: 'System Configuration', path: 'system-configuration' },
        { label: 'Compliance Configuration (NEW)', path: 'compliance-configuration' },
      ],
    },
    {
      label: '🔐 COMPLIANCE',
      slug: 'compliance',
      sublinks: [
        { label: 'Audit Trail', path: 'audit-trail' },
        { label: 'Approval Queue', path: 'approval-queue' },
        { label: 'Compliance Events', path: 'compliance-events' },
        { label: 'Data Management', path: 'data-management' },
        { label: 'Risk Assessment', path: 'risk-assessment' },
        { label: 'Policy Monitoring', path: 'policy-monitoring' },
        { label: 'Compliance Reports', path: 'compliance-reports' },
      ],
    },
    {
      label: '📞 SUPPORT & HELP',
      slug: 'support',
      sublinks: [
        { label: 'Documentation', path: 'documentation' },
        { label: 'FAQs', path: 'faqs' },
        { label: 'Contact Support', path: 'contact-support' },
        { label: 'System Status', path: 'system-status' },
      ],
    },
  ];

  return (
    <SidebarContainer>
      <Logo>PMS</Logo>
      <NavList>
        {modules.map((m, index) => (
          <ModuleItem 
            key={index}
            label={m.label}
            slug={m.slug}
            sublinks={m.sublinks}
          />
        ))}
      </NavList>
    </SidebarContainer>
  );
};

export default Sidebar;