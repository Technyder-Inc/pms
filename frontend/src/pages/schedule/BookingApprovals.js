import React from 'react';
import styled from 'styled-components';
const Wrap = styled.div`padding:1.5rem;font-family:'Lexend',sans-serif;`;
const Title = styled.h1`margin:0 0 0.5rem;color:${p=>p.theme.colors.secondary};font-size:1.2rem;`;
const Note = styled.p`margin:0.25rem 0 0;color:${p=>p.theme.colors.primary};`;
/**
 * BookingApprovals
 * Purpose: Schedule → Booking Approvals placeholder.
 */
export default function BookingApprovals(){
  return(<Wrap><Title>Schedule: Booking Approvals</Title><Note>Placeholder page for Booking Approvals.</Note></Wrap>);
}