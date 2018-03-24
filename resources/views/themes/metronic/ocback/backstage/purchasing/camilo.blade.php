<!DOCTYPE html>
<html lang="en">
@extends('themes.metronic.ocback.backstage.public.css.p_css')
@yield('p_css')

<body id="mimin" class="dashboard">
<!-- start: Header -->
<!-- end: Header -->

<!-- end: Left Menu -->

<!-- start: content -->
<div id="content">
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">卡密查询</h3>
                <p class="animated fadeInDown"> 业务 <span class="fa-angle-right fa"></span> 卡密查询 </p>
            </div>
        </div>
    </div>
    <div class="col-md-12 padding-0 form-element">
        <div class="col-md-12">
            <div class="panel form-element-padding">
                <div class="panel-heading">
                    <h4>查询条件</h4>
                </div>
                <div class="panel-body" style="padding-bottom:30px;">
                    <div class="form-group">
                        <label class="col-sm-1 control-label text-right">卡密状态</label>
                        <div class="col-sm-2">
                            <select class="form-control">
                                <option>option one</option>
                                <option>option two</option>
                                <option>option three</option>
                                <option>option four</option>
                            </select>
                        </div>
                        <label class="col-sm-1 control-label text-right">商品</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                        <label class="col-sm-1 control-label text-right">订单号</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                        <label class="col-sm-1 control-label text-right">卡号</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label text-right">面额</label>
                        <div class="col-sm-2">
                            <select class="form-control">
                                <option>option one</option>
                                <option>option two</option>
                                <option>option three</option>
                                <option>option four</option>
                            </select>
                        </div>
                        <label class="col-sm-1 control-label text-right">交易时间</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <input class="submit btn btn-danger" type="submit" value="提交">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <h3>查询结果</h3>
                </div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <div id="datatables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered dataTable no-footer" width="100%" cellspacing="0"  style="width: 100%;">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc"style="width: 60px;">订单号</th>
                                            <th class="sorting" style="width: 60px;">商品</th>
                                            <th class="sorting" style="width: 60px;">面额</th>
                                            <th class="sorting" style="width: 60px;">交易时间</th>
                                            <th class="sorting"  style="width: 60px;">卡号</th>
                                            <th class="sorting"  style="width: 60px;">密码</th>
                                            <th class="sorting"  style="width: 60px;">卡密状态</th>
                                            <th class="sorting"  style="width: 60px;">价格</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">Airi Satou</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>33</td>
                                            <td>2008/11/28</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: content -->
@extends('themes.metronic.ocback.backstage.public.js.p_js')
@yield('p_js')
</body>
</html>