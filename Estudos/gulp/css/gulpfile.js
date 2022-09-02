const { series, parallel } = require('gulp')
const gulp = require('gulp')
const sass = require('gulp-sass')(require('sass'));
const uglifycss = require('gulp-uglifycss')
const concat = require('gulp-concat')
const htmlmin = require('gulp-htmlmin');

function transformacaoCSS(){
    return gulp.src('src/sass/index.scss')
    .pipe(sass().on('error',sass.logError))
    .pipe(uglifycss({"uglyComments": true}))
    .pipe(concat('estilo.min.css'))
    .pipe(gulp.dest('build/css'))
}

function copiarHTML(){
    return gulp.src('src/**/*.html')
    .pipe(htmlmin({ collapseWhitespace: true }))
    .pipe(gulp.dest('build'))
}

exports.default = parallel(transformacaoCSS,copiarHTML)
