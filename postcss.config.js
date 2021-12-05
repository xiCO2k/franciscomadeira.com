module.exports = {
    plugins: [
        // prettier-ignore
        require('postcss-import')(),
        require('tailwindcss/nesting')(require('postcss-nesting')),
        require('tailwindcss')('./tailwind.config.js'),
    ],
}
