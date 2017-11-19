var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minifyCSS = require('gulp-minify-css');
var imagemin = require('gulp-imagemin');
var sourcemaps = require('gulp-sourcemaps');
var del = require('del');

var paths = {
    scripts: ['public/assets/js/libs/jquery.js','public/assets/js/libs/bootstrap.js','public/assets/**/*.js'],
    styles: ['public/assets/css/libs/bootstrap.css','public/assets/**/*.css','public/assets/css/libs/styles.css'],
    images: 'public/images/**/*'
};

// Not all tasks need to use streams
// A gulpfile is just another node program and you can use any package available on npm
gulp.task('clean', function() {
    // You can use multiple globbing patterns as you would with `gulp.src`
    return del(['build']);
});

gulp.task('scripts', ['clean'], function() {
    // Minify and copy all JavaScript (except vendor scripts)
    // with sourcemaps all the way down
    return gulp.src(paths.scripts)
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(concat('all.min.js'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('public/build/js'));
});

gulp.task('styles', ['clean'], function() {
    // Minify and copy all JavaScript (except vendor scripts)
    // with sourcemaps all the way down
    return gulp.src(paths.styles)
        .pipe(sourcemaps.init())
        .pipe(minifyCSS())
        .pipe(concat('all.min.css'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('public/build/css'));
});

// Copy all static images
gulp.task('images', ['clean'], function() {
    return gulp.src(paths.images)
    // Pass in options to the task
        .pipe(imagemin({verbose: true,progressive: true,optimizationLevel: 5}))
        .pipe(gulp.dest('public/build/img'));
});

// Rerun the task when a file changes
gulp.task('watch', function() {
    gulp.watch(paths.scripts, ['scripts']);
    gulp.watch(paths.styles, ['styles']);
    gulp.watch(paths.images, ['images']);
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['watch', 'scripts', 'styles', 'images']);