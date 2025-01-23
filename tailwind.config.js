import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';
// import preline from 'preline/plugin';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/preline/dist/*.js'

    ],
    theme: {
        colors: {
            ...colors,
            primary: {
                DEFAULT: '#2E3192'
            },
        },
        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
                sm: '1rem',
                md: '2rem',
                lg: '4rem',
                xl: '3rem',
                '2xl': '3rem',
            },
        },
        extend: {
            backgroundImage: {
                'headerBackground': "url('images/vector.png')",
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'page-header': 'url("/images/page-header-bg.png"), radial-gradient(50% 50% at 50% 50%, #0072BB 44.5%, #2E3192 100%)',
                'about-page-section-1': 'linear-gradient(270deg, #0072BB 0%, #2E3192 100%)',
            }
        },
    },

    plugins: [forms, require('preline/plugin', require('@tailwindcss/forms'))],
};
