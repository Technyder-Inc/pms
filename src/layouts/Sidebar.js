import React, { useState } from 'react';
import styled from 'styled-components';
import { NavLink } from 'react-router-dom';
import { IoChevronDown, IoChevronForward } from 'react-icons/io5';

const SidebarContainer = styled.div`
  width: 280px;
  height: 100vh;
  background-color: ${props => props.theme.colors.secondary};
  color: white;
  padding: 2rem 1rem;
  position: fixed;
  left: 0;
  top: 0;
  overflow-y: auto;
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
  font-size: 0.9rem;

  &:hover {
    background-color: rgba(255, 255, 255, 0.1);
    text-decoration: none;
  }

  &.active {
    background-color: ${props => props.theme.colors.primary};
  }
`;

const ModuleItem = ({ title, sublinks }) => {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <NavItem>
      <ModuleHeader onClick={() => setIsOpen(!isOpen)} isActive={isOpen}>
        <span>{title}</span>
        {isOpen ? <IoChevronDown /> : <IoChevronForward />}
      </ModuleHeader>
      <SubMenu isOpen={isOpen}>
        {sublinks.map((link, index) => (
          <NavItem key={index}>
            <StyledNavLink 
              to={`/${title.toLowerCase()}/${link.toLowerCase().replace(/\s+/g, '-')}`}
            >
              {link}
            </StyledNavLink>
          </NavItem>
        ))}
      </SubMenu>
    </NavItem>
  );
};

const Sidebar = () => {
  const modules = [
    {
      title: 'Customers',
      sublinks: ['All Customers', 'Active Customers', 'Blocked Customers']
    },
    {
      title: 'Property',
      sublinks: ['All Properties', 'Developed Properties', 'Allotted Properties', 'Available Properties']
    },
    {
      title: 'Payments',
      sublinks: ['All Deposit Challans', 'Wrong Deposit Challans']
    },
    {
      title: 'Schedule',
      sublinks: ['All Schedules', 'Schedules by Size']
    },
    {
      title: 'Transfer',
      sublinks: ['Transfer Completed', 'In-Process Transfers']
    }
  ];

  return (
    <SidebarContainer>
      <Logo>PMS</Logo>
      <NavList>
        {modules.map((module, index) => (
          <ModuleItem 
            key={index}
            title={module.title}
            sublinks={module.sublinks}
          />
        ))}
      </NavList>
    </SidebarContainer>
  );
};

export default Sidebar;