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

  // Attach JWT from localStorage if present
  const token = localStorage.getItem('jwt');
  if (token && !headers.Authorization) {
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