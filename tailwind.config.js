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
                dark: {
                    DEFAULT: '#0A0A0F',
                    base: '#0A0A0F',
                    surface: '#121218',
                    elevated: '#161622',
                    border: '#232336',
                    hover: '#1E1E2D',
                },
                brand: {
                    50: '#EFF6FF',
                    100: '#DBEAFE',
                    200: '#BFDBFE',
                    300: '#93C5FD',
                    400: '#60A5FA',
                    500: '#3B82F6',
                    600: '#2563EB',
                    700: '#1D4ED8',
                    800: '#1E40AF',
                    900: '#1E3A8A',
                    DEFAULT: '#2563EB',
                },
                // Backward-compatibility aliases remapped to dark/blue theme
                terracotta: {
                    DEFAULT: '#2563EB',
                    dark: '#1D4ED8',
                    light: '#60A5FA',
                },
                navy: {
                    DEFAULT: '#121218',
                    light: '#161622',
                },
                cream: {
                    DEFAULT: '#0A0A0F',
                    dark: '#121218',
                },
                sage: {
                    DEFAULT: '#3B82F6',
                    light: '#60A5FA',
                },
            },
        },
    },

    plugins: [forms],
};
