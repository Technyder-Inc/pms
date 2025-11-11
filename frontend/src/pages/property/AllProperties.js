import React from 'react';
import PropertiesGrid from '../../components/PropertiesGrid';

/**
 * AllProperties
 * Purpose: Property → All Properties page that displays a grid of all properties.
 * Inputs: None (reads filters inside PropertiesGrid).
 * Outputs: Renders PropertiesGrid with full CRUD support and pagination.
 */
export default function AllProperties() {
  return <PropertiesGrid title="All Properties" defaultFilter="All" />;
}