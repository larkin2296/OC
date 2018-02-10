<div class="table-tr-buttons">
    <a href="{{route('admin.user.edit', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="修改"><span class="fa fa-pencil font-green"></span></a>

    <a data-url="{{route('admin.user.destroy', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" data-method="delete" data-reload="true" data-confirm="" data-type="json" title="删除"><span class="fa fa-trash font-green"></span></a>
    
    <a data-url="{{route('admin.user.pass.reset', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" data-method="put" data-confirm="" data-type="json" title="重置密码"><span class="fa fa-plug font-green"></span></a>
    
    @if($status == getCommonCheckValue(true)) 
        <a data-url="{{route('admin.user.lock', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" data-method="put" data-confirm="" data-type="json" title="锁定"><span class="fa fa-lock font-green"></span></a>
    @else 
        <a data-url="{{route('admin.user.unlock', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" data-method="put" data-confirm="" data-type="json" title="解锁"><span class="fa fa-unlock font-green"></span></a>
    @endif
</div>