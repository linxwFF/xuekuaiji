@extends('layouts.master')

@section('extendCss')
<link href={{asset("/build/css/custom.css")}} rel="stylesheet">
<style>

.black{
    color: #000000;
}


</style>
@endsection

@section('content')
<div class="row">

    <div class="panel panel-primary">
        <div class="panel-body">
            <h4>个人信息</h4>
        </div>

        <table class="table table-bordered">
      <thead>
        <tr>
              <th class="text-center" colspan="4"><span style="color:#FF4500;">您的到期时间为：2019-2-1 9:42:57</span></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">账号名：</td>
          <td class="text-center">fjsy0003</td>
          <td class="text-center">密码：</td>
          <td class="text-center">fjsy0003</td>
        </tr>
        <tr>
          <td class="text-center">身份证号：</td>
          <td class="text-center">450205198008xxxxxx</td>
          <td class="text-center">手机号：</td>
          <td class="text-center">180xxxxxxxx</td>
        </tr>
        <tr>
          <td class="text-center">常用邮箱：</td>
          <td class="text-center">xxxx@qq.com</td>
          <td class="text-center">姓名:</td>
          <td class="text-center">试用账号</td>
        </tr>
        <tr>
          <td class="text-center">准考证号：</td>
          <td class="text-center">123456789123xxxxxx</td>
          <td class="text-center"></td>
          <td class="text-center"></td>
        </tr>
        <tr>
          <th class="text-center" colspan="4"><button type="button" class="btn btn-info btn-lg">&nbsp;&nbsp;&nbsp;&nbsp;修改&nbsp;&nbsp;&nbsp;&nbsp;</button></th>
        </tr>
      </tbody>
    </table>
    </div>

</div>
@endsection

@section('extentJs')
<script src={{asset("/build/js/custom.js")}}></script>
@endsection
