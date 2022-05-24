const path = require('path');
const miniCss = require('mini-css-extract-plugin');

module.exports = {
  mode: 'development',
  entry: {
    main: [
      './src/index.js'
  ]
},

  output: {
    filename: '[name].bundle.js',
    path: path.resolve(__dirname, 'dist')
  },
  module: {
    rules: [
       {
          test: /\.css$/,
          use: [
             miniCss.loader,
             'css-loader',
          ]
       },
       {
          test: /\.s[ac]ss$/,
          use: [
             miniCss.loader,
             'css-loader',
             'sass-loader',
          ]
       },
      {
        test: /\.?js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ['@babel/preset-env']
          }
        }
      }
    ]
   },
   plugins: [

     new miniCss({
       filename: 'style.css',
     })
   ],
}
