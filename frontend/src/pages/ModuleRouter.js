import React from 'react';
import styled from 'styled-components';
import { useParams } from 'react-router-dom';

const Container = styled.div`
  padding: 1.5rem;
  font-family: 'Lexend', sans-serif;
`;

const Title = styled.h1`
  margin: 0 0 0.5rem 0;
  color: ${props => props.theme.colors.secondary};
  font-size: 1.25rem;
`;

const Badge = styled.span`
  display: inline-block;
  margin-top: 0.5rem;
  background: ${props => props.theme.colors.primary};
  color: white;
  padding: 0.25rem 0.5rem;
  border-radius: 4px;
  font-size: 0.85rem;
`;

/**
 * ModuleRouter
 * Purpose: Route dynamic module/view paths to their specific components. If a
 *          component is not yet implemented, show a branded fallback.
 * Inputs: Reads `module` and `view` from URL params.
 * Outputs: Renders the mapped component or a simple placeholder.
 */
export default function ModuleRouter() {
  const { module, view } = useParams();

  // Map of module/view to components. Extend as new pages are added.
  const routes = {
    customers: {
      'all-customers': React.lazy(() => import('./customers/AllCustomers')),
      'active-customers': React.lazy(() => import('./customers/ActiveCustomers')),
      'blocked-customers': React.lazy(() => import('./customers/BlockedCustomers')),
    },
    property: {
      projects: React.lazy(() => import('./property/Projects')),
      'inventory-status': React.lazy(() => import('./property/InventoryStatus')),
      'price-management': React.lazy(() => import('./property/PriceManagement')),
      'availability-matrix': React.lazy(() => import('./property/AvailabilityMatrix')),
    },
    payments: {
      collections: React.lazy(() => import('./payments/Collections')),
      'dues-defaulters': React.lazy(() => import('./payments/DuesDefaulters')),
      'waivers-adjustments': React.lazy(() => import('./payments/WaiversAdjustments')),
      'ndc-management': React.lazy(() => import('./payments/NdcManagement')),
      refunds: React.lazy(() => import('./payments/Refunds')),
      'financial-ledger': React.lazy(() => import('./payments/FinancialLedger')),
    },
    schedule: {
      bookings: React.lazy(() => import('./schedule/Bookings')),
      'holds-management': React.lazy(() => import('./schedule/HoldsManagement')),
      possession: React.lazy(() => import('./schedule/Possession')),
      'booking-approvals': React.lazy(() => import('./schedule/BookingApprovals')),
      'payment-schedule-editor': React.lazy(() => import('./schedule/PaymentScheduleEditor')),
    },
    transfer: {
      'transfer-requests': React.lazy(() => import('./transfer/TransferRequests')),
      'transfer-approvals': React.lazy(() => import('./transfer/TransferApprovals')),
    },
    reports: {
      'sales-analytics': React.lazy(() => import('./reports/SalesAnalytics')),
      'collections-analytics': React.lazy(() => import('./reports/CollectionsAnalytics')),
      'dues-analysis': React.lazy(() => import('./reports/DuesAnalysis')),
      'possession-status': React.lazy(() => import('./reports/PossessionStatus')),
      'transfer-summary': React.lazy(() => import('./reports/TransferSummary')),
      'custom-reports': React.lazy(() => import('./reports/CustomReports')),
    },
    'ai-automation': {
      'lead-scoring': React.lazy(() => import('./ai-automation/LeadScoring')),
      'collection-prediction': React.lazy(() => import('./ai-automation/CollectionPrediction')),
      'anomaly-detection': React.lazy(() => import('./ai-automation/AnomalyDetection')),
      'automated-reminders': React.lazy(() => import('./ai-automation/AutomatedReminders')),
      'smart-recommendations': React.lazy(() => import('./ai-automation/SmartRecommendations')),
      'audit-trail-ai-actions': React.lazy(() => import('./ai-automation/AuditTrailAIActions')),
    },
    settings: {
      'company-settings': React.lazy(() => import('./settings/CompanySettings')),
      'business-rules': React.lazy(() => import('./settings/BusinessRules')),
      'payment-configuration': React.lazy(() => import('./settings/PaymentConfiguration')),
      'notification-rules': React.lazy(() => import('./settings/NotificationRules')),
      'users-roles': React.lazy(() => import('./settings/UsersRoles')),
      'approval-workflows': React.lazy(() => import('./settings/ApprovalWorkflows')),
      'system-configuration': React.lazy(() => import('./settings/SystemConfiguration')),
      'compliance-configuration': React.lazy(() => import('./settings/ComplianceConfiguration')),
    },
    compliance: {
      'audit-trail': React.lazy(() => import('./compliance/AuditTrail')),
      'approval-queue': React.lazy(() => import('./compliance/ApprovalQueue')),
      'compliance-events': React.lazy(() => import('./compliance/ComplianceEvents')),
      'data-management': React.lazy(() => import('./compliance/DataManagement')),
      'risk-assessment': React.lazy(() => import('./compliance/RiskAssessment')),
      'policy-monitoring': React.lazy(() => import('./compliance/PolicyMonitoring')),
      'compliance-reports': React.lazy(() => import('./compliance/ComplianceReports')),
    },
  };

  const Mod = routes[module]?.[view];
  if (Mod) {
    return (
      <React.Suspense fallback={<Container><Title>Loading…</Title></Container>}>
        <Mod />
      </React.Suspense>
    );
  }

  const title = (module || 'Module').replace(/-/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
  const detail = (view || 'Overview').replace(/-/g, ' ');
  return (
    <Container>
      <Title>{title}</Title>
      <div>This section is a placeholder for “{title}”.</div>
      <Badge>{detail}</Badge>
    </Container>
  );
}