// webpack.config.js
const webpack = require('webpack');
const path = require('path');

module.exports = {
  entry: "./assets/js/projectx-admin.js",
  output: {
    filename: "projectx-admin-bundle.js",
    path: path.resolve(__dirname, 'assets/js')
  },
  watch: true,
  module: {
    rules: [
        { test: /\.js$/, exclude: /node_modules/, loader: "babel-loader" }
    ]
  },
  plugins: [
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: JSON.stringify('production')
      }
    }),
    new webpack.optimize.UglifyJsPlugin()
  ]
}