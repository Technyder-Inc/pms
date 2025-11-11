import React, { useEffect, useMemo, useState } from 'react';
import styled from 'styled-components';
import { useNavigate } from 'react-router-dom';
import { getProperties, getProperty, createProperty, updateProperty, deleteProperty } from '../utils/api';

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

const Input = styled.input`
  padding: 0.4rem 0.5rem;
  border: 1px solid ${props => props.theme.colors.secondary};
  border-radius: 4px;
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

const StatusBadge = styled.span`
  display: inline-block;
  padding: 0.25rem 0.5rem;
  border-radius: 12px;
  font-size: 0.85rem;
  color: white;
  background: ${props => {
    const s = String(props.status || '').toLowerCase();
    if (s === 'available') return props.theme.colors.primary;
    if (s === 'allotted') return '#2ca02c';
    if (s === 'sold') return '#d9534f';
    return props.theme.colors.secondary;
  }};
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
  width: 780px;
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

const FormGrid = styled.div`
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0.75rem;
`;

const Label = styled.label`
  font-size: 0.9rem;
  color: ${p => p.theme.colors.secondary};
`;

const Field = styled.input`
  width: 100%;
  padding: 0.4rem 0.5rem;
  border: 1px solid ${p => p.theme.colors.secondary};
  border-radius: 4px;
`;

const ActionsRow = styled.div`
  display: flex;
  justify-content: flex-end;
  gap: 0.5rem;
  margin-top: 0.75rem;
`;

/**
 * PropertiesGrid
 * Purpose: Render properties list with filters, pagination, and CRUD actions.
 * Inputs:
 *  - title: string heading for the grid (e.g., 'All Properties')
 *  - defaultFilter: 'All' | 'Available' | 'Allotted' | 'Sold'
 * Outputs:
 *  - Table of properties with create/edit/delete modals and server-side pagination.
 */
export default function PropertiesGrid({ title = 'Properties', defaultFilter = 'All' }) {
  const navigate = useNavigate();
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [properties, setProperties] = useState([]);
  const [page, setPage] = useState(1);
  const [pageSize, setPageSize] = useState(50);
  const [totalCount, setTotalCount] = useState(0);
  const [totalPages, setTotalPages] = useState(1);
  const [statusFilter, setStatusFilter] = useState('');
  const [search, setSearch] = useState('');
  const [selectedId, setSelectedId] = useState(null);
  const [detail, setDetail] = useState(null);
  const [detailLoading, setDetailLoading] = useState(false);
  const [detailError, setDetailError] = useState('');
  const [showCreate, setShowCreate] = useState(false);
  const [editData, setEditData] = useState(null);

  const routeFilter = useMemo(() => defaultFilter, [defaultFilter]);

  useEffect(() => {
    let isMounted = true;
    setLoading(true);
    setError('');
    const params = {
      ...(routeFilter === 'All' ? {} : { status: routeFilter }),
      ...(statusFilter ? { status: statusFilter } : {}),
      ...(search ? { search } : {}),
      page,
      pageSize,
    };
    getProperties(params)
      .then(data => {
        const list = Array.isArray(data?.data) ? data.data : Array.isArray(data) ? data : [];
        if (!isMounted) return;
        setProperties(list);
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
        setError(err.message || 'Failed to load properties');
      })
      .finally(() => {
        if (isMounted) setLoading(false);
      });
    return () => { isMounted = false; };
  }, [routeFilter, statusFilter, search, page, pageSize]);

  /**
   * handleRowDoubleClick
   * Purpose: Load the selected property's details and open the modal.
   * Inputs:
   *  - id: string property identifier
   * Outputs:
   *  - Populates detail state and sets selectedId for the modal.
   */
  const handleRowDoubleClick = async (id) => {
    const pid = String(id || '').trim();
    if (!pid) return;
    setSelectedId(pid);
    setDetail(null);
    setDetailError('');
    setDetailLoading(true);
    try {
      const data = await getProperty(pid);
      setDetail(data);
    } catch (e) {
      setDetailError(e.message || 'Failed to load property details');
    } finally {
      setDetailLoading(false);
    }
  };

  /**
   * handleCreate
   * Purpose: Create a new property using form data.
   * Inputs:
   *  - payload: object with property fields
   * Outputs:
   *  - Creates property and refreshes the grid.
   */
  const handleCreate = async (payload) => {
    try {
      await createProperty(payload);
      setShowCreate(false);
      setPage(1);
    } catch (e) {
      alert(e.message || 'Failed to create property');
    }
  };

  /**
   * handleUpdate
   * Purpose: Update an existing property.
   * Inputs:
   *  - id: string property id
   *  - payload: object of updated fields
   * Outputs:
   *  - Updates property and refreshes the grid.
   */
  const handleUpdate = async (id, payload) => {
    try {
      await updateProperty(id, { ...payload, PropertyId: id });
      setEditData(null);
      setPage(page); // reload current page
    } catch (e) {
      alert(e.message || 'Failed to update property');
    }
  };

  /**
   * handleDelete
   * Purpose: Delete a property by id.
   * Inputs:
   *  - id: string property id
   * Outputs:
   *  - Deletes property and refreshes the grid.
   */
  const handleDelete = async (id) => {
    if (!window.confirm('Are you sure you want to delete this property?')) return;
    try {
      await deleteProperty(id);
      setPage(1);
    } catch (e) {
      alert(e.message || 'Failed to delete property');
    }
  };

  const filtered = useMemo(() => {
    let list = properties;
    if (routeFilter !== 'All') {
      list = list.filter(p => (p.Status || p.status) === routeFilter);
    }
    return list;
  }, [properties, routeFilter]);

  return (
    <PageContainer>
      <Header>
        <HeaderLeft>
          <Title>{title}</Title>
          <Actions>
            <Button onClick={() => navigate('/property/all-properties')}>All</Button>
            <Select
              value={statusFilter}
              onChange={(e) => { setPage(1); setStatusFilter(e.target.value); }}
              aria-label="Status Filter"
            >
              <option value="">All Statuses</option>
              <option value="Available">Available</option>
              <option value="Allotted">Allotted</option>
              <option value="Sold">Sold</option>
            </Select>
            <Input
              value={search}
              placeholder="Search (project, block, plot, location)"
              onChange={(e) => { setPage(1); setSearch(e.target.value); }}
              aria-label="Search Properties"
            />
          </Actions>
        </HeaderLeft>
        <HeaderRight>
          <Button variant="primary" onClick={() => setShowCreate(true)}>New Property</Button>
        </HeaderRight>
      </Header>

      {loading && <div>Loading properties…</div>}
      {error && <div style={{ color: 'crimson' }}>{error}</div>}

      {!loading && !error && (
        <Table>
          <colgroup>
            <col style={{ width: '14%' }} />
            <col style={{ width: '20%' }} />
            <col style={{ width: '12%' }} />
            <col style={{ width: '12%' }} />
            <col style={{ width: '12%' }} />
            <col style={{ width: '14%' }} />
            <col style={{ width: '10%' }} />
            <col style={{ width: '6%' }} />
          </colgroup>
          <thead>
            <tr>
              <Th>Property ID</Th>
              <Th>Project</Th>
              <Th>Block</Th>
              <Th>Plot No</Th>
              <Th>Size</Th>
              <Th>Type/Category</Th>
              <Th>Status</Th>
              <Th>Actions</Th>
            </tr>
          </thead>
          <tbody>
            {filtered.map((p) => (
              <tr
                key={p.PropertyId || p.propertyId || p.id}
                onDoubleClick={() => handleRowDoubleClick(p.PropertyId || p.propertyId || p.id)}
                style={{ cursor: 'pointer' }}
                title="Double-click to open details"
              >
                <Td>{p.PropertyId || p.propertyId || p.id}</Td>
                <Td>{p.ProjectName || p.projectName || p.projectid || p.projectId}</Td>
                <Td>{p.Block || p.block}</Td>
                <Td>{p.PlotNo || p.plotNo || p.plotno}</Td>
                <Td>{p.Size || p.size}</Td>
                <Td>{(p.Type || p.type || p.PropertyType || p.propertytype || p.Category || p.category) || '—'}</Td>
                <Td>
                  <StatusBadge status={(p.Status || p.status)}>
                    {p.Status || p.status || 'Unknown'}
                  </StatusBadge>
                </Td>
                <Td>
                  <SmallButton onClick={() => setEditData(p)}>Edit</SmallButton>
                  <SmallButton onClick={() => handleDelete(p.PropertyId || p.propertyId || p.id)}>Delete</SmallButton>
                </Td>
              </tr>
            ))}
            {filtered.length === 0 && (
              <tr>
                <Td colSpan="8">No properties found.</Td>
              </tr>
            )}
          </tbody>
        </Table>
      )}

      {!loading && !error && (
        <Footer>
          <div>
            Showing {filtered.length} of {totalCount} properties
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
              <span>Property Details — {selectedId}</span>
              <CloseButton onClick={() => { setSelectedId(null); setDetail(null); }}>Close</CloseButton>
            </ModalHeader>
            <ModalBody>
              {detailLoading && <div>Loading details…</div>}
              {detailError && <div style={{ color: 'crimson' }}>{detailError}</div>}
              {!detailLoading && !detailError && detail && (
                <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '0.75rem' }}>
                  <div><strong>ID:</strong> {detail.propertyId || detail.PropertyId}</div>
                  <div><strong>Project:</strong> {detail.projectName || detail.ProjectName}</div>
                  <div><strong>Block:</strong> {detail.block || detail.Block}</div>
                  <div><strong>Plot No:</strong> {detail.plotNo || detail.PlotNo}</div>
                  <div><strong>Size:</strong> {detail.size || detail.Size}</div>
                  <div><strong>Type:</strong> {detail.type || detail.Type}</div>
                  <div><strong>Category:</strong> {detail.category || detail.Category}</div>
                  <div><strong>Status:</strong> {detail.status || detail.Status}</div>
                  <div><strong>Location:</strong> {detail.location || detail.Location}</div>
                  <div><strong>Price:</strong> {detail.price || detail.Price}</div>
                  <div><strong>Created At:</strong> {detail.createdAt || detail.CreatedAt}</div>
                </div>
              )}
            </ModalBody>
          </ModalCard>
        </ModalBackdrop>
      )}

      {showCreate && (
        <ModalBackdrop onClick={() => setShowCreate(false)}>
          <ModalCard onClick={(e) => e.stopPropagation()}>
            <ModalHeader>
              <span>New Property</span>
              <CloseButton onClick={() => setShowCreate(false)}>Close</CloseButton>
            </ModalHeader>
            <ModalBody>
              <PropertyForm onSubmit={handleCreate} />
            </ModalBody>
          </ModalCard>
        </ModalBackdrop>
      )}

      {editData && (
        <ModalBackdrop onClick={() => setEditData(null)}>
          <ModalCard onClick={(e) => e.stopPropagation()}>
            <ModalHeader>
              <span>Edit Property — {editData.PropertyId || editData.propertyId}</span>
              <CloseButton onClick={() => setEditData(null)}>Close</CloseButton>
            </ModalHeader>
            <ModalBody>
              <PropertyForm
                initial={editData}
                onSubmit={(payload) => handleUpdate(editData.PropertyId || editData.propertyId, payload)}
              />
            </ModalBody>
          </ModalCard>
        </ModalBackdrop>
      )}
    </PageContainer>
  );
}

/**
 * PropertyForm
 * Purpose: Controlled form for creating/updating properties.
 * Inputs:
 *  - initial: optional initial values for editing
 *  - onSubmit: function to call with form payload
 * Outputs:
 *  - Emits payload with normalized keys matching backend model.
 */
function PropertyForm({ initial, onSubmit }) {
  const [form, setForm] = useState({
    ProjectName: initial?.ProjectName || initial?.projectName || '',
    SubProject: initial?.SubProject || initial?.subProject || '',
    Block: initial?.Block || initial?.block || '',
    PlotNo: initial?.PlotNo || initial?.plotNo || '',
    Size: initial?.Size || initial?.size || '',
    Category: initial?.Category || initial?.category || '',
    Type: initial?.Type || initial?.type || '',
    Location: initial?.Location || initial?.location || '',
    Price: initial?.Price ?? initial?.price ?? '',
    Status: initial?.Status || initial?.status || 'Available',
  });

  const set = (k) => (e) => setForm(f => ({ ...f, [k]: e.target.value }));

  return (
    <form onSubmit={(e) => { e.preventDefault(); onSubmit(form); }}>
      <FormGrid>
        <div>
          <Label>Project Name</Label>
          <Field value={form.ProjectName} onChange={set('ProjectName')} />
        </div>
        <div>
          <Label>Sub Project</Label>
          <Field value={form.SubProject} onChange={set('SubProject')} />
        </div>
        <div>
          <Label>Block</Label>
          <Field value={form.Block} onChange={set('Block')} />
        </div>
        <div>
          <Label>Plot No</Label>
          <Field value={form.PlotNo} onChange={set('PlotNo')} />
        </div>
        <div>
          <Label>Size</Label>
          <Field value={form.Size} onChange={set('Size')} />
        </div>
        <div>
          <Label>Category</Label>
          <Field value={form.Category} onChange={set('Category')} />
        </div>
        <div>
          <Label>Type</Label>
          <Field value={form.Type} onChange={set('Type')} />
        </div>
        <div>
          <Label>Location</Label>
          <Field value={form.Location} onChange={set('Location')} />
        </div>
        <div>
          <Label>Price</Label>
          <Field value={form.Price} onChange={set('Price')} />
        </div>
        <div>
          <Label>Status</Label>
          <Select value={form.Status} onChange={set('Status')}>
            <option value="Available">Available</option>
            <option value="Allotted">Allotted</option>
            <option value="Sold">Sold</option>
          </Select>
        </div>
      </FormGrid>
      <ActionsRow>
        <Button type="submit" variant="primary">Save</Button>
      </ActionsRow>
    </form>
  );
}