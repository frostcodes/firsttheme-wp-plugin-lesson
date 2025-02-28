import fs from 'fs';
import yargs from 'yargs'
import { hideBin } from 'yargs/helpers'

import gulp from 'gulp';
import gulpSaas from 'gulp-sass'
import * as sass from 'sass'
import * as del from 'del'

import gulpIf from 'gulp-if';
import imagemin from 'gulp-imagemin';
import sourcemaps from 'gulp-sourcemaps'
import gulpCleanCss from 'gulp-clean-css';

import webpack from 'webpack-stream'
import named from 'vinyl-named';
import GulpZip from 'gulp-zip';
import gulpReplace from 'gulp-replace';

const packageInfo = JSON.parse(fs.readFileSync('./package.json', 'utf8'));

const scss = gulpSaas(sass);
const argv = yargs(hideBin(process.argv)).argv
const IS_PRODUCTION_MODE = argv.prod

const paths = {
  styles: {
    src: ['src/assets/scss/admin-area.scss', 'src/assets/scss/frontend.scss'],
    dest: 'dist/assets/css'
  },
  images: {
    src: 'src/assets/images/**/*.{jpg,jpeg,png,svg,gif}',
    dest: 'dist/assets/images'
  },
  scripts: {
    src: ['src/assets/js/admin-area.js', 'src/assets/js/frontend.js'],
    dest: 'dist/assets/js'
  },
  others: {
    src: ['src/assets/**/*', '!src/assets/{images,js,scss}{,/**}'],
    dest: 'dist/assets'
  },
  finalBuildPackage: {
    src: ['**/*', '!.vscode{,/**}', '!node_modules{,/**}', '!src{,/**}', '!releases{,/**}', '!.babelrc', '!.gitignore', '!.git{,/**}', '!gulpfile.mjs', '!rough-samples{,/**}', '!temp{,/**}', '!package.json', '!package-lock.json', '!jsconfig.json'],
    dest: 'releases',
  }
}

export function styles() {
  return gulp.src(paths.styles.src)
    .pipe(gulpIf(!IS_PRODUCTION_MODE, sourcemaps.init()))
    .pipe(scss().on('error', scss.logError))
    .pipe(gulpIf(IS_PRODUCTION_MODE, gulpCleanCss({ compatibility: 'ie8' })))
    .pipe(gulpIf(!IS_PRODUCTION_MODE, sourcemaps.write()))
    .pipe(gulp.dest(paths.styles.dest))
}

export function images() {
  return gulp.src(paths.images.src, { encoding: false })
    .pipe(gulpIf(IS_PRODUCTION_MODE, imagemin()))
    .pipe(gulp.dest(paths.images.dest))
}

export function scripts() {
  return gulp.src(paths.scripts.src)
    .pipe(named())
    .pipe(webpack({
      mode: IS_PRODUCTION_MODE ? 'production' : 'development',
      devtool: !IS_PRODUCTION_MODE ? 'inline-source-map' : false,
      module: {
        rules: [
          {
            test: /\.js$/,
            use: {
              loader: 'babel-loader',
              options: {
                presets: ['@babel/preset-env']

              }
            }
          }
        ]
      },
      output: {
        filename: '[name].js'
      },
    }))
    .pipe(gulp.dest(paths.scripts.dest))
}

export function copy() {
  return gulp.src(paths.others.src, { encoding: false })
    .pipe(gulp.dest(paths.others.dest))
}

export function clean(done) {
  del.deleteSync(['dist'])
  done()
}

export function watch() {
  gulp.watch('src/assets/scss/**/*.scss', styles)
  gulp.watch('src/assets/js/**/*.js', scripts)

  gulp.watch(paths.images.src, images)
  gulp.watch(paths.others.src, copy)
}

export async function build() {
  return gulp.series(clean, gulp.parallel(styles, scripts, images, copy), compress)();
}

export async function dev() {
  return gulp.series(clean, gulp.parallel(styles, scripts, images, copy), watch)();
}

export function compress() {
  // TODO: add more replacers for this:  https://developer.wordpress.org/themes/basics/main-stylesheet-style-css/

  return gulp.src(paths.finalBuildPackage.src, { encoding: false, base: '../' })
    .pipe(gulpIf((file) => (file.relative.split('.').pop() !== 'zip'), gulpReplace('_UPPERCASED_PLUGIN_NAME', packageInfo.name.toUpperCase())))
    .pipe(gulpIf((file) => (file.relative.split('.').pop() !== 'zip'), gulpReplace('_PLUGIN_NAME', packageInfo.name)))
    .pipe(gulpIf((file) => (file.relative.split('.').pop() !== 'zip'), gulpReplace('_PLUGIN_VERSION', packageInfo.version)))

    .pipe(gulpIf((file) => (file.relative.split('.').pop() !== 'zip'), gulpReplace('_UPPERCASED_THEME_NAME', packageInfo.theme.toUpperCase())))
    .pipe(gulpIf((file) => (file.relative.split('.').pop() !== 'zip'), gulpReplace('_THEME_NAME', packageInfo.theme)))

    // .pipe(gulpIf((file) => (file.relative.split('.').pop() !== 'zip'), gulpReplace('_TSN', packageInfo.themeShortName)))
    .pipe(gulpIf((file) => (file.relative.split('.').pop() !== 'zip'), gulpReplace('_tsn', packageInfo.themeShortName)))

    .pipe(GulpZip(`${packageInfo.theme}-${packageInfo.name}.zip`))
    .pipe(gulp.dest(paths.finalBuildPackage.dest))
}

export default dev;
