const path = require("path")
const webpack = require("webpack")

module.exports = {
  entry: "./assets/js/app.js",
  output: {
    path: "/",
    filename: "bundle.js"
  },
  externals: {
    jquery: "jQuery"
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules\/(?!(foundation-sites)\/).*/,
        loader: "babel-loader"
      }
    ]
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      "window.jQuery": "jquery"
    })
  ]
}
