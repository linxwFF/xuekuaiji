@extends('layouts.master')

@section('extendCss')
<link href="{{ asset('/build/css/custom.css') }}" rel="stylesheet">
<!-- Datatables -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">

<style>

.black{
    color: #000000;
}
.selected{
    background-color: #b0bed9;
}


</style>
@endsection

@section('content')
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
        <h2>试题管理<small>试题列表 </small></h2>

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
        <!-- 验证 -->

            <span class="section">
            <button type="button" class="btn btn-success">新增</button>
            <button id="selectAll" type="button" class="btn btn-primary">全选</button>
            <button id="unSelect"  type="button" class="btn btn-info">全不选</button>
            <button id="inverse"   type="button" class="btn btn-warning">反选</button>
            <button id="delete"    type="button" class="btn btn-danger">删除选中的行</button>
            </span>
            <table id="table" class="table table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
            <th></th>
            <th>ID</th>
            <th>题目</th>
            <th>分数</th>
            <th>题型</th>
            <th>创建时间</th>
             <th>操作</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
            <th></th>
            <th>ID</th>
            <th>题目</th>
            <th>分数</th>
            <th>题型</th>
            <th>创建时间</th>
             <th>操作</th>
            </tr>
            </tfoot>
            <tbody>
            </tbody>
            </table>

        </div>
    </div>
    </div>
</div>
@endsection

@section('extentJs')
<script src="{{ asset('/build/js/custom.js') }}"></script>
<!-- Datatables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function() {
    //表格初始化
    initTable();
} );

/**
*表格初始化
*/
function initTable() {
    var table = $('#table').DataTable( { //初始化表格
        // 进度提示
        "processing": true,
        // 请求地址
        "ajax": "questionManage/table",
        // 显示字段
        "columns": [
            { "data": null, orderable: false, },
            { "data": "id" },
            { "data": "subject", orderable: false, },
            { "data": "score" },
            { "data": "type" },
            { "data": "created_at" },
            { "data": null, orderable: false, },
        ],

        // 设置每页显示记录的下拉菜单
        "aLengthMenu": [[10, 25, 50, 100, 200, -1], ["每页10条", "每页25条", "每页50条", "每页100条", "每页200条", "显示所有数据"]],

        // 中文
        "oLanguage": {
        "sLengthMenu": "每页显示 _MENU_ 条记录",
        "sZeroRecords": "抱歉， 没有找到",
        "sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
        "sInfoEmpty": "没有数据",
        "sInfoFiltered": "(从 _MAX_ 条数据中检索)",
        "oPaginate": {
        "sFirst": "首页",
        "sPrevious": "前一页",
        "sNext": "后一页",
        "sLast": "尾页"
        },
        "sZeroRecords": "没有检索到数据",
        "sProcessing": "<img src='/assets/img/loading.gif' />",
        "sSearch": "搜索"
        },

        // 字段处理
        "columnDefs": [
            {
                  "targets": [0],
                  "render": function(data, type, full) {
                    return '<input name="selectItem" type="checkbox" value="' + full.id + '" />';
                   }
            },
            {
                  "targets": [2],
                  "render": function(data, type, full) {
                    return "<a href='/show?id=" + full.id + "'>" + data + "</a>";
                   }
            },
            {
                  "targets": [3],
                  "render": function(data, type, full) {
                    return "<span style='color:red'>"+ data +"分</span>";
                   }
            },
            // 增加一列，包括删除和修改，同时将需要传递的数据传递到链接中
            {
                 "targets": [6], // 目标列位置，下标从0开始
                 "render": function(data, type, full) { // 返回自定义内容
                     return "<a href='/delete?id=" + full.id + "'>删除</a>&nbsp;<a href='/update?id=" + full.id + "'>更新</a>";
                 }
            }
        ],

        // 下拉回调  初始化分组显示
        "drawCallback": function(settings) {
           var api = this.api();
           var rows = api.rows({
               page: 'current'
           }).nodes();
           var last = null;

           api.column(3, {
               page: 'current'
           }).data().each(function(group, i) {
               if (last !== group) {
                   $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                   last = group;
               }
           });
        },

    });
}

//----------------------------自定义操作------------------------
    // 根据组排序
   $('#table tbody').on('click', 'tr.group',
   function() {
       var currentOrder = table.order()[0];
       if (currentOrder[0] === 3 && currentOrder[1] === 'asc') {
           table.order([3, 'desc']).draw();
       } else {
           table.order([3, 'asc']).draw();
       }
   });


   // 删除选中项
   $('#delete').click( function () {
       var chk_value =[];
       $("#table input:checkbox").each(function(){
           chk_value.push($(this).val());
       });
       console.log(chk_value);
       alert(chk_value.length==0 ?'你还没有选择任何内容！':chk_value);
   } );

    // 全选
    $("#selectAll").click(function () {
        $("#table input:checkbox").each(function () {
            this.checked = true;
        })
    });
    // 全不选
    $("#unSelect").click(function () {
        $("#table input:checkbox").each(function () {
            this.checked = false;
        })
    });
    // 反选
    $("#inverse").click(function () {
        $("#table input:checkbox").each(function () {
            this.checked = !this.checked;
        })
    });





</script>
@endsection
