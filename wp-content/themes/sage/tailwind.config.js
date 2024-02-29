const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: [
    // https://tailwindcss.com/docs/content-configuration
    './*.php',
    './inc/**/*.php',
    './template-parts/**/*.php',
    './resources/views/**/*.blade.php',
  ],
  safelist: [
    'text-center'
    //{
    //  pattern: /text-(white|black)-(200|500|800)/
    //}
  ],
  theme: {
    screens: {
      xs: "490px",
      sm: "640px",
      md: "782px",
      lg: "1024px",
      xl: "1280px",
      "2xl": "1536px",
    },
    spacing: {
      "px": "1px",
      0: "0px",
      0.5: "0.125rem",
      1: "0.25rem",
      1.5: "0.375rem",
      2: "0.5rem",
      2.5: "0.625rem",
      3: "0.75rem",
      3.5: "0.875rem",
      4: "1rem",
      5: "1.25rem",
      6: "1.5rem",
      7: "1.75rem",
      8: "2rem",
      9: "2.25rem",
      10: "2.5rem",
      11: "2.75rem",
      12: "3rem",
      14: "3.5rem",
      16: "4rem",
      20: "5rem",
      24: "6rem",
      28: "7rem",
      32: "8rem",
      36: "9rem",
      40: "10rem",
      44: "11rem",
      48: "12rem",
      52: "13rem",
      56: "14rem",
      60: "15rem",
      64: "16rem",
      72: "18rem",
      80: "20rem",
      96: "24rem",
    },
    fontSize: {
      xs: ["0.75rem", { lineHeight: "1rem" }],
      sm: ["0.875rem", { lineHeight: "1.25rem" }],
      base: ["1rem", { lineHeight: "1.5rem" }],
      lg: ["1.125rem", { lineHeight: "1.75rem" }],
      xl: ["1.25rem", { lineHeight: "1.75rem" }],
      "2xl": ["1.5rem", { lineHeight: "2rem" }],
      "3xl": ["1.875rem", { lineHeight: "2.25rem" }],
      "4xl": ["2.25rem", { lineHeight: "2.5rem" }],
      "5xl": ["3rem", { lineHeight: "1" }],
      "6xl": ["3.75rem", { lineHeight: "1" }],
      "7xl": ["4.5rem", { lineHeight: "1" }],
      "8xl": ["6rem", { lineHeight: "1" }],
      "9xl": ["8rem", { lineHeight: "1" }],
    },
    extend: {
      borderRadius: {
        '4xl': '2.5rem',
      },
      colors: {
        'base': '#ffffff',
        'primary': '#19437f',
        'primary-dark': '#003266',
        'primary-darker': '#00264d',
        'primary-light': '#AAC9E9',
        'secondary': '#32c5f4',
        'tertiary': '#F6F6F6',
        'foreground': '#000000',
        'foreground-gray': '#221f20',
        'foreground-light': '#222123',
        'danger': "#c02b0a"
      },
      fontFamily: {
        sans: ['Poppins', ...defaultTheme.fontFamily.sans],
        display: [
          ['Poppins', ...defaultTheme.fontFamily.sans],
          { fontVariationSettings: '"wdth" 125' },
        ],
      },
      backgroundImage: theme => ({
        none: "none",
        "gradient-b-to-t": `linear-gradient(90deg,rgba(0,0,0,.5) 0,rgba(0,0,0,.3) 10%,rgba(0,0,0,.1) 50%,rgba(0,0,0,0) 100%)`,
        "gradient-to-p": `linear-gradient(0deg, ${theme('colors.primary')} 60%, ${theme('colors.secondary')} 100%)`,
        "gradient-to-p-90": `linear-gradient(90deg, ${theme('colors.primary')} 60%, ${theme('colors.secondary')} 100%)`,
      })
    }
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
  ]
}
