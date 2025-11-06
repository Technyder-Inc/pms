import React from 'react';
import styled from 'styled-components';
const Wrap = styled.div`padding:1.5rem;font-family:'Lexend',sans-serif;`;
const Title = styled.h1`margin:0 0 0.5rem;color:${p=>p.theme.colors.secondary};font-size:1.2rem;`;
const Note = styled.p`margin:0.25rem 0 0;color:${p=>p.theme.colors.primary};`;
/**
 * TransferSummary
 * Purpose: Reports → Transfer Summary placeholder.
 */
export default function TransferSummary(){
  return(<Wrap><Title>Reports: Transfer Summary</Title><Note>Placeholder page for Transfer Summary.</Note></Wrap>);
}