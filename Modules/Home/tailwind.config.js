/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./Modules/**/Resources/views/**/*.blade.php",
      "./Modules/**/Resources/js/**/*.js",
      "./Modules/**/Resources/js/**/*.vue",
      "./Modules/**/Resources/css/**/*.css",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

