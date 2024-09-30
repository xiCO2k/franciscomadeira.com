import aspectRatio from "@tailwindcss/aspect-ratio";

export default {
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
        "./resources/js/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                mono: ["Monolisa", "Roboto Mono", "monospace"],
            },
        },
    },
    variants: {
        extend: {},
    },
    plugins: [
        aspectRatio,
        ({ addVariant }) => {
            addVariant("scrollbar", "&::-webkit-scrollbar");
            addVariant("scrollbar-track", "&::-webkit-scrollbar-track");
            addVariant("scrollbar-thumb", "&::-webkit-scrollbar-thumb");
        },
    ],
};
