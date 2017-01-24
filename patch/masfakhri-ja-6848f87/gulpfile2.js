var gulp = require('gulp');
var sass = require('gulp-ruby-sass');

gulp.task('sass', function() {
    return sass('assets/**/*.scss', {style: 'compressed'})
    .on('error', function (err) {
      console.error('ERROR!', err.message);
   })
    .pipe(gulp.dest('assets/css/compile'));
});

gulp.task('watch', function () {
    gulp.watch('assets/**/*.scss', ['sass']);
});

gulp.task('default', ['sass', 'watch']);
