@extends('themes.metronic.ocback.backstage.index.query')
@section('title')
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">个人信息</h3>
                <p class="animated fadeInDown"> 业务 <span class="fa-angle-right fa"></span> 个人信息 </p>
            </div>
        </div>
    </div>
@endsection
@section('query')
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
@endsection
@section('panel')

@endsection



