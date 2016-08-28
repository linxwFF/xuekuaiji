<!DOCTYPE html>
<html lang="en">
  <!-- header -->
  @include('layouts.header')
  <!-- /header -->
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src={{asset("../src/images/img.jpg")}} alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- 左侧导航 -->
            @include('layouts.sidebar_menu')
            <!-- /左侧导航 -->

          </div>
        </div>

            <!-- 右侧顶部导航 -->
            @include('layouts.top_navigation')
            <!-- /右侧顶部导航 -->

            <!-- 页面内容 -->
            <div class="right_col" role="main">
            @yield('content')
            </div>
            <!-- /页面内容 -->

            <!-- 脚部内容 -->
            @include('layouts.footer')
            <!-- /脚部内容  -->
      </div>
    </div>
    <!-- jQuery -->
    <script src={{asset("../vendors/jquery/dist/jquery.min.js")}}></script>
    <!-- Bootstrap -->
    <script src={{asset("../vendors/bootstrap/dist/js/bootstrap.min.js")}}></script>
    <!-- 自定义扩展JS -->
    @yield('extentJs')
  </body>
</html>
