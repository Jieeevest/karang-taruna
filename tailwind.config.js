const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: "#00CED1",
                    50: "#E0FFFF",
                    100: "#AFEEEE",
                    200: "#7FFFD4",
                    300: "#40E0D0",
                    400: "#00CED1",
                    500: "#00CED1",
                    600: "#00B8BB",
                    700: "#008B8B",
                    800: "#006666",
                    900: "#004444",
                },
                aqua: {
                    DEFAULT: "#00CED1",
                    light: "#7FFFD4",
                    dark: "#008B8B",
                },
                black: "#000000",
                white: "#FFFFFF",
            },
        },
    },

    plugins: [require("@tailwindcss/forms"), require("flowbite/plugin")],
};
