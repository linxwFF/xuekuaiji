@extends('layouts.master')

@section('extendCss')
<link href={{asset("../build/css/custom.css")}} rel="stylesheet">
<style>
.title{
    display: block;
    font-size: 2em;
    -webkit-margin-before: 0.67em;
    -webkit-margin-after: 0.67em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
    font-weight: bold;
    color: #000000;
}
.black{
    color: #000000;
}
.btn-bg-color{
    background-color:#00FFFF;
}


</style>
@endsection

@section('content')
<div class="row">
<div class="col-md-12">
    <h1 class="title"><b>无纸化模拟考试系统</b></h1>
</div>
<div class="col-md-12">
    <p><b>全真模拟：</b>全面模拟机考流程，给考生最贴近实际的机考体验</p>
</div>
<div class="col-md-12">
    <p><b>名师题库：</b>顶级名师团队精心编写，题型全面，覆盖各类考点</p>
</div>
<div class="col-md-12">
    <p><b>随机组卷：</b>模拟机考随机精选试题组卷，含金量高，直击考试</p>
</div>

    <div class="col-md-4" style="margin-top: 15px;margin-bottom: 20px;">
        <button type="button" class="btn btn-info btn-lg btn-bg-color"><a href="{{url('/start_exam')}}">&nbsp;&nbsp;&nbsp;&nbsp;开始考试&nbsp;&nbsp;&nbsp;&nbsp;<a/></button>
    </div>
</div>

<div class="col-md-4" style="margin-left:-10px;">
    <div class="panel panel-info">
    <div class="panel-heading"><h4><b class="black">主要功能</b></h4></div>
      <div class="panel-body" style="padding: 10px">
          <ul style="list-style:none;">
              <li style="float:left;">
                      <a href="/Main/Ksdl" target="_blank" class="black"><i class="fa fa-graduation-cap fa-2x fa-fw" aria-hidden="true">模拟考试</i></a>
              </li>
              <li style="float:left;margin-left:10px">
                      <a href="/Main/Ksdl" target="_blank" class="black"><i class="fa fa-bars fa-2x fa-fw" aria-hidden="true">章节练习</i></a>
              </li>
              <li style="float:left;margin-left:10px">
                      <a href="/Main/Ksdl" target="_blank" class="black"><i class="fa fa-bar-chart fa-2x fa-fw" aria-hidden="true">考试大纲</i></a>
              </li>
              <li style="float:left;margin-left:10px">
                      <a href="/Main/Ksdl" target="_blank" class="black"><i class="fa fa-question-circle-o fa-2x fa-fw" aria-hidden="true">常见问题</i></a>
              </li>
              <li style="float:left;margin-left:10px">
                      <a href="/Main/Ksdl" target="_blank" class="black"><i class="fa fa-line-chart fa-2x fa-fw" aria-hidden="true">考前冲刺</i></a>
              </li>
          </ul>
      </div>
    </div>
</div>
<div class="col-md-4">
    <div class="panel panel-info">
    <div class="panel-heading"><h4><b class="black">考试提醒</b></h4></div>
      <div class="panel-body">
          <div class="content">
              <p style="font-size: 17px;">请按照我们设置的课程，尽快学习，有不懂的可以通过网页底部QQ给老师留言。祝您考试成功！</p>
          </div>
      </div>
    </div>
</div>
@endsection

@section('extentJs')
<script src={{asset("../build/js/custom.js")}}></script>
@endsection
