import React from 'react';
import styled from 'styled-components';

const TopBarContainer = styled.div`
  height: 60px;
  background-color: #f8fafc;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  padding: 0 2rem;
  position: sticky;
  top: 0;
  left: 0;
  right: 0;
  z-index: 100;
  border-bottom: 1px solid rgba(0, 35, 76, 0.06);
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
  color: ${props => props.theme.colors.secondary};
  font-size: 1.2rem;
  cursor: pointer;
  padding: 0.5rem;
  
  &:hover {
    color: ${props => props.theme.colors.primary};
  }
`;

/**
 * TopBar
 * Purpose: Render the header at the top of the page with a near-white background for a lighter appearance.
 * Inputs: None.
 * Outputs: Header UI with notification, avatar, and user label. Uses brand secondary for text and primary for accents.
 */
const TopBar = () => {
  return (
    <TopBarContainer>
      <UserSection>
        <NotificationBell>
          🔔
        </NotificationBell>
        <UserAvatar>
          SG
        </UserAvatar>
        <UserName>Logged in as: Shahid Ghauri</UserName>
      </UserSection>
    </TopBarContainer>
  );
};

export default TopBar;