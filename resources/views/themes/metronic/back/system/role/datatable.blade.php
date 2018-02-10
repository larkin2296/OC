<div class="table-tr-buttons">
    <a href="{{route('admin.role.edit', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="修改"><span class="fa fa-pencil font-green"></span></a>
    <a data-url="{{route('admin.role.destroy', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" data-method="delete" data-reload="true" data-confirm="" data-type="json" title="删除"><span class="fa fa-trash font-green"></span></a>
    <a href="{{route('admin.role.user.show', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="角色用户"><span class="fa fa-users font-green"></span></a>
    <a href="{{route('admin.role.permission.edit', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="角色权限"><span class="fa fa-wrench font-green"></span></a>
</div>
