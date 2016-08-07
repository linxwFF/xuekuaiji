var gulp = require('gulp');
var elixir = require('laravel-elixir');

/**
 * 拷贝任何需要的文件
 *
 * Do a 'gulp copyfiles' after bower updates
 */
gulp.task("copyfiles", function() {
    //jquery.js
    gulp.src("vendor/bower_dl/jquery/dist/jquery.js")
        .pipe(gulp.dest("resources/assets/js/"));
    //bootstap.js
    gulp.src("vendor/bower_dl/bootstrap/dist/js/bootstrap.js")
        .pipe(gulp.dest("resources/assets/js/"));
    //bootstrap css 文件
    gulp.src("vendor/bower_dl/bootstrap/less/**")
        .pipe(gulp.dest("resources/assets/less/bootstrap"));

    //animate.css css 文件
    gulp.src("vendor/bower_dl/animate.css/**")
        .pipe(gulp.dest("resources/assets/less/animate.css"));

    //bootstrap 字体文件
    gulp.src("vendor/bower_dl/bootstrap/dist/fonts/**")
        .pipe(gulp.dest("public/assets/fonts"));

    //背景图片资源
    gulp.src("resources/assets/img/**")
        .pipe(gulp.dest("public/assets/img"));

});

/**
 * Default gulp is to run this elixir stuff
 */
elixir(function(mix) {

    // 合并 scripts  合并 jquery.js 和 bootstrap.js
    mix.scripts(['js/jquery.js','js/bootstrap.js'],
        'public/assets/js/bootstrapJquery.js',
        'resources/assets'
    );

    // 编译 Less 合并放在 public/assets/css/bootstrap.css 路径下
    mix.less('bootstrap.less', 'public/assets/css/bootstrap.css');

    // 编译 Less 合并放在 public/assets/css/animate.css 路径下
    mix.less('animate.less', 'public/assets/css/animate.css');
});
