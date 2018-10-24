var gulp = require('gulp');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var minify = require('gulp-clean-css');

gulp.task('sass', function() {
    return gulp.src('scss/theme.scss')
        .pipe(sass())
        .pipe(gulp.dest('css-compiled/'))
        .pipe(rename('theme.min.css'))
        .pipe(minify())
        .pipe(gulp.dest('css-compiled/'));
});

gulp.task('watch', function() {
    gulp.watch(['scss/theme.scss', 'scss/theme/*.scss'], ['sass']);
});

gulp.task('default', ['sass', 'watch']);