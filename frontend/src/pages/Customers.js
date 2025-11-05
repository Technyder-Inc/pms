import React, { useEffect, useMemo, useState } from 'react';
import styled from 'styled-components';
import { useParams, useNavigate } from 'react-router-dom';
import { getCustomers, getCustomer } from '../utils/api';

const PageContainer = styled.div`
  background: white;
  border-radius: 8px;
  padding: 1.5rem;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
`;

const Header = styled.div`
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.5rem 0; /* compact height, but keep inside content width */
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
  font-family: 'Lexend', sans-serif;
  font-weight: 600;
  font-size: 1.1rem;
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
  font-family: 'Lexend', sans-serif;
`;

const Th = styled.th`
  text-align: left;
  padding: 0.75rem;
  background: ${props => props.theme.colors.secondary};
  color: white;
  font-weight: 600;
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
  font-family: 'Lexend', sans-serif;
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
  font-family: 'Lexend', sans-serif;
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
 * CustomersPage
 * Purpose: Display customers list with filters aligned to route segment.
 * Inputs:
 *  - view route param: 'all-customers' | 'active-customers' | 'blocked-customers'
 * Outputs:
 *  - Renders a table of customers with optional client-side filtering
 */
/**
 * CustomersPage
 * Purpose: Render the customers grid with pagination and server-side filters.
 * Inputs: URL `view` segment; internal `status` and `allotment` dropdowns.
 * Outputs: Paginated table data rendered with mapped API fields.
 */
export default function CustomersPage() {
  const { view } = useParams();
  const navigate = useNavigate();
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [customers, setCustomers] = useState([]);
  const [page, setPage] = useState(1);
  const [pageSize, setPageSize] = useState(50);
  const [totalCount, setTotalCount] = useState(0);
  const [totalPages, setTotalPages] = useState(1);
  const [statusFilter, setStatusFilter] = useState(''); // '', Active, Blocked, Cancelled
  const [allotmentFilter, setAllotmentFilter] = useState(''); // '', Allotted, Not Allotted, Pending
  const [selectedId, setSelectedId] = useState(null);
  const [detail, setDetail] = useState(null);
  const [detailLoading, setDetailLoading] = useState(false);
  const [detailError, setDetailError] = useState('');

  const filter = useMemo(() => {
    switch (view) {
      case 'active-customers':
        return 'Active';
      case 'blocked-customers':
        return 'Blocked';
      case 'all-customers':
      default:
        return 'All';
    }
  }, [view]);

  useEffect(() => {
    let isMounted = true;
    setLoading(true);
    setError('');

    // Attempt server-side filter via query if supported; fallback to client filter
    const params = {
      ...(filter === 'All' ? {} : { status: filter }), // legacy route-based filter
      ...(statusFilter ? { status: statusFilter } : {}),
      // Prefer Neon DB column name: allotmentstatus; keep legacy 'allotment' for compatibility
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
        // Capture pagination metadata if available; otherwise infer
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

    return () => {
      isMounted = false;
    };
  }, [filter, statusFilter, allotmentFilter, page, pageSize]);

  /**
   * handleRowDoubleClick
   * Purpose: Open the modal and load the selected customer's details.
   * Inputs:
   *  - id: string customer identifier from the row
   * Outputs:
   *  - Sets modal state and populates detail data
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
    if (filter !== 'All') {
      list = list.filter(c => (c.Status || c.status) === filter || (c.IsActive === true && filter === 'Active') || (c.IsActive === false && filter === 'Blocked'));
    }

    if (allotmentFilter) {
      const target = norm(allotmentFilter);
      list = list.filter(c => {
        const val = norm(c.AllotmentStatus || c.allotmentStatus || c.allotmentstatus);
        return val === target;
      });
    }

    return list;
  }, [customers, filter, allotmentFilter]);

  return (
    <PageContainer>
      <Header>
        <HeaderLeft>
          <Title>Customers</Title>
          <Actions>
            <Button onClick={() => navigate('/customers/all-customers')}>All</Button>
            <Button onClick={() => navigate('/customers/active-customers')}>Active</Button>
            <Button onClick={() => navigate('/customers/blocked-customers')}>Blocked</Button>
            {/* Status filter dropdown */}
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
            {/* Allotment filter dropdown */}
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
          {/* Define percentage-based column widths to ensure 100% fit without overflow */}
          <colgroup>
            <col style={{ width: '12%' }} /> {/* Customer ID */}
            <col style={{ width: '18%' }} /> {/* Full Name */}
            <col style={{ width: '14%' }} /> {/* CNIC */}
            <col style={{ width: '10%' }} /> {/* Gender */}
            <col style={{ width: '26%' }} /> {/* Email */}
            <col style={{ width: '10%' }} /> {/* Phone */}
            <col style={{ width: '10%' }} /> {/* Status */}
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
                <Td colSpan="5">No customers found.</Td>
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

      {/* Detail Modal */}
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
                  {/* Add more fields as needed, avoiding debug-only output */}
                </div>
              )}
            </ModalBody>
          </ModalCard>
        </ModalBackdrop>
      )}
    </PageContainer>
  );
}