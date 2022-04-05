const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        fontWeight: {
            light: 300,
            normal: 400,
            bold: 600
        },
        extend: {
            fontFamily: { sans: ['Source Sans Pro', ...defaultTheme.fontFamily.sans] },
            transitionDuration: { DEFAULT: '250ms' }
        },
    },
    plugins: [],
}
