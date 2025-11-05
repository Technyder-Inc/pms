import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import styled from 'styled-components';
import { login } from '../utils/api';

/**
 * Login
 * Purpose: Render a branded login form and authenticate users.
 * Inputs: None (reads user-entered email and password).
 * Outputs: Navigates to dashboard on success; shows error on failure.
 */
export default function Login() {
  const navigate = useNavigate();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  async function handleSubmit(e) {
    e.preventDefault();
    setError('');
    setLoading(true);
    try {
      await login(email.trim(), password);
      navigate('/dashboard');
    } catch (err) {
      setError(err.message || 'Login failed');
    } finally {
      setLoading(false);
    }
  }

  return (
    <Wrapper>
      <Card>
        <BrandTitle>Welcome back</BrandTitle>
        <Subtitle>Please sign in to continue</Subtitle>
        {error && <ErrorBox role="alert">{error}</ErrorBox>}
        <Form onSubmit={handleSubmit}>
          <Label htmlFor="email">Email</Label>
          <Input
            id="email"
            type="email"
            placeholder="you@example.com"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
          />
          <Label htmlFor="password">Password</Label>
          <Input
            id="password"
            type="password"
            placeholder="••••••"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
          />
          <Button type="submit" disabled={loading}>
            {loading ? 'Signing in…' : 'Sign In'}
          </Button>
        </Form>
      </Card>
    </Wrapper>
  );
}

const Wrapper = styled.div`
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f7f9fc;
  font-family: 'Lexend', sans-serif;
`;

const Card = styled.div`
  width: 100%;
  max-width: 420px;
  background: #ffffff;
  border: 1px solid rgba(0,0,0,0.06);
  border-radius: 12px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.08);
  padding: 28px;
`;

const BrandTitle = styled.h1`
  margin: 0 0 6px;
  font-size: 24px;
  color: ${(p) => p.theme?.secondary || '#00234C'};
  letter-spacing: 0.2px;
`;

const Subtitle = styled.p`
  margin: 0 0 20px;
  color: #5b6b7c;
`;

const Form = styled.form`
  display: grid;
  grid-gap: 12px;
`;

const Label = styled.label`
  font-weight: 600;
  color: #1f2a37;
`;

const Input = styled.input`
  height: 40px;
  border: 1px solid #d0d7e2;
  border-radius: 8px;
  padding: 0 12px;
  font-size: 14px;
  outline: none;
  &:focus {
    border-color: ${(p) => p.theme?.primary || '#dd9c6b'};
    box-shadow: 0 0 0 3px rgba(221, 156, 107, 0.2);
  }
`;

const Button = styled.button`
  height: 42px;
  border: none;
  border-radius: 8px;
  background: ${(p) => p.theme?.primary || '#dd9c6b'};
  color: #fff;
  font-weight: 700;
  cursor: pointer;
  transition: transform 0.04s ease, box-shadow 0.2s ease;
  &:hover { transform: translateY(-1px); }
  &:disabled { opacity: 0.7; cursor: default; }
`;

const ErrorBox = styled.div`
  background: rgba(255, 0, 0, 0.08);
  border: 1px solid rgba(255, 0, 0, 0.25);
  color: #8b0000;
  padding: 8px 12px;
  border-radius: 8px;
  margin-bottom: 8px;
`;