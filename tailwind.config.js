import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
                display: ['"Playfair Display"', 'Georgia', 'serif'],
            },
            colors: {
                brand: {
                    50: '#f0f4ff',
                    100: '#e0e9fe',
                    500: '#6366f1',
                    600: '#4f46e5',
                    700: '#4338ca',
                    900: '#1e1b4b',
                },
                accent: {
                    400: '#38bdf8',
                    500: '#0ea5e9',
                    600: '#0284c7',
                }
            }
        },
    },
    plugins: [forms, typography],
};
