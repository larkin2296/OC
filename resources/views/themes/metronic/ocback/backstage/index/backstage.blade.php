<!DOCTYPE html>
<html lang="en">
@include('themes.metronic.ocback.backstage.public.css.p_css')
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
            <li><a href="login_out"><span class="fa fa-power-off"></span> 退出登录</a></li>
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
@include('themes.metronic.ocback.backstage.public.js.p_js')
</body>
</html>
