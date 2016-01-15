// sudo npm i gulp gulp-jshint gulp-uglify gulp-concat gulp-rename gulp-minify-css

var gulp 	= require('gulp');
var jshint 	= require('gulp-jshint');
var uglify 	= require('gulp-uglify');
var concat 	= require('gulp-concat');
var rename 	= require('gulp-rename');
var cssmin 	= require('gulp-minify-css');
var files_js  = './_assets/js/**/*.js';
var files_css = './_assets/css/**/*.css';


gulp.task('js', function() {
    gulp.src('./_assets/js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));

    gulp.src([
        './_assets/js/plugins/*.js',
        './_assets/js/*.js'
        ])
        .pipe(concat('./_assets/js'))
        .pipe(rename('main.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./assets'));

    gulp.src(
        './_assets/js/dashboard/**/*.js')
        .pipe(concat('./_assets/js'))
        .pipe(rename('dashboard.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./assets'));
});

gulp.task('css', function() {
    gulp.src(
        './_assets/css/**/*.css')
        .pipe(concat('./_assets/css'))
        .pipe(rename('main.css'))
        .pipe(cssmin())
        .pipe(gulp.dest('./assets'));

    gulp.src(
        './_assets/css/dashboard/*.css')
        .pipe(concat('./_assets/css'))
        .pipe(rename('dashboard.css'))
        .pipe(cssmin())
        .pipe(gulp.dest('./assets'));
});

gulp.task('build', function() {
    // gulp.run('css', 'js', 'img');
    gulp.watch(files_js, ['js']);
    gulp.watch(files_css, ['css']);
});
