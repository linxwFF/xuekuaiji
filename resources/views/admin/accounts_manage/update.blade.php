@extends('layouts.master')

@section('extendCss')
<link href="{{ asset('/build/css/custom.css') }}" rel="stylesheet">
<style>

.black{
    color: #000000;
}
</style>
@endsection

@section('content')
<div class="row black">

    <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
        <h2>账户管理</h2>

        <!-- 右侧工具栏 -->
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

                <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a></li>
                <li><a href="#">Settings 2</a></li>
                </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>

        <div class="clearfix"></div>
        </div>
        <div class="x_content">

            @foreach($data as $item)
            @include("admin.accounts_manage.update_form")
            @endforeach

        </div>
    </div>
    </div>
</div>
@endsection

@section('extentJs')
<script src="{{ asset('/build/js/custom.js') }}"></script>

<!-- jquery.serializeJSON -->
<script src="{{ asset('/src/js/jquery.serializeJSON/jquery.serializejson.js') }}"></script>

<script>
$(document).ready(function() {
    //编辑
    $("#edit").click(function(){
        $("input").removeAttr("readonly");
        $("textarea").removeAttr("readonly");

        //选项修改状态
        $("div[choose_right_change]").addClass("hidden");
        $("div[choose_right]").removeClass("hidden");

        $("#submit").removeClass("hidden");
    });
    //返回列表
    $("#go_back").click(function(){
        window.location.href="/admin/userManage/";
    });
    //提交
    $("#submit").click(function(){
        var counter     = $("#counter").val();
        var id          = $("#id").val();
        var url         = '/admin/userManage/'+ id;
        var csrfToken   = $("meta[name='csrf-token']").attr("content");
        var baseForm    = $('#baseForm').serializeJSON();
        var arr = new Array();
        for(var i = 0;i<counter;i++){
            arr[i] = $('#derivedFrom_'+ i).serializeJSON();
        }
        console.log(arr);
        var data = {
            _token      : csrfToken,
            baseForm    : baseForm,
            derivedFrom : arr,
        };
        var result = Util.ajaxHelper(url, 'PUT', data);
        if(result.is_true){
            Util.notify(result.data.message, 1);

            $("input").attr("readonly", "readonly");
            $("textarea").attr("readonly", "readonly");
        }
    });
} );

</script>
@endsection
