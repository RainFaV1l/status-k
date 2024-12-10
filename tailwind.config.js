/** @type {import('tailwindcss').Config} */
export default {
  content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
      './Modules/**/resources/views/**/*.blade.php',
      './Modules/**/resources/js/**/*.js',
      './Modules/**/resources/js/**/*.vue',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

