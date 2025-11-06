import React, { useEffect, useMemo, useState } from 'react';
import styled from 'styled-components';
import { useNavigate } from 'react-router-dom';
import { getCustomers, getCustomer } from '../utils/api';

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

const HeaderRight = styled.div`
  margin-left: auto;
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
  font-size: 0.95rem; /* slightly lesser for compact header */
`;

const Td = styled.td`
  padding: 0.75rem;
  border-bottom: 1px solid ${props => props.theme.colors.lightGray};
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
`;

const StatusBadge = styled.span`
  display: inline-block;
  padding: 0.25rem 0.5rem;
  border-radius: 12px;
  font-size: 0.85rem;
  color: white;
  background: ${props => props.status === 'Active' ? props.theme.colors.primary : '#d9534f'};
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

const Select = styled.select`
  padding: 0.4rem 0.5rem;
  border: 1px solid ${props => props.theme.colors.secondary};
  border-radius: 4px;
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

const DetailText = styled.span`
  color: ${props => props.theme.colors.secondary};
  font-weight: 600;
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
 * CustomersGrid
 * Purpose: Reusable grid for customers with filters, pagination, and details.
 * Inputs:
 *  - title: string heading for the grid (e.g., 'All Customers')
 *  - defaultFilter: 'All' | 'Active' | 'Blocked'
 * Outputs:
 *  - Renders a paginated table with server-side and client-side filters.
 */
export default function CustomersGrid({ title = 'Customers', defaultFilter = 'All' }) {
  const navigate = useNavigate();
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [customers, setCustomers] = useState([]);
  const [page, setPage] = useState(1);
  const [pageSize, setPageSize] = useState(50);
  const [totalCount, setTotalCount] = useState(0);
  const [totalPages, setTotalPages] = useState(1);
  const [statusFilter, setStatusFilter] = useState('');
  const [allotmentFilter, setAllotmentFilter] = useState('');
  const [selectedId, setSelectedId] = useState(null);
  const [detail, setDetail] = useState(null);
  const [detailLoading, setDetailLoading] = useState(false);
  const [detailError, setDetailError] = useState('');

  const routeFilter = useMemo(() => defaultFilter, [defaultFilter]);

  useEffect(() => {
    let isMounted = true;
    setLoading(true);
    setError('');

    const params = {
      ...(routeFilter === 'All' ? {} : { status: routeFilter }),
      ...(statusFilter ? { status: statusFilter } : {}),
      ...(allotmentFilter ? { allotmentstatus: allotmentFilter } : {}),
      ...(allotmentFilter ? { allotment: allotmentFilter } : {}),
      page,
      pageSize,
    };
    getCustomers(params)
      .then(data => {
        const list = Array.isArray(data?.data) ? data.data : Array.isArray(data) ? data : [];
        if (!isMounted) return;
        setCustomers(list);
        const tc = typeof data?.totalCount === 'number' ? data.totalCount : list.length;
        const pg = typeof data?.page === 'number' ? data.page : page;
        const ps = typeof data?.pageSize === 'number' ? data.pageSize : pageSize;
        const tp = typeof data?.totalPages === 'number' ? data.totalPages : Math.max(1, Math.ceil(tc / ps));
        setTotalCount(tc);
        setPage(pg);
        setPageSize(ps);
        setTotalPages(tp);
      })
      .catch(err => {
        if (!isMounted) return;
        setError(err.message || 'Failed to load customers');
      })
      .finally(() => {
        if (isMounted) setLoading(false);
      });

    return () => { isMounted = false; };
  }, [routeFilter, statusFilter, allotmentFilter, page, pageSize]);

  /**
   * handleRowDoubleClick
   * Purpose: Load the selected customer's details and open the modal.
   * Inputs:
   *  - id: string customer identifier
   * Outputs:
   *  - Populates detail state and sets selectedId for the modal.
   */
  const handleRowDoubleClick = async (id) => {
    const cid = String(id || '').trim();
    if (!cid) return;
    setSelectedId(cid);
    setDetail(null);
    setDetailError('');
    setDetailLoading(true);
    try {
      const data = await getCustomer(cid);
      setDetail(data);
    } catch (e) {
      setDetailError(e.message || 'Failed to load customer details');
    } finally {
      setDetailLoading(false);
    }
  };

  const filtered = useMemo(() => {
    const norm = v => String(v ?? '').trim().toLowerCase();

    let list = customers;
    if (routeFilter !== 'All') {
      list = list.filter(c => (c.Status || c.status) === routeFilter || (c.IsActive === true && routeFilter === 'Active') || (c.IsActive === false && routeFilter === 'Blocked'));
    }

    if (allotmentFilter) {
      const target = norm(allotmentFilter);
      list = list.filter(c => {
        const val = norm(c.AllotmentStatus || c.allotmentStatus || c.allotmentstatus);
        return val === target;
      });
    }

    return list;
  }, [customers, routeFilter, allotmentFilter]);

  return (
    <PageContainer>
      <Header>
        <HeaderLeft>
          <Title>{title}</Title>
          <Actions>
            <Button onClick={() => navigate('/customers/all-customers')}>All</Button>
            <Button onClick={() => navigate('/customers/active-customers')}>Active</Button>
            <Button onClick={() => navigate('/customers/blocked-customers')}>Blocked</Button>
            <Select
              value={statusFilter}
              onChange={(e) => { setPage(1); setStatusFilter(e.target.value); }}
              aria-label="Status Filter"
            >
              <option value="">All Statuses</option>
              <option value="Active">Active</option>
              <option value="Blocked">Blocked</option>
              <option value="Cancelled">Cancelled</option>
            </Select>
            <Select
              value={allotmentFilter}
              onChange={(e) => { setPage(1); setAllotmentFilter(e.target.value); }}
              aria-label="Allotment Status"
            >
              <option value="">All Allotment Statuses</option>
              <option value="Allotted">Allotted</option>
              <option value="Not Allotted">Not Allotted</option>
              <option value="Pending">Pending</option>
            </Select>
          </Actions>
        </HeaderLeft>
        <HeaderRight>
          <DetailText>Customers Detail</DetailText>
        </HeaderRight>
      </Header>

      {loading && <div>Loading customers…</div>}
      {error && <div style={{ color: 'crimson' }}>{error}</div>}

      {!loading && !error && (
        <Table>
          <colgroup>
            <col style={{ width: '12%' }} />
            <col style={{ width: '18%' }} />
            <col style={{ width: '14%' }} />
            <col style={{ width: '10%' }} />
            <col style={{ width: '26%' }} />
            <col style={{ width: '10%' }} />
            <col style={{ width: '10%' }} />
          </colgroup>
          <thead>
            <tr>
              <Th>Customer ID</Th>
              <Th>Full Name</Th>
              <Th>CNIC</Th>
              <Th>Gender</Th>
              <Th>Email</Th>
              <Th>Phone</Th>
              <Th>Status</Th>
            </tr>
          </thead>
          <tbody>
            {filtered.map((c) => (
              <tr
                key={c.CustomerId || c.customerId || c.id}
                onDoubleClick={() => handleRowDoubleClick(c.CustomerId || c.customerId || c.id)}
                style={{ cursor: 'pointer' }}
                title="Double-click to open details"
              >
                <Td>{c.CustomerId || c.customerId || c.id}</Td>
                <Td>{c.FullName || c.fullName || c.full_name || c.Name || c.name}</Td>
                <Td>{c.Cnic || c.cnic}</Td>
                <Td>{(c.Gender || c.gender || '').toString() || '—'}</Td>
                <Td>{c.Email || c.email}</Td>
                <Td>{c.Phone || c.phone}</Td>
                <Td>
                  <StatusBadge status={(c.Status || c.status || (c.IsActive === true ? 'Active' : c.IsActive === false ? 'Blocked' : 'Unknown'))}>
                    {c.Status || c.status || (c.IsActive === true ? 'Active' : c.IsActive === false ? 'Blocked' : 'Unknown')}
                  </StatusBadge>
                </Td>
              </tr>
            ))}
            {filtered.length === 0 && (
              <tr>
                <Td colSpan="7">No customers found.</Td>
              </tr>
            )}
          </tbody>
        </Table>
      )}

      {!loading && !error && (
        <Footer>
          <div>
            Showing {filtered.length} of {totalCount} customers
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
              {[10, 25, 50, 100].map((n) => (
                <option key={n} value={n}>{n}</option>
              ))}
            </Select>
            <span>Page {page} of {totalPages}</span>
            <SmallButton
              onClick={() => setPage((p) => Math.max(1, p - 1))}
              disabled={page <= 1}
            >
              Prev
            </SmallButton>
            <SmallButton
              onClick={() => setPage((p) => Math.min(totalPages, p + 1))}
              disabled={page >= totalPages}
            >
              Next
            </SmallButton>
          </Pager>
        </Footer>
      )}

      {selectedId && (
        <ModalBackdrop onClick={() => { setSelectedId(null); setDetail(null); }}>
          <ModalCard onClick={(e) => e.stopPropagation()}>
            <ModalHeader>
              <span>Customer Details — {selectedId}</span>
              <CloseButton onClick={() => { setSelectedId(null); setDetail(null); }}>Close</CloseButton>
            </ModalHeader>
            <ModalBody>
              {detailLoading && <div>Loading details…</div>}
              {detailError && <div style={{ color: 'crimson' }}>{detailError}</div>}
              {!detailLoading && !detailError && detail && (
                <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '0.75rem' }}>
                  <div><strong>ID:</strong> {detail.customerId || detail.CustomerId}</div>
                  <div><strong>Name:</strong> {detail.fullName || detail.FullName}</div>
                  <div><strong>Gender:</strong> {(detail.gender || detail.Gender || '').toString() || '—'}</div>
                  <div><strong>Email:</strong> {detail.email || detail.Email}</div>
                  <div><strong>Phone:</strong> {detail.phone || detail.Phone}</div>
                  <div><strong>CNIC:</strong> {detail.cnic || detail.Cnic}</div>
                  <div><strong>Status:</strong> {detail.status || detail.Status}</div>
                  <div><strong>City:</strong> {detail.city || detail.City}</div>
                  <div><strong>Country:</strong> {detail.country || detail.Country}</div>
                  <div><strong>Reg ID:</strong> {detail.regId || detail.RegId}</div>
                  <div><strong>Plan ID:</strong> {detail.planId || detail.PlanId}</div>
                </div>
              )}
            </ModalBody>
          </ModalCard>
        </ModalBackdrop>
      )}
    </PageContainer>
  );
}