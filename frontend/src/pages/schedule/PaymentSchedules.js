import React, { useEffect, useMemo, useState } from 'react';
import styled from 'styled-components';
import { getPaymentSchedules } from '../../utils/api';

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
  grid-template-columns: 180px 180px 160px 1fr;
  gap: 0.5rem;
  margin: 0.75rem 0 1rem;
`;
const Input = styled.input`
  border: 1px solid #ddd;
  border-radius: 6px;
  padding: 0.4rem 0.6rem;
  font-family: 'Lexend', sans-serif;
`;
const Select = styled.select`
  border: 1px solid #ddd;
  border-radius: 6px;
  padding: 0.4rem 0.6rem;
  font-family: 'Lexend', sans-serif;
`;

/**
 * PaymentSchedules
 * Purpose: Display child Payment Schedules grid, optionally filtered by Plan ID.
 * Inputs: None.
 * Outputs: Table of payment schedules fetched from `/api/PaymentSchedules`.
 */
/**
 * PaymentSchedules
 * Purpose: Display child Payment Schedules grid, optionally filtered by Plan ID.
 * Inputs:
 *  - defaultPlanId: optional string to pre-fill Plan ID filter
 * Outputs:
 *  - Table of payment schedules fetched from `/api/PaymentSchedules`.
 */
export default function PaymentSchedules({ defaultPlanId = '' }) {
  const [rows, setRows] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [page, setPage] = useState(1);
  const [pageSize, setPageSize] = useState(10);
  const [planId, setPlanId] = useState(defaultPlanId || '');
  const [search, setSearch] = useState('');
  const [meta, setMeta] = useState({ totalCount: 0, totalPages: 0 });

  const fetchRows = async () => {
    setLoading(true);
    setError('');
    try {
      const res = await getPaymentSchedules({ page, pageSize, planId });
      const data = res.data ?? res;
      setRows(Array.isArray(data) ? data : []);
      setMeta({
        totalCount: res.totalCount ?? data.length ?? 0,
        totalPages: res.totalPages ?? 1,
      });
    } catch (e) {
      setError(e.message || 'Failed to load payment schedules');
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => { fetchRows(); }, [page, pageSize, planId]);
  useEffect(() => { setPlanId(defaultPlanId || ''); }, [defaultPlanId]);

  const filtered = useMemo(() => {
    const term = search.trim().toLowerCase();
    if (!term) return rows;
    return rows.filter(r => (
      String(r.scheduleid ?? r.ScheduleId ?? '').toLowerCase().includes(term) ||
      String(r.paymentdescription ?? r.PaymentDescription ?? '').toLowerCase().includes(term)
    ));
  }, [rows, search]);

  return (
    <Wrap>
      <TitleRow>
        <Title>Schedule: Payment Schedules</Title>
        <Actions>
          <Button onClick={fetchRows} disabled={loading}>Refresh</Button>
        </Actions>
      </TitleRow>

      <Toolbar>
        <Input placeholder="Filter by Plan ID (e.g., PLAN001)" value={planId} onChange={e => setPlanId(e.target.value)} />
        <Input placeholder="Search description or Schedule ID" value={search} onChange={e => setSearch(e.target.value)} />
        <Select value={pageSize} onChange={e => setPageSize(Number(e.target.value))}>
          <option value={10}>10</option>
          <option value={20}>20</option>
          <option value={50}>50</option>
        </Select>
      </Toolbar>

      {error && <div style={{ color: '#b00020', marginBottom: '0.5rem' }}>{error}</div>}

      <Grid>
        <thead>
          <tr>
            <Th>Schedule ID</Th>
            <Th>Plan ID</Th>
            <Th>Payment Description</Th>
            <Th>Installment No</Th>
            <Th>Due Date</Th>
            <Th>Amount</Th>
            <Th>Surcharge Applied</Th>
            <Th>Surcharge Rate</Th>
            <Th>Description</Th>
          </tr>
        </thead>
        <tbody>
          {loading ? (
            <tr><Td colSpan={9}>Loading...</Td></tr>
          ) : filtered.length === 0 ? (
            <tr><Td colSpan={9}>No payment schedules found</Td></tr>
          ) : (
            filtered.map((r, i) => {
              const scheduleId = r.scheduleid ?? r.ScheduleId;
              const pId = r.planid ?? r.PlanId;
              const desc = r.paymentdescription ?? r.PaymentDescription;
              const instNo = r.installmentno ?? r.InstallmentNo;
              const due = r.duedate ?? r.DueDate;
              const amt = r.amount ?? r.Amount;
              const surchargeApplied = r.surchargeapplied ?? r.SurchargeApplied;
              const surchargeRate = r.surchargerate ?? r.SurchargeRate;
              const note = r.description ?? r.Description;
              return (
                <tr key={scheduleId || i}>
                  <Td>{scheduleId}</Td>
                  <Td>{pId}</Td>
                  <Td>{desc ?? '-'}</Td>
                  <Td>{instNo ?? '-'}</Td>
                  <Td>{due ? String(due).slice(0,10) : '-'}</Td>
                  <Td>{amt ?? '-'}</Td>
                  <Td>{String(surchargeApplied ?? '-')}</Td>
                  <Td>{surchargeRate ?? '-'}</Td>
                  <Td>{note ?? '-'}</Td>
                </tr>
              );
            })
          )}
        </tbody>
      </Grid>

      <div style={{ marginTop: '0.75rem', display: 'flex', gap: '0.5rem', alignItems: 'center' }}>
        <Button onClick={() => setPage(p => Math.max(1, p - 1))} disabled={page <= 1 || loading}>Prev</Button>
        <span style={{ color: '#00234C' }}>Page {page} / {meta.totalPages || 1}</span>
        <Button onClick={() => setPage(p => p + 1)} disabled={loading || (meta.totalPages && page >= meta.totalPages)}>Next</Button>
      </div>
    </Wrap>
  );
}