@extends('layouts.master')

@section('extendCss')
<link href="{{ asset('/build/css/custom.css') }}" rel="stylesheet">
<!-- Datatables -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.dataTables.min.css')}}">
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
<div class="row black">

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
            <a href="{{ url('admin/questionManage/create')}}" ><button type="button" class="btn btn-success">新增</button></a>
            <button id="delete" type="button" class="btn btn-danger">删除选中的行</button>
            </span>
            <table id="table" class="table table-hover table-bordered table-condensed " cellspacing="0" width="100%">
            <thead>
            <tr>
            <th><input name="selectAll" type="checkbox" /></th>
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
<script type="text/javascript" charset="utf8" src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>

<script>
var QuestionManage = (function() {
    'use strict';

    $(document).ready(function() {
        //表格初始化
        initTable();
    });

/**
*表格初始化
*/
function initTable() {
    var table = $('#table').DataTable( { //初始化表格

        "processing": true, //进度提示

        // "searching" : false, //搜索框
        // "paging" : false, //翻页
        // "bServerSide" : false, //服务端模式
        // "bAutoWidth" : true, //自适应宽度
        // "ordering" : false, //全局禁用排序
        // "bStateSave" : false, //保持状态

        // ajax请求
        "ajax": {
            'url' : 'questionManage/table', //请求地址
            //传递额外参数 (条件搜索)
            // 'data' : function (d) {
            //     d.test = 1;
            // }
        },
        // 显示字段
        "aoColumns": [{ "mData": null,
              "orderable": false,
              "sDefaultContent" : "",
              "sWidth" : "5%",
                // 返回自定义内容
                "render": function(data, type, full) {
                    return '<input name="selectItem" type="checkbox" value="' + full.id + '" />';
                },
            },{ "mData": "id",
              "orderable": false,
              "sDefaultContent" : "",
              "sWidth" : "5%",
            },{ "mData": "subject",
              "orderable": true,
              "sDefaultContent" : "",
              "sWidth" : "30%",
            },{ "mData": "score",
              "orderable": true,
              "sDefaultContent" : "",
              "sWidth" : "5%",
                // 返回自定义内容
                "render": function(data, type, full) {
                    return "<span style='color:red'>"+ data +"分</span>";
                }
            },{ "mData": "type",
              "orderable": true,
              "sDefaultContent" : "",
              "sWidth" : "5%",
            },{ "mData": "created_at",
              "orderable": false,
              "sDefaultContent" : "",
              "sWidth" : "10%",
            },{ "mData": "null",
              "orderable": false,
              "sDefaultContent" : "",
              "sWidth" : "10%",
                // 返回自定义内容
                "render": function(data, type, full) {
                    return "<a type='button' class='btn btn-warning btn-sm' href='/admin/questionManage/" + full.id + "/edit'>修改</a>&nbsp;<a type='button' class='delete btn btn-danger btn-sm' href='javascript:void(0);' >删除</a>";
                }
            },
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
        // 初始化回调函数
        // initComplete:initComplete,
        // drawCallback: function( settings) {
        //     $('input[name=selectAll]')[0].checked = false; //取消全选状态
        // }
    });

//----------------------------自定义操作------------------------


    //单击行，改变行的样式
    $('#table tbody').on('click', 'tr', function () {
        //联动checkbox 选中状态
        $($(this).children()[0]).children().each(function(){
            if(!this.checked){
					this.checked = true;
                }else{
					this.checked = false;
				}
        });
       $(this).toggleClass('selected');
    } );


    //删除选中行
    $('#delete').click( function () {
       var Tdata = new Array();
       var ids = new Array();
       var table = $('#table').DataTable(); //获取DataTable对象
       Tdata = table.rows('.selected').data(); //获取选择行对象
       for (var i = 0; i < Tdata.length; i++) {
           ids[i] = Tdata[i]['id'];
       }
       if(ids.length<1){
           layer.alert('请至少选择一个');
	   }else{
           layer.msg('确定删除这些项目？', {
            time: 0
            ,btn: ['确定', '取消']
            ,yes: function(index){
              layer.close(index);
              var url = '/admin/questionManage/destroy_many';
              var csrfToken = $("meta[name='csrf-token']").attr("content");
              var data = {
                  _token : csrfToken,
                  ids : ids,
              };

              var result = Util.ajaxHelper(url, 'POST', data);
              if(result.is_true){
                    table.rows('.selected').remove().draw( true ); //删除选中行
                    Util.notify(result.data.message, 1);
                }
              }
           });

	   }
    } );

    // 全选按钮被点击事件
    $('input[name=selectAll]').click(function(){
        if(this.checked){
            $('#table tbody tr').each(function(){
                if(!$(this).hasClass('selected')){
                    $(this).click();
                }
            });
        }else{
            $('#table tbody tr').click();
        }
    });


    $('#table tbody').on('click', 'a.delete', function(e) {
       e.preventDefault();

       var table = $('#table').DataTable(); //获取DataTable对象
       var row = table.row($(this).parents('tr'))
       var id = row.data().id; //获取选中行数据.id

        layer.msg('确定删除？', {
         time: 0
         ,btn: ['确定', '取消']
         ,yes: function(index){
           layer.close(index);
           var url = '/admin/questionManage/' + id;
           var csrfToken = $("meta[name='csrf-token']").attr("content");
           var data = {
               _token: csrfToken
           };

           var result = Util.ajaxHelper(url, 'DELETE', data);
           if(result.is_true){
               row.remove().draw( true ); //删除选择行
               Util.notify(result.data.message, 1);
           }
           }
        });
    });

}
})();
</script>
@endsection
