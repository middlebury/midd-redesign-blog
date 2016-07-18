var gulp = require('gulp');
var notify = require('gulp-notify');
var browserSync = require('browser-sync').create();
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var cssnano = require('gulp-cssnano');
var cmq = require('gulp-combine-mq');
var imagemin = require('gulp-imagemin');
var uglify = require('gulp-uglify');
var gulpif = require('gulp-if');
var args = require('yargs').argv;
var del = require('del');
var sassGlob = require('gulp-sass-glob');

var PRODUCTION = !!args.production;

var projectName = process.env.PROJECT_NAME || 'midd-redesign-blog';

var plumberErrorHandler = {
  errorHandler: notify.onError({
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
  })
};

var paths = {
  images: {
    src: './src/images/**/*.{jpg, jpeg, png, svg, gif}',
    dest: './img'
  },
  sass: {
    src: './src/sass/**/*.scss',
    dest: './'
  },
  js: {
    src: './src/js/**/*.js',
    dest: './js/'
  }
}

gulp.task('clean', function() {
  return del([
    './style.css',
    './img/**',
    './js/**'
  ]);
});

gulp.task('images', function() {
  return gulp.src(paths.images.src)
    .pipe(imagemin({
      optimizationLevel: 5
    }))
    .pipe(gulp.dest(paths.images.dest));
});

gulp.task('sass', function() {
  return gulp.src(paths.sass.src)
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sassGlob())
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(cmq())
    .pipe(cssnano())
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(gulp.dest(paths.sass.dest))
    .pipe(browserSync.stream())
});

gulp.task('scripts', function() {
  return gulp.src(paths.js.src)
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(gulpif(PRODUCTION, uglify()))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(gulp.dest(paths.js.dest))
    .pipe(browserSync.stream());
});

gulp.task('browser-sync', function() {
  browserSync.init({
    open: false,
    notify: false,
    files: [
      './*.php',
      paths.sass.src
    ],
    proxy: 'localhost/' + projectName
  });
});

gulp.task('build', ['clean', 'sass']);

gulp.task('watch', function() {
  gulp.watch(paths.sass.src, ['sass']);
  gulp.watch(paths.images.src, ['images']);
  gulp.watch(paths.js.src, ['scripts']);
});

gulp.task('default', ['scripts', 'sass', 'watch', 'browser-sync']);
