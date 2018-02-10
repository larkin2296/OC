<div class="table-tr-buttons">
    <a href="{{route('admin.postdrug.edit', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="修改"><span class="fa fa-pencil font-green"></span></a>
    <a data-url="{{route('admin.drug.destroy', $id_hash)}}" class="destroy" data-toggle="tooltip" data-placement="bottom" data-method="delete" data-reload="true" data-confirm="" data-type="json" title="删除"><span class="fa fa-trash font-green"></span></a>
</div>