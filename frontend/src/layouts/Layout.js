import React from 'react';
import styled from 'styled-components';
import Sidebar from './Sidebar';
import TopBar from './TopBar';
import { Outlet } from 'react-router-dom';

const PageWrapper = styled.div`
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  width: 100%;
  background-color: ${props => props.theme.colors.lightGray};
  overflow-x: hidden;
`;

const PageBanner = styled.div`
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: ${props => props.theme.colors.primary};
  color: white;
  font-family: 'Lexend', sans-serif;
  padding: 0.25rem 2rem; /* further reduced height per request */
  box-sizing: border-box;
  width: 100%;
`;

const ContentWrapper = styled.div`
  display: flex;
  flex-direction: column;
  gap: 1rem;
  padding: 1rem 2rem 2rem;
  max-width: 100%;
`;

const SecondRow = styled.div`
  display: grid;
  grid-template-columns: 220px minmax(0, 1fr); /* narrower sidebar width */
  gap: 1rem;
  align-items: start;

  @media (max-width: 1024px) {
    grid-template-columns: 1fr;
  }
`;

const MainContent = styled.main`
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.08);
  padding: 1rem;
  min-width: 0; /* allow content to shrink within grid to avoid overflow */
`;

/**
 * Layout
 * Purpose: Page shell with header at top, then two rows:
 *          - Row 1: two columns (panels) full width
 *          - Row 2: side links bar and main content area
 * Inputs: None (uses routing Outlet for content area).
 * Outputs: Structured layout applying brand theme and font.
 */
const Layout = () => {
  return (
    <PageWrapper>
      <TopBar />
      {/* Secondary header directly under TopBar, full width and brand gold */}
      <PageBanner>
        <span style={{ fontWeight: 600 }}>Section Header</span>
        <div />
      </PageBanner>
      <ContentWrapper>
        <SecondRow>
          <Sidebar />
          <MainContent>
            <Outlet />
          </MainContent>
        </SecondRow>
      </ContentWrapper>
    </PageWrapper>
  );
};

export default Layout;