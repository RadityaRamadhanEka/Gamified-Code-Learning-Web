import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import containerQueries from '@tailwindcss/container-queries';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                "tertiary-container": "#ffd700",
                "surface-container-highest": "#353436",
                "on-surface": "#e5e2e3",
                "secondary-fixed-dim": "#d1bcff",
                "on-secondary-container": "#ddcdff",
                "on-secondary-fixed-variant": "#5700c9",
                "primary": "#dbfcff",
                "surface": "#131314",
                "surface-container-low": "#1c1b1c",
                "surface-container-lowest": "#0e0e0f",
                "surface-bright": "#3a393a",
                "on-error": "#690005",
                "on-primary": "#00363a",
                "on-primary-fixed-variant": "#004f54",
                "inverse-surface": "#e5e2e3",
                "on-tertiary-container": "#705d00",
                "surface-container": "#201f20",
                "tertiary-fixed": "#ffe16d",
                "error": "#ffb4ab",
                "on-surface-variant": "#b9cacb",
                "on-secondary": "#3c0090",
                "tertiary-fixed-dim": "#e9c400",
                "on-secondary-fixed": "#23005b",
                "on-primary-fixed": "#002022",
                "outline": "#849495",
                "inverse-on-surface": "#313031",
                "primary-fixed": "#7df4ff",
                "secondary-fixed": "#e9ddff",
                "error-container": "#93000a",
                "primary-fixed-dim": "#00dbe9",
                "on-primary-container": "#006970",
                "secondary-container": "#7000ff",
                "tertiary": "#fff5de",
                "surface-variant": "#353436",
                "surface-container-high": "#2a2a2b",
                "surface-dim": "#131314",
                "on-tertiary-fixed": "#221b00",
                "on-background": "#e5e2e3",
                "secondary": "#d1bcff",
                "on-error-container": "#ffdad6",
                "outline-variant": "#3b494b",
                "primary-container": "#00f0ff",
                "on-tertiary-fixed-variant": "#544600",
                "surface-tint": "#00dbe9",
                "inverse-primary": "#006970",
                "on-tertiary": "#3a3000",
                "background": "#131314"
            },
            spacing: {
                "gutter": "24px",
                "container-max": "1440px",
                "margin-desktop": "48px",
                "margin-mobile": "16px",
                "base": "8px"
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                "headline-lg-mobile": ["Inter", ...defaultTheme.fontFamily.sans],
                "label-caps": ["JetBrains Mono", ...defaultTheme.fontFamily.mono],
                "headline-lg": ["Inter", ...defaultTheme.fontFamily.sans],
                "body-md": ["Inter", ...defaultTheme.fontFamily.sans],
                "display-lg": ["Inter", ...defaultTheme.fontFamily.sans],
                "code-sm": ["JetBrains Mono", ...defaultTheme.fontFamily.mono]
            },
            fontSize: {
                "headline-lg-mobile": ["24px", { "lineHeight": "1.2", "fontWeight": "700" }],
                "label-caps": ["12px", { "lineHeight": "1.0", "letterSpacing": "0.1em", "fontWeight": "600" }],
                "headline-lg": ["32px", { "lineHeight": "1.2", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                "body-md": ["16px", { "lineHeight": "1.6", "fontWeight": "400" }],
                "display-lg": ["48px", { "lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800" }],
                "code-sm": ["14px", { "lineHeight": "1.5", "fontWeight": "400" }]
            },
            keyframes: {
                shimmer: {
                    '100%': { transform: 'translateX(100%)' }
                }
            },
            animation: {
                shimmer: 'shimmer 2s infinite'
            }
        },
    },

    plugins: [forms, containerQueries],
};
