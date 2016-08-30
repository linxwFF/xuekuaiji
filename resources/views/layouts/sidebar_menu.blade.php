<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
      <li ><a><i class="fa fa-home"></i> 系统管理目录 <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{url('/')}}">模拟考试</a></li>
          <li><a href="{{url('/chapter_practice')}}">章节练习</a></li>
          <li><a href="{{url('/dati_practice')}}">大题练习</a></li>
          <li><a href="{{url('/sprint_test')}}">考前冲刺</a></li>
          <li><a href="{{url('/video')}}">学习视频</a></li>
          <li><a href="{{url('/test_syllabus')}}">考试大纲</a></li>
        </ul>
      </li>

      <li ><a><i class="fa fa-edit"></i> 用户中心 <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" >
          <li><a href="{{url('/accounts_manage')}}">帐号管理</a></li>
          <li><a href="{{url('/test_syllabus')}}">考试中心</a></li>
          <li><a href="{{url('/test_syllabus')}}">成绩分析</a></li>
          <li><a href="{{url('/question')}}">常见问题</a></li>
        </ul>
      </li>

      @role('admin')
      <li ><a><i class="fa fa-edit"></i> 管理员中心 <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" >
          <li><a href="{{url('/admin/userManage')}}">帐号管理</a></li>
          <li><a href="{{url('/admin/questionManage')}}">试题管理</a></li>
        </ul>
      </li>
      @endrole

    </ul>
  </div>

</div>

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
  <a data-toggle="tooltip" data-placement="top" title="Settings">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="FullScreen">
    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="Lock">
    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{url('/logout')}}">
    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
  </a>
</div>
<!-- /menu footer buttons -->
