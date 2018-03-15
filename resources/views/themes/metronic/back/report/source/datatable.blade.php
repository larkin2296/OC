
<div class="table-tr-buttons">
    <a href="{{route('admin.source.edit', $id_hash)}}" data-target="#php-ajax-modal-small" data-toggle="modal tooltip" data-placement="bottom" title="修改"><span class="fa fa-pencil font-green"></span></a>
    <a data-url="{{route('admin.source.destroy', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" data-method="delete" data-reload="true" data-confirm="" data-type="json" title="删除"><span class="fa fa-trash font-green"></span></a>
    <a data-url="{{route('admin.source.download', $id_hash)}}"  data-toggle="tooltip" data-placement="bottom" data-method="get" data-confirm="" data-type="json" title="下载"><span class="fa fa-download font-green"></span></a>
    @if($issue == 1)
    <a href="{{route('admin.source.issue', $id_hash)}}" data-target="#php-ajax-modal-small" data-toggle="modal tooltip" data-placement="bottom"  title="分发"><span class="fa fa-send font-green"></span></a>
    @else
    <a data-url="{{route('admin.source.recycling', $id_hash)}}"  data-toggle="tooltip" data-placement="bottom" data-method="delete" data-reload="true" data-confirm="" data-type="json" title="回收"><span class="fa fa-recycle font-green"></span></a>
    @endif
</div>