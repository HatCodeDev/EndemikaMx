import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                bosque: '#4CAF50',      // Verde Bosque
                maguey: '#FFC107',      // Amarillo Maguey
                turquesa: '#00796B',    // Azul Turquesa
                coral: '#FF5722',       // Rojo Coral
                arena: '#FAFAFA',       // Blanco Arena
            },
        },
    },

    plugins: [forms],
};
