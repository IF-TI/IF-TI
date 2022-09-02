const gulp = require('gulp')
const { series, parallel} = require('gulp')
const rename = require('gulp-rename');

const antes1 = cb => {
    console.log('Tarefa Antes1 ')
    return cb()
}
const antes2 = cb => {
    console.log('Tarefa Antes2 ')
    return cb()
}

function copiar(cb){
    // gulp.src(['pastaA/arquivo1.txt','pastaA/arquivo2.txt'])
   gulp.src('pastaA/**/*.txt')
    .pipe(gulp.dest('pastaB'))
    return cb()
}

const fim = cb => {
    console.log('Tarefa Fim ')
    return cb()
}

function jsUglify(cb){
	gulp.src('**/*_src.js')
    .pipe(rename(function(path) {
        return {
            dirname: path.dirname,
            basename: path.basename.split('_src')[0],
            extname: ".js"
          }
        })
    )	
    .pipe(gulp.dest('dist'))
    return cb()
}
module.exports.default = series(
    parallel(antes1, antes2),
    copiar,
    fim
)