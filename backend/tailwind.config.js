/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'maroon': {
          500: '#A0153E',
          700: '#800020',
          900: '#4A0011',
        },
        'gold': {
          300: '#E8D48B',
          500: '#D4AF37',
        },
        'cream': {
          50: '#FFFEF7',
          100: '#FFF8DC',
        }
      }
    },
  },
  plugins: [],
}
