<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="xxxxx">
    <meta name="author" content="xxxxx">
    <meta name="keyword" content="xxxxx">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>xxxxx</title>
    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('asset/css/bootstrap.min.css')}}">
    <!-- plugins -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('asset/css/plugins/font-awesome.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('asset/css/plugins/simple-line-icons.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('asset/css/plugins/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('asset/css/plugins/fullcalendar.min.css')}}"/>
    <link href="{{URL::asset('asset/css/style.css')}}" rel="stylesheet">
    <!-- end: Css -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{URL::asset('asset/js/html5shiv.min.js')}}"></script>
    <script src="{{URL::asset('asset/js/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body id="mimin" class="dashboard">
<!-- start: Header -->
<!-- end: Header -->

<!-- end: Left Menu -->

<!-- start: content -->
<div id="content">
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">个人信息</h3>
                <p class="animated fadeInDown"> 业务 <span class="fa-angle-right fa"></span> 个人信息 </p>
            </div>
        </div>
    </div>
    <div class="col-md-12 padding-0 form-element">
        <div class="col-md-12">
            <div class="panel form-element-padding">
                <div class="panel-heading">
                    <h4>个人信息</h4>
                </div>
                <div class="panel-body" style="padding-bottom:30px;">
                    <div class="form-group">
                        <label class="col-sm-1 control-label text-right">账号</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                        <label class="col-sm-1 control-label text-right">昵称</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                        <label class="col-sm-1 control-label text-right">密码</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                        <label class="col-sm-1 control-label text-right">身份证号</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label text-right">省份</label>
                        <div class="col-sm-2">
                            <select class="form-control">
                                <option>option one</option>
                                <option>option two</option>
                                <option>option three</option>
                                <option>option four</option>
                            </select>
                        </div>
                        <label class="col-sm-1 control-label text-right">城市</label>
                        <div class="col-sm-2">
                            <select class="form-control">
                                <option>option one</option>
                                <option>option two</option>
                                <option>option three</option>
                                <option>option four</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input class="submit btn btn-danger" type="submit" value="修改">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: content -->
<!-- start: Javascript -->
<script src="{{URL::asset('asset/js/jquery.min.js')}}"></script>
<script src="{{URL::asset('asset/js/jquery.ui.min.js')}}"></script>
<script src="{{URL::asset('asset/js/bootstrap.min.js')}}"></script>
<!-- plugins -->
<script src="{{URL::asset('asset/js/plugins/jquery.nicescroll.js')}}"></script>
<!-- custom -->
{{--<script src="{{URL::asset('asset/js/main.js')}}"></script>--}}
<!-- end: Javascript -->
<script>
    $("#left-menu-2").click() ;
</script>
</body>
</html>