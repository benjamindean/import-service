var gulp = require('gulp'),
    cssmin = require('gulp-cssmin'),
    rename = require('gulp-rename'),
    autoprefixer = require('gulp-autoprefixer'),
    uglify = require('gulp-uglify'),
    sass = require('gulp-sass');

gulp.task('copy', function () {
    gulp.src(['public/assets/components/skeleton/css/skeleton.css'])
        .pipe(gulp.dest('public/assets/src/css/'));
    gulp.src(['public/assets/components/skeleton/css/normalize.css'])
        .pipe(gulp.dest('public/assets/src/css/'));
});

gulp.task('sass', function () {
    gulp.src('public/assets/src/scss/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('public/assets/dist/css/'));
});

gulp.task('css', function () {
    gulp.src('public/assets/src/css/*.css')
        .pipe(autoprefixer('> 0%'))
        .pipe(cssmin())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('public/assets/dist/css/'));
});

gulp.task('js', function () {
    gulp.src('public/assets/src/js/*.js')
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('public/assets/dist/js'))
});

gulp.task('default', ['copy', 'sass', 'css', 'js'], function () {
    gulp.watch('public/assets/src/scss/*.scss', ['sass', 'css']);
    gulp.watch('public/assets/src/js/*.js', ['js']);
});