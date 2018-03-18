<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="description" content="12">
<meta name="author" content="12">
<meta name="keyword" content="12">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>油卡后台管理</title>
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
<nav class="navbar navbar-default header navbar-fixed-top">
  <div class="col-md-12 nav-wrapper">
    <div class="navbar-header" style="width:100%;">
      <div class="opener-left-menu is-open"> <span class="top"></span> <span class="middle"></span> <span class="bottom"></span> </div>
      <a href="index.html" class="navbar-brand"> <b>油卡管理系统</b> </a>
      <ul class="nav navbar-nav navbar-right user-nav">
        <li class="user-name"><span></span></li>
        <li class="dropdown avatar-dropdown"> <img src="{{URL::asset('asset/img/avatar.jpg')}}" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
          <ul class="dropdown-menu user-dropdown">
            <li><a href="#"><span class="fa fa-power-off"></span> 退出登录</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- end: Header -->
<div class="container-fluid mimin-wrapper"> 
  <!-- start:Left Menu -->
@yield('meau')
  <!-- end: Left Menu -->

  <div class="admin">
    <iframe scrolling="auto" id='content' border=0 rameborder="0" src="message" name="right"   style="background-color: #ffffff;height:900px;"></iframe>
  </div>
  
</div>

<!-- start: Javascript --> 
<script src="{{URL::asset('asset/js/jquery.min.js')}}"></script>
<script src="{{URL::asset('asset/js/jquery.ui.min.js')}}"></script>
<script src="{{URL::asset('asset/js/bootstrap.min.js')}}"></script>
<!-- plugins --> 
<script src="{{URL::asset('asset/js/plugins/jquery.nicescroll.js')}}"></script>
<!-- custom --> 
{{--<script src="{{URL::asset('asset/js/main.js')}}"></script>--}}
<!-- end: Javascript -->
</body>
</html>