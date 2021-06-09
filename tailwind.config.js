module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
  darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            colors: () => {
                const purple = {
                    50: "#F6F8FB",
                    100: "#F0EFFA",
                    200: "#DFD9F7",
                    300: "#CDBCF5",
                    400: "#B78FF2",
                    500: "#886CB3",
                    600: "#7E41E6",
                    700: "#5F33C8",
                    800: "#472A99",
                    900: "#382376",
                };
                const red = {
                    50: "#FCF9F7",
                    100: "#FCF2EE",
                    200: "#F9DDD8",
                    300: "#F6BEB5",
                    400: "#F58C7C",
                    500: "#F4604D",
                    600: "#E73E31",
                    700: "#BF2F2D",
                    800: "#902529",
                    900: "#6F1F23",
                };
                const yellow = {
                    50: "#FBFAF6",
                    100: "#FAF6E9",
                    200: "#F4E9C6",
                    300: "#EED492",
                    400: "#FBBF24",
                    500: "#D68724",
                    600: "#B66115",
                    700: "#884917",
                    800: "#63371A",
                    900: "#4B2C19",
                };
                const olive = {
                    50: "#F9FAF8",
                    100: "#F6F7EF",
                    200: "#EAEDD8",
                    300: "#DADBB5",
                    400: "#B8BA7C",
                    500: "#8E9549",
                    600: "#69702F",
                    700: "#50562B",
                    800: "#3C4128",
                    900: "#2F3323",
                };
                const blue = {
                    50: "#F5F9FB",
                    100: "#E9F5FA",
                    200: "#CDE6F5",
                    300: "#ABD1F2",
                    400: "#76ADED",
                    500: "#4683E7",
                    600: "#335FD7",
                    700: "#2D4AB3",
                    800: "#263A84",
                    900: "#1F2F65",
                };
                const green = {
                    400: "#3BCBA4"
                };
                return {
                    purple,
                    red,
                    yellow,
                    olive,
                    blue,
                    green,
                    primary: purple,
                    danger: red,
                };
            }
        },
    },
  variants: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/forms'), require('@tailwindcss/ui'),
  ],
}
