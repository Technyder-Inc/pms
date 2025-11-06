// Purpose: Route guard component that restricts access to authenticated users only.
// Inputs: None directly; reads `jwt` from `localStorage` and current location via React Router.
// Outputs: Renders protected child routes when authenticated, otherwise redirects to `/login`.
import React from 'react';
import { Navigate, Outlet, useLocation } from 'react-router-dom';

/**
 * RequireAuth ensures only authenticated users can access protected routes.
 * - Checks for a JWT token in `localStorage` under the key `jwt`.
 * - If no token is present, redirects to `/login` and preserves the intended path in state.
 * - If authenticated, renders an `<Outlet/>` to display nested protected routes.
 *
 * Returns:
 * - `<Navigate to="/login" />` when unauthenticated
 * - `<Outlet />` when authenticated
 */
function RequireAuth() {
  const location = useLocation();
  const token = typeof window !== 'undefined' ? window.localStorage.getItem('jwt') : null;

  if (!token) {
    return <Navigate to="/login" state={{ from: location }} replace />;
  }

  return <Outlet />;
}

export default RequireAuth;