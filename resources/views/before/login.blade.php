<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>登录页</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="{{url("./assets/css/bootstrap.css")}}" rel="stylesheet">
    <link href="{{url("./assets/css/animate.css")}}" rel="stylesheet">
    <link href="{{url("./assets/extendCss/style.min.css")}}" rel="stylesheet">
    <link href="{{url("./assets/extendCss/login.min.css")}}" rel="stylesheet">
    <script src="{{url("./assets/js/bootstrapJquery.js")}}" ></script>

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>

</head>

<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-7">
                <div class="signin-info">
                    <div class="logopanel m-b">
                        <h1>xuekuaiji.site</h1>
                    </div>
                    <div class="m-b"></div>
                    <h4>欢迎使用 <strong>会计模拟考试系统</strong></h4>
                    <ul class="m-b">
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势一</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势二</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势三</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势四</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势五</li>
                    </ul>
                    <!--<strong>还没有账号？ <a href="#">立即注册&raquo;</a></strong><br />-->
                    <strong>试用账号获取 <a href="#">立即获取&raquo;</a></strong>
                </div>
            </div>
            <div class="col-sm-5">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul style="color:red;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="/login">
                    {!! csrf_field() !!}
                    <h4 class="no-margins">登录：</h4>
                    <p class="m-t-md">登录会计模拟考试系统</p>
                    <input type="email" class="form-control uname" placeholder="用户名" value="{{ old ('email')}}" name="email" />
                    <input type="password" class="form-control pword m-b" placeholder="密码" value="{{ old ('password')}}" name="password" />
                    <input type="checkbox" name="remember"> 记住我
                    <a href="#">忘记密码了？</a>
                    <button class="btn btn-success btn-block">登录</button>
                </form>
            </div>
        </div>
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2016 xuekuaiji.site
            </div>
        </div>
    </div>
</body>


</html>
