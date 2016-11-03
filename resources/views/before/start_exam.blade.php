<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>2016会计无纸化考试题库系统</title>

    <link href="{{url("/assets/css/bootstrap.css")}}" rel="stylesheet">
    <link href="{{url("/assets/extendCss/exam/exam.css")}}" rel="stylesheet">
    <script src="{{url("/assets/js/bootstrapJquery.js")}}" ></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('select').on('change', function () {
                if ($(this).val() == null) {
                    alert('请选择考试科目');
                }
                $('#lianjie').attr("href", "/exam?kemu_id=" + $(this).val() + "&timestamp=0636462431");
            })
        });
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <body>

    <div class="myexam_login_bj">
        <img src="{{asset('/assets/img/exam/bj.jpg')}}" alt="" />
    </div>
    <div class="myexam_login_memo">
        <table>
            <tr>
                <td class="ar">准考证号：</td>
                <td>123456789123xxxxxx</td>
            </tr>
            <tr>
                <td class="ar">姓名：</td>
                <td>fjsy0003</td>
            </tr>
            <tr>
                <td class="ar">考试科目：</td>
                <td>
                    <div class="form-group">
                        <select  class="form-control">
                            <option value="">请选择考试内容</option>
                            <option value="1">财经法规与会计职业道德</option>
                            <option value="2">会计电算化</option>
                            <option value="3">会计基础</option>
                            <option value="0">三科联考</option>
                        </select>
                    </div>
            </tr>
            <tr>
                <td height="56" colspan="2" align="center" class="dlbut">
                    <a id="lianjie" href="/exam?kemu_id=1&amp;timestamp=0636462431">
                        <button class="btn btn-primary">&nbsp;&nbsp;确定&nbsp;&nbsp;</button>
                    </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/">
                        <button class="btn btn-primary">&nbsp;&nbsp;返回&nbsp;&nbsp;</button>
                    </a>
                </td>
            </tr>
        </table>
    </div>
</body>

  </body>

</html>
