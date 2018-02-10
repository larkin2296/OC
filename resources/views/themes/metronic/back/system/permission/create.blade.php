@extends(getThemeTemplate('layout.admin'))

@section('content')
<div class="portlet light bordered form-fit">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-layers font-green"></i>
            <span class="caption-subject font-green sbold uppercase">@lang('module/permission.create.title')</span>
        </div>
    </div>
    <div class="portlet-body form">
    	@include(getThemeTemplate('layout.partical.admin.error'))
        <form action="{{ route('admin.permission.store') }}" method="post" class="form-horizontal form-bordered form-row-stripped">
        	{{ csrf_field() }}
        	<div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">权限名称</label>
                    <div class="col-md-9">
                        <input type="text" name="name" value="{{old('name')}}" placeholder="@lang('field/permission.name.placeholder')" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">权限显示名称</label>
                    <div class="col-md-9">
                        <input type="text" name="display_name" placeholder="@lang('field/permission.display_name.placeholder')" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">权限描述</label>
                    <div class="col-md-9">
                    	<textarea class="form-control" rows="3"  name="description" placeholder="@lang('field/permission.description.placeholder')">{{old('description')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn green">
                            <i class="fa fa-check"></i> @lang('module/permission.create.submit') </button>
                        <button type="button" class="btn default" onclick="javascript:window.history.go(-1);">取消</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection