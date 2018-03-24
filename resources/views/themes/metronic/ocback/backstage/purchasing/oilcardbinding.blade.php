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
                <h3 class="animated fadeInLeft">油卡绑定</h3>
                <p class="animated fadeInDown"> 业务 <span class="fa-angle-right fa"></span> 油卡绑定 </p>
            </div>
        </div>
    </div>
    <div class="col-md-12 padding-0 form-element">
        <div class="col-md-12">
            <div class="panel form-element-padding">
                <div class="panel-heading">
                    <h4>添加油卡</h4>
                </div>
                <div class="panel-body" style="padding-bottom:30px;">
                    <div class="form-group">
                        <label class="col-sm-1 control-label text-right">卡号</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                        <label class="col-sm-1 control-label text-right">姓名</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                        <label class="col-sm-1 control-label text-right">编号</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label text-right">身份证</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                        <label class="col-sm-1 control-label text-right">官网账号</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control">
                        </div>
                        <label class="col-sm-1 control-label text-right">密码</label>
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
                    <h3>您的油卡</h3>
                </div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <div id="datatables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered dataTable no-footer" width="100%" cellspacing="0"  style="width: 100%;">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc"style="width: 60px;">卡号</th>
                                            <th class="sorting" style="width: 60px;">姓名</th>
                                            <th class="sorting" style="width: 60px;">编号</th>
                                            <th class="sorting" style="width: 60px;">身份证</th>
                                            <th class="sorting"  style="width: 60px;">官网账号</th>
                                            <th class="sorting"  style="width: 60px;">油卡状态</th>
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