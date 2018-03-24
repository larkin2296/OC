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
                <h3 class="animated fadeInLeft">直冲充值</h3>
                <p class="animated fadeInDown"> 业务 <span class="fa-angle-right fa"></span> 直冲充值 </p>
            </div>
        </div>
    </div>
    <div class="col-md-12 padding-0 form-element">
        <div class="col-md-12">
            <div class="panel form-element-padding">
                <div class="panel-heading">
                    <h4>生成订单</h4>
                </div>
                <div class="panel-body" style="padding-bottom:30px;">
                    <div class="form-group">
                        <label class="col-sm-1 control-label text-right">采购方式</label>
                        <div class="col-sm-2">
                            <select class="form-control">
                                <option>长期</option>
                                <option>临时</option>
                            </select>
                        </div>
                        <label class="col-sm-1 control-label text-right">折扣</label>
                        <div class="col-sm-2">
                            <select class="form-control">
                                <option>option one</option>
                                <option>option two</option>
                            </select>
                        </div>
                        <label class="col-sm-1 control-label text-right">截止时间</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label text-right">采购数量</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                        <label class="col-sm-1 control-label text-right">选择油卡</label>
                        <div class="col-sm-2">
                            <select class="form-control">
                                <option>option one</option>
                                <option>option two</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input class="submit btn btn-danger" type="submit" value="添加订单">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h3>购物车</h3>
                </div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <div id="datatables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered dataTable no-footer" width="100%" cellspacing="0"  style="width: 100%;">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc"style="width: 60px;"></th>
                                            <th class="sorting" style="width: 60px;">编号</th>
                                            <th class="sorting" style="width: 60px;">姓名</th>
                                            <th class="sorting" style="width: 60px;">油卡</th>
                                            <th class="sorting" style="width: 60px;">状态</th>
                                            <th class="sorting"  style="width: 60px;">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1"><input type="checkbox" /></td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>33</td>
                                            <td>33</td>
                                            <td>2008/11/28</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <input class="submit btn btn-danger" type="submit" value="暂停充值">
                        <input class="submit btn btn-danger" type="submit" value="恢复充值">
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