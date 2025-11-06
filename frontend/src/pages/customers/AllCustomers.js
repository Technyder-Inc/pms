import React from 'react';
import CustomersGrid from '../../components/CustomersGrid';

/**
 * AllCustomers
 * Purpose: Render the customers grid for the "All Customers" view.
 * Inputs: None.
 * Outputs: Grid with filters, pagination, and detail modal.
 */
export default function AllCustomers() {
  return <CustomersGrid title="Customers: All Customers" defaultFilter="All" />;
}