"use strict"

import plugins from "gulp-load-plugins"
import yargs from "yargs"
import browser from "browser-sync"
import gulp from "gulp"
import yaml from "js-yaml"
import fs from "fs"
import named from "vinyl-named"
import webpackStream from "webpack-stream"
import webpack from "webpack"
import myWebpackConfig from "./webpack/webpack.config.js"

// Load all gulp plugins in to one variable
const $ = plugins()

// Check for --production flag
const PRODUCTION = !!yargs.argv.PRODUCTION

// Load Settings from config.yml
const { COMPATIBILITY, PROXY, PORT, PATHS } = loadConfig()
function loadConfig() {
  let ymlFile = fs.readFileSync("config.yml", "utf8")
  return yaml.load(ymlFile)
}

gulp.task("default", gulp.series(server, watch))

gulp.task("prod", gulp.series(gulp.parallel(sass, javascript)))

// Compile Sass into CSS
// In production, the CSS is compressed
function sass() {
  return (
    gulp
      .src("assets/scss/style.scss")
      .pipe($.sourcemaps.init())
      .pipe(
        $.sass({
          includePaths: PATHS.sass
        }).on("error", $.sass.logError)
      )
      .pipe(
        $.autoprefixer({
          browsers: COMPATIBILITY
        })
      )
      // Comment in the pipe below to run UnCSS in production
      //.pipe($.if(PRODUCTION, $.uncss(UNCSS_OPTIONS)))
      .pipe($.if(PRODUCTION, $.cleanCss({ compatibility: "ie9" })))
      .pipe($.if(!PRODUCTION, $.sourcemaps.write()))
      .pipe(gulp.dest(PATHS.root))
      .pipe(browser.reload({ stream: true }))
  )
}

// Combine JavaScript into one file
// In production, the file is minified
function javascript() {
  return gulp
    .src(PATHS.es6js)
    .pipe(named())
    .pipe($.sourcemaps.init())
    .pipe(webpackStream(myWebpackConfig, webpack))
    .pipe(
      $.if(
        PRODUCTION,
        $.uglify().on("error", e => {
          console.log(e)
        })
      )
    )
    .pipe($.if(!PRODUCTION, $.sourcemaps.write()))
    .pipe(gulp.dest(PATHS.root))
}

// Start a server with BrowserSync to preview the site in
function server(done) {
  browser.init({
    proxy: PROXY,
    port: PORT,
    open: false
  })
  done()
}

// Reload the browser with BrowserSync
function reload(done) {
  browser.reload()
  done()
}

// Watch for changes to static assets, pages, Sass, and JavaScript
function watch() {
  gulp.watch("assets/scss/**/*.scss").on("all", sass)
  gulp
    .watch("assets/js/**/*.js")
    .on("all", gulp.series(javascript, browser.reload))
  //   gulp.watch("assets/img/**/*").on("all", gulp.series(images, browser.reload))
}
