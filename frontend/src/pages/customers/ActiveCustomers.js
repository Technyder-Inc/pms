import React from 'react';
import CustomersGrid from '../../components/CustomersGrid';

/**
 * ActiveCustomers
 * Purpose: Render the customers grid for the "Active Customers" view.
 * Inputs: None.
 * Outputs: Grid with filters, pagination, and detail modal.
 */
export default function ActiveCustomers() {
  return <CustomersGrid title="Customers: Active Customers" defaultFilter="Active" />;
}