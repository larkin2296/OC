@extends('themes.metronic.ocback.backstage.index.index')
@section('meau')
<div id="left-menu">
    <div class="sub-left-menu scroll">
        <ul class="nav nav-list">
            <li>
                <div class="left-bg"></div>
            </li>
            {{--<li class=" ripple"> <a class="tree-toggle nav-header" href="message" target="right"><span class="fa-home fa"></span> 首页 <span class="fa-angle-right fa right-arrow text-right"></span> </a> </li>--}}
            <li class="active ripple"> <a class="tree-toggle nav-header"> <span class="fa-diamond fa"></span> 查询 <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                <ul class="nav nav-list tree">
                    <li><a href="list" target="right">查询油卡</a></li>
                    <li><a href="kami" target="right">查询卡密</a></li>
                </ul>
            </li>
            <li class=" ripple"> <a class="tree-toggle nav-header"><span class="fa fa-check-square-o"></span> 个人信息管理 <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                <ul class="nav nav-list tree">
                    <li><a href="usermes" target="right">个人信息</a></li>
                    <li><a href="binding" target="right">油卡绑定</a></li>
                </ul>
            </li>
            <li class=" ripple"> <a class="tree-toggle nav-header"><span class="fa fa-calendar-o"></span> 采购订单 <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                <ul class="nav nav-list tree">
                    <li><a href="kmrecharge" target="right">卡密订单</a></li>
                    <li><a href="zcrecharge" target="right">直冲订单</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
    @endsection
