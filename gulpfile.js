// https://github.com/thecodercoder/frontend-boilerplate/blob/master/gulpfile.js
// Importing specific gulp API functions lets us write them below as series() instead of gulp.series()
const {gulp, series, watch, src, dest, parallel} = require("gulp")
/******** Import Gulp plugins.*********/
const autoprefixer = require('autoprefixer');
const babel = require("gulp-babel")
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const cssnano = require('cssnano');
const notify = require('gulp-notify');
const plumber = require("gulp-plumber")
const postcss = require('gulp-postcss');
const rename = require('gulp-rename');
const replace = require('gulp-replace');
const sass = require('gulp-dart-sass');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const mysqlDump = require('mysqldump');
const webpack = require('webpack-stream');

/******** Error Reporting  *********/
let onError = function (err) {
    notify.onError({
        title: "Gulp",
        subtitle: "Failure!",
        message: "Error: <%= error.message %>",
        sound: "Basso"
    })(err);
    this.emit('end');
};

/******** Directory Mapping *********/
const dirs = {
    src: 'web/assets',
    dest: 'web/assets'
};
const sassPath = {
    src: `${dirs.src}/scss/global.scss`,
    dest: `${dirs.dest}`
}
const jsPath = {
    src: `${dirs.src}/JS/_components/*.js`,
    dest: `${dirs.dest}`
};

const jsWebpackPath = {
    src: `${dirs.src}/JS/_webpack/*.js`,
    dest: `${dirs.dest}`
};

/******** JavaScript Tasks *********/
function jsDeps(done) {
    const files = [
        "node_modules/jquery/dist/jquery.min.js",
        "node_modules/slick-carousel/slick/slick.min.js",
        "./web/assets/JS/_vendor/jquery.ihavecookies.min.js",
        "./web/assets/JS/_vendor/jquery.magnific-popup.js",
        "./web/assets/JS/_vendor/jquery.selectBox.js",
        "./web/assets/JS/_vendor/plyr.js",
        "./web/assets/JS/_vendor/jquery-ui.js",
    ]
    return (
        src(files)
            .pipe(plumber({errorHandler: onError}))
            .pipe(concat("main.deps.js"))
            .pipe(dest("./tmp"))
    )
}

function jsWebpack(done) {
    return (
        src(jsWebpackPath.src)
            .pipe(webpack(require("./webpack.config.js")))
            .pipe(dest(jsWebpackPath.dest))
    )
}

function jsBuild(done) {
    return (
        src(jsPath.src)
            .pipe(plumber({errorHandler: onError}))
            .pipe(concat("main.build.js"))
            .pipe(babel({presets: [["@babel/env", {modules: false}]]}))
            .pipe(dest("./tmp"))
    )
}

function jsConcat(done) {
    const files = ["./tmp/main.deps.js", "./tmp/main.build.js"]
    return (
        src(files)
            .pipe(plumber({errorHandler: onError}))
            .pipe(concat("scripts.min.js"))
            .pipe(uglify())
            .pipe(dest(jsPath.dest))
    )
}

exports.js = series(jsDeps, jsBuild, jsConcat, jsWebpack)
exports.jsbuild = jsBuild
exports.jsWebpack = jsWebpack
/******** SCSS Tasks *********/

sass.compiler = require('sass');
function scssTask() {
    return src(sassPath.src)
        .pipe(plumber({errorHandler: onError}))
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([autoprefixer()]))
        // .pipe(postcss([ autoprefixer(), cssnano() ]))
        .pipe(rename('index.css'))
        .pipe(sourcemaps.write('.'))
        .pipe(dest(sassPath.dest))
}

exports.scss = scssTask

function scssProd() {
    return src(sassPath.src)
        .pipe(plumber({errorHandler: onError}))
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(rename('index.css'))
        .pipe(dest(sassPath.dest))
}

exports.scssProd = scssProd

/******** Watch Tasks *********/
function watchStylesTask() {
    watch('web/assets/SCSS/**/*.scss',
        series([scssTask]));
}

exports.watchStyles = watchStylesTask

function watchScriptsTask() {
    watch('web/assets/JS/_components/*.js',
        series(jsDeps, jsBuild, jsConcat,jsWebpack),
    );
    watch('web/assets/JS/_webpack/**/*.js',
        series(jsDeps, jsBuild, jsConcat,jsWebpack),
    );
}

exports.watchScripts = watchScriptsTask

/******** Database Dump Task *********/
function dumpDatabaseTask() {
    return new Promise(function (resolve, reject) {
        mysqlDump({
            connection: {
                host: '127.0.0.1',
                user: 'root',
                password: '',
                database: 'craft_dev',
            },
            dumpToFile: './storage/dump.sql',
        });
        resolve();
    });
};

exports.dumpDatabase = dumpDatabaseTask

/******** Default Task *********/
exports.default = series(
    parallel(scssTask, series(jsDeps, jsBuild, jsConcat, jsWebpack)),
    parallel(watchStylesTask, watchScriptsTask)
);
