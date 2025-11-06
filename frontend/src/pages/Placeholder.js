import React from 'react';
import styled from 'styled-components';
import { useParams } from 'react-router-dom';

const Container = styled.div`
  padding: 1.5rem;
  color: ${props => props.theme.colors.text};
  font-family: 'Lexend', sans-serif;
`;

const Title = styled.h1`
  margin: 0 0 0.5rem 0;
  color: ${props => props.theme.colors.secondary};
  font-size: 1.25rem;
`;

const Badge = styled.span`
  display: inline-block;
  margin-top: 0.5rem;
  background: ${props => props.theme.colors.primary};
  color: white;
  padding: 0.25rem 0.5rem;
  border-radius: 4px;
  font-size: 0.85rem;
`;

/**
 * Placeholder
 * Purpose: Provide a branded placeholder screen for new sidebar links until
 *          dedicated pages are implemented, preventing navigation errors.
 * Inputs: None directly; reads `module` and `view` from the URL via useParams.
 * Outputs: Renders a simple message indicating the module and view selected.
 */
const Placeholder = () => {
  const { module, view } = useParams();
  const title = (module || 'Module').replace(/-/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
  const detail = (view || 'Overview').replace(/-/g, ' ');

  return (
    <Container>
      <Title>{title}</Title>
      <div>This section is a placeholder for “{title}”.</div>
      <Badge>{detail}</Badge>
    </Container>
  );
};

export default Placeholder;