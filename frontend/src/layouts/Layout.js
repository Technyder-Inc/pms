import React, { useState } from 'react';
import styled from 'styled-components';
import Sidebar from './Sidebar';
import TopBar from './TopBar';
import { Outlet } from 'react-router-dom';
import { FiChevronRight } from 'react-icons/fi';

// Two-column grid layout:
// - Column 1: Sidebar spans full height with no extra spacing.
// - Column 2: TopBar at the top; main content begins directly below.
const Shell = styled.div`
  display: grid;
  grid-template-columns: ${p => p.$sidebarHidden ? '12px minmax(0, 1fr)' : '280px minmax(0, 1fr)'};
  grid-template-rows: 60px 1fr;
  grid-template-areas:
    'sidebar topbar'
    'sidebar content';
  height: 100vh;
  width: 100%;
  overflow: hidden;
  background-color: ${(p) => p.theme.colors.lightGray};
`;

const SidebarArea = styled.aside`
  grid-area: sidebar;
`;

const TopBarArea = styled.header`
  grid-area: topbar;
`;

const ContentArea = styled.main`
  grid-area: content;
  overflow: auto;
  background: #ffffff;
  padding: 1rem 1.25rem;
`;

const CollapsedHandle = styled.button`
  width: 14px;
  height: 100%;
  background: ${p => p.theme.colors.secondary};
  color: #fff;
  border: none;
  cursor: pointer;
  font-family: 'Lexend', sans-serif;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0.9;
  &:hover { opacity: 1; }
`;

/**
 * Layout
 * Purpose: Render a two-column app shell.
 * Inputs: None.
 * Outputs: Sidebar (full-height, no outer spacing), TopBar in right column, and routed content below TopBar.
 */
/**
 * Layout
 * Purpose: Render a two-column app shell with a hide/unhide toggle for the links bar.
 * Inputs: None.
 * Outputs: Sidebar (can be collapsed), TopBar, and routed content.
 */
const Layout = () => {
  const [isSidebarHidden, setIsSidebarHidden] = useState(false);

  const handleToggleLinksBar = () => {
    setIsSidebarHidden(prev => !prev);
  };

  return (
    <Shell $sidebarHidden={isSidebarHidden}>
      <SidebarArea>
        {isSidebarHidden ? (
          <CollapsedHandle aria-label="Open sidebar" onClick={() => setIsSidebarHidden(false)}>
            <FiChevronRight size={16} />
          </CollapsedHandle>
        ) : (
          <Sidebar onToggleLinksBar={handleToggleLinksBar} />
        )}
      </SidebarArea>
      <TopBarArea>
        <TopBar />
      </TopBarArea>
      <ContentArea>
        <Outlet />
      </ContentArea>
    </Shell>
  );
};

export default Layout;