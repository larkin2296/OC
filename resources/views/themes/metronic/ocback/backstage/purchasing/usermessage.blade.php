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
            @include('themes.metronic.ocback.backstage.index.user')
        </div>
    </div>
@endsection
@section('panel')

@endsection



