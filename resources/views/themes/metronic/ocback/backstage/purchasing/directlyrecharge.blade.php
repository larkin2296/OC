@extends('themes.metronic.ocback.backstage.index.query')
@section('title')
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">直冲充值</h3>
                <p class="animated fadeInDown"> 业务 <span class="fa-angle-right fa"></span> 直冲充值 </p>
            </div>
        </div>
    </div>
@endsection
@section('query')
    <div class="panel form-element-padding">
        <div class="panel-heading">
            <h4>生成订单</h4>
        </div>
        <div class="panel-body" style="padding-bottom:30px;">
            @include('themes.metronic.ocback.backstage.index.create_search')
        </div>
    </div>
@endsection
@section('panel')
    <div class="panel">
        <div class="panel-heading">
            <h3>购物车</h3>
        </div>
        <div class="panel-body">
            <div class="responsive-table">
                <div id="datatables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            @include('themes.metronic.ocback.backstage.index.table_data')                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <input class="submit btn btn-danger" type="submit" value="暂停充值">
                <input class="submit btn btn-danger" type="submit" value="恢复充值">
            </div>
        </div>
    </div>
@endsection




