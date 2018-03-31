@extends('themes.metronic.ocback.backstage.index.query')
@section('title')
    <div class="panel">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">油卡绑定</h3>
                <p class="animated fadeInDown"> 业务 <span class="fa-angle-right fa"></span> 油卡绑定 </p>
            </div>
        </div>
    </div>
@endsection
@section('query')
    <form role="form" class="panel form-element-padding"  method="post" action="{{route('admin.backstage.oil_binding.create')}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="panel-heading">
            <h4>添加油卡</h4>
        </div>
        <div class="panel-body" style="padding-bottom:30px;">
            @include('themes.metronic.ocback.backstage.index.create_search')
        </div>
    </form>
@endsection
@section('panel')
    <div class="panel">
        <div class="panel-heading">
            <h3>您的油卡</h3>
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




