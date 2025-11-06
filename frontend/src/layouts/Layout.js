import React from 'react';
import styled from 'styled-components';
import Sidebar from './Sidebar';
import TopBar from './TopBar';
import { Outlet } from 'react-router-dom';

// Two-column grid layout:
// - Column 1: Sidebar spans full height with no extra spacing.
// - Column 2: TopBar at the top; main content begins directly below.
const Shell = styled.div`
  display: grid;
  grid-template-columns: 280px minmax(0, 1fr);
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

/**
 * Layout
 * Purpose: Render a two-column app shell.
 * Inputs: None.
 * Outputs: Sidebar (full-height, no outer spacing), TopBar in right column, and routed content below TopBar.
 */
const Layout = () => {
  return (
    <Shell>
      <SidebarArea>
        <Sidebar />
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