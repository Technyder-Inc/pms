import React, { useEffect, useMemo, useState } from 'react';
import styled from 'styled-components';
import { getPaymentSchedules, createPaymentSchedule, updatePaymentSchedule, deletePaymentSchedule } from '../../utils/api';

const PageContainer = styled.div`
  background: white;
  border-radius: 8px;
  padding: 1.5rem;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  font-family: 'Lexend', sans-serif;
`;

const Header = styled.div`
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.5rem 0;
  margin-bottom: 0.75rem;
`;

const HeaderLeft = styled.div`
  display: flex;
  align-items: center;
  gap: 0.75rem;
`;

const Title = styled.h2`
  margin: 0;
  font-weight: 600;
  font-size: 1.1rem;
  color: ${p => p.theme.colors.secondary};
`;

const Actions = styled.div`
  display: flex;
  gap: 0.5rem;
`;

const Button = styled.button`
  background: ${props => props.variant === 'primary' ? props.theme.colors.primary : 'transparent'};
  color: ${props => props.variant === 'primary' ? 'white' : props.theme.colors.secondary};
  border: 1px solid ${props => props.theme.colors.secondary};
  padding: 0.5rem 0.75rem;
  border-radius: 4px;
  cursor: pointer;
`;

const Input = styled.input`
  padding: 0.4rem 0.5rem;
  border: 1px solid ${props => props.theme.colors.secondary};
  border-radius: 4px;
  font-family: 'Lexend', sans-serif;
`;

const Select = styled.select`
  padding: 0.4rem 0.5rem;
  border: 1px solid ${props => props.theme.colors.secondary};
  border-radius: 4px;
`;

const Table = styled.table`
  width: 100%;
  border-collapse: collapse;
  table-layout: fixed;
`;

const Th = styled.th`
  text-align: left;
  padding: 0.65rem 0.75rem;
  background: ${props => props.theme.colors.lightGray};
  color: ${props => props.theme.colors.secondary};
  font-weight: 600;
  font-size: 0.95rem;
`;

const Td = styled.td`
  padding: 0.75rem;
  border-bottom: 1px solid ${props => props.theme.colors.lightGray};
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
`;

const Footer = styled.div`
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 1rem;
`;

const Pager = styled.div`
  display: flex;
  align-items: center;
  gap: 0.75rem;
`;

const SmallButton = styled.button`
  background: ${props => props.theme.colors.secondary};
  color: white;
  border: none;
  padding: 0.4rem 0.6rem;
  border-radius: 4px;
  cursor: pointer;
  opacity: ${props => props.disabled ? 0.5 : 1};
`;

const ModalBackdrop = styled.div`
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0, 0, 0, 0.3);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
`;

const ModalCard = styled.div`
  width: 720px;
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

const ModalBody = styled.div`
  padding: 1rem;
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
 * ScheduleManager
 * Purpose: Manage child Payment Schedules within a parent Payment Plan.
 * Inputs:
 *  - planId: string identifier of the parent Payment Plan
 * Outputs:
 *  - Renders a grid of schedules and provides add/edit/delete interactions
 */
export default function ScheduleManager({ planId }) {
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [rows, setRows] = useState([]);
  const [page, setPage] = useState(1);
  const [pageSize, setPageSize] = useState(20);
  const [totalCount, setTotalCount] = useState(0);
  const [totalPages, setTotalPages] = useState(1);

  const [search, setSearch] = useState('');
  const [addOpen, setAddOpen] = useState(false);
  const [editOpen, setEditOpen] = useState(false);
  const [saving, setSaving] = useState(false);
  const [saveError, setSaveError] = useState('');

  const [addForm, setAddForm] = useState(() => ({
    PlanId: planId || '',
    PaymentDescription: '',
    InstallmentNo: '',
    DueDate: '',
    Amount: '',
    SurchargeApplied: true,
    SurchargeRate: 0.05,
    Description: '',
  }));

  const [editForm, setEditForm] = useState(null);

  /**
   * fetchRows
   * Purpose: Load schedules for the given plan with pagination.
   * Inputs: none (uses local state planId, page, pageSize)
   * Outputs: Updates rows and meta information.
   */
  const fetchRows = async () => {
    if (!planId) {
      setRows([]);
      setTotalCount(0);
      setTotalPages(1);
      setLoading(false);
      return;
    }
    setLoading(true);
    setError('');
    try {
      const res = await getPaymentSchedules({ page, pageSize, planId });
      const data = res?.data ?? res;
      const list = Array.isArray(data) ? data : [];
      setRows(list);
      const tc = typeof res?.totalCount === 'number' ? res.totalCount : list.length;
      const tp = typeof res?.totalPages === 'number' ? res.totalPages : Math.max(1, Math.ceil(tc / pageSize));
      setTotalCount(tc);
      setTotalPages(tp);
    } catch (e) {
      setError(e.message || 'Failed to load payment schedules');
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchRows();
  }, [planId, page, pageSize]);

  useEffect(() => {
    setAddForm(prev => ({ ...prev, PlanId: planId || '' }));
  }, [planId]);

  const filtered = useMemo(() => {
    const term = search.trim().toLowerCase();
    if (!term) return rows;
    return rows.filter(r => (
      String(r.ScheduleId ?? r.scheduleid ?? '').toLowerCase().includes(term) ||
      String(r.PaymentDescription ?? r.paymentdescription ?? '').toLowerCase().includes(term)
    ));
  }, [rows, search]);

  /**
   * openAdd
   * Purpose: Open add modal and initialize form with current planId.
   * Inputs: none
   * Outputs: Sets addOpen and resets addForm.
   */
  const openAdd = () => {
    setAddForm({
      PlanId: planId || '',
      PaymentDescription: '',
      InstallmentNo: '',
      DueDate: '',
      Amount: '',
      SurchargeApplied: true,
      SurchargeRate: 0.05,
      Description: '',
    });
    setAddOpen(true);
    setSaveError('');
  };

  /**
   * openEdit
   * Purpose: Open edit modal for a selected row.
   * Inputs:
   *  - row: object representing the payment schedule
   * Outputs: Sets editOpen and populates editForm.
   */
  const openEdit = (row) => {
    const normalized = {
      ScheduleId: row.ScheduleId ?? row.scheduleid ?? '',
      PlanId: row.PlanId ?? row.planid ?? planId ?? '',
      PaymentDescription: row.PaymentDescription ?? row.paymentdescription ?? '',
      InstallmentNo: row.InstallmentNo ?? row.installmentno ?? '',
      DueDate: (row.DueDate ?? row.duedate ?? '') ? String(row.DueDate ?? row.duedate).slice(0, 10) : '',
      Amount: row.Amount ?? row.amount ?? '',
      SurchargeApplied: row.SurchargeApplied ?? row.surchargeapplied ?? true,
      SurchargeRate: row.SurchargeRate ?? row.surchargerate ?? 0.05,
      Description: row.Description ?? row.description ?? '',
    };
    setEditForm(normalized);
    setEditOpen(true);
    setSaveError('');
  };

  /**
   * handleAddChange
   * Purpose: Update addForm state on input changes.
   * Inputs:
   *  - field: string field name
   *  - value: any value
   * Outputs: Mutates addForm state.
   */
  const handleAddChange = (field, value) => {
    setAddForm(prev => ({ ...prev, [field]: value }));
  };

  /**
   * handleEditChange
   * Purpose: Update editForm state on input changes.
   * Inputs:
   *  - field: string field name
   *  - value: any value
   * Outputs: Mutates editForm state.
   */
  const handleEditChange = (field, value) => {
    setEditForm(prev => ({ ...prev, [field]: value }));
  };

  /**
   * saveAdd
   * Purpose: Persist a new schedule via API and refresh list.
   * Inputs: none (uses addForm)
   * Outputs: Creates schedule, closes modal, and reloads rows.
   */
  const saveAdd = async () => {
    setSaving(true);
    setSaveError('');
    try {
      const payload = {
        PlanId: addForm.PlanId,
        PaymentDescription: addForm.PaymentDescription || null,
        InstallmentNo: addForm.InstallmentNo ? Number(addForm.InstallmentNo) : null,
        DueDate: addForm.DueDate || null,
        Amount: addForm.Amount ? Number(addForm.Amount) : null,
        SurchargeApplied: Boolean(addForm.SurchargeApplied),
        SurchargeRate: addForm.SurchargeRate !== '' && addForm.SurchargeRate !== null ? Number(addForm.SurchargeRate) : null,
        Description: addForm.Description || null,
      };
      await createPaymentSchedule(payload);
      setAddOpen(false);
      await fetchRows();
    } catch (e) {
      setSaveError(e.message || 'Failed to create schedule');
    } finally {
      setSaving(false);
    }
  };

  /**
   * saveEdit
   * Purpose: Persist schedule updates via API and refresh list.
   * Inputs: none (uses editForm)
   * Outputs: Updates schedule, closes modal, and reloads rows.
   */
  const saveEdit = async () => {
    if (!editForm?.ScheduleId) return;
    setSaving(true);
    setSaveError('');
    try {
      const payload = {
        ScheduleId: editForm.ScheduleId,
        PlanId: editForm.PlanId,
        PaymentDescription: editForm.PaymentDescription || null,
        InstallmentNo: editForm.InstallmentNo ? Number(editForm.InstallmentNo) : null,
        DueDate: editForm.DueDate || null,
        Amount: editForm.Amount ? Number(editForm.Amount) : null,
        SurchargeApplied: Boolean(editForm.SurchargeApplied),
        SurchargeRate: editForm.SurchargeRate !== '' && editForm.SurchargeRate !== null ? Number(editForm.SurchargeRate) : null,
        Description: editForm.Description || null,
      };
      await updatePaymentSchedule(editForm.ScheduleId, payload);
      setEditOpen(false);
      setEditForm(null);
      await fetchRows();
    } catch (e) {
      setSaveError(e.message || 'Failed to update schedule');
    } finally {
      setSaving(false);
    }
  };

  /**
   * handleDelete
   * Purpose: Delete a schedule after confirmation and refresh list.
   * Inputs:
   *  - scheduleId: string identifier of the schedule
   * Outputs: Removes schedule and reloads rows.
   */
  const handleDelete = async (scheduleId) => {
    const ok = window.confirm('Delete this schedule?');
    if (!ok) return;
    try {
      await deletePaymentSchedule(scheduleId);
      await fetchRows();
    } catch (e) {
      alert(e.message || 'Failed to delete schedule');
    }
  };

  return (
    <PageContainer>
      <Header>
        <HeaderLeft>
          <Title>Child Schedules</Title>
          <Actions>
            <Button onClick={() => fetchRows()} variant="secondary">Refresh</Button>
            <Button onClick={openAdd} variant="primary">Add Schedule</Button>
          </Actions>
        </HeaderLeft>
        <div style={{ marginLeft: 'auto', display: 'flex', gap: '0.5rem', alignItems: 'center' }}>
          <Input placeholder="Search description or ID" value={search} onChange={(e) => setSearch(e.target.value)} />
          <Select value={pageSize} onChange={(e) => { setPage(1); setPageSize(parseInt(e.target.value, 10)); }}>
            {[10, 20, 50].map(n => (<option key={n} value={n}>{n}</option>))}
          </Select>
        </div>
      </Header>

      {loading && <div>Loading schedules…</div>}
      {error && <div style={{ color: 'crimson' }}>{error}</div>}

      {!loading && !error && (
        <Table>
          <colgroup>
            <col style={{ width: '12%' }} />
            <col style={{ width: '16%' }} />
            <col style={{ width: '18%' }} />
            <col style={{ width: '12%' }} />
            <col style={{ width: '12%' }} />
            <col style={{ width: '10%' }} />
            <col style={{ width: '8%' }} />
            <col style={{ width: '12%' }} />
          </colgroup>
          <thead>
            <tr>
              <Th>Schedule ID</Th>
              <Th>Payment Description</Th>
              <Th>Due Date</Th>
              <Th>Installment No</Th>
              <Th>Amount</Th>
              <Th>Surcharge?</Th>
              <Th>Rate</Th>
              <Th>Actions</Th>
            </tr>
          </thead>
          <tbody>
            {filtered.map((r, i) => (
              <tr key={(r.ScheduleId ?? r.scheduleid ?? i)}>
                <Td>{r.ScheduleId ?? r.scheduleid}</Td>
                <Td>{r.PaymentDescription ?? r.paymentdescription ?? '—'}</Td>
                <Td>{(r.DueDate ?? r.duedate) ? String(r.DueDate ?? r.duedate).slice(0, 10) : '—'}</Td>
                <Td>{r.InstallmentNo ?? r.installmentno ?? '—'}</Td>
                <Td>{r.Amount ?? r.amount ?? '—'}</Td>
                <Td>{String(r.SurchargeApplied ?? r.surchargeapplied ?? '—')}</Td>
                <Td>{r.SurchargeRate ?? r.surchargerate ?? '—'}</Td>
                <Td>
                  <SmallButton onClick={() => openEdit(r)}>Edit</SmallButton>
                  <SmallButton style={{ marginLeft: 6 }} onClick={() => handleDelete(r.ScheduleId ?? r.scheduleid)}>Delete</SmallButton>
                </Td>
              </tr>
            ))}
            {filtered.length === 0 && (
              <tr>
                <Td colSpan={8}>No schedules found for this plan</Td>
              </tr>
            )}
          </tbody>
        </Table>
      )}

      {!loading && !error && (
        <Footer>
          <div>
            Showing {filtered.length} of {totalCount} schedules
          </div>
          <Pager>
            <span>Rows per page:</span>
            <Select
              value={pageSize}
              onChange={(e) => {
                setPage(1);
                setPageSize(parseInt(e.target.value, 10));
              }}
            >
              {[10, 20, 50].map((n) => (
                <option key={n} value={n}>{n}</option>
              ))}
            </Select>
            <span>Page {page} of {totalPages}</span>
            <SmallButton onClick={() => setPage((p) => Math.max(1, p - 1))} disabled={page <= 1}>Prev</SmallButton>
            <SmallButton onClick={() => setPage((p) => Math.min(totalPages, p + 1))} disabled={page >= totalPages}>Next</SmallButton>
          </Pager>
        </Footer>
      )}

      {addOpen && (
        <ModalBackdrop onClick={() => setAddOpen(false)}>
          <ModalCard onClick={(e) => e.stopPropagation()}>
            <ModalHeader>
              <span>New Schedule</span>
              <div style={{ display: 'flex', gap: '0.5rem' }}>
                <CloseButton onClick={() => setAddOpen(false)}>Close</CloseButton>
              </div>
            </ModalHeader>
            <ModalBody>
              <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '0.75rem' }}>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Plan ID</label>
                  <input value={addForm.PlanId} readOnly style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4, background: '#f7f7f7' }} />
                </div>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Installment No</label>
                  <input type="number" value={addForm.InstallmentNo} onChange={(e) => handleAddChange('InstallmentNo', e.target.value)} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
                </div>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Due Date</label>
                  <input type="date" value={addForm.DueDate} onChange={(e) => handleAddChange('DueDate', e.target.value)} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
                </div>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Amount</label>
                  <input type="number" value={addForm.Amount} onChange={(e) => handleAddChange('Amount', e.target.value)} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
                </div>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Payment Description</label>
                  <input value={addForm.PaymentDescription} onChange={(e) => handleAddChange('PaymentDescription', e.target.value)} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
                </div>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Surcharge Applied?</label>
                  <select value={addForm.SurchargeApplied ? 'true' : 'false'} onChange={(e) => handleAddChange('SurchargeApplied', e.target.value === 'true')} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }}>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                  </select>
                </div>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Surcharge Rate</label>
                  <input type="number" step="0.01" value={addForm.SurchargeRate} onChange={(e) => handleAddChange('SurchargeRate', e.target.value)} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
                </div>
                <div style={{ gridColumn: '1 / -1' }}>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Description</label>
                  <textarea value={addForm.Description} onChange={(e) => handleAddChange('Description', e.target.value)} style={{ width: '100%', minHeight: '80px', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
                </div>

                {saveError && <div style={{ gridColumn: '1 / -1', color: 'crimson' }}>{saveError}</div>}
                <div style={{ gridColumn: '1 / -1', display: 'flex', justifyContent: 'flex-end', gap: '0.5rem' }}>
                  <Button variant="secondary" onClick={() => setAddOpen(false)}>Cancel</Button>
                  <Button variant="primary" onClick={saveAdd} disabled={saving}>{saving ? 'Saving…' : 'Create'}</Button>
                </div>
              </div>
            </ModalBody>
          </ModalCard>
        </ModalBackdrop>
      )}

      {editOpen && editForm && (
        <ModalBackdrop onClick={() => { setEditOpen(false); setEditForm(null); }}>
          <ModalCard onClick={(e) => e.stopPropagation()}>
            <ModalHeader>
              <span>Edit Schedule — {editForm.ScheduleId}</span>
              <div style={{ display: 'flex', gap: '0.5rem' }}>
                <CloseButton onClick={() => { setEditOpen(false); setEditForm(null); }}>Close</CloseButton>
              </div>
            </ModalHeader>
            <ModalBody>
              <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '0.75rem' }}>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Plan ID</label>
                  <input value={editForm.PlanId} onChange={(e) => handleEditChange('PlanId', e.target.value)} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
                </div>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Installment No</label>
                  <input type="number" value={editForm.InstallmentNo} onChange={(e) => handleEditChange('InstallmentNo', e.target.value)} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
                </div>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Due Date</label>
                  <input type="date" value={editForm.DueDate} onChange={(e) => handleEditChange('DueDate', e.target.value)} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
                </div>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Amount</label>
                  <input type="number" value={editForm.Amount} onChange={(e) => handleEditChange('Amount', e.target.value)} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
                </div>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Payment Description</label>
                  <input value={editForm.PaymentDescription} onChange={(e) => handleEditChange('PaymentDescription', e.target.value)} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
                </div>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Surcharge Applied?</label>
                  <select value={editForm.SurchargeApplied ? 'true' : 'false'} onChange={(e) => handleEditChange('SurchargeApplied', e.target.value === 'true')} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }}>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                  </select>
                </div>
                <div>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Surcharge Rate</label>
                  <input type="number" step="0.01" value={editForm.SurchargeRate} onChange={(e) => handleEditChange('SurchargeRate', e.target.value)} style={{ width: '100%', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
                </div>
                <div style={{ gridColumn: '1 / -1' }}>
                  <label style={{ color: '#00234C', fontWeight: 600 }}>Description</label>
                  <textarea value={editForm.Description} onChange={(e) => handleEditChange('Description', e.target.value)} style={{ width: '100%', minHeight: '80px', padding: '0.5rem', border: '1px solid #00234C', borderRadius: 4 }} />
                </div>

                {saveError && <div style={{ gridColumn: '1 / -1', color: 'crimson' }}>{saveError}</div>}
                <div style={{ gridColumn: '1 / -1', display: 'flex', justifyContent: 'flex-end', gap: '0.5rem' }}>
                  <Button variant="secondary" onClick={() => { setEditOpen(false); setEditForm(null); }}>Cancel</Button>
                  <Button variant="primary" onClick={saveEdit} disabled={saving}>{saving ? 'Saving…' : 'Save Changes'}</Button>
                </div>
              </div>
            </ModalBody>
          </ModalCard>
        </ModalBackdrop>
      )}
    </PageContainer>
  );
}
