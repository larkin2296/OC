<div class="table-tr-buttons">
    <a href="{{route('admin.workflow.edit', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="修改"><span class="fa fa-pencil font-green"></span></a>
    
    <a data-url="{{route('admin.workflow.destroy', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" data-method="delete" data-reload="true" data-confirm="" data-type="json" title="删除"><span class="fa fa-trash font-green"></span></a>

    <a href="{{ route('admin.workflow.setting', $id_hash) }}" data-toggle="tooltip" data-placement="bottom" title="配置"><span class="fa fa-tasks font-green"></span></a>

</div>
