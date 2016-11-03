@extends('layouts.master')

@section('extendCss')
<link href={{asset("/build/css/custom.css")}} rel="stylesheet">
<style>

.black{
    color: #000000;
}
.title{
    color: #207089;
    font: 18px/48px 微软雅黑;
}


</style>
@endsection

@section('content')
<div class="row" style="background-color: white;">

<div class="col-md-12">

        &nbsp;&nbsp;<i class="fa fa-search fa-2x" aria-hidden="true"><span class="title">网校视频网址及提取码</span></i>
        <div class="table-responsive">
        <table class="table table-bordered table-condensed">
      <thead>
        <tr>
          <th>#</th>
          <th class="text-left">学习视频名称</th>
          <th class="text-left">学习视频网址</th>
          <th class="text-left">提取码</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td >1</th>
          <td class="text-left">会计基础</td>
          <td class="text-left">
              <a href="www.baidu.com" target="_blank"><span class="label label-warning">点我</span></a>
              <a href="http://pan.baidu.com/share/init?shareid=2294200210&amp;uk=1009444357" target="_blank">
                  http://pan.baidu.com/share/init?shareid=2294200210&amp;uk=1009444357
              </a>
          </td>
          <td>
              找买家索取
          </td>
         </tr>

        <tr>
          <td >3</th>
          <td class="text-left">财经法规与职业道德</td>
          <td class="text-left">
              <a href="www.baidu.com" target="_blank"><span class="label label-warning">点我</span></a>
              <a href="http://pan.baidu.com/share/init?shareid=2294200210&amp;uk=1009444357" target="_blank">
                  http://pan.baidu.com/share/init?shareid=2294200210&amp;uk=1009444357
              </a>
          </td>
          <td>
              找买家索取
          </td>
        </tr>

        <tr>
          <td >3</th>
          <td class="text-left">初级会计电算化</td>
          <td class="text-left">
              <a href="www.baidu.com" target="_blank"><span class="label label-warning">点我</span></a>
              <a href="http://pan.baidu.com/share/init?shareid=2294200210&amp;uk=1009444357" target="_blank">
                  http://pan.baidu.com/share/init?shareid=2294200210&amp;uk=1009444357
              </a>
          </td>
          <td>
              找买家索取
          </td>
         </tr>
      </tbody>
    </table>
    </div>
</div>

</div>
@endsection

@section('extentJs')
<script src={{asset("/build/js/custom.js")}}></script>
@endsection
