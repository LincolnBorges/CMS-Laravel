var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin');
var sourcemaps = require('gulp-sourcemaps');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var newer = require('gulp-newer');
var cssnano = require('cssnano');
var del = require('del');
//var exec = require('child_process').exec;

var paths = {
    scripts: ['public/assets/js/libs/jquery.js','public/assets/js/libs/bootstrap.js','public/assets/**/*.js'],
    styles: ['public/assets/css/libs/bootstrap.css','public/assets/**/*.css','public/assets/css/libs/styles.css'],
    images: 'public/images/**/*'
};

gulp.task('clean:js', function() {
    return del(['public/build/js']);
});

gulp.task('clean:css', function() {
    return del(['public/build/css']);
});

gulp.task('clean:img', function() {
    return del(['public/build/img']);
});


gulp.task('scripts', ['clean:js'], function() {
    return gulp.src(paths.scripts)
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(concat('all.min.js'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('public/build/js'));
});

gulp.task('styles', ['clean:css'], function() {
    var plugins = [
        autoprefixer({browsers: ['last 10 version']}),
        cssnano({discardComments: {removeAll: true}})
    ];
    return gulp.src(paths.styles)
        .pipe(sourcemaps.init())
        .pipe(postcss(plugins))
        .pipe(concat('all.min.css'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('public/build/css'));
});

// Tentativa de deletar os arquivos que não estão no banco de dados antes de executar a otimização do gulp
// gulp.task('delete_useless_photos', function(){
//     exec('php delete_useless_photos.php', function (err, stdout, stderr) {
//         console.log(stdout)
//         console.log(stderr)
//     })
// });

gulp.task('images', ['clean:img'], function() {
    return gulp.src(paths.images)
        .pipe(newer('public/build/img'))
        .pipe(imagemin({
            verbose: true,
            progressive: true,
            arithmetic: true,
            optimizationLevel: 7,
            bitDepthReduction: true,
            colorTypeReduction: true,
            paletteReduction: true
        }))
        .pipe(gulp.dest('public/build/img'));
});

gulp.task('watch', function() {
    gulp.watch(paths.scripts, ['scripts']);
    gulp.watch(paths.styles, ['styles']);
    gulp.watch(paths.images, ['images']);
});

gulp.task('default', ['clean:js', 'clean:css', 'clean:img', 'scripts', 'styles', 'images', 'watch']);