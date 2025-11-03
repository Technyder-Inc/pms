import React from 'react';
import styled from 'styled-components';

const TopBarContainer = styled.div`
  height: 60px;
  background-color: white;
  border-bottom: 1px solid ${props => props.theme.colors.lightGray};
  display: flex;
  align-items: center;
  justify-content: flex-end;
  padding: 0 2rem;
  position: fixed;
  top: 0;
  right: 0;
  left: 280px; // Updated sidebar width
  z-index: 100;
`;

const UserSection = styled.div`
  display: flex;
  align-items: center;
  gap: 1rem;
`;

const UserAvatar = styled.div`
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background-color: ${props => props.theme.colors.primary};
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 500;
`;

const UserName = styled.span`
  color: ${props => props.theme.colors.secondary};
  font-weight: 500;
`;

const NotificationBell = styled.button`
  background: none;
  border: none;
  color: ${props => props.theme.colors.gray};
  font-size: 1.2rem;
  cursor: pointer;
  padding: 0.5rem;
  
  &:hover {
    color: ${props => props.theme.colors.secondary};
  }
`;

const TopBar = () => {
  return (
    <TopBarContainer>
      <UserSection>
        <NotificationBell>
          🔔
        </NotificationBell>
        <UserAvatar>
          JD
        </UserAvatar>
        <UserName>John Doe</UserName>
      </UserSection>
    </TopBarContainer>
  );
};

export default TopBar;