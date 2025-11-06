import React from 'react';
import CustomersGrid from '../../components/CustomersGrid';

/**
 * BlockedCustomers
 * Purpose: Render the customers grid for the "Blocked Customers" view.
 * Inputs: None.
 * Outputs: Grid with filters, pagination, and detail modal.
 */
export default function BlockedCustomers() {
  return <CustomersGrid title="Customers: Blocked Customers" defaultFilter="Blocked" />;
}