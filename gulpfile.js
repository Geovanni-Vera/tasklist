const {src,dest,watch} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const plumber = require('gulp-plumber');
//compilador de sass a css
function css(done){
    src('src/scss/**/*.scss')
    .pipe(plumber())
    .pipe(sass())
    .pipe(dest('build/css/'));
    done();
}
//watch a css
function dev(done){
    watch('src/scss/**/*.scss',css);
    done()  //to tell gulp that task is completed.
}

exports.css = css;
exports.dev = dev;