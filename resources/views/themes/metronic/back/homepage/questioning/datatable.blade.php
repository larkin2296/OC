<div class="table-tr-buttons">
    <a href="{{route('admin.questioning.open', $id)}}"  data-target="#php-ajax-modal-small" data-toggle="modal tooltip"  data-placement="bottom" title="发送任务"><span class="fa fa-send font-green"></span></a>

    <a href="{{route('admin.report.value.index', $id)}}" data-toggle="tooltip" data-placement="bottom" title="查看任务"><span class="fa fa-eye font-green"></span></a>
    
    <a data-url="{{route('admin.questioning.close', $id)}}" data-toggle="tooltip" data-placement="bottom" data-method="put" data-callback="page.reloadTable" data-confirm="" data-type="json" title="关闭任务"><span class="fa fa-minus-circle font-green"></span></a>
</div>