import { createGlobalStyle } from 'styled-components';
import '@fontsource/lexend';

export const theme = {
  colors: {
    primary: '#dd9c6b',
    secondary: '#00234C',
    background: '#ffffff',
    text: '#333333',
    lightGray: '#f5f5f5',
    gray: '#888888',
  },
  fonts: {
    main: 'Lexend, sans-serif',
  },
};

const GlobalStyles = createGlobalStyle`
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: ${props => props.theme.fonts.main};
    color: ${props => props.theme.colors.text};
    background-color: ${props => props.theme.colors.background};
    line-height: 1.5;
  }

  h1, h2, h3, h4, h5, h6 {
    color: ${props => props.theme.colors.secondary};
    font-weight: 600;
  }

  a {
    color: ${props => props.theme.colors.primary};
    text-decoration: none;
    
    &:hover {
      text-decoration: underline;
    }
  }

  button {
    font-family: ${props => props.theme.fonts.main};
  }
`;

export default GlobalStyles;