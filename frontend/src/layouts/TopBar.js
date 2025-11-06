import React, { useMemo } from 'react';
import { useNavigate } from 'react-router-dom';
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

const LogoutButton = styled.button`
  background: transparent;
  color: ${p => p.theme.colors.secondary};
  border: 1px solid ${p => p.theme.colors.secondary};
  padding: 0.35rem 0.6rem;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
  &:hover {
    background: ${p => p.theme.colors.primary};
    color: #fff;
    border-color: ${p => p.theme.colors.primary};
  }
`;

/**
 * TopBar
 * Purpose: Render the header with current user name and logout.
 * Inputs: Reads `user` object from `localStorage` to display `fullname`.
 * Outputs: Shows "Logged in as: <Fullname>" and a Logout button that clears auth and navigates to `/login`.
 */
const TopBar = () => {
  const navigate = useNavigate();

  /**
   * getDisplayName
   * Purpose: Derive a friendly display name from the stored user object.
   * Inputs: None (reads and parses `localStorage.user`).
   * Outputs: String display name using `fullname` (or reasonable fallbacks).
   */
  const displayName = useMemo(() => {
    try {
      const raw = localStorage.getItem('user');
      if (!raw) return 'User';
      const user = JSON.parse(raw);
      const name = user?.fullname || user?.fullName || user?.Fullname || user?.name || [user?.firstName, user?.lastName].filter(Boolean).join(' ');
      return name || 'User';
    } catch {
      return 'User';
    }
  }, []);

  /**
   * handleLogout
   * Purpose: Clear auth data and redirect to login.
   * Inputs: None.
   * Outputs: Navigates to `/login` after clearing token, expiry, and user.
   */
  function handleLogout() {
    localStorage.removeItem('jwt');
    localStorage.removeItem('jwt_expires');
    localStorage.removeItem('user');
    navigate('/login', { replace: true });
  }

  const initials = useMemo(() => {
    return (displayName || 'User')
      .split(' ')
      .filter(Boolean)
      .map(w => w[0])
      .slice(0, 2)
      .join('')
      .toUpperCase();
  }, [displayName]);

  return (
    <TopBarContainer>
      <UserSection>
        <NotificationBell>
          🔔
        </NotificationBell>
        <UserAvatar>
          {initials || 'US'}
        </UserAvatar>
        <UserName>Logged in as: {displayName}</UserName>
        <LogoutButton onClick={handleLogout}>Logout</LogoutButton>
      </UserSection>
    </TopBarContainer>
  );
};

export default TopBar;