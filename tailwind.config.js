module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                mono: ['Monolisa', 'Roboto Mono', 'monospace'],
            },
        },
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        ({ addVariant }) => {
            addVariant('scrollbar', '&::-webkit-scrollbar')
            addVariant('scrollbar-track', '&::-webkit-scrollbar-track')
            addVariant('scrollbar-thumb', '&::-webkit-scrollbar-thumb')
        },
    ],
}
