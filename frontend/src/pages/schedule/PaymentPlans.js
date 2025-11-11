import React, { useEffect, useMemo, useState } from 'react';
import styled from 'styled-components';
import { useNavigate } from 'react-router-dom';
import { getPaymentPlans } from '../../utils/api';

const Wrap = styled.div`
  padding: 1.5rem;
  font-family: 'Lexend', sans-serif;
`;
const TitleRow = styled.div`
  display: flex;
  justify-content: space-between;
  align-items: center;
`;
const Title = styled.h1`
  margin: 0 0 0.5rem;
  color: ${p => p.theme.colors.secondary};
  font-size: 1.2rem;
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
const Grid = styled.table`
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  overflow: hidden;
`;
const Th = styled.th`
  text-align: left;
  padding: 0.6rem 0.75rem;
  background: rgba(0,35,76,0.06);
  color: ${p => p.theme.colors.secondary};
  font-weight: 600;
`;
const Td = styled.td`
  padding: 0.6rem 0.75rem;
  border-top: 1px solid #eee;
  color: ${p => p.theme.colors.secondary};
`;
const Toolbar = styled.div`
  display: grid;
  grid-template-columns: 1fr;
  gap: 0.5rem;
  margin: 0.75rem 0 1rem;
`;
const Input = styled.input`
  border: 1px solid #ddd;
  border-radius: 6px;
  padding: 0.4rem 0.6rem;
  font-family: 'Lexend', sans-serif;
`;
const Pager = styled.div`
  display: none;
`;

/**
 * PaymentPlans
 * Purpose: Display all Payment Plans in a single grid without pagination.
 * Inputs: None.
 * Outputs: Table rendering all payment plans fetched from `/api/PaymentPlans`.
 */
export default function PaymentPlans() {
  const navigate = useNavigate();
  const [plans, setPlans] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [search, setSearch] = useState('');
  const [meta, setMeta] = useState({ totalCount: 0, totalPages: 1 });

  /**
   * fetchPlans
   * Purpose: Load all payment plans (no paging) and update grid state.
   * Inputs: None.
   * Outputs: Updates `plans` array and meta totalCount.
   */
  const fetchPlans = async () => {
    setLoading(true);
    setError('');
    try {
      // Fetch all plans from DB (request large pageSize to avoid truncation)
      const res = await getPaymentPlans({ page: 1, pageSize: 1000 });
      const data = res.data ?? res;
      setPlans(Array.isArray(data) ? data : []);
      setMeta({
        totalCount: (res.totalCount ?? data.length ?? 0),
        totalPages: 1,
      });
    } catch (e) {
      setError(e.message || 'Failed to load payment plans');
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => { fetchPlans(); }, []);

  const filtered = useMemo(() => {
    const term = search.trim().toLowerCase();
    if (!term) return plans;
    return plans.filter(p => (
      String(p.planId ?? p.PlanId ?? '').toLowerCase().includes(term) ||
      String(p.planName ?? p.PlanName ?? '').toLowerCase().includes(term) ||
      String(p.frequency ?? p.Frequency ?? '').toLowerCase().includes(term)
    ));
  }, [plans, search]);

  return (
    <Wrap>
      <TitleRow>
        <Title>Schedule: Payment Plans</Title>
        <Actions>
          <Button onClick={fetchPlans} disabled={loading}>Refresh</Button>
        </Actions>
      </TitleRow>

      <Toolbar>
        <Input placeholder="Search by ID/Name/Frequency" value={search} onChange={e => setSearch(e.target.value)} />
      </Toolbar>

      {error && <div style={{ color: '#b00020', marginBottom: '0.5rem' }}>{error}</div>}

      <Grid>
        <thead>
          <tr>
            <Th>Plan ID</Th>
            <Th>Name</Th>
            <Th>Total Amount</Th>
            <Th>Duration (months)</Th>
            <Th>Frequency</Th>
            <Th>Description</Th>
            <Th>Created</Th>
            <Th>Actions</Th>
            
          </tr>
        </thead>
        <tbody>
          {loading ? (
            <tr><Td colSpan={9}>Loading...</Td></tr>
          ) : filtered.length === 0 ? (
            <tr><Td colSpan={9}>No payment plans found</Td></tr>
          ) : (
            filtered.map((p, i) => {
              const planId = p.planId ?? p.PlanId;
              const planName = p.planName ?? p.PlanName;
              // Map schema differences: totalamount/durationmonths in user schema
              const totalAmount = p.totalamount ?? p.TotalAmount ?? p.installmentAmount ?? p.InstallmentAmount;
              const durationMonths = p.durationmonths ?? p.DurationMonths ?? p.totalInstallments ?? p.TotalInstallments;
              const freq = p.frequency ?? p.Frequency;
              const desc = p.description ?? p.Description;
              const created = p.createdat ?? p.CreatedAt;
              
              return (
                <tr key={planId || i}>
                  <Td>{planId}</Td>
                  <Td>{planName}</Td>
                  <Td>{totalAmount ?? '-'}</Td>
                  <Td>{durationMonths ?? '-'}</Td>
                  <Td>{freq ?? '-'}</Td>
                  <Td>{desc ?? '-'}</Td>
                  <Td>{created ? String(created).slice(0,10) : '-'}</Td>
                  <Td>
                    <Button onClick={() => navigate(`/schedule/payment-plans/${encodeURIComponent(planId)}`)}>
                      View Details
                    </Button>
                  </Td>
                </tr>
              );
            })
          )}
        </tbody>
      </Grid>

      <Pager />
    </Wrap>
  );
}