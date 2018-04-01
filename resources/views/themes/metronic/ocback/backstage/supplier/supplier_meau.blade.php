@extends('themes.metronic.ocback.backstage.index.backstage')
@section('meau')
    <div id="left-menu">
        <div class="sub-left-menu scroll">
            <ul class="nav nav-list">
                <li>
                    <div class="left-bg"></div>
                </li>
                <li class=" ripple"> <a class="tree-toggle nav-header" href="message" target="right"><span class="fa-home fa"></span> 首页 <span class="fa-angle-right fa right-arrow text-right"></span> </a> </li>
                <li class="active ripple"> <a class="tree-toggle nav-header"> <span class="fa-diamond fa"></span> 查询 <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                    <ul class="nav nav-list tree">
                        <li><a href="s_list/index" target="right">订单查询</a></li>
                    </ul>
                </li>
                <li class=" ripple"> <a class="tree-toggle nav-header"><span class="fa fa-check-square-o"></span> 信息 <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                    <ul class="nav nav-list tree">
                        <li><a href="user_message/index" target="right">信息管理</a></li>
                    </ul>
                </li>
                <li class=" ripple"> <a class="tree-toggle nav-header"><span class="fa fa-calendar-o"></span> 供货 <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                    <ul class="nav nav-list tree">
                        <li><a href="s_camilo/index" target="right">卡密供货</a></li>
                        <li><a href="s_directly/index" target="right">直冲供货</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
@endsection