/**
 * fetchJson
 * Purpose: Perform a JSON HTTP request to the backend API with optional auth.
 * Inputs:
 *  - path: string API path like "/api/Customers"
 *  - options: fetch options (method, headers, body)
 * Outputs:
 *  - Resolves to parsed JSON response or throws error with context
 */
export async function fetchJson(path, options = {}) {
  const baseUrl = process.env.REACT_APP_API_URL || 'http://localhost:5296';

  const headers = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    ...(options.headers || {}),
  };

  // Attach JWT from localStorage if present, except for auth endpoints
  const token = localStorage.getItem('jwt');
  const lowerPath = String(path || '').toLowerCase();
  const isAuthEndpoint = lowerPath.includes('/api/auth/login') || lowerPath.includes('/api/auth/register');
  if (token && !headers.Authorization && !isAuthEndpoint) {
    headers.Authorization = `Bearer ${token}`;
  }

  const resp = await fetch(`${baseUrl}${path}`, {
    ...options,
    headers,
  });

  const contentType = resp.headers.get('content-type') || '';
  const isJson = contentType.includes('application/json');
  const data = isJson ? await resp.json() : await resp.text();

  if (!resp.ok) {
    const message = isJson ? (data.message || JSON.stringify(data)) : data;
    throw new Error(`API error ${resp.status}: ${message}`);
  }

  return data;
}

/**
 * getCustomers
 * Purpose: Fetch customers list from the backend, optionally filtered.
 * Inputs:
 *  - params: object of query params (e.g., { page, pageSize, status })
 * Outputs:
 *  - Returns customers array or paginated object depending on API
 */
export async function getCustomers(params = {}) {
  const query = new URLSearchParams();
  Object.entries(params).forEach(([k, v]) => {
    if (v !== undefined && v !== null && v !== '') query.append(k, v);
  });

  const path = query.toString()
    ? `/api/Customers?${query.toString()}`
    : '/api/Customers';

  return fetchJson(path);
}

/**
 * getCustomer
 * Purpose: Fetch a single customer by ID for detail view.
 * Inputs:
 *  - id: string customer identifier (e.g., 'C0001234')
 * Outputs:
 *  - Returns a customer object with related entities when available
 */
export async function getCustomer(id) {
  if (!id) throw new Error('Customer id is required');
  return fetchJson(`/api/Customers/${encodeURIComponent(id)}`);
}

/**
 * login
 * Purpose: Authenticate a user with email and password, store JWT.
 * Inputs:
 *  - email: string user email
 *  - password: string user password
 * Outputs:
 *  - Returns the login response { token, expiresAt, user }
 *  - Side effect: stores `jwt`, `jwt_expires`, and `user` in localStorage
 */
export async function login(email, password) {
  if (!email || !password) throw new Error('Email and password are required');
  const res = await fetchJson('/api/Auth/login', {
    method: 'POST',
    // Normalize to avoid whitespace/casing mismatch with backend
    body: JSON.stringify({ email: String(email).trim(), password: String(password).trim() }),
  });

  // Persist auth (robust to different JSON casing)
  const token = res.token ?? res.Token;
  const expiresAt = res.expiresAt ?? res.ExpiresAt;
  const user = res.user ?? res.User;

  if (!token) {
    throw new Error('Login succeeded but no token returned');
  }

  localStorage.setItem('jwt', token);
  localStorage.setItem('jwt_expires', typeof expiresAt === 'string' ? expiresAt : String(expiresAt ?? ''));
  localStorage.setItem('user', JSON.stringify(user));
  return { token, expiresAt, user };
}