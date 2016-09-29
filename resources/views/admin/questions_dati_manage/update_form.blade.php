    <div class="x_content">
        <form class="form-horizontal form-label-left input_mask" id="baseForm">
          <input type="hidden" value="{{$data['base']['id']}}" id="id" name="id">
          <input type="hidden" value="{{count($data['derived'])}}" id="counter">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">题目<span style="color:red;">({{$data['base']['type_text']}})</span>：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea id="textarea" name="subject" readonly="readonly" rows="4" class="form-control col-md-7 col-xs-12" aria-required="true">{{$data['base']['subject']}}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">本题总分数： </label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <div class="input-group">
                <input readonly="readonly" name="score" class="form-control col-md-2 col-xs-12" value="{{$data['base']['score']}}">
                <div class="input-group-addon">分</div>
                </div>
            </div>
          </div>
        </form>

        @foreach($data['derived'] as $k => $v)
        <form class="form-horizontal form-label-left input_mask" id="derivedFrom_{{$k}}">
        <div class="ln_solid"></div>
            <input type="hidden" value="{{$v['id']}}" id="id" name="id">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">小题题目<span style="color:red;">({{$k+1}})</span>：</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <textarea id="textarea" name="subject" readonly="readonly" rows="4" class="form-control col-md-7 col-xs-12" aria-required="true">{{$v['subject']}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">分数： </label>
              <div class="col-md-2 col-sm-2 col-xs-12" id="score_change">
                  <div class="input-group">
                  <input readonly="readonly" name="score" class="form-control col-md-2 col-xs-12" value="{{$v['score']}}">
                  <div class="input-group-addon">分</div>
                  </div>
              </div>
            </div>

        @foreach($v['choose'] as $key => $value)
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">选项{{$key}}：</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input readonly="readonly" class="form-control col-md-7 col-xs-12" name="choose_{{$key}}" placeholder="选项{{$key}}" value="{{$value}}" required="required" type="text">
            </div>
          </div>
        @endforeach

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">正确选项：
            </label>
            <div class="col-md-2 col-sm-2 col-xs-12 " choose_right_change>
                <input readonly="readonly" class="form-control col-md-2 col-xs-12" value="{{is_array($v['choose_right_'.$k])? implode(',', $v['choose_right_'.$k]) : $v['choose_right_'.$k]}}">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 hidden" choose_right>
                <input readonly="readonly" type="checkbox" name="choose_right[]" value="A" @if(in_array("A", $v['choose_right_'.$k]) == 'A' ) checked @endif> A &nbsp;&nbsp;
                <input readonly="readonly" type="checkbox" name="choose_right[]" value="B" @if(in_array("B", $v['choose_right_'.$k]) == 'B' ) checked @endif> B &nbsp;&nbsp;
                <input readonly="readonly" type="checkbox" name="choose_right[]" value="C" @if(in_array("C", $v['choose_right_'.$k]) == 'C' ) checked @endif> C &nbsp;&nbsp;
                <input readonly="readonly" type="checkbox" name="choose_right[]" value="D" @if(in_array("D", $v['choose_right_'.$k]) == 'D' ) checked @endif> D &nbsp;&nbsp;
            </div>
          </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">解析：
          </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
          <textarea readonly="readonly" name="analysis" id="analysis" rows="5"  class="form-control col-md-7 col-xs-12">{{$v['analysis']}}</textarea>
          </div>
        </div>
        </form>
        @endforeach

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">

              <button type="button" class="btn btn-warning" id="edit">修改</button>
              <button type="button" class="btn btn-success hidden" id="submit">提交</button>
            </div>
          </div>

    </div>
