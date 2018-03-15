@extends(getThemeTemplate('layout.admin'))

@section('content')
	<div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">角色管理</span>
            </div>
        </div>
		<div class="portlet-body">
			<div class="table-toolbar">
		        <div class="row">
		            <div class="col-md-6">
		                <div class="btn-group">
		                    <a href="{{route('admin.role.create')}}" class="btn sbold green"><i class="fa fa-plus"></i>@lang('module/role.index.create')</a>
		                </div>
		            </div>
		        </div>
		    </div>
			{!! $html->table() !!}
		</div>
	</div>
@endsection

@push('js')
    <script src="/vendor/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="/vendor/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    {!! $html->scripts() !!}
@endpush