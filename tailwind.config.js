/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",

        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#9E3216",
                secondary: "#921C06",
                terciary: "#BE7663",
            },
            backgroundSize: {
                auto: "auto",
                cover: "cover",
                contain: "contain",
                "90%": "90%",
                "80%": "80%",
                "70%": "70%",
                "60%": "60%",
                "50%": "50%",
                "40%": "40%",
                "30%": "30%",
                "20%": "20%",
                "10%": "10%",
                4: "1rem",
                6: "1.5rem",
                8: "2rem",
                10: "2.5rem",
                12: "3rem",
                16: "4rem",
                20: "5rem",
                24: "6rem",
                28: "7rem",
                32: "8rem",
                36: "9rem",
                40: "10rem",
            },
            keyframes: {
                scrollText: {
                    '0%': {
                        opacity:0,
                        right:'0',
                    },
                    '15%':{
                        opacity:'1',
                    },
                    
                    '100%': {
                        opacity:0,
                        right: '110%',
                        opacity:1,
                    }
                },
            },
            animation: {
                'scroll-text': "scrollText 30s infinite ease-in-out",
            }
        },
    },
    plugins: [],
    darkMode: "class",
};
