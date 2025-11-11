import React, { useEffect, useMemo, useState } from 'react';
import styled from 'styled-components';
import { useParams, useNavigate } from 'react-router-dom';
import { getPayments, getCustomer, updatePayment } from '../../utils/api';

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

const Table = styled.table`
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

const ModalBackdrop = styled.div`
  position: fixed;
  top: 0; left: 0;
  width: 100vw; height: 100vh;
  background: rgba(0,0,0,0.3);
  display: flex; align-items: center; justify-content: center;
  z-index: 1000;
`;

const ModalCard = styled.div`
  width: 640px;
  max-width: 92vw;
  background: white;
  border-radius: 10px;
  box-shadow: 0 12px 30px rgba(0,0,0,0.2);
  overflow: hidden;
`;

const ModalHeader = styled.div`
  background: ${props => props.theme.colors.primary};
  color: white;
  padding: 0.75rem 1rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
`;

const CloseButton = styled.button`
  background: transparent;
  color: white;
  border: 1px solid rgba(255,255,255,0.7);
  padding: 0.25rem 0.5rem;
  border-radius: 4px;
  cursor: pointer;
`;

/**
 * CustomerPayments
 * Purpose: List and update payments for a specific customer.
 * Inputs: Reads `customerId` from the URL.
 * Outputs: Payments grid with inline edit modal to update a payment.
 */
export default function CustomerPayments() {
  const { customerId } = useParams();
  const navigate = useNavigate();
  const [customer, setCustomer] = useState(null);
  const [loadingCustomer, setLoadingCustomer] = useState(true);
  const [errorCustomer, setErrorCustomer] = useState('');

  const [rows, setRows] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  const [selected, setSelected] = useState(null);
  const [form, setForm] = useState(null);
  const [saving, setSaving] = useState(false);
  const [saveError, setSaveError] = useState('');

  useEffect(() => {
    setLoadingCustomer(true);
    setErrorCustomer('');
    getCustomer(customerId)
      .then((d) => setCustomer(d))
      .catch((e) => setErrorCustomer(e.message || 'Failed to load customer'))
      .finally(() => setLoadingCustomer(false));
  }, [customerId]);

  const fetchRows = async () => {
    setLoading(true);
    setError('');
    try {
      const res = await getPayments({ customerId });
      const data = res.data ?? res;
      setRows(Array.isArray(data) ? data : []);
    } catch (e) {
      setError(e.message || 'Failed to load payments');
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => { fetchRows(); }, [customerId]);

  const openEdit = (row) => {
    setSelected(row);
    const normalized = {
      PaymentId: row.PaymentId ?? row.paymentId,
      CustomerId: row.CustomerId ?? row.customerId ?? customerId,
      InstallmentNo: row.InstallmentNo ?? row.installmentNo ?? '',
      Amount: row.Amount ?? row.amount ?? 0,
      PaymentDate: row.PaymentDate ?? row.paymentDate ?? '',
      Status: row.Status ?? row.status ?? 'Pending',
      LateFee: row.LateFee ?? row.lateFee ?? 0,
      Discount: row.Discount ?? row.discount ?? 0,
      NetAmount: row.NetAmount ?? row.netAmount ?? 0,
      Notes: row.Notes ?? row.notes ?? '',
    };
    setForm(normalized);
    setSaveError('');
  };

  const handleFormChange = (field, value) => {
    setForm((prev) => ({ ...prev, [field]: value }));
  };

  const save = async () => {
    if (!form?.PaymentId) return;
    setSaving(true);
    setSaveError('');
    try {
      const payload = { ...form };
      const updated = await updatePayment(form.PaymentId, payload);
      setRows((prev) => prev.map((r) => {
        const id = r.PaymentId ?? r.paymentId;
        if (String(id) !== String(form.PaymentId)) return r;
        return { ...r, ...updated };
      }));
      setSelected(null);
      setForm(null);
    } catch (e) {
      setSaveError(e.message || 'Failed to update payment');
    } finally {
      setSaving(false);
    }
  };

  return (
    <Page>
      <Header>
        <Title>Customer Payments</Title>
        <Actions>
          <Button onClick={() => navigate(-1)}>Back</Button>
          <Button onClick={fetchRows} disabled={loading}>Refresh</Button>
        </Actions>
      </Header>
      <div style={{ color: '#888', marginBottom: '0.5rem' }}>
        Customer: <strong style={{ color: '#00234C' }}>{customerId}</strong>
        {customer && (
          <span> — {customer.FullName || customer.fullName}</span>
        )}
        {errorCustomer && <span style={{ color: 'crimson' }}> — {errorCustomer}</span>}
      </div>

      {error && <div style={{ color: 'crimson', marginBottom: '0.5rem' }}>{error}</div>}

      <Table>
        <thead>
          <tr>
            <Th>Payment ID</Th>
            <Th>Installment</Th>
            <Th>Payment Date</Th>
            <Th>Amount</Th>
            <Th>Late Fee</Th>
            <Th>Discount</Th>
            <Th>Net Amount</Th>
            <Th>Status</Th>
            <Th>Actions</Th>
          </tr>
        </thead>
        <tbody>
          {loading ? (
            <tr><Td colSpan={9}>Loading…</Td></tr>
          ) : rows.length === 0 ? (
            <tr><Td colSpan={9}>No payments found</Td></tr>
          ) : (
            rows.map((r) => (
              <tr key={r.PaymentId ?? r.paymentId}>
                <Td>{r.PaymentId ?? r.paymentId}</Td>
                <Td>{r.InstallmentNo ?? r.installmentNo}</Td>
                <Td>{(r.PaymentDate ?? r.paymentDate ?? '').toString().slice(0,10) || '—'}</Td>
                <Td>{r.Amount ?? r.amount}</Td>
                <Td>{r.LateFee ?? r.lateFee}</Td>
                <Td>{r.Discount ?? r.discount}</Td>
                <Td>{r.NetAmount ?? r.netAmount}</Td>
                <Td>{r.Status ?? r.status}</Td>
                <Td>
                  <Button onClick={() => openEdit(r)}>Edit</Button>
                </Td>
              </tr>
            ))
          )}
        </tbody>
      </Table>

      {selected && form && (
        <ModalBackdrop onClick={() => { setSelected(null); setForm(null); }}>
          <ModalCard onClick={e => e.stopPropagation()}>
            <ModalHeader>
              <span>Edit Payment — {form.PaymentId}</span>
              <CloseButton onClick={() => { setSelected(null); setForm(null); }}>Close</CloseButton>
            </ModalHeader>
            <div style={{ padding: '1rem', display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '0.75rem' }}>
              <div>
                <label style={{ color: '#00234C', fontWeight: 600 }}>Payment Date</label>
                <input type="date" value={(form.PaymentDate || '').slice(0,10)} onChange={(e) => handleFormChange('PaymentDate', e.target.value)} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
              </div>
              <div>
                <label style={{ color: '#00234C', fontWeight: 600 }}>Amount</label>
                <input type="number" value={form.Amount} onChange={(e) => handleFormChange('Amount', Number(e.target.value))} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
              </div>
              <div>
                <label style={{ color: '#00234C', fontWeight: 600 }}>Late Fee</label>
                <input type="number" value={form.LateFee} onChange={(e) => handleFormChange('LateFee', Number(e.target.value))} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
              </div>
              <div>
                <label style={{ color: '#00234C', fontWeight: 600 }}>Discount</label>
                <input type="number" value={form.Discount} onChange={(e) => handleFormChange('Discount', Number(e.target.value))} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
              </div>
              <div>
                <label style={{ color: '#00234C', fontWeight: 600 }}>Status</label>
                <select value={form.Status} onChange={(e) => handleFormChange('Status', e.target.value)} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }}>
                  <option value="Pending">Pending</option>
                  <option value="Verified">Verified</option>
                  <option value="Cancelled">Cancelled</option>
                </select>
              </div>
              {saveError && <div style={{ gridColumn: '1 / -1', color: 'crimson' }}>{saveError}</div>}
              <div style={{ gridColumn: '1 / -1', display: 'flex', justifyContent: 'flex-end', gap: '0.5rem' }}>
                <Button onClick={() => { setSelected(null); setForm(null); }}>Cancel</Button>
                <Button onClick={save} disabled={saving}>{saving ? 'Saving…' : 'Save Changes'}</Button>
              </div>
            </div>
          </ModalCard>
        </ModalBackdrop>
      )}
    </Page>
  );
}