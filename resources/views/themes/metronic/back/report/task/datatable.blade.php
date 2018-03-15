<div class="table-tr-buttons">
    <a  href="{{route('admin.report.task.reassign.index', $id_hash)}}" data-target="#php-ajax-modal-small" data-toggle="modal tooltip" data-placement="bottom" title="重新分配"><span class="fa fa-send font-green"></span></a>

    @if($report_identify)
	    <a href="{{route('admin.report.value.index', $report_id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="查看报告详情"><span class="fa fa-eye font-green"></span></a>
	@else
	    <a href="{{route('admin.report.mainpage.index', ['source_id' => $source_id])}}" data-toggle="tooltip" data-placement="bottom" title="新增报告"><span class="fa fa-file-text font-green"></span></a>
	    <a href="{{route('admin.report.task.newversion.index', $id_hash)}}" data-target="#php-ajax-modal-small" data-toggle="modal tooltip" data-placement="bottom" title="新增新版本"><span class="fa fa-code-fork font-green"></span></a>
	    <a href="{{route('admin.report.task.relevance.index', $id_hash)}}" data-target="#php-ajax-modal-small" data-toggle="modal tooltip" data-placement="bottom" title="关联"><span class="fa fa-chain font-green"></span></a>
	    <a href="{{route('admin.user.edit', $id_hash)}}" data-toggle="tooltip" data-placement="bottom" title="查看原始资料"><span class="fa fa-folder-open font-green"></span></a>
    @endif
</div>