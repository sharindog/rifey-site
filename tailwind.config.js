/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                'green-rifey': '#7BC043',     // основной зелёный из логотипа
                'graphite': '#181716',        // для текста и заголовков
                'gray-light': '#f5f5f5',      // фон секций
            },
            fontFamily: {
                sans: ['"Inter"', 'sans-serif'], // подключи Cera Pro отдельно, если нужно
            },
            spacing: {
                '18': '4.5rem', // 72px
                '20': '5rem',   // 80px
            },
            borderColor: {
                'green-rifey': '#7BC043',
            },
        },
    },
    plugins: [
        require('@tailwindcss/line-clamp'),
    ],

}
