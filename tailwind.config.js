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
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                terracotta: {
                    DEFAULT: '#E07A5F',
                    dark: '#C96B50',
                    light: '#F4A68C',
                },
                navy: {
                    DEFAULT: '#3D405B',
                    light: '#545876',
                },
                cream: {
                    DEFAULT: '#FEFAE0',
                    dark: '#FAF0C8',
                },
                sage: {
                    DEFAULT: '#81B29A',
                    light: '#A8D5BA',
                },
            },
        },
    },

    plugins: [forms],
};
