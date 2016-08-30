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

    //----------------------------扩展样式（主题）----------------------
            //puikinsh/gentelella  主题扩展包
            gulp.src("vendor/bower_dl/gentelella/build/**")
                .pipe(gulp.dest("public/build"));
            gulp.src("vendor/bower_dl/gentelella/src/**")
                .pipe(gulp.dest("public/src"));
            gulp.src("vendor/bower_dl/gentelella/vendors/**")
                .pipe(gulp.dest("public/vendors"));
            //-----补js
            gulp.src("vendor/bower_dl/gentelella/production/js/**")
                .pipe(gulp.dest("public/src/js"));
            //-----补css
            gulp.src("vendor/bower_dl/gentelella/production/css/**")
                .pipe(gulp.dest("public/src/css"));
            //-----补image
            gulp.src("vendor/bower_dl/gentelella/production/images/**")
                .pipe(gulp.dest("public/src/images"));

    //----------------------------扩展样式（主题）----------------------

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
