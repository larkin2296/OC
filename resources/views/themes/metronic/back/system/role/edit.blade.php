@extends(getThemeTemplate('layout.admin'))

@section('content')
	<div class="portlet light bordered form-fit">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="icon-layers font-green"></i>
	            <span class="caption-subject font-green sbold uppercase">@lang('module/role.edit.title')</span>
	        </div>
	    </div>
	    <div class="portlet-body form">
	    	@include(getThemeTemplate('layout.partical.admin.error'))
            <form action="{{ route('admin.role.update', $role->id_hash) }}" method="post" class="form-horizontal form-bordered form-row-stripped">
            	{{ csrf_field() }}
				{{ method_field('PUT')}}
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">角色名称</label>
                        <div class="col-md-9">
                            <input type="text" name="name" value="{{old('name', $role->name)}}" placeholder="@lang('field/role.name.placeholder')" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">角色显示名称</label>
                        <div class="col-md-9">
                            <input type="text" name="display_name" value="{{old('display_name', $role->display_name)}}" placeholder="@lang('field/role.display_name.placeholder')" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">角色描述</label>
                        <div class="col-md-9">
                            <textarea class="form-control" rows="3" name="description" placeholder="@lang('field/role.description.placeholder')">{{old('description', $role->description)}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">组织结构角色</label>
                        <div class="col-md-9">
                            <select class="form-control" name="organize_role_id" id="">
                                @include(getThemeTemplate('layout.partical.admin.option'), ['options' => $roleOrganizes, 'selected' => old('organize_role_id', $role->organize_role_id)])
                            </select>
                        </div>
                    </div>
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