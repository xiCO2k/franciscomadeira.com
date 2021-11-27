module.exports = {
    plugins: [
        // prettier-ignore
        require('postcss-import')(),
        require('postcss-nesting')(),
        require('tailwindcss')('./tailwind.config.js'),
    ],
}
