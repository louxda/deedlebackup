/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'baskervile': ['Libre Baskerville','serif' ]
      },
      colors: {
        lightBackgroundColor: "#F9F9F9",
        darkBackgroundColor: "#111111",
        darkDividerColor: "#E6E6E6",
        lightDividerColor: "#2C2C2C",
        lightOverlayColor: "rgba(211, 211, 211, 0.71)",
        darkOverlayColor: "rgba(44, 44, 44, 0.71)"
      }
    },
  },
  plugins: [],
}
