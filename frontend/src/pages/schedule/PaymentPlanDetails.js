import React, { useEffect, useMemo, useState } from 'react';
import styled from 'styled-components';
import { useParams, useNavigate } from 'react-router-dom';
import { getPaymentPlan } from '../../utils/api';
import PaymentSchedules from './PaymentSchedules';

const Page = styled.div`
  padding: 1.5rem;
  font-family: 'Lexend', sans-serif;
`;

const Header = styled.div`
  display: flex;
  justify-content: space-between;
  align-items: center;
`;

const Title = styled.h1`
  margin: 0 0 0.5rem;
  color: ${p => p.theme.colors.secondary};
  font-size: 1.2rem;
`;

const Subhead = styled.div`
  color: ${p => p.theme.colors.gray};
  margin-bottom: 0.75rem;
`;

const Section = styled.div`
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  padding: 1rem;
  margin-bottom: 1rem;
`;

const Actions = styled.div`
  display: flex;
  gap: 0.5rem;
`;

const Button = styled.button`
  background: ${p => p.theme.colors.primary};
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 0.4rem 0.75rem;
  cursor: pointer;
  font-family: 'Lexend', sans-serif;
`;


/**
 * PaymentPlanDetails
 * Purpose: Master-detail view for a Payment Plan. Shows schedule payments only.
 * Inputs: Reads `planId` from the URL.
 * Outputs: Displays child Payment Schedules for the plan; removes customer detail.
 */
export default function PaymentPlanDetails() {
  const { planId } = useParams();
  const navigate = useNavigate();
  const [plan, setPlan] = useState(null);
  const [loadingPlan, setLoadingPlan] = useState(true);
  const [errorPlan, setErrorPlan] = useState('');


  useEffect(() => {
    setLoadingPlan(true);
    setErrorPlan('');
    getPaymentPlan(planId)
      .then((data) => setPlan(data))
      .catch((e) => setErrorPlan(e.message || 'Failed to load plan'))
      .finally(() => setLoadingPlan(false));
  }, [planId]);

  // Note: Customer section removed per requirement — focus on schedules only.

  return (
    <Page>
      <Header>
        <Title>Payment Plan Details</Title>
        <Actions>
          <Button onClick={() => navigate('/schedule/payment-plans')}>Back to Plans</Button>
        </Actions>
      </Header>

      <Subhead>
        Viewing Plan: <strong style={{ color: '#00234C' }}>{planId}</strong>
        {plan && (
          <span> — {plan.planName || plan.PlanName || ''}</span>
        )}
        {errorPlan && <span style={{ color: 'crimson' }}> — {errorPlan}</span>}
      </Subhead>

      <Section>
        <h2 style={{ margin: 0, fontSize: '1.1rem' }}>Schedule Payments</h2>
        <div style={{ marginTop: '0.5rem' }}>
          <PaymentSchedules defaultPlanId={planId} />
        </div>
      </Section>
    </Page>
  );
}