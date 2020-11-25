const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    theme: {
        extend: {
            colors: {
                primary: {
                    500: "#ABABAB",
                    600: "#414141"
                },
                secondary: {
                    500: "#FFA41D"
                }
            },
            spacing: {
                "72": "18rem",
                "84": "21rem",
                "96": "24rem"
            },
            minHeight: {
                "1": "0.25rem",
                "2": "0.5rem",
                "3": "0.75rem",
                "4": "1rem",
                "5": "1.25rem",
                "6": "1.5rem",
                "8": "2rem",
                "10": "2.5rem",
                "12": "3rem",
                "16": "4rem",
                "20": "5rem",
                "24": "6rem",
                "32": "8rem",
                "40": "10rem",
                "48": "12rem",
                "56": "14rem",
                "64": "16rem",
                "72": "18rem",
                "84": "21rem",
                "96": "24rem",
                halfscreen: "50vh",
                quarterscreen: "75vh",
                screen: "100vh"
            },
            minWidth: {
                "1": "0.25rem",
                "2": "0.5rem",
                "3": "0.75rem",
                "4": "1rem",
                "5": "1.25rem",
                "6": "1.5rem",
                "8": "2rem",
                "10": "2.5rem",
                "12": "3rem",
                "16": "4rem",
                "20": "5rem",
                "24": "6rem",
                "32": "8rem",
                "40": "10rem",
                "48": "12rem",
                "56": "14rem",
                "64": "16rem",
                "72": "18rem",
                "84": "21rem",
                "96": "24rem",
                halfscreen: "50vw",
                quarterscreen: "75vw",
                screen: "100vw"
            },
            maxHeight: {
                "1": "0.25rem",
                "2": "0.5rem",
                "3": "0.75rem",
                "4": "1rem",
                "5": "1.25rem",
                "6": "1.5rem",
                "8": "2rem",
                "10": "2.5rem",
                "12": "3rem",
                "16": "4rem",
                "20": "5rem",
                "24": "6rem",
                "32": "8rem",
                "40": "10rem",
                "48": "12rem",
                "56": "14rem",
                "64": "16rem",
                "72": "18rem",
                "84": "21rem",
                "96": "24rem",
                halfscreen: "50vh",
                quarterscreen: "75vh",
                screen: "100vh"
            },
            height: {
                "1": "0.25rem",
                "2": "0.5rem",
                "3": "0.75rem",
                "4": "1rem",
                "5": "1.25rem",
                "6": "1.5rem",
                "8": "2rem",
                "10": "2.5rem",
                "12": "3rem",
                "16": "4rem",
                "20": "5rem",
                "24": "6rem",
                "32": "8rem",
                "40": "10rem",
                "48": "12rem",
                "56": "14rem",
                "64": "16rem",
                "72": "18rem",
                "84": "21rem",
                "96": "24rem",
                halfscreen: "50vh",
                quarterscreen: "75vh",
                screen: "100vh"
            },
            maxWidth: {
                "1": "0.25rem",
                "2": "0.5rem",
                "3": "0.75rem",
                "4": "1rem",
                "5": "1.25rem",
                "6": "1.5rem",
                "8": "2rem",
                "10": "2.5rem",
                "12": "3rem",
                "16": "4rem",
                "20": "5rem",
                "24": "6rem",
                "32": "8rem",
                "40": "10rem",
                "48": "12rem",
                "56": "14rem",
                "64": "16rem",
                "72": "18rem",
                "84": "21rem",
                "96": "24rem",
                halfscreen: "50vw",
                quarterscreen: "75vw",
                screen: "100vw"
            },
            width: {
                "1": "0.25rem",
                "2": "0.5rem",
                "3": "0.75rem",
                "4": "1rem",
                "5": "1.25rem",
                "6": "1.5rem",
                "8": "2rem",
                "10": "2.5rem",
                "12": "3rem",
                "16": "4rem",
                "20": "5rem",
                "24": "6rem",
                "32": "8rem",
                "40": "10rem",
                "48": "12rem",
                "56": "14rem",
                "64": "16rem",
                "72": "18rem",
                "84": "21rem",
                "96": "24rem",
                halfscreen: "50vw",
                quarterscreen: "75vw",
                screen: "100vw"
            },
            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans]
            },
            screens:{
                'xxl':'1920px'
            }
        }
    },

    variants: {
        opacity: ["responsive", "hover", "focus", "disabled"]
    },

    future: {
        removeDeprecatedGapUtilities: true,
        purgeLayersByDefault: true
    },
    purge: {
        content: [
            './app/**/*.php',
            './resources/**/*.html',
            './resources/**/*.js',
            './resources/**/*.jsx',
            './resources/**/*.ts',
            './resources/**/*.tsx',
            './resources/**/*.php',
            './resources/**/*.vue',
            './resources/**/*.twig',
        ],
        options: {
            defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
            whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
        },
    },
    plugins: [
        require('@tailwindcss/ui'),
        require('@tailwindcss/typography'),
    ],
};
