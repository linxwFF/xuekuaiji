@extends('layouts.master')

@section('extendCss')
<link href="{{asset('/build/css/custom.css')}}" rel="stylesheet">
<style>

.black{
    color: #000000;
}


</style>
@endsection

@section('content')
<div class="row">
<div class="x_panel">
  <div class="x_title">
    <h2>添加试题 <small><a href="{{ url('admin/questionManage/createDati') }}"><button class="btn btn-primary">添加大题</button></a></small></h2>
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
   <form action="{{ url('admin/questionManage') }}" method="post">
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

        <li>
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

          <div class="item form-group {{ $errors->has('type')?"bad":'' }}">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">题型 <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="type" id="type">
                    <option value="0">请选择题型</option>
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
           @if ($errors->first('type'))
           <div class="alert">{{ $errors->first('type') }}</div>
           @endif
           </div>

           <div class="item form-group {{ $errors->has('score')?"bad":'' }}">
             <label class="control-label col-md-2 col-sm-2 col-xs-12">分数 <span class="required">*</span>
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
                 <input type="radio" name="score" value="1"> 1 分
                 <input type="radio" name="score" value="2"> 2 分
                 <input type="radio" name="score" value="3"> 3 分
             </div>
             @if ($errors->first('score'))
             <div class="alert">{{ $errors->first('score') }}</div>
             @endif
             </div>

      </div>
      </div>

      <div id="step-22">
        <div class="form-horizontal form-label-left">
          <h2 class="StepTitle">基本属性：</h2>
          <span class="section"></span>

          <div class="item form-group {{ $errors->has('subject')?"bad":'' }}">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">题目 <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="textarea" name="subject"
              rows="3"
              required="required"
              placeholder="题目"
              class="form-control col-md-7 col-xs-12">{{ old('subject') }}</textarea>
            </div>
          @if ($errors->first('subject'))
          <div class="alert">{{ $errors->first('subject') }}</div>
          @endif
          </div>

      </div>
    </div>

    <div id="step-33">

    </div>

    <div id="step-44">
        <div class="form-horizontal form-label-left">
          <h2 class="StepTitle">正确答案：</h2>
          <span class="section"></span>
          <div class="item form-group {{ $errors->has('choose_right')?"bad":'' }}">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">正确选项 <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="choose_right" class="form-control col-md-7 col-xs-12"
              value="{{ old('choose_right') }}"
              data-validate-length-range="6"
              data-validate-words="2"
              name="choose_right"
              placeholder="正确选项"
              required="required" type="text">
            </div>
            @if ($errors->first('choose_right'))
            <div class="alert">{{ $errors->first('choose_right') }}</div>
            @endif
          </div>

          <div class="item form-group {{ $errors->has('analysis')?"bad":'' }}">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">解析 <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="textarea" name="analysis"
              value="{{ old('analysis') }}"
              rows="3"
              placeholder="解析"
              required="required"
              class="form-control col-md-7 col-xs-12"></textarea>
            </div>
            @if ($errors->first('analysis'))
            <div class="alert">{{ $errors->first('analysis') }}</div>
            @endif
          </div>
        </div>
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

    <!-- jQuery Smart Wizard -->
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
                  html_ABCD += '          data-validate-length-range="6"';
                  html_ABCD += '          data-validate-words="2"';
                  html_ABCD += '          name="choose_A"';
                  html_ABCD += '          placeholder="选项A"';
                  html_ABCD += '          required="required" type="text">';
                  html_ABCD += '        </div>';
                  html_ABCD += '      </div>';

                  html_ABCD += '      <div class="item form-group ">';
                  html_ABCD += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项B <span class="required">*</span>';
                  html_ABCD += '        </label>';
                  html_ABCD += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCD += '          <input id="choose_B" class="form-control col-md-7 col-xs-12"';
                  html_ABCD += '          data-validate-length-range="6"';
                  html_ABCD += '          data-validate-words="2"';
                  html_ABCD += '          name="choose_B"';
                  html_ABCD += '          placeholder="选项B"';
                  html_ABCD += '          required="required" type="text">';
                  html_ABCD += '        </div>';
                  html_ABCD += '      </div>';

                  html_ABCD += '      <div class="item form-group ">';
                  html_ABCD += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项C <span class="required">*</span>';
                  html_ABCD += '        </label>';
                  html_ABCD += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCD += '          <input id="choose_C" class="form-control col-md-7 col-xs-12"';
                  html_ABCD += '          data-validate-length-range="6"';
                  html_ABCD += '          data-validate-words="2"';
                  html_ABCD += '          name="choose_C"';
                  html_ABCD += '          placeholder="选项C"';
                  html_ABCD += '          required="required" type="text">';
                  html_ABCD += '        </div>';
                  html_ABCD += '      </div>';

                  html_ABCD += '      <div class="item form-group ">';
                  html_ABCD += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项D <span class="required">*</span>';
                  html_ABCD += '        </label>';
                  html_ABCD += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCD += '          <input id="choose_A" class="form-control col-md-7 col-xs-12"';
                  html_ABCD += '          data-validate-length-range="6"';
                  html_ABCD += '          data-validate-words="2"';
                  html_ABCD += '          name="choose_D"';
                  html_ABCD += '          placeholder="选项D"';
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
                  html_ABCDEFG += '          data-validate-length-range="6"';
                  html_ABCDEFG += '          data-validate-words="2"';
                  html_ABCDEFG += '          name="choose_A"';
                  html_ABCDEFG += '          placeholder="选项A"';
                  html_ABCDEFG += '          required="required" type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '      </div>';

                  html_ABCDEFG += '      <div class="item form-group ">';
                  html_ABCDEFG += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项B <span class="required">*</span>';
                  html_ABCDEFG += '        </label>';
                  html_ABCDEFG += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCDEFG += '          <input id="choose_B" class="form-control col-md-7 col-xs-12"';
                  html_ABCDEFG += '          data-validate-length-range="6"';
                  html_ABCDEFG += '          data-validate-words="2"';
                  html_ABCDEFG += '          name="choose_B"';
                  html_ABCDEFG += '          placeholder="选项B"';
                  html_ABCDEFG += '          required="required" type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '      </div>';

                  html_ABCDEFG += '      <div class="item form-group ">';
                  html_ABCDEFG += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项C <span class="required">*</span>';
                  html_ABCDEFG += '        </label>';
                  html_ABCDEFG += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCDEFG += '          <input id="choose_C" class="form-control col-md-7 col-xs-12"';
                  html_ABCDEFG += '          data-validate-length-range="6"';
                  html_ABCDEFG += '          data-validate-words="2"';
                  html_ABCDEFG += '          name="choose_C"';
                  html_ABCDEFG += '          placeholder="选项C"';
                  html_ABCDEFG += '          required="required" type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '      </div>';

                  html_ABCDEFG += '      <div class="item form-group ">';
                  html_ABCDEFG += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项D <span class="required">*</span>';
                  html_ABCDEFG += '        </label>';
                  html_ABCDEFG += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCDEFG += '          <input id="choose_A" class="form-control col-md-7 col-xs-12"';
                  html_ABCDEFG += '          data-validate-length-range="6"';
                  html_ABCDEFG += '          data-validate-words="2"';
                  html_ABCDEFG += '          name="choose_D"';
                  html_ABCDEFG += '          placeholder="选项D"';
                  html_ABCDEFG += '          required="required" type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '      </div>';

                  html_ABCDEFG += '      <div class="item form-group ">';
                  html_ABCDEFG += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项E';
                  html_ABCDEFG += '        </label>';
                  html_ABCDEFG += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCDEFG += '          <input id="choose_E" class="form-control col-md-7 col-xs-12"';
                  html_ABCDEFG += '          data-validate-length-range="6"';
                  html_ABCDEFG += '          data-validate-words="2"';
                  html_ABCDEFG += '          name="choose_E"';
                  html_ABCDEFG += '          placeholder="选项E"';
                  html_ABCDEFG += '          required="required" type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '      </div>';

                  html_ABCDEFG += '      <div class="item form-group ">';
                  html_ABCDEFG += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项F';
                  html_ABCDEFG += '        </label>';
                  html_ABCDEFG += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCDEFG += '          <input id="choose_E" class="form-control col-md-7 col-xs-12"';
                  html_ABCDEFG += '          data-validate-length-range="6"';
                  html_ABCDEFG += '          data-validate-words="2"';
                  html_ABCDEFG += '          name="choose_F"';
                  html_ABCDEFG += '          placeholder="选项F"';
                  html_ABCDEFG += '          required="required" type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '       </div>';

                  html_ABCDEFG += '      <div class="item form-group ">';
                  html_ABCDEFG += '        <label class="control-label col-md-2 col-sm-2 col-xs-12">选项G';
                  html_ABCDEFG += '        </label>';
                  html_ABCDEFG += '        <div class="col-md-6 col-sm-6 col-xs-12">';
                  html_ABCDEFG += '          <input id="choose_G" class="form-control col-md-7 col-xs-12"';
                  html_ABCDEFG += '          data-validate-length-range="6"';
                  html_ABCDEFG += '          data-validate-words="2"';
                  html_ABCDEFG += '          name="choose_G"';
                  html_ABCDEFG += '          placeholder="选项G"';
                  html_ABCDEFG += '          required="required" type="text">';
                  html_ABCDEFG += '        </div>';
                  html_ABCDEFG += '      </div>';
                  html_ABCDEFG += '    </div>';

          //默认
          var type = $("#type").val();
          switch (parseInt(type)) {
            case 1:$("#step-33").append(html_ABCD); break;
            case 2:$("#step-33").append(html_ABCDEFG); break;
            case 3:$("#step-33").empty(); break;
            case 4:alert("无效");break;
          }

        $('#wizard_verticle').smartWizard({
        transitionEffect: 'slide'
        });
        //设置按钮样式
        $('.buttonNext').addClass('btn btn-success');
        $('.buttonPrevious').addClass('btn btn-primary');
        $('.buttonFinish').addClass('btn btn-default');

        //下拉选择题型 动态显示
        $('#type').change(function(){
            var type = $("#type").val();
            switch (parseInt(type)) {
              case 1: $("#step-33").empty();$("#step-33").append(html_ABCD);break;
              case 2: $("#step-33").empty();$("#step-33").append(html_ABCDEFG);break;
              case 3: $("#step-33").empty();break;
              case 4: alert("无效"); break;
            }
        });

      });
    </script>
    <!-- /jQuery Smart Wizard -->
@endsection
