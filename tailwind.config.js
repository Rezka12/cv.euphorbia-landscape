const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        './storage/framework/views/*.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        extend: {
            container: { center: true, padding: '1rem' },
            fontFamily: { sans: ['Figtree', ...defaultTheme.fontFamily.sans] },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};

// tailwind.config.js
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    safelist: [
        'bg-emerald-700',
        'text-white',
        'border-emerald-700',
        'visited:text-white',
        'bg-white',
        'text-gray-700',
        'border-gray-300',
        'hover:bg-gray-50',
        'visited:text-gray-700',
    ],
    theme: { extend: {} },
    plugins: [],
}
