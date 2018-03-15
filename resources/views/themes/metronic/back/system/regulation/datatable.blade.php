<div class="table-tr-buttons">
    <a href="{{route('admin.rule.edit', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="修改"><span class="fa fa-pencil font-green"></span></a>
    <a data-url="{{route('admin.rule.destroy', $id_hash)}}" class="destroy" data-toggle="tooltip" data-placement="bottom" data-reload="true" data-method="delete" data-confirm="" data-type="json" title="删除"><span class="fa fa-trash font-green"></span></a>
</div>