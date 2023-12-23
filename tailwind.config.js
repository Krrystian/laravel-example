/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
        colors: {
            sage: "#A3A380",
            vanilla: "#D6CE93",
            beige: "#EFEBCE",
            buff: "#D8A48F",
            oldrose: "#BB8588",
            black: "#000000",
        },
    },
    plugins: [],
};
