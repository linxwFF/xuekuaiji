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
        <h2>试题管理</h2>
        <button type="button" class="btn btn-primary btn-sm" id="go_back">返回</button>

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
            @include("admin.questions_manage.update_form")
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
        $("#score_change").addClass("hidden");
        $("#choose_right_change").addClass("hidden");
        $("#score").removeClass("hidden");
        $("#choose_right").removeClass("hidden");
        $("#edit").addClass("hidden");
        $("#submit").removeClass("hidden");
    });
    //返回
    $("#go_back").click(function(){
        history.go(-1);
    });
    //提交
    $("#submit").click(function(){
        var id = $("#id").val();
        var url = '/admin/questionManage/'+ id;
        var csrfToken = $("meta[name='csrf-token']").attr("content");
        var form = $('#form').serializeJSON();
        var data = {
            _token: csrfToken,
            form : form,
        };
        var result = Util.ajaxHelper(url, 'PUT', data);
        if(result.is_true){
            Util.notify(result.data.message, 1);
        }
    });
} );

</script>
@endsection
