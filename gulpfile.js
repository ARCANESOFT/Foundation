'use strict';

/* --------------------------------------------------------------------------
 *  Gulp libs
 * --------------------------------------------------------------------------
 */
var gulp       = require('gulp'),
    concat     = require('gulp-concat'),
    less       = require('gulp-less'),
    minifyCss  = require('gulp-minify-css'),
    notify     = require('gulp-notify'),
    rename     = require('gulp-rename'),
    uglify     = require('gulp-uglify'),
    merge      = require('merge-stream');

/* --------------------------------------------------------------------------
 *  Directories
 * --------------------------------------------------------------------------
 */
var dirs       = {};
dirs.resources = './resources/assets';
dirs.bower     = dirs.resources + '/bower';
dirs.dist      = dirs.resources + '/dist';

/* --------------------------------------------------------------------------
 *  Main Tasks
 * --------------------------------------------------------------------------
 */
gulp.task('all',     ['default', 'vendors']);
gulp.task('default', ['less', 'js']);
gulp.task('vendors', ['css-vendors', 'js-vendors', 'img-vendors', 'fonts-vendors']);

/* --------------------------------------------------------------------------
 *  Resources Tasks
 * --------------------------------------------------------------------------
 */
gulp.task('less', function () {
    return gulp.src(dirs.resources + '/less/style.less')
        .on('error', notify.onError({
            title:   'Error compiling LESS.',
            message: 'Error: <%= error.message %>',
            onLast:  true,
            sound:   true
        }))
        .pipe(less())
        .pipe(gulp.dest(dirs.dist + '/css'))
        .pipe(minifyCss({
            keepSpecialComments: 0
        }))
        .pipe(rename({ extname: '.min.css' }))
        .pipe(gulp.dest(dirs.dist + '/css/'))
        .pipe(notify({
            title:   'Less compiled',
            message: 'Less compiled with success !',
            onLast:   true,
            sound:    false
        }));
});

gulp.task('js', function () {
    return gulp.src(dirs.resources + '/js/app.js')
        .on('error', notify.onError({
            title:   'Error compiling Javascript.',
            message: 'Error: <%= error.message %>',
            onLast:  true,
            sound:   true
        }))
        .pipe(gulp.dest(dirs.dist + '/js'))
        .pipe(uglify())
        .pipe(rename({ extname: '.min.js' }))
        .pipe(gulp.dest(dirs.dist + '/js'))
        .pipe(notify({
            title:   'Javascript compiled',
            message: 'Javascript compiled with success !',
            onLast:   true,
            sound:    false
        }));
});

gulp.task('css-vendors', function () {
    return gulp.src([
        dirs.bower + '/foundation-assets/dist/css/*'
    ]).pipe(gulp.dest(dirs.dist + '/css'))
});

gulp.task('js-vendors', function() {
    return gulp.src([
        dirs.bower + '/foundation-assets/dist/js/**/*'
    ]).pipe(gulp.dest(dirs.dist + '/js'))
});

gulp.task('img-vendors', function() {
    return gulp.src([
        dirs.bower + '/foundation-assets/dist/img/**/*'
    ]).pipe(gulp.dest(dirs.dist + '/img'))
});

gulp.task('fonts-vendors', function() {
    return gulp.src([
        dirs.bower + '/foundation-assets/dist/fonts/*'
    ]).pipe(gulp.dest(dirs.dist + '/fonts'))
});
