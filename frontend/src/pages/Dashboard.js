import React from 'react';
import styled from 'styled-components';
import { FiUsers, FiCheckCircle, FiSlash, FiTrendingUp } from 'react-icons/fi';

const Wrap = styled.div`
  padding: 1.5rem;
  font-family: 'Lexend', sans-serif;
`;

const Header = styled.div`
  display: flex;
  align-items: baseline;
  justify-content: space-between;
  margin-bottom: 1rem;
`;

const Title = styled.h1`
  margin: 0;
  color: ${p => p.theme.colors.secondary};
  font-size: 1.4rem;
`;

const Updated = styled.span`
  color: ${p => p.theme.colors.gray};
  font-size: 0.85rem;
`;

const Grid = styled.div`
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 1rem;
  @media (max-width: 1200px) {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
  @media (max-width: 640px) {
    grid-template-columns: 1fr;
  }
`;

const Card = styled.div`
  background: #fff;
  border-radius: 10px;
  border-top: 4px solid ${p => p.theme.colors.primary};
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  padding: 1rem;
  display: flex;
  align-items: center;
  gap: 0.75rem;
`;

const IconWrap = styled.div`
  width: 42px;
  height: 42px;
  border-radius: 8px;
  background: ${p => p.theme.colors.lightGray};
  display: flex;
  align-items: center;
  justify-content: center;
  color: ${p => p.theme.colors.secondary};
`;

const Metric = styled.div`
  display: flex;
  flex-direction: column;
`;

const Label = styled.span`
  color: ${p => p.theme.colors.gray};
  font-size: 0.85rem;
`;

const Value = styled.span`
  color: ${p => p.theme.colors.secondary};
  font-size: 1.4rem;
  font-weight: 700;
`;

/**
 * StatCard
 * Purpose: Render a single metric card for dashboard summary.
 * Inputs:
 *  - icon: React component — visual icon for the metric
 *  - label: string — metric label (e.g., "Total Customers")
 *  - value: number|string — metric value to display
 * Outputs: A styled card showing the metric with brand styling.
 */
function StatCard({ icon: Icon, label, value }) {
  return (
    <Card>
      <IconWrap><Icon size={22} /></IconWrap>
      <Metric>
        <Label>{label}</Label>
        <Value>{value}</Value>
      </Metric>
    </Card>
  );
}

/**
 * Dashboard
 * Purpose: Display key customer-related KPIs on the home dashboard.
 * Inputs: None.
 * Outputs: A responsive grid of summary KPI cards with static values.
 */
export default function Dashboard() {
  // Static metrics requested for MVP display
  const metrics = [
    { label: 'Total Customers', value: 1200, icon: FiUsers },
    { label: 'Paid Customers', value: 780, icon: FiCheckCircle },
    { label: 'Blocked Customers', value: 32, icon: FiSlash },
    { label: 'Active Customers', value: 950, icon: FiTrendingUp },
  ];

  return (
    <Wrap>
      <Header>
        <Title>Dashboard Overview</Title>
        <Updated>Last updated: Static placeholder</Updated>
      </Header>
      <Grid>
        {metrics.map((m) => (
          <StatCard key={m.label} icon={m.icon} label={m.label} value={m.value} />
        ))}
      </Grid>

      <ChartsGrid>
        <ChartCard>
          <SectionTitle>Monthly Paid Customers</SectionTitle>
          <SectionNote>Static demo data for recent months</SectionNote>
          <BarChart width={720} height={280} data={barData} color={themePrimary} axisColor="#dddddd" />
          <Legend>
            <LegendItem><LegendSwatch $color={themePrimary} /> Paid</LegendItem>
          </Legend>
        </ChartCard>

        <ChartCard>
          <SectionTitle>Customer Status Distribution</SectionTitle>
          <SectionNote>Static demo snapshot</SectionNote>
          <PieChart width={360} height={280} data={pieData} />
          <Legend>
            {pieData.map(s => (
              <LegendItem key={s.label}><LegendSwatch $color={s.color} /> {s.label}</LegendItem>
            ))}
          </Legend>
        </ChartCard>
      </ChartsGrid>
    </Wrap>
  );
}

// Theme color helpers
const themePrimary = '#dd9c6b';
const themeSecondary = '#00234C';
const themeGray = '#888888';

const ChartsGrid = styled.div`
  margin-top: 1.5rem;
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 1rem;
  @media (max-width: 900px) {
    grid-template-columns: 1fr;
  }
`;

const ChartCard = styled.div`
  margin-top: 1.5rem;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
  border-top: 4px solid ${p => p.theme.colors.primary};
  padding: 1rem;
`;

const SectionTitle = styled.h2`
  margin: 0;
  color: ${p => p.theme.colors.secondary};
  font-size: 1.1rem;
`;

const SectionNote = styled.div`
  color: ${p => p.theme.colors.gray};
  font-size: 0.85rem;
  margin: 0.35rem 0 0.75rem;
`;

const Legend = styled.div`
  display: flex;
  gap: 1rem;
  margin-top: 0.75rem;
  align-items: center;
  flex-wrap: wrap;
`;

const LegendItem = styled.span`
  display: inline-flex;
  align-items: center;
  gap: 0.35rem;
  color: ${p => p.theme.colors.secondary};
  font-size: 0.9rem;
`;

const LegendSwatch = styled.span`
  width: 14px;
  height: 14px;
  display: inline-block;
  border-radius: 3px;
  background: ${p => p.$color};
`;

// Static bar chart data (months vs paid counts)
const barData = [
  { label: 'May', value: 620 },
  { label: 'Jun', value: 660 },
  { label: 'Jul', value: 700 },
  { label: 'Aug', value: 720 },
  { label: 'Sep', value: 750 },
  { label: 'Oct', value: 780 },
];

// Static pie chart data (status distribution)
const pieData = [
  { label: 'Paid', value: 780, color: themePrimary },
  { label: 'Active', value: 950, color: themeSecondary },
  { label: 'Blocked', value: 32, color: themeGray },
];

/**
 * BarChart
 * Purpose: Render a simple responsive vertical bar chart using SVG.
 * Inputs:
 *  - width: number — chart width in px for viewBox
 *  - height: number — chart height in px for viewBox
 *  - data: array — items like { label, value }
 *  - color: string — bar fill color (brand primary recommended)
 *  - axisColor: string — axis line color
 * Outputs: An SVG bar chart with axes and labels.
 */
function BarChart({ width = 720, height = 280, data = [], color = themePrimary, axisColor = '#dddddd' }) {
  const margin = { top: 20, right: 20, bottom: 40, left: 48 };
  const innerW = width - margin.left - margin.right;
  const innerH = height - margin.top - margin.bottom;

  const maxY = Math.max(...data.map(d => Number(d.value || 0))) || 1;
  const xStep = innerW / data.length;
  const barW = Math.max(12, xStep * 0.6);
  const yScale = (v) => innerH - (v / maxY) * innerH;

  // Y ticks (5)
  const ticks = 5;
  const yTicks = Array.from({ length: ticks + 1 }, (_, i) => Math.round((i * maxY) / ticks));

  return (
    <svg width="100%" viewBox={`0 0 ${width} ${height}`} preserveAspectRatio="xMidYMid meet">
      <g transform={`translate(${margin.left},${margin.top})`}>
        {/* Axes */}
        <line x1={0} y1={innerH} x2={innerW} y2={innerH} stroke={axisColor} />
        <line x1={0} y1={0} x2={0} y2={innerH} stroke={axisColor} />

        {/* Y-axis ticks and labels */}
        {yTicks.map((t, i) => (
          <g key={`yt-${i}`}>
            <line x1={-6} y1={yScale(t)} x2={innerW} y2={yScale(t)} stroke="#f0f0f0" />
            <text x={-10} y={yScale(t)} fill="#888" fontSize="11" textAnchor="end" dy="0.35em">{t}</text>
          </g>
        ))}

        {/* Bars */}
        {data.map((d, i) => {
          const x = i * xStep + (xStep - barW) / 2;
          const h = innerH - yScale(Number(d.value || 0));
          return (
            <g key={`bar-${d.label}`}>
              <rect x={x} y={yScale(d.value)} width={barW} height={h} fill={color} rx={4} />
              <text x={x + barW / 2} y={innerH + 18} fill="#888" fontSize="11" textAnchor="middle">{d.label}</text>
              <text x={x + barW / 2} y={yScale(d.value) - 6} fill={themeSecondary} fontSize="11" textAnchor="middle">{d.value}</text>
            </g>
          );
        })}
      </g>
    </svg>
  );
}

/**
 * PieChart
 * Purpose: Render a simple pie chart using SVG arc paths.
 * Inputs:
 *  - width: number — chart width in px for viewBox
 *  - height: number — chart height in px for viewBox
 *  - data: array — items like { label, value, color }
 * Outputs: An SVG pie chart; each slice uses its provided color.
 */
function PieChart({ width = 360, height = 280, data = [] }) {
  const cx = width / 2;
  const cy = height / 2 - 10; // slight lift for labels area
  const r = Math.min(width, height) * 0.35;
  const total = data.reduce((sum, d) => sum + Number(d.value || 0), 0) || 1;

  let startAngle = -Math.PI / 2; // start at top

  const polarToCartesian = (cx, cy, r, angle) => ({
    x: cx + r * Math.cos(angle),
    y: cy + r * Math.sin(angle),
  });

  return (
    <svg width="100%" viewBox={`0 0 ${width} ${height}`} preserveAspectRatio="xMidYMid meet">
      {/* Slices */}
      {data.map((d, i) => {
        const value = Number(d.value || 0);
        const sliceAngle = (value / total) * Math.PI * 2;
        const endAngle = startAngle + sliceAngle;
        const largeArc = sliceAngle > Math.PI ? 1 : 0;
        const start = polarToCartesian(cx, cy, r, startAngle);
        const end = polarToCartesian(cx, cy, r, endAngle);
        const path = `M ${cx} ${cy} L ${start.x} ${start.y} A ${r} ${r} 0 ${largeArc} 1 ${end.x} ${end.y} Z`;
        startAngle = endAngle;
        return <path key={`slice-${i}`} d={path} fill={d.color} />;
      })}

      {/* Center label */}
      <text x={cx} y={cy} textAnchor="middle" fill={themeSecondary} fontSize="12" dy="0.35em">{total} total</text>
    </svg>
  );
}