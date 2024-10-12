var gulp = require("gulp");

var concat = require("gulp-concat");
var babel = require("gulp-babel");
var minify = require("gulp-minify");

const javascriptObfuscator = require("gulp-javascript-obfuscator");
const sourcemaps = require("gulp-sourcemaps");

gulp.task("jSkm", function () {
	return (
		gulp
			.src("assets/js/skm.js")
			.pipe(
				babel({
					presets: ["@babel/env"],
				})
			)
			.pipe(
				javascriptObfuscator({
					compact: true,
				})
			)
			.pipe(sourcemaps.write())
			.pipe(concat("skm-production.js"))
			// .pipe(minify())
			.pipe(gulp.dest("assets/lib/"))
	);
});

gulp.task("jsValid", function () {
	return (
		gulp
			.src("assets/js/skm_validation.js")
			.pipe(
				babel({
					presets: ["@babel/env"],
				})
			)
			.pipe(
				javascriptObfuscator({
					compact: true,
				})
			)
			.pipe(sourcemaps.write())
			.pipe(concat("skm-validation.js"))
			// .pipe(minify())
			.pipe(gulp.dest("assets/lib/"))
	);
});

gulp.task("jsConsole", function () {
	return (
		gulp
			.src("assets/js/console_login.js")
			.pipe(
				babel({
					presets: ["@babel/env"],
				})
			)
			.pipe(
				javascriptObfuscator({
					compact: true,
				})
			)
			.pipe(sourcemaps.write())
			.pipe(concat("skm-console.js"))
			// .pipe(minify())
			.pipe(gulp.dest("assets/lib/"))
	);
});

gulp.task("watch", function () {
	// You can use a single task
	gulp.watch("assets/js/skm.js", gulp.series(["jSkm"]));
	gulp.watch("assets/js/skm_validation.js", gulp.series(["jsValid"]));
	gulp.watch("assets/js/console_login.js", gulp.series(["jsConsole"]));
});
