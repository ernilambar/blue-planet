// Config.
var rootPath = './';

// Gulp.
var gulp = require( 'gulp' );

// Rename.
var rename = require( 'gulp-rename' );

// Uglify.
var uglify = require( 'gulp-uglify' );

gulp.task( 'scripts', function() {
	return gulp.src( [ rootPath + 'scripts/*.js' ] )
		.pipe( gulp.dest( 'js' ) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( uglify() )
		.pipe( gulp.dest( 'js' ) );
} );

// Tasks.
gulp.task( 'build', gulp.series( 'scripts' ) );
