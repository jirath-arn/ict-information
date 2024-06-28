const colors = require('tailwindcss/colors');
const defaultTheme = require('tailwindcss/defaultTheme');
const aspectRatio = require('@tailwindcss/aspect-ratio');

const hexToRGB = (h) => {
  let r = 0, g = 0, b = 0;

  if (h.length === 4) {
    // 3 Digits.
    r = parseInt(h[1] + h[1], 16);
    g = parseInt(h[2] + h[2], 16);
    b = parseInt(h[3] + h[3], 16);

  } else if (h.length === 7) {
    // 6 Digits.
    r = parseInt(h[1] + h[2], 16);
    g = parseInt(h[3] + h[4], 16);
    b = parseInt(h[5] + h[6], 16);
  }

  return `${r} ${g} ${b}`;
};

const withOpacityValue = (variable) => {
  return ({ opacityValue }) => {
    if (opacityValue === undefined) {
      return `rgb(var(${variable}))`;
    }
    return `rgb(var(${variable}) / ${opacityValue})`;
  };
};

export default {
  content: ['resources/**/*.blade.php'],
  darkMode: 'class',
  theme: {
    container: {
      center: true,
      padding: '1rem'
    },
    fontFamily: {
      heading: ['var(--font-heading)', ...defaultTheme.fontFamily.sans],
      body: ['var(--font-body)', ...defaultTheme.fontFamily.sans]
    },
    skin: {
      white: hexToRGB(colors.white),
      sky: {
        DEFAULT: hexToRGB(colors.sky[600]),
        50: hexToRGB(colors.sky[50]),
        100: hexToRGB(colors.sky[100]),
        200: hexToRGB(colors.sky[200]),
        300: hexToRGB(colors.sky[300]),
        400: hexToRGB(colors.sky[400]),
        500: hexToRGB(colors.sky[500]),
        600: hexToRGB(colors.sky[600]),
        700: hexToRGB(colors.sky[700]),
        800: hexToRGB(colors.sky[800]),
        900: hexToRGB(colors.sky[900]),
        950: hexToRGB(colors.sky[950])
      },
      red: {
        DEFAULT: hexToRGB(colors.red[600]),
        50: hexToRGB(colors.red[50]),
        100: hexToRGB(colors.red[100]),
        200: hexToRGB(colors.red[200]),
        300: hexToRGB(colors.red[300]),
        400: hexToRGB(colors.red[400]),
        500: hexToRGB(colors.red[500]),
        600: hexToRGB(colors.red[600]),
        700: hexToRGB(colors.red[700]),
        800: hexToRGB(colors.red[800]),
        900: hexToRGB(colors.red[900]),
        950: hexToRGB(colors.red[950])
      },
      orange: {
        DEFAULT: hexToRGB(colors.orange[600]),
        50: hexToRGB(colors.orange[50]),
        100: hexToRGB(colors.orange[100]),
        200: hexToRGB(colors.orange[200]),
        300: hexToRGB(colors.orange[300]),
        400: hexToRGB(colors.orange[400]),
        500: hexToRGB(colors.orange[500]),
        600: hexToRGB(colors.orange[600]),
        700: hexToRGB(colors.orange[700]),
        800: hexToRGB(colors.orange[800]),
        900: hexToRGB(colors.orange[900]),
        950: hexToRGB(colors.orange[950])
      },
      amber: {
        DEFAULT: hexToRGB(colors.amber[600]),
        50: hexToRGB(colors.amber[50]),
        100: hexToRGB(colors.amber[100]),
        200: hexToRGB(colors.amber[200]),
        300: hexToRGB(colors.amber[300]),
        400: hexToRGB(colors.amber[400]),
        500: hexToRGB(colors.amber[500]),
        600: hexToRGB(colors.amber[600]),
        700: hexToRGB(colors.amber[700]),
        800: hexToRGB(colors.amber[800]),
        900: hexToRGB(colors.amber[900]),
        950: hexToRGB(colors.amber[950])
      },
      yellow: {
        DEFAULT: hexToRGB(colors.yellow[600]),
        50: hexToRGB(colors.yellow[50]),
        100: hexToRGB(colors.yellow[100]),
        200: hexToRGB(colors.yellow[200]),
        300: hexToRGB(colors.yellow[300]),
        400: hexToRGB(colors.yellow[400]),
        500: hexToRGB(colors.yellow[500]),
        600: hexToRGB(colors.yellow[600]),
        700: hexToRGB(colors.yellow[700]),
        800: hexToRGB(colors.yellow[800]),
        900: hexToRGB(colors.yellow[900]),
        950: hexToRGB(colors.yellow[950])
      },
      lime: {
        DEFAULT: hexToRGB(colors.lime[600]),
        50: hexToRGB(colors.lime[50]),
        100: hexToRGB(colors.lime[100]),
        200: hexToRGB(colors.lime[200]),
        300: hexToRGB(colors.lime[300]),
        400: hexToRGB(colors.lime[400]),
        500: hexToRGB(colors.lime[500]),
        600: hexToRGB(colors.lime[600]),
        700: hexToRGB(colors.lime[700]),
        800: hexToRGB(colors.lime[800]),
        900: hexToRGB(colors.lime[900]),
        950: hexToRGB(colors.lime[950])
      },
      green: {
        DEFAULT: hexToRGB(colors.green[600]),
        50: hexToRGB(colors.green[50]),
        100: hexToRGB(colors.green[100]),
        200: hexToRGB(colors.green[200]),
        300: hexToRGB(colors.green[300]),
        400: hexToRGB(colors.green[400]),
        500: hexToRGB(colors.green[500]),
        600: hexToRGB(colors.green[600]),
        700: hexToRGB(colors.green[700]),
        800: hexToRGB(colors.green[800]),
        900: hexToRGB(colors.green[900]),
        950: hexToRGB(colors.green[950])
      },
      emerald: {
        DEFAULT: hexToRGB(colors.emerald[600]),
        50: hexToRGB(colors.emerald[50]),
        100: hexToRGB(colors.emerald[100]),
        200: hexToRGB(colors.emerald[200]),
        300: hexToRGB(colors.emerald[300]),
        400: hexToRGB(colors.emerald[400]),
        500: hexToRGB(colors.emerald[500]),
        600: hexToRGB(colors.emerald[600]),
        700: hexToRGB(colors.emerald[700]),
        800: hexToRGB(colors.emerald[800]),
        900: hexToRGB(colors.emerald[900]),
        950: hexToRGB(colors.emerald[950])
      },
      teal: {
        DEFAULT: hexToRGB(colors.teal[600]),
        50: hexToRGB(colors.teal[50]),
        100: hexToRGB(colors.teal[100]),
        200: hexToRGB(colors.teal[200]),
        300: hexToRGB(colors.teal[300]),
        400: hexToRGB(colors.teal[400]),
        500: hexToRGB(colors.teal[500]),
        600: hexToRGB(colors.teal[600]),
        700: hexToRGB(colors.teal[700]),
        800: hexToRGB(colors.teal[800]),
        900: hexToRGB(colors.teal[900]),
        950: hexToRGB(colors.teal[950])
      },
      cyan: {
        DEFAULT: hexToRGB(colors.cyan[600]),
        50: hexToRGB(colors.cyan[50]),
        100: hexToRGB(colors.cyan[100]),
        200: hexToRGB(colors.cyan[200]),
        300: hexToRGB(colors.cyan[300]),
        400: hexToRGB(colors.cyan[400]),
        500: hexToRGB(colors.cyan[500]),
        600: hexToRGB(colors.cyan[600]),
        700: hexToRGB(colors.cyan[700]),
        800: hexToRGB(colors.cyan[800]),
        900: hexToRGB(colors.cyan[900]),
        950: hexToRGB(colors.cyan[950])
      },
      blue: {
        DEFAULT: hexToRGB(colors.blue[600]),
        50: hexToRGB(colors.blue[50]),
        100: hexToRGB(colors.blue[100]),
        200: hexToRGB(colors.blue[200]),
        300: hexToRGB(colors.blue[300]),
        400: hexToRGB(colors.blue[400]),
        500: hexToRGB(colors.blue[500]),
        600: hexToRGB(colors.blue[600]),
        700: hexToRGB(colors.blue[700]),
        800: hexToRGB(colors.blue[800]),
        900: hexToRGB(colors.blue[900]),
        950: hexToRGB(colors.blue[950])
      },
      indigo: {
        DEFAULT: hexToRGB(colors.indigo[600]),
        50: hexToRGB(colors.indigo[50]),
        100: hexToRGB(colors.indigo[100]),
        200: hexToRGB(colors.indigo[200]),
        300: hexToRGB(colors.indigo[300]),
        400: hexToRGB(colors.indigo[400]),
        500: hexToRGB(colors.indigo[500]),
        600: hexToRGB(colors.indigo[600]),
        700: hexToRGB(colors.indigo[700]),
        800: hexToRGB(colors.indigo[800]),
        900: hexToRGB(colors.indigo[900]),
        950: hexToRGB(colors.indigo[950])
      },
      violet: {
        DEFAULT: hexToRGB(colors.violet[600]),
        50: hexToRGB(colors.violet[50]),
        100: hexToRGB(colors.violet[100]),
        200: hexToRGB(colors.violet[200]),
        300: hexToRGB(colors.violet[300]),
        400: hexToRGB(colors.violet[400]),
        500: hexToRGB(colors.violet[500]),
        600: hexToRGB(colors.violet[600]),
        700: hexToRGB(colors.violet[700]),
        800: hexToRGB(colors.violet[800]),
        900: hexToRGB(colors.violet[900]),
        950: hexToRGB(colors.violet[950])
      },
      purple: {
        DEFAULT: hexToRGB(colors.purple[600]),
        50: hexToRGB(colors.purple[50]),
        100: hexToRGB(colors.purple[100]),
        200: hexToRGB(colors.purple[200]),
        300: hexToRGB(colors.purple[300]),
        400: hexToRGB(colors.purple[400]),
        500: hexToRGB(colors.purple[500]),
        600: hexToRGB(colors.purple[600]),
        700: hexToRGB(colors.purple[700]),
        800: hexToRGB(colors.purple[800]),
        900: hexToRGB(colors.purple[900]),
        950: hexToRGB(colors.purple[950])
      },
      fuchsia: {
        DEFAULT: hexToRGB(colors.fuchsia[600]),
        50: hexToRGB(colors.fuchsia[50]),
        100: hexToRGB(colors.fuchsia[100]),
        200: hexToRGB(colors.fuchsia[200]),
        300: hexToRGB(colors.fuchsia[300]),
        400: hexToRGB(colors.fuchsia[400]),
        500: hexToRGB(colors.fuchsia[500]),
        600: hexToRGB(colors.fuchsia[600]),
        700: hexToRGB(colors.fuchsia[700]),
        800: hexToRGB(colors.fuchsia[800]),
        900: hexToRGB(colors.fuchsia[900]),
        950: hexToRGB(colors.fuchsia[950])
      },
      pink: {
        DEFAULT: hexToRGB(colors.pink[600]),
        50: hexToRGB(colors.pink[50]),
        100: hexToRGB(colors.pink[100]),
        200: hexToRGB(colors.pink[200]),
        300: hexToRGB(colors.pink[300]),
        400: hexToRGB(colors.pink[400]),
        500: hexToRGB(colors.pink[500]),
        600: hexToRGB(colors.pink[600]),
        700: hexToRGB(colors.pink[700]),
        800: hexToRGB(colors.pink[800]),
        900: hexToRGB(colors.pink[900]),
        950: hexToRGB(colors.pink[950])
      },
      rose: {
        DEFAULT: hexToRGB(colors.rose[600]),
        50: hexToRGB(colors.rose[50]),
        100: hexToRGB(colors.rose[100]),
        200: hexToRGB(colors.rose[200]),
        300: hexToRGB(colors.rose[300]),
        400: hexToRGB(colors.rose[400]),
        500: hexToRGB(colors.rose[500]),
        600: hexToRGB(colors.rose[600]),
        700: hexToRGB(colors.rose[700]),
        800: hexToRGB(colors.rose[800]),
        900: hexToRGB(colors.rose[900]),
        950: hexToRGB(colors.rose[950])
      },
      gray: {
        50: hexToRGB(colors.gray[50]),
        100: hexToRGB(colors.gray[100]),
        200: hexToRGB(colors.gray[200]),
        300: hexToRGB(colors.gray[300]),
        400: hexToRGB(colors.gray[400]),
        500: hexToRGB(colors.gray[500]),
        600: hexToRGB(colors.gray[600]),
        700: hexToRGB(colors.gray[700]),
        800: hexToRGB(colors.gray[800]),
        900: hexToRGB(colors.gray[900]),
        950: hexToRGB(colors.gray[950])
      },
      slate: {
        50: hexToRGB(colors.slate[50]),
        100: hexToRGB(colors.slate[100]),
        200: hexToRGB(colors.slate[200]),
        300: hexToRGB(colors.slate[300]),
        400: hexToRGB(colors.slate[400]),
        500: hexToRGB(colors.slate[500]),
        600: hexToRGB(colors.slate[600]),
        700: hexToRGB(colors.slate[700]),
        800: hexToRGB(colors.slate[800]),
        900: hexToRGB(colors.slate[900]),
        950: hexToRGB(colors.slate[950])
      },
      zinc: {
        50: hexToRGB(colors.zinc[50]),
        100: hexToRGB(colors.zinc[100]),
        200: hexToRGB(colors.zinc[200]),
        300: hexToRGB(colors.zinc[300]),
        400: hexToRGB(colors.zinc[400]),
        500: hexToRGB(colors.zinc[500]),
        600: hexToRGB(colors.zinc[600]),
        700: hexToRGB(colors.zinc[700]),
        800: hexToRGB(colors.zinc[800]),
        900: hexToRGB(colors.zinc[900]),
        950: hexToRGB(colors.zinc[950])
      },
      neutral: {
        50: hexToRGB(colors.neutral[50]),
        100: hexToRGB(colors.neutral[100]),
        200: hexToRGB(colors.neutral[200]),
        300: hexToRGB(colors.neutral[300]),
        400: hexToRGB(colors.neutral[400]),
        500: hexToRGB(colors.neutral[500]),
        600: hexToRGB(colors.neutral[600]),
        700: hexToRGB(colors.neutral[700]),
        800: hexToRGB(colors.neutral[800]),
        900: hexToRGB(colors.neutral[900]),
        950: hexToRGB(colors.neutral[950])
      },
      stone: {
        50: hexToRGB(colors.stone[50]),
        100: hexToRGB(colors.stone[100]),
        200: hexToRGB(colors.stone[200]),
        300: hexToRGB(colors.stone[300]),
        400: hexToRGB(colors.stone[400]),
        500: hexToRGB(colors.stone[500]),
        600: hexToRGB(colors.stone[600]),
        700: hexToRGB(colors.stone[700]),
        800: hexToRGB(colors.stone[800]),
        900: hexToRGB(colors.stone[900]),
        950: hexToRGB(colors.stone[950])
      },
      secondary: {
        DEFAULT: hexToRGB(colors.gray[600])
      }
    },
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: {
        50: withOpacityValue('--color-gray-50'),
        100: withOpacityValue('--color-gray-100'),
        200: withOpacityValue('--color-gray-200'),
        300: withOpacityValue('--color-gray-300'),
        400: withOpacityValue('--color-gray-400'),
        500: withOpacityValue('--color-gray-500'),
        600: withOpacityValue('--color-gray-600'),
        700: withOpacityValue('--color-gray-700'),
        800: withOpacityValue('--color-gray-800'),
        900: withOpacityValue('--color-gray-900'),
        950: withOpacityValue('--color-gray-950')
      },
      primary: {
        DEFAULT: withOpacityValue('--color-primary'),
        50: withOpacityValue('--color-primary-50'),
        100: withOpacityValue('--color-primary-100'),
        200: withOpacityValue('--color-primary-200'),
        300: withOpacityValue('--color-primary-300'),
        400: withOpacityValue('--color-primary-400'),
        500: withOpacityValue('--color-primary-500'),
        600: withOpacityValue('--color-primary-600'),
        700: withOpacityValue('--color-primary-700'),
        800: withOpacityValue('--color-primary-800'),
        900: withOpacityValue('--color-primary-900'),
        950: withOpacityValue('--color-primary-950')
      },
      secondary: withOpacityValue('--color-secondary')
    },
    extend: {
      fontSize: {
        '4xl': '2rem',
        'line-height': '3rem'
      },
      borderRadius: {
        xl: '10px'
      },
      boxShadow: {
        DEFAULT: '1px 1px 5px 0 rgba(0, 0, 0, 0.16)'
      },
      colors: {
        success: '#28A745',
        danger: '#DC3545',
        warning: '#FFC107',
        info: '#17A2B8',
        social: {
          facebook: '#3B5998',
          twitter: '#1DA1F2',
          pinterest: '#BD081C',
          whatsapp: '#25D366'
        }
      },
      animation: {
        'spin-slow': 'spin 3s linear infinite'
      },
      backgroundColor: {
        background: withOpacityValue('--color-background'),
        foreground: withOpacityValue('--color-foreground'),
        input: withOpacityValue('--color-input')
      },
      borderColor: {
        divider: withOpacityValue('--color-divider'),
        border: withOpacityValue('--color-border')
      },
      textColor: {
        normal: withOpacityValue('--color-text-normal'),
        muted: withOpacityValue('--color-text-muted'),
        highlighted: withOpacityValue('--color-text-highlighted'),
        placeholder: withOpacityValue('--color-text-placeholder'),
        component: withOpacityValue('--color-text-component')
      }
    }
  },
  plugins: [aspectRatio]
};
