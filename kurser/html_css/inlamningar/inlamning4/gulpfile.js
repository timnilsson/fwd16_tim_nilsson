var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync');
var merge = require('merge-stream');

gulp.task('browserSync', function(){
    browserSync({
        server: {
            baseDir: 'app'
        }
    });
});

gulp.task('sass', function(){
    return gulp.src('app/scss/**/*.+(scss|sass)')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('app/css'))
    .pipe(browserSync.reload({
        stream: true
    }));
});

gulp.task('watch', ['browserSync', 'sass'], function(){
    gulp.watch('app/scss/**/*.+(scss|sass)', ['sass']);
    gulp.watch('app/index.html', browserSync.reload);
});

gulp.task('prod', function(){
    var html=gulp.src('app/*.html')
    .pipe(gulp.dest('dist'))

    var css=gulp.src('app/css/*.css')
    .pipe(gulp.dest('dist/css'))

    var img=gulp.src('app/images/**/*.+(png|jpg|gif|svg)')
    .pipe(gulp.dest('dist/images'))

    var js=gulp.src('app/js/*.js')
    .pipe(gulp.dest('dist/js'))

    return merge(html, css, img, js);
});

gulp.task('default', ['sass', 'browserSync', 'watch', 'prod']);