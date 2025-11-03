import React from 'react';
import styled from 'styled-components';
import Sidebar from './Sidebar';
import TopBar from './TopBar';
import { Outlet } from 'react-router-dom';

const LayoutContainer = styled.div`
  display: flex;
  min-height: 100vh;
`;

const MainContent = styled.main`
  flex: 1;
  margin-left: 280px; // Updated sidebar width
  padding: 80px 2rem 2rem; // Top padding for TopBar
  background-color: ${props => props.theme.colors.lightGray};
`;

const Layout = () => {
  return (
    <LayoutContainer>
      <Sidebar />
      <TopBar />
      <MainContent>
        <Outlet />
      </MainContent>
    </LayoutContainer>
  );
};

export default Layout;