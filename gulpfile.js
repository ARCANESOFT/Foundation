'use strict';

/* --------------------------------------------------------------------------
 *  Gulp libs
 * --------------------------------------------------------------------------
 */
var gulp       = require('gulp'),
    less       = require('gulp-less'),
    concat     = require('gulp-concat'),
    minifyCss  = require('gulp-minify-css'),
    uglify     = require('gulp-uglify'),
    notify     = require('gulp-notify');

/* --------------------------------------------------------------------------
 *  Directories
 * --------------------------------------------------------------------------
 */
var dirs       = {};
dirs.resources = './resources/assets';
dirs.bower     = dirs.resources + '/bower';

/* --------------------------------------------------------------------------
 *  Main Tasks
 * --------------------------------------------------------------------------
 */
gulp.task('foundation', ['foundation-less', 'foundation-js']);

gulp.task('foundation-all', ['foundation', 'foundation-vendors']);
