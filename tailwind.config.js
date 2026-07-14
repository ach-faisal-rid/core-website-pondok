import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                pondok: {
                    50: '#f2f7f4',
                    100: '#ddeee4',
                    600: '#1f6b4f',
                    700: '#185640',
                    800: '#134535',
                    900: '#0f3a2d',
                    950: '#0a2820',
                },
            },
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
                display: ['Cormorant Garamond', 'Georgia', 'serif'],
            },
        },
    },

    plugins: [forms],
};
