import React from 'react';
import styled from 'styled-components';
const Wrap = styled.div`padding:1.5rem;font-family:'Lexend',sans-serif;`;
const Title = styled.h1`margin:0 0 0.5rem;color:${p=>p.theme.colors.secondary};font-size:1.2rem;`;
const Note = styled.p`margin:0.25rem 0 0;color:${p=>p.theme.colors.primary};`;
/**
 * AnomalyDetection
 * Purpose: AI & Automation → Anomaly Detection placeholder.
 */
export default function AnomalyDetection(){
  return(<Wrap><Title>AI & Automation: Anomaly Detection</Title><Note>Placeholder page for Anomaly Detection.</Note></Wrap>);
}