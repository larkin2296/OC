@extends(getThemeTemplate('layout.admin'))

@section('content')
	<div class="portlet light bordered form-fit">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">角色权限</span>
            </div>
        </div>
        <div class="portlet-body form">
            @include(getThemeTemplate('layout.partical.admin.error'))
            <form action="{{ route('admin.role.permission.update', $role->id_hash) }}" method="post" class="form-horizontal form-bordered form-row-stripped">
                {{ csrf_field() }}
                {{ method_field('PUT')}}
                <div class="form-body">
                    @foreach($data as $key=>$lists)
                    <div class="form-group">
                        <label class="control-label col-md-3">{{ $key }}</label>
                        <div class="col-md-9">
                            @foreach($lists as $itemKey=>$item)
                                <label>
                                    <input type="checkbox" @if($item['selected']) checked @endif name="permission[]" class="form-control" value="{{ $itemKey }}">{{ $item['dispaly_name'] }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">
                                <i class="fa fa-check"></i> @lang('module/role.edit.submit') </button>
                            <button type="button" class="btn default" onclick="javascript:window.history.go(-1);">取消</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
	
@endpush