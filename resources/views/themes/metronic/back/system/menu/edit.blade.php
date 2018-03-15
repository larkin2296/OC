<div class="portlet light bordered form-fit">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-layers font-green"></i>
            <span class="caption-subject font-green sbold uppercase">@lang('module/menu.edit.title')</span>
        </div>
    </div>
    <div class="portlet-body form">
		@include(getThemeTemplate('layout.partical.admin.error'))
        <form action="{{ route('admin.menu.update', $menu->id_hash) }}" method="post" class="form-horizontal form-bordered form-row-stripped">
        	{{ csrf_field() }}
			{{ method_field('PUT') }}
        	<input type="hidden" name="parent_id" value="{{ $parentMenu['id_hash'] }}" >
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">父级菜单</label>
                    <div class="col-md-9">
                        <input type="text" value="{{ $parentMenu['name']}}" readonly class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">菜单名称</label>
                    <div class="col-md-9">
                        <input type="text" name="name" placeholder="@lang('field/menu.name.placeholder')" value="{{ old('name', $menu->name) }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">菜单路由</label>
                    <div class="col-md-9">
                        <input type="text" name="route"  value="{{ old('route', $menu->route) }}" placeholder="@lang('field/menu.route.placeholder')" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">菜单图标</label>
                    <div class="col-md-9">
                        <input type="text" name="icon" value="{{old('icon', $menu->icon)}}" placeholder="@lang('field/menu.icon.placeholder')" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">菜单权限</label>
                    <div class="col-md-9">
                        <input type="text" name="permission" value="{{old('permission', $menu->permission)}}" placeholder="@lang('field/menu.permission.placeholder')" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">菜单描述</label>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="3" name="description" placeholder="@lang('field/menu.description.placeholder')">{{old('description', $menu->description)}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">菜单位置</label>
                    <div class="col-md-9">
                        <select class="form-control" name="position" id="">
                            @include(getThemeTemplate('layout.partical.admin.option'), ['options' => $positions, 'selected' => old('position', $menu->position)])
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn green">
                            <i class="fa fa-check"></i> @lang('module/menu.edit.submit') </button>
                        <button type="button" class="btn default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>