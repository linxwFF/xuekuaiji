
                  <div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left input_mask" id="form">
                     <input type="hidden" value="{{$item['type']}}" id="type">
                     <input type="hidden" value="{{$item['id']}}" id="id" name="id">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">题目<span style="color:red;">({{$item['type_text']}})</span>：</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea id="textarea" name="subject" readonly="readonly" rows="4" class="form-control col-md-7 col-xs-12" aria-required="true">{{$item['subject']}}</textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">分数： </label>
                        <div class="col-md-2 col-sm-2 col-xs-12" id="score_change">
                            <input readonly="readonly" class="form-control col-md-2 col-xs-12" value="{{$item['score']}}&nbsp;分">
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12 hidden" id="score">
                            <input readonly="readonly" type="radio" name="score" value="1" @if($item['score'] && $item['score'] == 1) checked @endif> 1 分
                            <input readonly="readonly" type="radio" name="score" value="2" @if($item['score'] && $item['score'] == 2) checked @endif> 2 分
                            <input readonly="readonly" type="radio" name="score" value="3" @if($item['score'] && $item['score'] == 3) checked @endif> 3 分
                        </div>
                      </div>


                      @foreach($item['choose'] as $k => $v)
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">选项{{$k}}：</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input readonly="readonly" class="form-control col-md-7 col-xs-12" name="choose_{{$k}}" placeholder="选项{{$k}}" value="{{$v}}" required="required" type="text">
                        </div>
                      </div>
                      @endforeach

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">正确选项：
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12" id="choose_right_change">
                            <input readonly="readonly" class="form-control col-md-2 col-xs-12" value="{{is_array($item['choose_right'])? implode(',', $item['choose_right']) : $item['choose_right']}}">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 hidden" id="choose_right">
                            @if($item['type'] == 1)
                            <input readonly="readonly" type="radio" name="choose_right" value="A" @if($item['choose_right'] == 'A' ) checked @endif> A &nbsp;&nbsp;
                            <input readonly="readonly" type="radio" name="choose_right" value="B" @if($item['choose_right'] == 'B' ) checked @endif> B &nbsp;&nbsp;
                            <input readonly="readonly" type="radio" name="choose_right" value="C" @if($item['choose_right'] == 'C' ) checked @endif> C &nbsp;&nbsp;
                            <input readonly="readonly" type="radio" name="choose_right" value="D" @if($item['choose_right'] == 'D' ) checked @endif> D &nbsp;&nbsp;
                            @elseif($item['type'] == 2)
                            <input readonly="readonly" type="checkbox" name="choose_right[]" value="A" @if(in_array("A", $item['choose_right']) == 'A' ) checked @endif> A &nbsp;&nbsp;
                            <input readonly="readonly" type="checkbox" name="choose_right[]" value="B" @if(in_array("B", $item['choose_right']) == 'B' ) checked @endif> B &nbsp;&nbsp;
                            <input readonly="readonly" type="checkbox" name="choose_right[]" value="C" @if(in_array("C", $item['choose_right']) == 'C' ) checked @endif> C &nbsp;&nbsp;
                            <input readonly="readonly" type="checkbox" name="choose_right[]" value="D" @if(in_array("D", $item['choose_right']) == 'D' ) checked @endif> D &nbsp;&nbsp;
                            <input readonly="readonly" type="checkbox" name="choose_right[]" value="E" @if(in_array("E", $item['choose_right']) == 'E' ) checked @endif> E &nbsp;&nbsp;
                            <input readonly="readonly" type="checkbox" name="choose_right[]" value="F" @if(in_array("F", $item['choose_right']) == 'F' ) checked @endif> F &nbsp;&nbsp;
                            @elseif($item['type'] == 3)
                            <input type="radio" name="choose_right" value="√" @if($item['choose_right'] == '√' ) checked @endif> √ &nbsp;&nbsp;
                            <input type="radio" name="choose_right" value="&#215;" @if($item['choose_right'] == '&#215;' ) checked @endif> &#215; &nbsp;&nbsp;
                            @endif
                        </div>
                      </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">解析：
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea readonly="readonly" name="analysis" id="analysis" rows="5"  class="form-control col-md-7 col-xs-12">{{$item['analysis']}}</textarea>
                      </div>
                    </div>
                    </form>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">

                          <button type="button" class="btn btn-warning" id="edit">修改</button>
                          <button type="button" class="btn btn-success hidden" id="submit">提交</button>
                        </div>
                      </div>


                  </div>
