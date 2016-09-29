@extends('layouts.master')

@section('extendCss')
<link href="{{asset('/build/css/custom.css')}}" rel="stylesheet">
<style>

.black{
    color: #000000;
}
.error{
	color:red;
}


</style>
@endsection

@section('content')
<div class="row black">
<div class="x_panel">
  <div class="x_title">
    <h2>添加试题 </h2>
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
      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
      @include('common._alert')
   <form action="{{ url('admin/questionManage') }}" method="post" id="signupForm">
       {{ csrf_field() }}
    <!-- Start SmartWizard Content -->
    <div id="wizard_verticle" class="form_wizard wizard_verticle">
      <ul class="list-unstyled wizard_steps" id="list-unstyled">
         <li>
          <a href="#step-11">
            <span class="step_no">1</span>
          </a>
        </li>

        <li>
          <a href="#step-22">
            <span class="step_no">2</span>
          </a>
        </li>

        <li id="type_3">
          <a href="#step-33">
            <span class="step_no">3</span>
          </a>
        </li>

        <li>
          <a href="#step-44">
            <span class="step_no">4</span>
          </a>
        </li>
      </ul>

      <div id="step-11">
        <div class="form-horizontal form-label-left">
          <h2 class="StepTitle">基本属性：</h2>
          <span class="section"></span>

          <div class="item form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">题型 <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12" id="typeDiv">
                <select class="form-control" name="type" id="type">
                    <option value="" checked>请选择题型</option>
                    @foreach($question_type as $item)
                    <option value="{{ $item['value'] }}"
                    @if(old('type') && old('type') == $item['value'])
                    selected="selected"
                    @endif
                    > {{ $item['text'] }}
                    </option>
                    @endforeach
               </select>
           </div>
           </div>

           <div class="item form-group">
             <label class="control-label col-md-2 col-sm-2 col-xs-12">分数 <span class="required">*</span>
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
                 <input type="radio" name="score" value="1" @if(old('score') && old('score') == 1) checked @endif> 1 分
                 <input type="radio" name="score" value="2" @if(old('score') && old('score') == 2) checked @endif> 2 分
                 <input type="radio" name="score" value="3" @if(old('score') && old('score') == 3) checked @endif> 3 分
             </div>
             </div>

      </div>
      </div>

      <div id="step-22">
        <div class="form-horizontal form-label-left">
          <h2 class="StepTitle">基本属性：</h2>
          <span class="section"></span>

          <div class="item form-group" style="height:250px">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">题目 <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea name="subject"
              id="subject"
              rows="5"
              placeholder="题目"
              class="form-control col-md-7 col-xs-12">{{ old('subject') }}</textarea>
            </div>
          </div>

      </div>
    </div>

    <div id="step-33">
        <div class="form-horizontal form-label-left">
          <h2 class="StepTitle">正确答案：</h2>
          <span class="section"></span>
          <div class="item form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">正确选项 <span class="required">*</span>
            </label>
              <div class="col-md-6 col-sm-6 col-xs-12" id="choose_right">
                  <!-- 根据题目类型 - 动态添加选项 -->
              </div>
          </div>

          <div class="item form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">解析 <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea name="analysis"
              id="analysis"
              rows="5"
              placeholder="解析"
              class="form-control col-md-7 col-xs-12">{{ old('analysis') }}</textarea>
            </div>
          </div>

        </div>
    </div>

    <div id="step-44">
        <!-- 根据题目类型 - 动态添加选项 -->
    </div>

    </div>
    <!-- End SmartWizard Content -->
    </form>
    </div>
</div>
</div>
@endsection

@section('extentJs')
<script src="{{ asset('/build/js/custom.js') }}"></script>

    <!-- jQuery Smart Wizard -->
    <script src="{{ asset('/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('/src/js/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <!-- validator_cn -->
    <script src="{{ asset('/src/js/jquery-validation/src/localization/messages_zh.js') }}"></script>
    <!-- Layer -->
    <script type="text/javascript" charset="utf8" src="{{ asset('src/js/layer/layer.js')}}"></script>

<script>
      $(document).ready(function() {
                  var html_ABCD = '';
                  html_ABCD += '    <div class="form-horizontal form-label-left">';
                  html_ABCD += '      <h2 class="StepTitle">选项：</h2>';
                  html_ABCD += '      <span class="section"></span>';

                  html_ABCD += '      <div class="item form-group ">';
                  html_ABCD += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项A <span class="required">*</span>';
                  html_ABCD += '        </label>';
                  html_ABCD += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCD += '          <input id="choose_A" class="form-control col-md-7 col-xs-12"';
                  html_ABCD += '          name="choose_A"';
                  html_ABCD += '          placeholder="选项A"';
                  html_ABCD += '          value="{{old('choose_A')}}"';
                  html_ABCD += '          required="required" type="text">';
                  html_ABCD += '        </div>';
                  html_ABCD += '      </div>';

                  html_ABCD += '      <div class="item form-group ">';
                  html_ABCD += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项B <span class="required">*</span>';
                  html_ABCD += '        </label>';
                  html_ABCD += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCD += '          <input id="choose_B" class="form-control col-md-7 col-xs-12"';
                  html_ABCD += '          name="choose_B"';
                  html_ABCD += '          placeholder="选项B"';
                  html_ABCD += '          value="{{old('choose_B')}}"';
                  html_ABCD += '          required="required" type="text">';
                  html_ABCD += '        </div>';
                  html_ABCD += '      </div>';

                  html_ABCD += '      <div class="item form-group ">';
                  html_ABCD += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项C <span class="required">*</span>';
                  html_ABCD += '        </label>';
                  html_ABCD += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCD += '          <input id="choose_C" class="form-control col-md-7 col-xs-12"';
                  html_ABCD += '          name="choose_C"';
                  html_ABCD += '          placeholder="选项C"';
                  html_ABCD += '          value="{{old('choose_C')}}"';
                  html_ABCD += '          required="required" type="text">';
                  html_ABCD += '        </div>';
                  html_ABCD += '      </div>';

                  html_ABCD += '      <div class="item form-group ">';
                  html_ABCD += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项D <span class="required">*</span>';
                  html_ABCD += '        </label>';
                  html_ABCD += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCD += '          <input id="choose_D" class="form-control col-md-7 col-xs-12"';
                  html_ABCD += '          name="choose_D"';
                  html_ABCD += '          placeholder="选项D"';
                  html_ABCD += '          value="{{old('choose_D')}}"';
                  html_ABCD += '          required="required" type="text">';
                  html_ABCD += '        </div>';


                  var html_ABCDEFG = '';
                  html_ABCDEFG += '    <div class="form-horizontal form-label-left">';
                  html_ABCDEFG += '      <h2 class="StepTitle">选项：</h2>';
                  html_ABCDEFG += '      <span class="section"></span>';

                  html_ABCDEFG += '      <div class="item form-group ">';
                  html_ABCDEFG += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项A <span class="required">*</span>';
                  html_ABCDEFG += '        </label>';
                  html_ABCDEFG += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCDEFG += '          <input id="choose_A" class="form-control col-md-7 col-xs-12"';
                  html_ABCDEFG += '          name="choose_A"';
                  html_ABCDEFG += '          placeholder="选项A"';
                  html_ABCDEFG += '          value="{{old('choose_A')}}"';
                  html_ABCDEFG += '          required="required" type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '      </div>';

                  html_ABCDEFG += '      <div class="item form-group ">';
                  html_ABCDEFG += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项B <span class="required">*</span>';
                  html_ABCDEFG += '        </label>';
                  html_ABCDEFG += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCDEFG += '          <input id="choose_B" class="form-control col-md-7 col-xs-12"';
                  html_ABCDEFG += '          name="choose_B"';
                  html_ABCDEFG += '          placeholder="选项B"';
                  html_ABCDEFG += '          value="{{old('choose_B')}}"';
                  html_ABCDEFG += '          required="required" type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '      </div>';

                  html_ABCDEFG += '      <div class="item form-group ">';
                  html_ABCDEFG += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项C <span class="required">*</span>';
                  html_ABCDEFG += '        </label>';
                  html_ABCDEFG += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCDEFG += '          <input id="choose_C" class="form-control col-md-7 col-xs-12"';
                  html_ABCDEFG += '          name="choose_C"';
                  html_ABCDEFG += '          value="{{old('choose_C')}}"';
                  html_ABCDEFG += '          placeholder="选项C"';
                  html_ABCDEFG += '          required="required" type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '      </div>';

                  html_ABCDEFG += '      <div class="item form-group ">';
                  html_ABCDEFG += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项D <span class="required">*</span>';
                  html_ABCDEFG += '        </label>';
                  html_ABCDEFG += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCDEFG += '          <input id="choose_D" class="form-control col-md-7 col-xs-12"';
                  html_ABCDEFG += '          name="choose_D"';
                  html_ABCDEFG += '          placeholder="选项D"';
                  html_ABCDEFG += '          value="{{old('choose_D')}}"';
                  html_ABCDEFG += '          required="required" type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '      </div>';

                  html_ABCDEFG += '      <div class="item form-group ">';
                  html_ABCDEFG += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项E';
                  html_ABCDEFG += '        </label>';
                  html_ABCDEFG += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCDEFG += '          <input id="choose_E" class="form-control col-md-7 col-xs-12"';
                  html_ABCDEFG += '          name="choose_E"';
                  html_ABCDEFG += '          placeholder="选项E"';
                  html_ABCDEFG += '          value="{{old('choose_E')}}"';
                  html_ABCDEFG += '          type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '      </div>';

                  html_ABCDEFG += '      <div class="item form-group ">';
                  html_ABCDEFG += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项F';
                  html_ABCDEFG += '        </label>';
                  html_ABCDEFG += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCDEFG += '          <input id="choose_F" class="form-control col-md-7 col-xs-12"';
                  html_ABCDEFG += '          name="choose_F"';
                  html_ABCDEFG += '          placeholder="选项F"';
                  html_ABCDEFG += '          value="{{old('choose_F')}}"';
                  html_ABCDEFG += '          type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '       </div>';

                  html_ABCDEFG += '      <div class="item form-group ">';
                  html_ABCDEFG += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项G';
                  html_ABCDEFG += '        </label>';
                  html_ABCDEFG += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCDEFG += '          <input id="choose_G" class="form-control col-md-7 col-xs-12"';
                  html_ABCDEFG += '          name="choose_G"';
                  html_ABCDEFG += '          placeholder="选项G"';
                  html_ABCDEFG += '          value="{{old('choose_G')}}"';
                  html_ABCDEFG += '          type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '      </div>';
                  html_ABCDEFG += '    </div>';


                  var html_right_1 = "";

                  html_right_1 += '<input type="radio" name="choose_right" value="A" @if(old('choose_right') && old('choose_right') == 'A' ) checked @endif> A &nbsp;&nbsp;';
                  html_right_1 += '<input type="radio" name="choose_right" value="B" @if(old('choose_right') && old('choose_right') == 'B' ) checked @endif> B &nbsp;&nbsp;';
                  html_right_1 += '<input type="radio" name="choose_right" value="C" @if(old('choose_right') && old('choose_right') == 'C' ) checked @endif> C &nbsp;&nbsp;';
                  html_right_1 += '<input type="radio" name="choose_right" value="D" @if(old('choose_right') && old('choose_right') == 'D' ) checked @endif> D &nbsp;&nbsp;';

                  var html_right_2 = "";

                  html_right_2 += '<input type="checkbox" name="choose_right[]" value="A" @if(is_array(old('choose_right')) && in_array("A", old('choose_right')) == 'A' ) checked @endif> A &nbsp;&nbsp;';
                  html_right_2 += '<input type="checkbox" name="choose_right[]" value="B" @if(is_array(old('choose_right')) && in_array("B", old('choose_right')) == 'B' ) checked @endif> B &nbsp;&nbsp;';
                  html_right_2 += '<input type="checkbox" name="choose_right[]" value="C" @if(is_array(old('choose_right')) && in_array("C", old('choose_right')) == 'C' ) checked @endif> C &nbsp;&nbsp;';
                  html_right_2 += '<input type="checkbox" name="choose_right[]" value="D" @if(is_array(old('choose_right')) && in_array("D", old('choose_right')) == 'D' ) checked @endif> D &nbsp;&nbsp;';
                  html_right_2 += '<input type="checkbox" name="choose_right[]" value="E" @if(is_array(old('choose_right')) && in_array("E", old('choose_right')) == 'E' ) checked @endif> E &nbsp;&nbsp;';
                  html_right_2 += '<input type="checkbox" name="choose_right[]" value="F" @if(is_array(old('choose_right')) && in_array("F", old('choose_right')) == 'F' ) checked @endif> F &nbsp;&nbsp;';

                  var html_right_3 = "";

                  html_right_3 += '<input type="radio" name="choose_right" value="√" @if(old('choose_right') && old('choose_right') == '√' ) checked @endif> √ &nbsp;&nbsp;';
                  html_right_3 += '<input type="radio" name="choose_right" value="&#215;" @if(old('choose_right') && old('choose_right') == '&#215;' ) checked @endif> &#215; &nbsp;&nbsp;';

          //默认
          var type = $("#type").val();
          switch (parseInt(type)) {
            case 1:$("#step-44").append(html_ABCD); $("#choose_right").append(html_right_1);break;
            case 2:$("#step-44").append(html_ABCDEFG); $("#choose_right").append(html_right_2);break;
            case 3:$("#step-44").empty(); $("#choose_right").append(html_right_3);break;
            case 4:alert("无效");break;
          }

        //下拉选择题型 动态显示
        $('#type').change(function(){
            var type = $("#type").val();
            switch (parseInt(type)) {
              case 1: $("#step-44").empty();$("#choose_right").empty();$("#step-44").append(html_ABCD); $("#choose_right").append(html_right_1);break;
              case 2: $("#step-44").empty();$("#choose_right").empty();$("#step-44").append(html_ABCDEFG); $("#choose_right").append(html_right_2);break;
              case 3: $("#step-44").empty();$("#choose_right").empty();$("#choose_right").append(html_right_3);break;
              case 4: alert("无效"); break;
            }
        });

      });
</script>


<script>
$().ready(function() {
     <!-- validator -->
     $("#signupForm").validate({
            submitHandler:function(form){
                form.submit();
            }
        });
    <!-- /validator -->
});

//jquery-wizard 相关
$(function(){
    //对象初始化，以及设定相关回调函数
	$('#wizard_verticle').smartWizard({
        transitionEffect: 'slide',
        labelNext:'下一步', // label for Next button
        labelPrevious:'上一步', // label for Previous button
        labelFinish:'提交',  // label for Finish button
        onLeaveStep : leaveAStepCallback,
        onShowStep	: showStepCallback,
	});
    //设置按钮样式
    $('.buttonNext').addClass('btn btn-success');
    $('.buttonPrevious').addClass('btn btn-primary');
    $('.buttonFinish').addClass('btn btn-default');
    //onShowStep 回调
    function showStepCallback(oFinishButton,context) {
    oFinishButton = $(".actionBar .buttonFinish");
    iFinishStep = $("#list-unstyled li").length;
    iCurrentStep = context.toStep;
        if (iCurrentStep == iFinishStep){
            oFinishButton.removeClass('buttonDisabled')
        } else {
            oFinishButton.addClass('buttonDisabled')
        }
    }
    //离开步骤回调
    function leaveAStepCallback(obj, context){
        return validateSteps(context.fromStep); // 返回true 继续下一步
    }

    //一步一步的验证逻辑
    function validateSteps(stepnumber){
        var isStepValid = true;
        var typeValue = $('#type option:selected').val(); //题目类型值
        var scoreValue = $("input:radio[name='score']:checked").val(); //分数值
        var choose_rightValue = $("input:radio[name='choose_right']:checked").val(); //单选值
        var choose_rightArrValue = $("input:checkbox[name='choose_right[]']:checked").val(); //正确选项值
        switch (stepnumber) {
            case 1:
                if(typeValue == ''){
                    Util.layerAlert('请选择题目类型', 'layui-layer-lan', 1);
                    isStepValid = false;
                }else if(scoreValue == null) {
                    Util.layerAlert('请选择分数', 'layui-layer-lan', 2);
                    isStepValid = false;
                }
                return isStepValid;
            case 2:
                if($("#subject").val() == ''){
                    Util.layerAlert('请填写题目', 'layui-layer-lan', 3);
                    isStepValid = false;
                }
                return isStepValid;
            case 3:
                if(typeValue == 1 || typeValue == 3){
                    if(choose_rightValue == null){
                        Util.layerAlert('请选择正确选项', 'layui-layer-lan', 3);
                        isStepValid = false;
                    }else {
                        if($("#analysis").val() == ''){
                            Util.layerAlert('请填写题目解析', 'layui-layer-lan', 4);
                            isStepValid = false;
                        }
                    }
                }else if (typeValue == 2) {
                    if(choose_rightArrValue == null){
                        Util.layerAlert('请选择正确选项', 'layui-layer-lan', 3);
                        isStepValid = false;
                    }else {
                        if($("#analysis").val() == ''){
                            Util.layerAlert('请填写题目解析', 'layui-layer-lan', 4);
                            isStepValid = false;
                        }
                    }
                }
                return isStepValid;
            case 4:
                return isStepValid;
            default:
                break;
        }
    }
 });
</script>
@endsection
