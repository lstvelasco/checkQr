/** @type {import('tailwindcss').Config} */
export default {
    plugins: [
        require("flowbite/plugin")({
            charts: true,
        }),
    ],
    darkMode: "class",
    content: [
        "./node_modules/flowbite/**/*.js",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            zIndex: {
                60: "60",
                70: "70",
                80: "80",
                90: "90",
                100: "100",
            },
            colors: {
                primary: {
                    50: "#f0fdf4",
                    100: "#dcfce7",
                    200: "#bbf7d0",
                    300: "#86efac",
                    400: "#4ade80",
                    500: "#22c55e",
                    600: "#16a34a",
                    700: "#15803d",
                    800: "#166534",
                    900: "#14532d",
                    950: "#0d4224",
                },
            },
        },
        animation: {
            "slide-in": "slideIn 0.5s ease-out",
            "slide-out": "slideOut 0.5s ease-in",
        },
        keyframes: {
            slideIn: {
                "0%": { transform: "translateY(100%)", opacity: "0" },
                "100%": { transform: "translateY(0)", opacity: "1" },
            },
            slideOut: {
                "0%": { transform: "translateY(0)", opacity: "1" },
                "100%": { transform: "translateY(100%)", opacity: "0" },
            },
        },
        fontFamily: {
            body: [
                "Inter",
                "ui-sans-serif",
                "system-ui",
                "-apple-system",
                "system-ui",
                "Segoe UI",
                "Roboto",
                "Helvetica Neue",
                "Arial",
                "Noto Sans",
                "sans-serif",
                "Apple Color Emoji",
                "Segoe UI Emoji",
                "Segoe UI Symbol",
                "Noto Color Emoji",
            ],
            sans: [
                "Inter",
                "ui-sans-serif",
                "system-ui",
                "-apple-system",
                "system-ui",
                "Segoe UI",
                "Roboto",
                "Helvetica Neue",
                "Arial",
                "Noto Sans",
                "sans-serif",
                "Apple Color Emoji",
                "Segoe UI Emoji",
                "Segoe UI Symbol",
                "Noto Color Emoji",
            ],
        },
    },
};
