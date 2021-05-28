module.exports = {
  purge: [
      './storage/framework/views/*.php',
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
  ],
  darkMode: 'media', // or 'media' or 'class'
  theme: {
    extend: {
        screen: {
            'tvScreen-3xl':'1600px'
        },
        bgColor:{

        }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [

  ],
}
