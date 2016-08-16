<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1" runat="server">
    <title>2016会计无纸化考试题库系统</title>
    <link href="{{url("./assets/extendCss/exam/exam.style.css")}}" rel="stylesheet">
    <link href="{{url("./assets/extendCss/exam/exam.css")}}" rel="stylesheet">
    <script src="{{url("./assets/extendjs/exam/jquery-1.7.1.min.js")}}" ></script>
    <script src="{{url("./assets/extendjs/exam/myscript.js")}}" ></script>
    <script src="{{url("./assets/extendjs/exam/cookie.js")}}" ></script>
    <script src="{{url("./assets/extendjs/exam/kaoshi.js")}}" ></script>
    <style type="text/css">
        .tab {
            padding-top: 5px;
            border-bottom: 1px solid #3176AD;
        }

            .tab span {
                display: inline-block;
                height: 30px;
                line-height: 30px;
                border: solid #3176AD;
                border-width: 1px 1px 0;
                margin-right: 5px;
                padding: 0 10px;
                position: relative;
                cursor: pointer;
            }

                .tab span.bs {
                    background: #3176AD;
                    color: #fff;
                }
    </style>
    <script type="text/javascript">
        $().ready(function () {
            //闹钟时间
            setInterval("ChangeTime()", 1000);

            //初始化时，定义考试的科目名称和科目的题目数量
            var title = $('.tab span[class=bs]').attr("title").split('|')[0];
            var count = $('.tab span[class=bs]').attr("title").split('|')[1];
            //考试科目名称
            $('#kskm').text(title);
            //总题数
            $('#zts').text(count);
            //重置时间
            // delCookie('sumsj-0636462431');
        });
        //闹钟时间
        function ChangeTime() {
            var kemu_count = parseInt('1');
            var TimeNum;
            //获取考卷时间
            if (!getCookie("sumsj-0636462431")) {
                //没有时间就是一个小时
                TimeNum = kemu_count * 60 * 60;
            } else {
                TimeNum = getCookie("sumsj-0636462431");
            }
            //每次减一秒
            TimeNum--;
            //剩余时间存放COOKIE
            setCookie("sumsj-0636462431", TimeNum);
            //时间视图
            if (TimeNum > 0) {
                var fz = Math.floor(TimeNum / 60);
                var ms = TimeNum % 60;
                var ys = kemu_count * 60 * 60 - TimeNum;
                $('#ys').val(ys);
                fz = (fz < 10) ? "0" + fz : fz;
                ms = (ms < 10) ? "0" + ms : ms;
                var sj = fz + "分" + ms + "秒";
                $("#myclock").text(sj);
            }
            else {
                submitpaper();
            }
        }
        //收集答案
        function collectanswer() {
            var result = new Array();
            var temp = new Array();
            $('.temp').each(function () {
                var index = $(this).index();
                //考试科目名字
                var kemu_name = $('.tab span').eq(index).text();
                var bid = $(this).attr("ref");
                $(this).children('.divr').each(function () {
                    var dataArray = $(this).attr("ref").split('|');
                    var tid = parseInt(dataArray[0]);
                    var sid = parseInt(dataArray[1]);
                    switch (tid) {
                        case 1:
                            temp.push(sid + '/' + tid + '/' + $(this).find('.divrda').find('input:checked').val());
                            break;
                        case 2:
                            temp.push(sid + '/' + tid + '/' + $(this).find('.divrda').find('input:checked').map(function () {
                                return $(this).val();
                            }).get().join(''));
                            break;
                        case 3:
                            temp.push(sid + '/' + tid + '/' + $(this).find('.divrda').find('input:checked').val());
                            break;
                        case 4:
                            if (bid == 1)
                                temp.push(sid + '/' + tid + '/' + $(this).find('.divrdaa').map(function () {
                                    return $(this).find('input:checked').map(function () {
                                        return $(this).val();
                                    }).get().join('');
                                }).get().join('$#$#'));
                            else
                                temp.push(sid + '/' + tid + '/' + $(this).find('.answerboxs').map(function () {
                                    return $(this).find('div').map(function () {
                                        return $(this).children().eq(0).val() + ',' + $(this).children().eq(1).val() + ',' + $(this).children().eq(2).val();
                                    }).get().join(';');
                                }).get().join('$#$#'));
                            break;
                        case 5:
                            temp.push(sid + '/' + tid + '/' + $(this).find('input[type=hidden]').val());
                            break;

                    }
                });
                result.push(temp.join('****') + '++++' + kemu_name);
                console.log(result);
                temp = new Array();
            });
            $('#daan').val(result.join('----').replace(/undefined/g, ''));
            // alert(result.join('----').replace(/undefined/g, ''));
        }
        function submitpaper() {
            if ($('.havebg').length > 0) {
                collectanswer();
                // $('form').submit();
            } else {
                alert('没有答题，无法交卷！');
            }
        }
    </script>
</head>
<body oncopy="return false;" oncontextmenu="return false" onselectstart="return false" ondragstart="return false" onbeforecopy="return false" oncopy="document.selection.empty()" onselect="document.selection.empty()" >



<form action="/Main/Jiaojuan" method="post">        <input type="hidden" name="daan" id="daan" />
        <input type="hidden" name="timestamp" value="0636462431" />
        <input type="hidden" name="kemu_id" value="1" />
        <input type="hidden" name="ys" id="ys" value="0" />
</form>




    <div class="myexam_head">
        <div class="topbg">
            <div class="top" style="background:url('{{ url('./assets/img/exam/tlogo/fujian.jpg')}}') no-repeat;">
                <div class="topr">
                    <img alt="" src={{url('./assets/img/exam/jsq.jpg')}} width="78" height="30" onclick="window.open('/Content/jsq.htm','_blank')"/>
                </div>
            </div>
        </div>
        <table>
            <tr>
                <td class="myexam_pic ac">
                    <img src={{url('./assets/img/exam/portrait.jpg')}} alt="" /></td>
                <td class="myexam_identity">
                    <ul>
                        <li>姓名：试用账号</li>
                        <li>准考证号：123456789123xxxxxx</li>
                        <li>身份证号：450205198008xxxxxx</li>
                        <li>考试科目：<span id="kskm2">财经法规与会计职业道德</span></li>
                    </ul>
                </td>
                <td class="myexam_tt ac">
                    <p>福建省会计从业资格无纸化考试系统</p>
                    <p><span id="kskm"></span></p>
                    <p>总题数：<span id="zts"></span></p>
                </td>
                <td class="myexam_time">
                    <dl>
                        <dt class="ac">剩余时间：
                                    <span id="myclock"></span>
                        </dt>
                    </dl>
                </td>
            </tr>
        </table>
    </div>

    <div class="tab">
            <span class='bs' title='财经法规与会计职业道德|62' ref="1">财经法规与会计职业道德</span>
    </div>

    <div class="myexam_body">
        <table>
            <tr>
                <td class="myexam_options">
                    <div class="myexam_wrap">
    <div style="display:block" ref="1">
            <div class='type_1' onclick='showsubmenu($(this))'>单选题（20）</div>
            <div class='numberlist'>
                <ul>
                        <li class='nomakebg'>1</li>
                        <li class='nomakebg'>2</li>
                        <li class='nomakebg'>3</li>
                        <li class='nomakebg'>4</li>
                        <li class='nomakebg'>5</li>
                        <li class='nomakebg'>6</li>
                        <li class='nomakebg'>7</li>
                        <li class='nomakebg'>8</li>
                        <li class='nomakebg'>9</li>
                        <li class='nomakebg'>10</li>
                        <li class='nomakebg'>11</li>
                        <li class='nomakebg'>12</li>
                        <li class='nomakebg'>13</li>
                        <li class='nomakebg'>14</li>
                        <li class='nomakebg'>15</li>
                        <li class='nomakebg'>16</li>
                        <li class='nomakebg'>17</li>
                        <li class='nomakebg'>18</li>
                        <li class='nomakebg'>19</li>
                        <li class='nomakebg'>20</li>
                </ul>
            </div>
                    <div class='type_1' onclick='showsubmenu($(this))'>多选题（20）</div>
            <div class='numberlist'>
                <ul>
                        <li class='nomakebg'>21</li>
                        <li class='nomakebg'>22</li>
                        <li class='nomakebg'>23</li>
                        <li class='nomakebg'>24</li>
                        <li class='nomakebg'>25</li>
                        <li class='nomakebg'>26</li>
                        <li class='nomakebg'>27</li>
                        <li class='nomakebg'>28</li>
                        <li class='nomakebg'>29</li>
                        <li class='nomakebg'>30</li>
                        <li class='nomakebg'>31</li>
                        <li class='nomakebg'>32</li>
                        <li class='nomakebg'>33</li>
                        <li class='nomakebg'>34</li>
                        <li class='nomakebg'>35</li>
                        <li class='nomakebg'>36</li>
                        <li class='nomakebg'>37</li>
                        <li class='nomakebg'>38</li>
                        <li class='nomakebg'>39</li>
                        <li class='nomakebg'>40</li>
                </ul>
            </div>
                    <div class='type_1' onclick='showsubmenu($(this))'>判断题（20）</div>
            <div class='numberlist'>
                <ul>
                        <li class='nomakebg'>41</li>
                        <li class='nomakebg'>42</li>
                        <li class='nomakebg'>43</li>
                        <li class='nomakebg'>44</li>
                        <li class='nomakebg'>45</li>
                        <li class='nomakebg'>46</li>
                        <li class='nomakebg'>47</li>
                        <li class='nomakebg'>48</li>
                        <li class='nomakebg'>49</li>
                        <li class='nomakebg'>50</li>
                        <li class='nomakebg'>51</li>
                        <li class='nomakebg'>52</li>
                        <li class='nomakebg'>53</li>
                        <li class='nomakebg'>54</li>
                        <li class='nomakebg'>55</li>
                        <li class='nomakebg'>56</li>
                        <li class='nomakebg'>57</li>
                        <li class='nomakebg'>58</li>
                        <li class='nomakebg'>59</li>
                        <li class='nomakebg'>60</li>
                </ul>
            </div>                    <div class='type_1' onclick='showsubmenu($(this))'>大题（2）</div>
            <div class='numberlist'>
                <ul>
                        <li class='nomakebg'>61</li>
                        <li class='nomakebg'>62</li>
                </ul>
            </div>    </div>

                        <div id="submitpaper" onclick="submitpaper()"></div>

                    </div>

                </td>
                <td class="myexam_main">
                         <div style="display:block;" ref="1" class="temp">
    <div class= 'divr'  style="display:block" ref="1|1">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />1、关于《会计法》的表述，不正确的是(     )<br />
            <br />
            A、《会计法》是会计工作的最高准则
            <br />
            B、《会计法》是会计法律制度中层次最高的法律规范
            <br />
            C、《会计法》是制定其他会计法规的依据
            <br />
            D、《会计法》是国家宪法
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>1</text>' value='A' type='radio' />
                B<input name='danx<text>1</text>' value='B' type='radio' />
                C<input name='danx<text>1</text>' value='C' type='radio' />
                D<input name='danx<text>1</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|2">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />2、下列各项中，属于我国会计工作管理体制实行的原则是(     )<br />
            <br />
            A、统一规划，分级管理
            <br />
            B、统一规划，集中管理
            <br />
            C、统一领导，分级管理
            <br />
            D、统一领导，条块管理
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>2</text>' value='A' type='radio' />
                B<input name='danx<text>2</text>' value='B' type='radio' />
                C<input name='danx<text>2</text>' value='C' type='radio' />
                D<input name='danx<text>2</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|3">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />3、下列各项中，不属于我国会计法律制度对会计核算统一规定的内容的是(     )<br />
            <br />
            A、填制会计凭证
            <br />
            B、记账本位币
            <br />
            C、编制审计报告
            <br />
            D、会计年度
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>3</text>' value='A' type='radio' />
                B<input name='danx<text>3</text>' value='B' type='radio' />
                C<input name='danx<text>3</text>' value='C' type='radio' />
                D<input name='danx<text>3</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|4">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />4、下列各项中，无权组织实施本行政区域内的会计师事务所执业质量检查的国家行政机关是(     )<br />
            <br />
            A、省级人民政府财政部门
            <br />
            B、自治区人民政府财政部门
            <br />
            C、直辖市人民政府财政部门
            <br />
            D、县级人民政府财政部门
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>4</text>' value='A' type='radio' />
                B<input name='danx<text>4</text>' value='B' type='radio' />
                C<input name='danx<text>4</text>' value='C' type='radio' />
                D<input name='danx<text>4</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|5">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />5、会计工作移交之后，接替人员正确的做法是(     )<br />
            <br />
            A、自行设立新账
            <br />
            B、继续使用移交前的会计账簿
            <br />
            C、分类账继续使用，日记账重新设立
            <br />
            D、总账继续使用，明细账重新设立
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>5</text>' value='A' type='radio' />
                B<input name='danx<text>5</text>' value='B' type='radio' />
                C<input name='danx<text>5</text>' value='C' type='radio' />
                D<input name='danx<text>5</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|6">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />6、根据《中华人民共和国会计法》的规定，会计人员变造会计凭证和会计账簿，尚不构成犯罪的，应承担的法律责任是(     )<br />
            <br />
            A、处以3 000元以上1万元以下的罚款，并吊销其会计从业资格证书
            <br />
            B、处以3 000元以上5万元以下的罚款，并吊销其会计从业资格证书
            <br />
            C、予以警告，并处以3 000元以上10万元以下的罚款
            <br />
            D、予以警告，并处以5 000元以上10万元以下的罚款
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>6</text>' value='A' type='radio' />
                B<input name='danx<text>6</text>' value='B' type='radio' />
                C<input name='danx<text>6</text>' value='C' type='radio' />
                D<input name='danx<text>6</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|7">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />7、开户银行根据开户单位日常零星开支所需现金核定其库存现金的最高限额的天数是(     )<br />
            <br />
            A、1-3天
            <br />
            B、15天
            <br />
            C、3-5天
            <br />
            D、5天
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>7</text>' value='A' type='radio' />
                B<input name='danx<text>7</text>' value='B' type='radio' />
                C<input name='danx<text>7</text>' value='C' type='radio' />
                D<input name='danx<text>7</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|8">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />8、(     )是指无权更改票据内容的人对票据上签章以外的记载事项加以改变的行为<br />
            <br />
            A、变造
            <br />
            B、伪造
            <br />
            C、销毁
            <br />
            D、隐匿
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>8</text>' value='A' type='radio' />
                B<input name='danx<text>8</text>' value='B' type='radio' />
                C<input name='danx<text>8</text>' value='C' type='radio' />
                D<input name='danx<text>8</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|9">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />9、存款人办理日常转账结算和现金收付的银行结算账户是(     )<br />
            <br />
            A、专用存款账户
            <br />
            B、临时存款账户
            <br />
            C、一般存款账户
            <br />
            D、基本存款账户
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>9</text>' value='A' type='radio' />
                B<input name='danx<text>9</text>' value='B' type='radio' />
                C<input name='danx<text>9</text>' value='C' type='radio' />
                D<input name='danx<text>9</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|10">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />10、下列各项中，属于票据非基本人的是(     )<br />
            <br />
            A、出票人
            <br />
            B、付款人
            <br />
            C、收款人
            <br />
            D、背书人
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>10</text>' value='A' type='radio' />
                B<input name='danx<text>10</text>' value='B' type='radio' />
                C<input name='danx<text>10</text>' value='C' type='radio' />
                D<input name='danx<text>10</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|11">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />11、根据《支付结算办法》的规定，同一持卡人单笔透支发生额，单位卡的限额是(     )<br />
            <br />
            A、不得超过1万元
            <br />
            B、不得超过5万元
            <br />
            C、不得超过10万元
            <br />
            D、不得超过20万元
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>11</text>' value='A' type='radio' />
                B<input name='danx<text>11</text>' value='B' type='radio' />
                C<input name='danx<text>11</text>' value='C' type='radio' />
                D<input name='danx<text>11</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|12">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />12、下列税种中采用超率累进税率方式征收的是(     )<br />
            <br />
            A、增值税
            <br />
            B、城镇土地使用税
            <br />
            C、个人所得税
            <br />
            D、土地增值税
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>12</text>' value='A' type='radio' />
                B<input name='danx<text>12</text>' value='B' type='radio' />
                C<input name='danx<text>12</text>' value='C' type='radio' />
                D<input name='danx<text>12</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|13">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />13、我国消费税税率形式不包括(     )<br />
            <br />
            A、不定额税率
            <br />
            B、定额税率
            <br />
            C、比例税率
            <br />
            D、复合税率
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>13</text>' value='A' type='radio' />
                B<input name='danx<text>13</text>' value='B' type='radio' />
                C<input name='danx<text>13</text>' value='C' type='radio' />
                D<input name='danx<text>13</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|14">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />14、下列各项中，不符合有关增值税纳税地点规定的是(     )<br />
            <br />
            A、进口货物，应当由进口人或其代理人向报关地海关申报纳税
            <br />
            B、非固定业户销售货物或者提供应税劳务，应当向销售地或劳务发生地主管税务机关申报纳税
            <br />
            C、非固定业户销售货物的，向其机构所在地缴纳税款
            <br />
            D、固定业户到外县(市)销售货物未向销售地主管税务机关申报纳税的，由其机构所在地主管税务机关补征税款
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>14</text>' value='A' type='radio' />
                B<input name='danx<text>14</text>' value='B' type='radio' />
                C<input name='danx<text>14</text>' value='C' type='radio' />
                D<input name='danx<text>14</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|15">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />15、不属于纳税申报的方式包括(     )<br />
            <br />
            A、直接申报
            <br />
            B、邮寄申报
            <br />
            C、数据电文申报
            <br />
            D、口头申报
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>15</text>' value='A' type='radio' />
                B<input name='danx<text>15</text>' value='B' type='radio' />
                C<input name='danx<text>15</text>' value='C' type='radio' />
                D<input name='danx<text>15</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|16">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />16、根据《预算法》的规定，下列各项中，负责具体组织地方各级总预算执行的是(     )<br />
            <br />
            A、本级人民代表大会
            <br />
            B、本级人民代表大会常务委员会
            <br />
            C、本级政府财政部门
            <br />
            D、本级政府审计部门
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>16</text>' value='A' type='radio' />
                B<input name='danx<text>16</text>' value='B' type='radio' />
                C<input name='danx<text>16</text>' value='C' type='radio' />
                D<input name='danx<text>16</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|17">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />17、下列各项中，不属于政府采购中供应商权利的是(     )<br />
            <br />
            A、排斥其他供应商参与竞争的权利
            <br />
            B、平等地获得政府采购信息的权利
            <br />
            C、要求采购人保守其商业秘密的权利
            <br />
            D、平等地取得政府采购供应商资格的权利
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>17</text>' value='A' type='radio' />
                B<input name='danx<text>17</text>' value='B' type='radio' />
                C<input name='danx<text>17</text>' value='C' type='radio' />
                D<input name='danx<text>17</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|18">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />18、下列各项中，属于财政支出支付方式的是(     )<br />
            <br />
            A、分批支付
            <br />
            B、授权支付
            <br />
            C、间接支付
            <br />
            D、按期支付
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>18</text>' value='A' type='radio' />
                B<input name='danx<text>18</text>' value='B' type='radio' />
                C<input name='danx<text>18</text>' value='C' type='radio' />
                D<input name='danx<text>18</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|19">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />19、下列不属于强化服务要求的是(     )<br />
            <br />
            A、树立服务要求意识
            <br />
            B、提高服务质量
            <br />
            C、维护会计职业良好的社会形象
            <br />
            D、提高会计技能的意识和愿望
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>19</text>' value='A' type='radio' />
                B<input name='danx<text>19</text>' value='B' type='radio' />
                C<input name='danx<text>19</text>' value='C' type='radio' />
                D<input name='danx<text>19</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr'  style="display:none" ref="1|20">
        <div class='divrcon'>
            <div class='divrtit'>一、单项选择题(本类题共20小题，每小题1分，共20分。每小题备选答案中，只有一个符合题意的正确答案，多选、错选、不选均不得分。)</div>
            <br />20、下列不属于会计职业道德教育的主要内容是(     )<br />
            <br />
            A、职业道德观念教育
            <br />
            B、职业道德规范教育
            <br />
            C、职业道德警示教育
            <br />
            D、职业道德学历教育
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='danx<text>20</text>' value='A' type='radio' />
                B<input name='danx<text>20</text>' value='B' type='radio' />
                C<input name='danx<text>20</text>' value='C' type='radio' />
                D<input name='danx<text>20</text>' value='D' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|21">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />21、根据规定，签发汇兑凭证必须记载的事项有(     )<br />
            <br />
            A、无条件支付的委托<br />
            B、付款人名称<br />
            C、委托日期<br />
            D、汇款人签章<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>21</text>' value='A' type='checkbox' />
                B<input name='duox<text>21</text>' value='B' type='checkbox' />
                C<input name='duox<text>21</text>' value='C' type='checkbox' />
                D<input name='duox<text>21</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|22">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />22、我国目前会计工作的自律管理组织有(     )<br />
            <br />
            A、中国注册会计师协会<br />
            B、中国会计学会<br />
            C、中国总会计师协会<br />
            D、中国会计教育学会<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>22</text>' value='A' type='checkbox' />
                B<input name='duox<text>22</text>' value='B' type='checkbox' />
                C<input name='duox<text>22</text>' value='C' type='checkbox' />
                D<input name='duox<text>22</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|23">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />23、下列各项中，属于在《会计档案管理办法》中进行了具体规定的有(     )<br />
            <br />
            A、会计档案的归档<br />
            B、会计档案的保管期限<br />
            C、会计档案的查阅与复制<br />
            D、会计档案的销毁<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>23</text>' value='A' type='checkbox' />
                B<input name='duox<text>23</text>' value='B' type='checkbox' />
                C<input name='duox<text>23</text>' value='C' type='checkbox' />
                D<input name='duox<text>23</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|24">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />24、按照《会计法》的规定，单位负责人在内部会计监督中的职责是(     )<br />
            <br />
            A、单位负责人应当保证会计机构、会计人员依法履行职责<br />
            B、单位负责人不得授意、指使、强令会计机构、会计人员违法办理会计事项<br />
            C、单位负责人授意、指使、强令会计机构、会计人员违法办理会计事项的，应当承担责任<br />
            D、单位负责人应对本单位会计机构、会计人员进行监督<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>24</text>' value='A' type='checkbox' />
                B<input name='duox<text>24</text>' value='B' type='checkbox' />
                C<input name='duox<text>24</text>' value='C' type='checkbox' />
                D<input name='duox<text>24</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|25">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />25、一般会计人员办理交接手续，由单位的(     )负责监交；会计机构负责人办理交接手续，由单位负责人负责监交，必要时可由上级主管部门派人会同监交<br />
            <br />
            A、单位负责人<br />
            B、人事部门负责人<br />
            C、会计机构负责人<br />
            D、会计主管人员<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>25</text>' value='A' type='checkbox' />
                B<input name='duox<text>25</text>' value='B' type='checkbox' />
                C<input name='duox<text>25</text>' value='C' type='checkbox' />
                D<input name='duox<text>25</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|26">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />26、行政处罚是指特定主体依法定职权和程序对违反行政法规尚未构成犯罪的行政管理相对人给予行政制裁的具体行政行为，其中这里的特定主体有(     )<br />
            <br />
            A、行政机关工作人员<br />
            B、其他行政主体中的工作人员<br />
            C、行政机关<br />
            D、行政机关以外的其他行政主体<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>26</text>' value='A' type='checkbox' />
                B<input name='duox<text>26</text>' value='B' type='checkbox' />
                C<input name='duox<text>26</text>' value='C' type='checkbox' />
                D<input name='duox<text>26</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|27">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />27、下列各项中，属于会计人员形成良好会计职业道德品行的会计继续教育内容的有(     )<br />
            <br />
            A、职业荣誉教育<br />
            B、职业权利教育<br />
            C、职业道德信念教育<br />
            D、职业义务教育<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>27</text>' value='A' type='checkbox' />
                B<input name='duox<text>27</text>' value='B' type='checkbox' />
                C<input name='duox<text>27</text>' value='C' type='checkbox' />
                D<input name='duox<text>27</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|28">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />28、下列各项中，可作为支付结算和资金清算主体的是(     )<br />
            <br />
            A、个人<br />
            B、农村信用合作社<br />
            C、银行<br />
            D、个体工商户<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>28</text>' value='A' type='checkbox' />
                B<input name='duox<text>28</text>' value='B' type='checkbox' />
                C<input name='duox<text>28</text>' value='C' type='checkbox' />
                D<input name='duox<text>28</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|29">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />29、下列各项中，关于各类银行存款账户的特点说法正确的是(     )<br />
            <br />
            A、基本存款账户用于办理日常转账结算和库存现金收付<br />
            B、一般存款账户用于办理借款转存、借款归还和其他结算的资金收付<br />
            C、专用存款账户用于对特定用途资金进行专项管理<br />
            D、临时存款账户用于临时机构及企业临时经营活动发生的资金收付<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>29</text>' value='A' type='checkbox' />
                B<input name='duox<text>29</text>' value='B' type='checkbox' />
                C<input name='duox<text>29</text>' value='C' type='checkbox' />
                D<input name='duox<text>29</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|30">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />30、下列各项中，属于我国《票据法》中规定的按照支付票款的方式划分的支票种类有(     )<br />
            <br />
            A、现金支票<br />
            B、转账支票<br />
            C、普通支票<br />
            D、划线支票<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>30</text>' value='A' type='checkbox' />
                B<input name='duox<text>30</text>' value='B' type='checkbox' />
                C<input name='duox<text>30</text>' value='C' type='checkbox' />
                D<input name='duox<text>30</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|31">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />31、《票据法》规定汇票上未记载付款地的，下列各项中可作为付款地的是(     )<br />
            <br />
            A、付款人的营业场所<br />
            B、付款人的住所<br />
            C、付款人的经常居住地<br />
            D、收款人的住所<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>31</text>' value='A' type='checkbox' />
                B<input name='duox<text>31</text>' value='B' type='checkbox' />
                C<input name='duox<text>31</text>' value='C' type='checkbox' />
                D<input name='duox<text>31</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|32">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />32、下列各项中，属于税收特征的有(     )<br />
            <br />
            A、强制性<br />
            B、固定性<br />
            C、分配性<br />
            D、无偿性<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>32</text>' value='A' type='checkbox' />
                B<input name='duox<text>32</text>' value='B' type='checkbox' />
                C<input name='duox<text>32</text>' value='C' type='checkbox' />
                D<input name='duox<text>32</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|33">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />33、个人所得税的纳税义务人可划分为居民纳税义务人和非居民纳税义务人，其划分依据有(     )<br />
            <br />
            A、境内有无住所<br />
            B、境内工作时间<br />
            C、取得收入的工作地<br />
            D、境内居住时间<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>33</text>' value='A' type='checkbox' />
                B<input name='duox<text>33</text>' value='B' type='checkbox' />
                C<input name='duox<text>33</text>' value='C' type='checkbox' />
                D<input name='duox<text>33</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|34">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />34、根据个人所得税法律制度的规定，可以将个人所得税的纳税义务人区分为居民纳税义务人和非居民纳税义务人，依据的标准有(     )<br />
            <br />
            A、境内有无住所<br />
            B、境内工作时间<br />
            C、取得收入的工作地<br />
            D、境内居住时间<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>34</text>' value='A' type='checkbox' />
                B<input name='duox<text>34</text>' value='B' type='checkbox' />
                C<input name='duox<text>34</text>' value='C' type='checkbox' />
                D<input name='duox<text>34</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|35">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />35、增值税一般纳税人如果存在虚开增值税专用发票行为经税务机关责令改正而仍未改正的情形，在增值税专用发票的管理上不正确的作法有(     )<br />
            <br />
            A、纳税人可向其他一般纳税人借入专用发票使用<br />
            B、纳税人不得领购增值税专用发票<br />
            C、纳税人如已领购使用专用发票，其结存的专用发票可继续使用<br />
            D、纳税人如已领使用专用发票，税务机关应收缴其结存的专用发票<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>35</text>' value='A' type='checkbox' />
                B<input name='duox<text>35</text>' value='B' type='checkbox' />
                C<input name='duox<text>35</text>' value='C' type='checkbox' />
                D<input name='duox<text>35</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|36">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />36、下列各项中，属于《预算法》规定的地方预算收入的有(     )<br />
            <br />
            A、地方本级收入<br />
            B、地方和中央共享收入中按照一定标准或者比例划归中央预算的收入<br />
            C、中央按照规定返还地方的收入<br />
            D、中央按照规定补助地方的收入<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>36</text>' value='A' type='checkbox' />
                B<input name='duox<text>36</text>' value='B' type='checkbox' />
                C<input name='duox<text>36</text>' value='C' type='checkbox' />
                D<input name='duox<text>36</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|37">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />37、下列各项中，属于政府采购对象范围的有(     )<br />
            <br />
            A、物业管理<br />
            B、成品软件<br />
            C、车辆保险<br />
            D、水利工程<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>37</text>' value='A' type='checkbox' />
                B<input name='duox<text>37</text>' value='B' type='checkbox' />
                C<input name='duox<text>37</text>' value='C' type='checkbox' />
                D<input name='duox<text>37</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|38">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />38、下列关于国库单一账户的表述中，正确的有(     )<br />
            <br />
            A、用于记录、核算和反映纳入预算管理的财政收入和财政支出活动<br />
            B、用于与财政部门零余额账户进行清算<br />
            C、用于与预算单位零余额账户进行清算<br />
            D、用于预算单位办理转账、提取现金等结算业务<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>38</text>' value='A' type='checkbox' />
                B<input name='duox<text>38</text>' value='B' type='checkbox' />
                C<input name='duox<text>38</text>' value='C' type='checkbox' />
                D<input name='duox<text>38</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|39">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />39、某企业会计人员在讨论会计职业道德和会计法律制度两者的关系时提出的下列观点中正确的有(     )<br />
            <br />
            A、两者在实施过程中相互补充、相互协调<br />
            B、会计法律制度是会计职业道德的最低要求<br />
            C、违反会计法律制度一定违反会计职业道德<br />
            D、违反会计职业道德也一定违反会计法律制度<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>39</text>' value='A' type='checkbox' />
                B<input name='duox<text>39</text>' value='B' type='checkbox' />
                C<input name='duox<text>39</text>' value='C' type='checkbox' />
                D<input name='duox<text>39</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="2|40">
        <div class='divrcon'>
            <div class='divrtit'>二、多项选择题(本类题共20小题，每小题2分，共40分。每小题备选答案中，有两个或两个以上符合题意的正确答案，多选、少选、错选、不选均不得分。)</div>
            <br />40、某公交公司因经营管理不善而长年亏损，新上任的财务部经理刘某抓住公司经营管理中的薄弱环节，以强化成本核算和管理为突破口，将成本逐层分解至每一辆车辆及其司乘人员，并创建了成本监控中心，不仅使每日、每车的运营收支情况一目了然，而且对异常成本变动能立即采取应对措施。有效的成本管理为公司领导作出扩大购车规模、增加营运能力的决策提供了科学依据，经过努力，公司营业收入在3年内翻了两番，彻底扭转了亏损局面。从会计职业道德角度分析，下列表述中，正确的有(     )<br />
            <br />
            A、刘某的行为体现了参与管理会计职业道德的要求<br />
            B、刘某的行为体现了客观公正会计职业道德的要求<br />
            C、刘某的行为体现了诚实守信会计职业道德的要求<br />
            D、刘某的行为体现了强化服务会计职业道德的要求<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                A<input name='duox<text>40</text>' value='A' type='checkbox' />
                B<input name='duox<text>40</text>' value='B' type='checkbox' />
                C<input name='duox<text>40</text>' value='C' type='checkbox' />
                D<input name='duox<text>40</text>' value='D' type='checkbox' />
                <br />
                <br />
                <img alt="" src='/Images/exam/diyiti.jpg' width='92' height='29'/>
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/zuimoti.jpg')}} width='92' height='29' />
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|41">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />41、我国《会计法》是会计法律制度中层次最高的法律规范，是指导会计工作的最高准则<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>41</text>' value='1' type='radio' />
                错误<input name='pand<text>41</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|42">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />42、国务院主管全国的会计工作<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>42</text>' value='1' type='radio' />
                错误<input name='pand<text>42</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|43">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />43、会计资料的内容和要求必须符合会计制度规定<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>43</text>' value='1' type='radio' />
                错误<input name='pand<text>43</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|44">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />44、内部审计是内部控制的一个组成部分，是单位内部会计机构、会计人员对会计资料进行的监督<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>44</text>' value='1' type='radio' />
                错误<input name='pand<text>44</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|45">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />45、参加考试并达到国家合格标准的人员，由全国会计专业技术资格考试办公室核发高级会计师资格考试成绩合格证，该证在全国范围内3年有效<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>45</text>' value='1' type='radio' />
                错误<input name='pand<text>45</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|46">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />46、授意、指使、强令会计机构、会计人员及其他人员伪造、变造会计凭证、会计账簿，编制虚假财务会计报告或隐匿、故意销毁依法应保存的会计凭证、会计账簿、财务会计报告，尚不构成犯罪的，可以处5000元以上5万元以下的罚款；属于国家工作人员的，还应当由其所在单位或者有关单位依法给予降级、撤职、开除的行政处分<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>46</text>' value='1' type='radio' />
                错误<input name='pand<text>46</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|47">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />47、票据上有伪造、变造的签章的，不影响票据上其他当事人真实签章的效力<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>47</text>' value='1' type='radio' />
                错误<input name='pand<text>47</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|48">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />48、收入汇缴账户除向其基本存款账户或预算外资金财政专用存款账户划缴款项外，只收不付，不得支取现金。业务支出账户除从其基本存款账户拨入款项外。只付不收，其现金支取必须按照国家现金管理的规定办理<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>48</text>' value='1' type='radio' />
                错误<input name='pand<text>48</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|49">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />49、出票人是指以法定方式签发票据并将票据交付给收款人的人<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>49</text>' value='1' type='radio' />
                错误<input name='pand<text>49</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|50">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />50、汇兑结算适用于同城和异地任何款项的结算<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>50</text>' value='1' type='radio' />
                错误<input name='pand<text>50</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|51">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />51、从量税是以征税对象的数量、重量、体积等作为计税依据，其课税数额与征税对象数量相关而与价格无关<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>51</text>' value='1' type='radio' />
                错误<input name='pand<text>51</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|52">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />52、金银首饰、钻石的消费税在零售环节纳税<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>52</text>' value='1' type='radio' />
                错误<input name='pand<text>52</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|53">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />53、《企业所得税法》所称的居民企业，是指依法在中国境内成立，或者依照外国(地区)法律成立且实际管理机构不在中国境内，但在中国境内设立机构、场所的企业<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>53</text>' value='1' type='radio' />
                错误<input name='pand<text>53</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|54">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />54、税务代理机构隶属于税务机关<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>54</text>' value='1' type='radio' />
                错误<input name='pand<text>54</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|55">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />55、根据《预算法实施条例》的有关规定，年度预算确定后，企事业单位改变隶属关系引起预算级次和关系变化的，应当在改变财务关系的同时，相应办理预算划转<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>55</text>' value='1' type='radio' />
                错误<input name='pand<text>55</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|56">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />56、公立医院属于政府采购主体的范围<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>56</text>' value='1' type='radio' />
                错误<input name='pand<text>56</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|57">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />57、国库集中收付方式下，财政性资金的清算活动在国库单一账户体系之外运行<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>57</text>' value='1' type='radio' />
                错误<input name='pand<text>57</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|58">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />58、会计职业道德其表现方法既有明确的成文规定，也有不成文的规范，它存在于人们的意识和信念之中<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>58</text>' value='1' type='radio' />
                错误<input name='pand<text>58</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|59">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />59、在会计工作中一定要提供上乘的服务质量，不管服务主体提出什么样的要求，会计人员都要尽量满足服务主体的需要<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>59</text>' value='1' type='radio' />
                错误<input name='pand<text>59</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="3|60">
        <div class='divrcon'>
            <div class='divrtit'>三、判断题(本类题共20小题，每小题1分，共20分。请判断每小题的表述是否正确，每小题答题正确的得一分，答题错误的或者不答题的均不得分。)</div>
            <br />60、会计职业道德教育主要包括职业道德观念教育、职业道德规范教育和职业道德警示教育<br />
            <br />
            <div class='divrda'>
                <span class='xzda'>选择答案：</span>
                正确<input name='pand<text>60</text>' value='1' type='radio' />
                错误<input name='pand<text>60</text>' value='0' type='radio' />
                <br />
                <br />
                <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
                <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
                <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
            </div>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="4|61">
        <div class='divrcon'>
            <div class='divrtit'>四、分析题(本类题共2大题，10小题，每小题2分，共20分)</div>
            <br />61、<span style="font-family:'Times New Roman';font-size:10.5pt;">A</span><span style="font-family:宋体;font-size:10.5pt;">公司因向</span><span style="font-family:'Times New Roman';font-size:10.5pt;">B</span><span style="font-family:宋体;font-size:10.5pt;">公司购买一批产品，签发一张金额为</span><span style="font-family:'Times New Roman';font-size:10.5pt;">10</span><span style="font-family:宋体;font-size:10.5pt;">万元的支票给</span><span style="font-family:'Times New Roman';font-size:10.5pt;">B</span><span style="font-family:宋体;font-size:10.5pt;">公司，</span><span style="font-family:'Times New Roman';font-size:10.5pt;">B</span><span style="font-family:宋体;font-size:10.5pt;">公司为支付工程价款又将该支票背书转让给</span><span style="font-family:'Times New Roman';font-size:10.5pt;">C</span><span style="font-family:宋体;font-size:10.5pt;">公司，</span><span style="font-family:'Times New Roman';font-size:10.5pt;">C</span><span style="font-family:宋体;font-size:10.5pt;">公司接受后，不慎将支票遗失，该支票被</span><span style="font-family:'Times New Roman';font-size:10.5pt;">D</span><span style="font-family:宋体;font-size:10.5pt;">公司拾获，</span><span style="font-family:'Times New Roman';font-size:10.5pt;">D</span><span style="font-family:宋体;font-size:10.5pt;">公司便伪造了</span><span style="font-family:'Times New Roman';font-size:10.5pt;">C</span><span style="font-family:宋体;font-size:10.5pt;">公司的签章，并将支票转让给不知情的</span><span style="font-family:'Times New Roman';font-size:10.5pt;">E</span><span style="font-family:宋体;font-size:10.5pt;">公司，</span><span style="font-family:'Times New Roman';font-size:10.5pt;">E</span><span style="font-family:宋体;font-size:10.5pt;">公司又将该支票的金额改为</span><span style="font-family:'Times New Roman';font-size:10.5pt;">18</span><span style="font-family:宋体;font-size:10.5pt;">万元转让给</span><span style="font-family:'Times New Roman';font-size:10.5pt;">F</span><span style="font-family:宋体;font-size:10.5pt;">公司，</span><span style="font-family:'Times New Roman';font-size:10.5pt;">F</span><span style="font-family:宋体;font-size:10.5pt;">公司则背书转让给</span><span style="font-family:'Times New Roman';font-size:10.5pt;">G</span><span style="font-family:宋体;font-size:10.5pt;">公司。</span>
            <div class='divswl'>

                    <br />
                    第<text>1</text>道、F公司需要承担(     )万元的票据责任 <br/><br/>
                    A、5 <br/>
                    B、9 <br/>
                    C、10 <br/>
                    D、18<br/>
                    <br />
                    <div class="divrdaa">
                        <span class="xzda">选择答案：</span>
                        A<input name="fenx_1" value="A" type="checkbox" />
                        B<input name="fenx_1" value="B" type="checkbox" />
                        C<input name="fenx_1" value="C" type="checkbox" />
                        D<input name="fenx_1" value="D" type="checkbox" />
                        <br />
                    </div>
                    <br />
                    第<text>2</text>道、根据以上材料，不需要承担票据责任的公司是(     ) <br/><br/>
                    A、A公司 <br/>
                    B、C公司 <br/>
                    C、D公司 <br/>
                    D、G公司<br/>
                    <br />
                    <div class="divrdaa">
                        <span class="xzda">选择答案：</span>
                        A<input name="fenx_2" value="A" type="checkbox" />
                        B<input name="fenx_2" value="B" type="checkbox" />
                        C<input name="fenx_2" value="C" type="checkbox" />
                        D<input name="fenx_2" value="D" type="checkbox" />
                        <br />
                    </div>
                    <br />
                    第<text>3</text>道、如果G公司要求F公司承担票据责任，则下列F公司的处理错误的是(     ) <br/><br/>
                    A、应先向G公司支付9万元，然后再向E公司要求支付9万元 <br/>
                    B、应先向G公司支付18万元，然后再向E公司要求支付18万元 <br/>
                    C、应先向G公司支付9万元，然后再向E公司要求支付8万元 <br/>
                    D、应先向G公司支付9万元，然后再向E公司要求支付18万元<br/>
                    <br />
                    <div class="divrdaa">
                        <span class="xzda">选择答案：</span>
                        A<input name="fenx_3" value="A" type="checkbox" />
                        B<input name="fenx_3" value="B" type="checkbox" />
                        C<input name="fenx_3" value="C" type="checkbox" />
                        D<input name="fenx_3" value="D" type="checkbox" />
                        <br />
                    </div>
                    <br />
                    第<text>4</text>道、B公司需要承担(     )万元的票据责任 <br/><br/>
                    A、5 <br/>
                    B、9 <br/>
                    C、10 <br/>
                    D、18<br/>
                    <br />
                    <div class="divrdaa">
                        <span class="xzda">选择答案：</span>
                        A<input name="fenx_4" value="A" type="checkbox" />
                        B<input name="fenx_4" value="B" type="checkbox" />
                        C<input name="fenx_4" value="C" type="checkbox" />
                        D<input name="fenx_4" value="D" type="checkbox" />
                        <br />
                    </div>
                    <br />
                    第<text>5</text>道、如果G公司要求E公司承担票据责任，则E公司应向G公司支付(     )万元 <br/><br/>
                    A、5 <br/>
                    B、9 <br/>
                    C、10 <br/>
                    D、18<br/>
                    <br />
                    <div class="divrdaa">
                        <span class="xzda">选择答案：</span>
                        A<input name="fenx_5" value="A" type="checkbox" />
                        B<input name="fenx_5" value="B" type="checkbox" />
                        C<input name="fenx_5" value="C" type="checkbox" />
                        D<input name="fenx_5" value="D" type="checkbox" />
                        <br />
                    </div>
            </div>
            <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
            <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
            <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
            <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
        </div>
    </div>
    <div class= 'divr' style="display:none" ref="4|62">
        <div class='divrcon'>
            <div class='divrtit'>四、分析题(本类题共2大题，10小题，每小题2分，共20分)</div>
            <br />62、<span style="font-family:宋体;font-size:10.5pt;">甲向乙签发了一张</span><span style="font-family:'Times New Roman';font-size:10.5pt;">20</span><span style="font-family:宋体;font-size:10.5pt;">万元的支票，出票时间为</span><span style="font-family:'Times New Roman';font-size:10.5pt;">2010</span><span style="font-family:宋体;font-size:10.5pt;">年</span><span style="font-family:'Times New Roman';font-size:10.5pt;">4</span><span style="font-family:宋体;font-size:10.5pt;">月</span><span style="font-family:'Times New Roman';font-size:10.5pt;">1</span><span style="font-family:宋体;font-size:10.5pt;">日，乙于同年</span><span style="font-family:'Times New Roman';font-size:10.5pt;">4</span><span style="font-family:宋体;font-size:10.5pt;">月</span><span style="font-family:'Times New Roman';font-size:10.5pt;">5</span><span style="font-family:宋体;font-size:10.5pt;">日背书转让给丙。</span>
            <div class='divswl'>

                    <br />
                    第<text>1</text>道、下列属于签发支票必须要记载的事项的是(     ) <br/><br/>
                    A、无条件支付的委托 <br/>
                    B、确定的金额 <br/>
                    C、承兑的时间 <br/>
                    D、出票人签章<br/>
                    <br />
                    <div class="divrdaa">
                        <span class="xzda">选择答案：</span>
                        A<input name="fenx_1" value="A" type="checkbox" />
                        B<input name="fenx_1" value="B" type="checkbox" />
                        C<input name="fenx_1" value="C" type="checkbox" />
                        D<input name="fenx_1" value="D" type="checkbox" />
                        <br />
                    </div>
                    <br />
                    第<text>2</text>道、根据《票据法》的规定，持票人丙应当在(     )提示付款 <br/><br/>
                    A、5月1日前 <br/>
                    B、4月11日前 <br/>
                    C、6月1日前 <br/>
                    D、9月1日前<br/>
                    <br />
                    <div class="divrdaa">
                        <span class="xzda">选择答案：</span>
                        A<input name="fenx_2" value="A" type="checkbox" />
                        B<input name="fenx_2" value="B" type="checkbox" />
                        C<input name="fenx_2" value="C" type="checkbox" />
                        D<input name="fenx_2" value="D" type="checkbox" />
                        <br />
                    </div>
                    <br />
                    第<text>3</text>道、关于支票的付款，下列说法正确的是(     ) <br/><br/>
                    A、支票是见票即付的，因此支票不得另行记载付款日期 <br/>
                    B、另行记载付款日期的支票，记载无效 <br/>
                    C、持票人应当自出票日起1个月内向付款人提示付款 <br/>
                    D、超过提示付款期限的，出票人丧失对持票人承担付款的责任<br/>
                    <br />
                    <div class="divrdaa">
                        <span class="xzda">选择答案：</span>
                        A<input name="fenx_3" value="A" type="checkbox" />
                        B<input name="fenx_3" value="B" type="checkbox" />
                        C<input name="fenx_3" value="C" type="checkbox" />
                        D<input name="fenx_3" value="D" type="checkbox" />
                        <br />
                    </div>
                    <br />
                    第<text>4</text>道、如果丙在5月10日提示付款，下列说法正确的是(     ) <br/><br/>
                    A、已过提示付款期，付款人可拒绝付款，但持票人并未丧失票据权利 <br/>
                    B、持票人对支票出票人的权利，自出票日起6个月 <br/>
                    C、已过提示付款期，付款人可拒绝付款，同时持票人丧失票据权利 <br/>
                    D、持票人对支票出票人的权利，自出票日起3个月<br/>
                    <br />
                    <div class="divrdaa">
                        <span class="xzda">选择答案：</span>
                        A<input name="fenx_4" value="A" type="checkbox" />
                        B<input name="fenx_4" value="B" type="checkbox" />
                        C<input name="fenx_4" value="C" type="checkbox" />
                        D<input name="fenx_4" value="D" type="checkbox" />
                        <br />
                    </div>
                    <br />
                    第<text>5</text>道、下列关于支票的说法正确的是(     ) <br/><br/>
                    A、支票按照付款方式可以分为现金支票、转账支票、普通支票 <br/>
                    B、普通支票可以用于支取现金，但不能用于转账 <br/>
                    C、普通支票左上角划两条平行线的，为划线支票，只能用于支取现金，不能用于转账 <br/>
                    D、转账支票在支票上印明&quot;转账&quot;字样，专门用于转账，不能用于支取现金<br/>
                    <br />
                    <div class="divrdaa">
                        <span class="xzda">选择答案：</span>
                        A<input name="fenx_5" value="A" type="checkbox" />
                        B<input name="fenx_5" value="B" type="checkbox" />
                        C<input name="fenx_5" value="C" type="checkbox" />
                        D<input name="fenx_5" value="D" type="checkbox" />
                        <br />
                    </div>
            </div>
            <img alt="" src={{ url('./assets/img/exam/diyiti.jpg')}} width='92' height='29' />
            <img alt="" src={{ url('./assets/img/exam/shangyiti.jpg')}} width='92' height='29' />
            <img alt="" src={{ url('./assets/img/exam/xiayiti.jpg')}} width='92' height='29' />
            <img alt="" src='/Images/exam/zuimoti.jpg' width='92' height='29'/>
        </div>
    </div>
                                    </div>


                </td>
            </tr>
        </table>
    </div>





</body>
</html>
