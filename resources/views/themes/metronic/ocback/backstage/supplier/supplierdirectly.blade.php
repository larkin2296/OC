@extends('themes.metronic.ocback.backstage.index.query')
@section('title')
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">直充供货</h3>
                <p class="animated fadeInDown"> 业务 <span class="fa-angle-right fa"></span> 直充供货 </p>
            </div>
        </div>
    </div>
@endsection
@section('panel')
    <div class="panel">
        <div class="panel-heading">
            <h3>直充订单</h3>
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