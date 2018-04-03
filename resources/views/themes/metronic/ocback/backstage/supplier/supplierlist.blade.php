@extends('themes.metronic.ocback.backstage.index.query')
@section('query')
    <form role="form" class="panel form-element-padding"  method="post" action="{{route('admin.backstage.s_list.index')}}">
        {{ csrf_field() }}
        <div class="panel-heading">
            <h4>查询条件</h4>
        </div>
        <div class="panel-body" style="padding-bottom:30px;">
            @include('themes.metronic.ocback.backstage.index.create_search')
        </div>
    </form>
@endsection

@section('panel')
    <div class="panel">
        <div class="panel-heading">
            <h3>查询结果</h3>
        </div>
        <div class="panel-body">
            <div class="responsive-table">
                <div id="datatables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            @include('themes.metronic.ocback.backstage.index.table_data')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">订单查询</h3>
                <p class="animated fadeInDown"> 业务 <span class="fa-angle-right fa"></span> 订单查询 </p>
            </div>
        </div>
    </div>
@endsection