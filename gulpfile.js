var gulp = require('gulp');
var scss = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('scss', function() {
    return gulp
        .src('./scss/main.scss')
        .pipe(scss({outputStyle: 'compressed'}))
        .pipe(autoprefixer({browserlist: ['> 0.5%', 'last 2 versions', 'maintained node versions', 'not dead']}))
        .pipe(gulp.dest(''));
});

gulp.task('watch', function() {
    return gulp
        .watch('./scss/**/*.scss', ['scss']);
});

gulp.task('default', ['scss', 'watch']);