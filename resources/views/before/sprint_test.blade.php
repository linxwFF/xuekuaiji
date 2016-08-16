@extends('layouts.master')

@section('extendCss')
<link href={{asset("../build/css/custom.css")}} rel="stylesheet">
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
            <h4>请选择科目</h4>
        </div>

        <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th class="text-center">科目名称</th>
          <th class="text-center">进入课程</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td class="text-center">财经法规与会计职业道德</td>
          <td class="text-center"><button type="button" class="btn btn-primary">
              进入练习
          </button></td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td class="text-center">会计电算化</td>
          <td class="text-center"><button type="button" class="btn btn-primary">
              进入练习
          </button></td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td class="text-center">会计基础</td>
          <td class="text-center"><button type="button" class="btn btn-primary">
              进入练习
          </button></td>
        </tr>
      </tbody>
    </table>
    </div>

</div>
@endsection

@section('extentJs')
<script src={{asset("../build/js/custom.js")}}></script>
@endsection
