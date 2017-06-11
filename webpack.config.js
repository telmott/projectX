module.exports = {
  entry: "./assets/js/lptlus.js",
  output: {
    filename: "./assets/js/bundle.js"
  },
  watch: true,
  module: {
    rules: [
        { test: /\.js$/, exclude: /node_modules/, loader: "babel-loader" }
    ]
  }
}