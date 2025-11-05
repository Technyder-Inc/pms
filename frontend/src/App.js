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
  Customers,
  Login
} from './pages';

function App() {
  return (
  <ThemeProvider theme={theme}>
      <GlobalStyles />
      <Router future={{ v7_startTransition: true, v7_relativeSplatPath: true }}>
        <Routes>
          {/* Public routes */}
          <Route path="/login" element={<Login />} />
          <Route path="/" element={<Layout />}>
            <Route index element={<Navigate to="/dashboard" replace />} />
          <Route path="dashboard" element={<Dashboard />} />
          <Route path="customers" element={<Navigate to="/customers/all-customers" replace />} />
          <Route path="customers/:view" element={<Customers />} />
          <Route path="projects" element={<Projects />} />
            <Route path="tasks" element={<Tasks />} />
            <Route path="team" element={<Team />} />
            <Route path="calendar" element={<Calendar />} />
            <Route path="reports" element={<Reports />} />
            <Route path="settings" element={<Settings />} />
          </Route>
        </Routes>
      </Router>
    </ThemeProvider>
  );
}

export default App;
