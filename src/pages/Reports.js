import React from 'react';
import styled from 'styled-components';

const ReportsContainer = styled.div`
  padding: 2rem;
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
`;

const Title = styled.h1`
  margin-bottom: 2rem;
`;

const Reports = () => {
  return (
    <ReportsContainer>
      <Title>Reports</Title>
      {/* Reports content will go here */}
    </ReportsContainer>
  );
};

export default Reports;