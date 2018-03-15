<div class="table-tr-buttons">

	@permission('export-report')
	    <a href="{{route('admin.report.mainpage.export', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="导出"></span></a>
	@endpermission

	@permission('show-report')
    	<a href="{{route('admin.report.value.index', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="详情"></span></a>
	@endpermission
    
	@permission('copy-report')
		{{-- 数据录入员 --}}
		@if(in_array(getRoleOrganizeValue('data_insert'), $organizeRoleIds))
	    	<a href="{{route('admin.report.mainpage.copy', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="复制"></span></a>
	    @endif
	@endpermission

	@permission('delete-report')
		{{-- 本人报告, 报告的状态在用户的角色范围内 --}}
		@if($user->id == $user_id && in_array($role_organize_status, $organizeRoleIds) )
	    	<a href="{{route('admin.report.mainpage.edit', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="删除"></span></a>
	    @endif
	@endpermission
    
	@permission('newversion-report')
		{{-- 数据录入员 并且报告已完成--}}
		@if(in_array(getRoleOrganizeValue('data_insert'), $organizeRoleIds) && $role_organize_status == 6)
	    	<a href="{{route('admin.report.mainpage.build', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="新建版本"></span></a>
	    @endif
	@endpermission
</div>