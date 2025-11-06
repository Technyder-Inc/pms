import React, { useEffect, useMemo, useState } from 'react';
import styled from 'styled-components';
import { NavLink, useLocation } from 'react-router-dom';
import { IoChevronDown, IoChevronForward } from 'react-icons/io5';
import {
  FiHome,
  FiUsers,
  FiLayers,
  FiCreditCard,
  FiCalendar,
  FiRepeat,
  FiBarChart2,
  FiCpu,
  FiSettings,
  FiShield,
  FiHelpCircle,
  FiChevronLeft,
} from 'react-icons/fi';

const SidebarContainer = styled.div`
  width: 280px; /* widened sidebar for improved readability */
  height: 100vh; /* stretch fully with no extra spacing around */
  background-color: ${props => props.theme.colors.secondary};
  color: white;
  padding: 1.25rem 1rem; /* inner padding for readability */
  border-radius: 0; /* no rounded edges; flush layout */
  font-family: 'Lexend', sans-serif;
  overflow-y: auto; /* allow scrolling so bottom links are visible */
  overscroll-behavior: contain; /* prevent scroll chaining */
`;

const Logo = styled.div`
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 2rem;
  color: ${props => props.theme.colors.primary};
`;

const ToggleRow = styled.div`
  display: flex;
  justify-content: flex-end;
  margin-bottom: 0.75rem;
`;

const ToggleButton = styled.button`
  background: transparent;
  color: ${p => p.theme.colors.primary};
  border: 1px solid ${p => p.theme.colors.primary};
  border-radius: 6px;
  width: 28px;
  height: 28px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-family: 'Lexend', sans-serif;
  transition: all 0.15s ease-in-out;
  &:hover { background: ${p => p.theme.colors.primary}; color: #fff; }
`;

const NavList = styled.ul`
  list-style: none;
  padding: 0;
`;

const NavItem = styled.li`
  margin-bottom: 0.25rem; /* tighter gap between links */
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

const HeaderLeft = styled.div`
  display: flex;
  align-items: center;
  gap: 0.5rem;
  & > span { font-size: 0.8rem; }
`;

const IconBox = styled.span`
  display: inline-flex;
  align-items: center;
  justify-content: center;
  color: #ffffff; /* icon color to white as requested */
`;

const SubMenu = styled.ul.withConfig({
  shouldForwardProp: (prop) => !['isOpen'].includes(prop),
})`
  list-style: none;
  padding-left: 1rem; /* slightly reduced indent */
  margin-top: 0.25rem; /* tighter spacing above submenu */
  display: ${props => props.isOpen ? 'block' : 'none'};
`;

const StyledNavLink = styled(NavLink)`
  color: white;
  text-decoration: none;
  padding: 0.4rem 0.75rem; /* restored padding */
  display: block;
  border-radius: 4px;
  font-size: 0.83rem; /* restored sublink font size */

  &:hover {
    background-color: rgba(221, 156, 107, 0.12); /* brand primary tint */
    text-decoration: none;
  }

  &.active {
    background-color: rgba(221, 156, 107, 0.18); /* subtle active background */
    color: ${props => props.theme.colors.primary}; /* brand-matching active text */
    border-left: 3px solid ${props => props.theme.colors.primary}; /* active accent */
  }
`;

/**
 * ModuleItem
 * Purpose: Render a top-level sidebar module with collapsible sublinks.
 * Inputs:
 *  - label: display string (e.g., 'CUSTOMERS')
 *  - slug: base path for routing (e.g., 'customers')
 *  - sublinks: array of { label, path } items
 *  - icon: React component for vector icon (e.g., FiUsers)
 * Outputs: Collapsible section with NavLink items; auto-opens when the current route is within the module.
 */
const ModuleItem = ({ label, slug, sublinks, icon: Icon }) => {
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
        <HeaderLeft>
          {Icon && (
            <IconBox>
              <Icon size={18} />
            </IconBox>
          )}
          <span>{label}</span>
        </HeaderLeft>
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
 * Inputs:
 *  - onToggleLinksBar: function to hide/unhide the links bar
 * Outputs: Sidebar navigation with groups and branded styling.
 */
const Sidebar = ({ onToggleLinksBar }) => {
  const modules = [
    {
      label: 'DASHBOARD',
      slug: 'dashboard',
      icon: FiHome,
      sublinks: [
        { label: 'Home Overview', path: '' },
      ],
    },
    {
      label: 'CUSTOMERS',
      slug: 'customers',
      icon: FiUsers,
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
      label: 'PROPERTY',
      slug: 'property',
      icon: FiLayers,
      sublinks: [
        { label: 'Projects', path: 'projects' },
        { label: 'Inventory Status', path: 'inventory-status' },
        { label: 'Price Management', path: 'price-management' },
        { label: 'Availability Matrix', path: 'availability-matrix' },
      ],
    },
    {
      label: 'PAYMENTS',
      slug: 'payments',
      icon: FiCreditCard,
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
      label: 'SCHEDULE',
      slug: 'schedule',
      icon: FiCalendar,
      sublinks: [
        { label: 'Bookings', path: 'bookings' },
        { label: 'Holds Management', path: 'holds-management' },
        { label: 'Possession', path: 'possession' },
        { label: 'Booking Approvals', path: 'booking-approvals' },
        { label: 'Payment Schedule Editor', path: 'payment-schedule-editor' },
      ],
    },
    {
      label: 'TRANSFER',
      slug: 'transfer',
      icon: FiRepeat,
      sublinks: [
        { label: 'Transfer Requests', path: 'transfer-requests' },
        { label: 'Transfer Approvals', path: 'transfer-approvals' },
      ],
    },
    {
      label: 'REPORTS',
      slug: 'reports',
      icon: FiBarChart2,
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
      label: 'AI & AUTOMATION (NEW)',
      slug: 'ai-automation',
      icon: FiCpu,
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
      label: 'SETTINGS',
      slug: 'settings',
      icon: FiSettings,
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
      label: 'COMPLIANCE',
      slug: 'compliance',
      icon: FiShield,
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
      label: 'SUPPORT & HELP',
      slug: 'support',
      icon: FiHelpCircle,
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
      <ToggleRow>
        <ToggleButton aria-label="Close sidebar" title="Close sidebar" onClick={onToggleLinksBar}>
          <FiChevronLeft size={16} />
        </ToggleButton>
      </ToggleRow>
      <Logo>PMS</Logo>
      <NavList>
        {modules.map((m, index) => (
          <ModuleItem 
            key={index}
            label={m.label}
            slug={m.slug}
            icon={m.icon}
            sublinks={m.sublinks}
          />
        ))}
      </NavList>
    </SidebarContainer>
  );
};

export default Sidebar;