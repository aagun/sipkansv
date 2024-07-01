/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            colors: {
               blue: {
                    '50': '#f0faff',
                    '100': '#dff3ff',
                    '200': '#b8e9ff',
                    '300': '#7ad9ff',
                    '400': '#34c7fc',
                    '500': '#09afed',
                    '600': '#008dcb',
                    '700': '#0070a5',
                    '800': '#045f88',
                    '900': '#0a4f70',
                    '950': '#07324a',
                },

                primary: {
                    '50': '#f0faff',
                    '100': '#dff3ff',
                    '200': '#b8e9ff',
                    '300': '#7ad9ff',
                    '400': '#34c7fc',
                    '500': '#09afed',
                    '600': '#008dcb',
                    '700': '#0070a5',
                    '800': '#045f88',
                    '900': '#0a4f70',
                    '950': '#07324a',
                },

                green: {
                    '50': '#edfff4',
                    '100': '#d6ffe8',
                    '200': '#afffd3',
                    '300': '#71ffb2',
                    '400': '#2dfb89',
                    '500': '#02e568',
                    '600': '#00bf53',
                    '700': '#009142',
                    '800': '#067539',
                    '900': '#085f31',
                    '950': '#003619',
                },

                yellow: {
                    '50': '#fefbe8',
                    '100': '#fef7c3',
                    '200': '#feec8a',
                    '300': '#fdd947',
                    '400': '#fbc92a',
                    '500': '#ebaa07',
                    '600': '#cb8203',
                    '700': '#a15c07',
                    '800': '#85480e',
                    '900': '#713b12',
                    '950': '#421e06',
                },

            }
        },
    },
    plugins: [
        require('flowbite/plugin')({charts: true}),
        require('flowbite-typography')
    ],
}
