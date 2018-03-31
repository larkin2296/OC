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
                    <li><a href="list/index" target="right">直冲查询</a></li>
                    <li><a href="camilo/index" target="right">卡密查询</a></li>
                </ul>
            </li>
            <li class=" ripple"> <a class="tree-toggle nav-header"><span class="fa fa-check-square-o"></span> 个人信息管理 <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                <ul class="nav nav-list tree">
                    <li><a href="user_message/index" target="right">个人信息</a></li>
                    <li><a href="oil_binding/index" target="right">油卡绑定</a></li>
                </ul>
            </li>
            <li class=" ripple"> <a class="tree-toggle nav-header"><span class="fa fa-calendar-o"></span> 订购 <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                <ul class="nav nav-list tree">
                    <li><a href="c_recharge/index" target="right">卡密订购</a></li>
                    <li><a href="d_recharge/index" target="right">直冲订购</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
    @endsection
