/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    'templates/**/*.html.twig',
    'assets/js/**/*.js',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    'tw-elements/dist/plugin',
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}

