const { src, dest, watch, series, parallel } = require( "gulp" );
const del = require( "del" );
const plumber = require( "gulp-plumber" );
const notify = require( "gulp-notify" );
const sass = require( "gulp-sass" );
const postcss = require( "gulp-postcss" );
const cssnext = require( "postcss-cssnext" );
const cleanCSS = require( "gulp-clean-css" );
const rename = require( "gulp-rename" );
const sourcemaps = require( "gulp-sourcemaps" );
const babel = require( "gulp-babel" );
const uglify = require( "gulp-uglify" );
const browserSync = require( "browser-sync" );
const imagemin = require( "gulp-imagemin" );
const imageminMozjpeg = require( "imagemin-mozjpeg" );
const imageminPngquant = require( "imagemin-pngquant" );
const imageminSvgo = require( "imagemin-svgo" );

const srcPath = {
    scss: 'src/assets/sass/**/*',
    css: 'src/assets/sass/**.scss',
    blockScss: 'inc/blocks/src/style.scss',
    js: 'src/assets/js/*.js',
    img: 'src/assets/images/**/*',
    php: '**/*.php',
}
const destPath = {
    css: 'assets/css/',
    blockCss: 'inc/blocks/build/',
    js: 'assets/js/',
    img: 'assets/images/'
}

const browsers = [
    'last 2 versions',
    '> 5%',
    'ie = 11',
    'not ie <= 10',
    'ios >= 8',
    'and_chr >= 5',
    'Android >= 5',
]

const browserSyncOption = {
    files: [ '**/*.php' ],
    proxy: 'dev.wordpress',
    open: true,
    watchOptions: {
        debounceDelay: 1000
    },
    reloadOnRestart: true,
}

const delDir = () => {
    return del([ 'assets/css', 'assets/js', 'assets/images'])
}

const imgImagemin = () => {
    return src(srcPath.img)
        .pipe(
            imagemin(
                [
                    imageminMozjpeg({
                        quality: 80
                    }),
                    imageminPngquant(),
                    imageminSvgo({
                        plugins: [
                            {
                                removeViewbox: false
                            }
                        ]
                    })
                ],
                {
                    verbose: true
                }
            )
        )
        .pipe( dest(destPath.img) )
}

const cssSass = () => {
    return src(srcPath.css)
        .pipe( sourcemaps.init() )
        .pipe(
            plumber(
                {
                    errorHandler: notify.onError( 'Error: <%= error.message %>')
                }
            )
        )
        .pipe( sass() )
        .pipe( postcss( [cssnext(browsers)] ) )
        .pipe( sourcemaps.write( '/maps' ) )
        .pipe( dest(destPath.css) )
        .pipe( cleanCSS() )
        .pipe(
            rename(
            { extname: '.min.css' }
            )
        )
        .pipe( dest(destPath.css) )
}

const blockSass = () => {
    return src(srcPath.blockScss)
        .pipe(
            plumber(
                {
                    errorHandler: notify.onError( 'Error: <%= error.message %>')
                }
            )
        )
        .pipe( sass() )
        .pipe( postcss( [cssnext(browsers)] ) )
        .pipe( dest(destPath.blockCss) )
}

const jsBabel = () => {
    return src(srcPath.js)
        .pipe(
            plumber(
                {
                    errorHandler: notify.onError( 'Error: <%= error.message %>')
                }
            )
        )
        .pipe( babel ( {
            presets: [ '@babel/preset-env' ]
        }))
        .pipe( dest(destPath.js) )
        .pipe( uglify() )
        .pipe(
            rename(
                { extname: '.min.js' }
            )
        )
        .pipe( dest(destPath.js) )
}

const browserSyncFunc = () => {
    browserSync.init( browserSyncOption );
}

const browserSyncReload = ( done ) => {
    browserSync.reload();
    done();
}

const watchFiles = () => {
    watch( srcPath.scss, series( cssSass, browserSyncReload ) )
    watch( srcPath.blockScss, series( blockSass, browserSyncReload ) )
    watch( srcPath.js, series( jsBabel, browserSyncReload ) )
    watch( srcPath.img, series( imgImagemin, browserSyncReload ) )
    watch( srcPath.php, browserSyncReload )
}

exports.default = series( series( cssSass, jsBabel, imgImagemin, blockSass ), parallel( watchFiles, browserSyncFunc ) );
exports.build = series( delDir, cssSass, jsBabel, blockSass, imgImagemin );
