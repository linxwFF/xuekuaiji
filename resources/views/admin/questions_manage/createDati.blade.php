@extends('layouts.master')

@section('extendCss')
<link href="{{ asset('/build/css/custom.css') }}" rel="stylesheet">

<style>

.black{
    color: #000000;
}

.log {
position:fixed; /*绝对定位*/
top:25%; /*距顶部50%*/
left:25%;
margin:-25px 0 0 -50px; /*设定这个div的margin-top的负值为自身的高度的一半,margin-left的值也是自身的宽度的一半的负值.(感觉在绕口令)*/
width:100px; /*宽为400,那么margin-top为-200px*/
height:50px; /*高为200那么margin-left为-100px;*/
z-index:99; /*浮动在最上层 */
}
.error{
	color:red;
}


</style>
@endsection

@section('content')
<div class="row">
    <div class="log">
    <button class="btn btn-warning btn-sm" id="addItem">新增小题</button>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>添加大题 </h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <form class="form-horizontal form-label-left" id="signupForm" action="{{ url('admin/questionManage/storeDati') }}" method="post">
              {{ csrf_field() }}
            <!-- 大题题目 -->
            <div class="item form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">大题题目 <span class="required">*</span>
              </label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <textarea id="textarea" name="subject"
                rows="7"
                required
                placeholder="大题题目"
                class="form-control col-md-7 col-xs-12"></textarea>
              </div>
            </div>
            <div class="ln_solid"></div>

        <div id="item">
            <!-- 小题 -->

        </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <button type="reset" class="btn btn-primary">重置</button>
                <button id='submit' type="submit" class="btn btn-success hidden">提交</button>
              </div>
            </div>
            </form>
        </div>
      </div>
    </div>

</div>
@endsection

@section('extentJs')
<script src="{{ asset('/build/js/custom.js') }}"></script>
    <!-- validator -->
   <script src="{{ asset('/src/js/jquery-validation/dist/jquery.validate.min.js') }}"></script>
   <!-- validator_cn -->
   <script src="{{ asset('/src/js/jquery-validation/src/localization/messages_zh.js') }}"></script>

<script>
$(document).ready(function() {
    var count = 0;

    $('#addItem').click(function(){
        count++;
        var html_item = '';
        html_item += '<div class="x_panel">';

        html_item += '<div class="item form-group">';
        html_item += '  <label class="control-label col-md-2 col-sm-2 col-xs-12">第('+ count +')小题题目 <span class="required">*</span>';
        html_item += '  </label>';
        html_item += '  <div class="col-md-6 col-sm-6 col-xs-12">';
        html_item += '    <textarea name="subject_['+ count +']"';
        html_item += '    rows="5"';
        html_item += '    required';
        html_item += '    placeholder="第('+ count +')小题题目"';
        html_item += '    class="form-control col-md-7 col-xs-12"></textarea>';
        html_item += '  </div>';
        html_item += '</div>';

        html_item += '   <div class="form-horizontal form-label-left">';
        html_item += '     <h2 class="StepTitle">选项：</h2>';
        html_item += '     <span class="section"></span>';

        html_item += '     <div class="item form-group ">';
        html_item += '       <label class="control-label col-md-2 col-sm-2 col-xs-12">选项A <span class="required">*</span>';
        html_item += '       </label>';
        html_item += '       <div class="col-md-6 col-sm-6 col-xs-12">';
        html_item += '         <input class="form-control col-md-7 col-xs-12"';
        html_item += '         name="choose_A['+ count +']"';
        html_item += '         placeholder="选项A"';
        html_item += '         required type="text">';
        html_item += '       </div>';
        html_item += '     </div>';

        html_item += '     <div class="item form-group ">';
        html_item += '       <label class="control-label col-md-2 col-sm-2 col-xs-12">选项B <span class="required">*</span>';
        html_item += '       </label>';
        html_item += '       <div class="col-md-6 col-sm-6 col-xs-12">';
        html_item += '         <input class="form-control col-md-7 col-xs-12"';
        html_item += '          name="choose_B['+ count +']"';
        html_item += '         placeholder="选项B"';
        html_item += '         required type="text">';
        html_item += '       </div>';
        html_item += '     </div>';

        html_item += '     <div class="item form-group ">';
        html_item += '       <label class="control-label col-md-2 col-sm-2 col-xs-12">选项C <span class="required">*</span>';
        html_item += '       </label>';
        html_item += '       <div class="col-md-6 col-sm-6 col-xs-12">';
        html_item += '         <input class="form-control col-md-7 col-xs-12"';
        html_item += '         name="choose_C['+ count +']"';
        html_item += '         placeholder="选项C"';
        html_item += '         required type="text">';
        html_item += '       </div>';
        html_item += '     </div>';

        html_item += '     <div class="item form-group ">';
        html_item += '       <label class="control-label col-md-2 col-sm-2 col-xs-12">选项D <span class="required">*</span>';
        html_item += '       </label>';
        html_item += '       <div class="col-md-6 col-sm-6 col-xs-12">';
        html_item += '         <input class="form-control col-md-7 col-xs-12"';
        html_item += '         name="choose_D['+ count +']"';
        html_item += '         placeholder="选项D"';
        html_item += '         required type="text">';
        html_item += '        </div>';
        html_item += '     </div>';

        html_item += '</div>';
        html_item += '</div>';

        $("#item").append(html_item);

        //必须添加小题才允许提交
        if (count > 0) {
            $('#submit').removeClass('hidden');
        }
    });
});
 
</script>

<!-- validator -->
 <script>
 $().ready(function() {
  $("#signupForm").validate({
         submitHandler:function(form){
             form.submit();
         }
     });
 });
 </script>
 <!-- /validator -->
@endsection
