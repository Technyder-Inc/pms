import React from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { ThemeProvider } from 'styled-components';
import GlobalStyles, { theme } from './styles/GlobalStyles';
import Layout from './layouts/Layout';
import {
  Dashboard,
  Projects,
  Tasks,
  Team,
  Calendar,
  Reports,
  Settings,
  Login
} from './pages';
import ModuleRouter from './pages/ModuleRouter';
import RequireAuth from './components/RequireAuth';

function App() {
  return (
  <ThemeProvider theme={theme}>
      <GlobalStyles />
      <Router future={{ v7_startTransition: true, v7_relativeSplatPath: true }}>
        <Routes>
          {/* Public routes */}
          <Route path="/login" element={<Login />} />
          <Route path="/" element={<Layout />}>
            {/* Default start at login */}
            <Route index element={<Navigate to="/login" replace />} />
            {/* Protected application routes */}
            <Route element={<RequireAuth />}>
              <Route path="dashboard" element={<Dashboard />} />
              <Route path="customers" element={<Navigate to="/customers/all-customers" replace />} />
              <Route path="projects" element={<Projects />} />
              <Route path="tasks" element={<Tasks />} />
              <Route path="team" element={<Team />} />
              <Route path="calendar" element={<Calendar />} />
              <Route path="reports" element={<Reports />} />
              <Route path="settings" element={<Settings />} />
              {/* Dynamic routes for new sidebar sections */}
              <Route path=":module" element={<ModuleRouter />} />
              <Route path=":module/:view" element={<ModuleRouter />} />
            </Route>
          </Route>
        </Routes>
      </Router>
    </ThemeProvider>
  );
}

export default App;
