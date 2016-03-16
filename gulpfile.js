process.env.DISABLE_NOTIFIER = true;

var gulp        = require('gulp');
var gulpjs      = require('./taskmodules/_gulpjs.js');
var gulpsass    = require('./taskmodules/_gulpsass.js');
var watcher     = require('gulp-watch');

gulp.task('default', function(done) {

    gulpjs.getBrowserifyMinifySourcemap('src/js/main.js', 'main.js', 'assets/js/main.js', false, false)(function() {
        console.log("JS COMPLETE");
    });

    gulpsass.getMinifySourcemap('src/scss/main.scss', 'style.css', './', false, false)(function() {
        console.log("CSS COMPLETE")
    });

});

gulp.task('watch', function() {

    watcher('src/**/*.js', function() {

        gulpjs.getBrowserifyMinifySourcemap('src/js/main.js', 'main.js', 'assets/js/main.js', false, false)(function() {
            console.log("JS COMPLETE");
        });

    });

    watcher('src/**/*.scss', function() {

        gulpsass.getMinifySourcemap('src/scss/main.scss', 'style.css', './', false, false)(function() {
            console.log("CSS COMPLETE")
        });

    })

});