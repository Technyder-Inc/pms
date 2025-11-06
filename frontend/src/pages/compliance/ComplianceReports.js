import React from 'react';
import styled from 'styled-components';
const Wrap = styled.div`padding:1.5rem;font-family:'Lexend',sans-serif;`;
const Title = styled.h1`margin:0 0 0.5rem;color:${p=>p.theme.colors.secondary};font-size:1.2rem;`;
const Note = styled.p`margin:0.25rem 0 0;color:${p=>p.theme.colors.primary};`;
/**
 * ComplianceReports
 * Purpose: Compliance → Compliance Reports placeholder.
 */
export default function ComplianceReports(){
  return(<Wrap><Title>Compliance: Compliance Reports</Title><Note>Placeholder page for Compliance Reports.</Note></Wrap>);
}