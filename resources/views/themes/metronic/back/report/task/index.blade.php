@extends(getThemeTemplate('layout.admin'))
@section('content')
	<div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">@lang('module/report/task.index.title')</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <a href="{{ route('admin.report.mainpage.index') }}" class="btn green btn-outline btn-circle btn-sm active">报告检索</a>
                </div>
            </div>
        </div>
		<div class="portlet-body">
			<div class="table-container">
                <div class="datatable-search_wrapper note note-info">
                    <form class="horizontal-form" id="question-list-form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">报告编号:</label>
                                        <input type="text" name="report_identify" class="form-control" placeholder="请输入报告编号">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">药物名称:</label>
                                        <input type="text" name="drug_name" class="form-control" placeholder="请输入药物名称">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">不良事件:</label>
                                        <input type="text" name="adverse_event" class="form-control" placeholder="请输入不良事件">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">任务进度:</label>
                                        <input type="text" name="organize_role_id" class="form-control" placeholder="请输入任务进度">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">因果关系:</label>
                                        <select name="causal_relationship" data-dict="因果关系" id="" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">企业报告类型:</label>
                                        <select name="received_from_id" data-dict="企业报告类型" id="" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">当前所有人:</label>
                                        <select name="task_user_id" data-dict="当前所有人" id="" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">任务状态:</label>
                                        <select name="status" data-dict="任务状态" id="" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-md-offset-9 col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-6">
                                    <label class="control-label hidden-lg hidden-md hidden-xs">&nbsp;</label>
                                    <a href="javascript:;" class="btn blue btn-block pv-search-event">搜索</a>
                                </div>    
                            </div>
                        </div>
                    </form>
                </div>
                <div class="dataTables_wrapper dataTables_extended_wrapper no-footer">
                    <table id="datatable_ajax" class="table table-striped table-bordered table-hover dataTable no-footer white-space-nowrap"></table>
                </div>
            </div>
		</div>
	</div>
@endsection

@push('js')
    <script src="/vendor/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="/vendor/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script>
    $(function(){
        var form = $('#question-list-form');
        var tableEl = $('#datatable_ajax');

        var datatables_cfg = {
            ajax: {
                url: "{{ route('admin.report.task.index') }}",
                data: function (d) {
                    $.each(["report_identify","drug_name","adverse_event","organize_role_id","causal_relationship","received_from_id","task_user_id","status"],function(index, item){
                        d[item] = $('input[name="'+item+'"]', form).val();
                    });
                   
                }
            },
            columns:[
                {'data' : 'report_identify', 'name' : 'report_identify', 'title' : '报告编号', 'sorting' : false, 'class': 'text-center'},
                {'data' : 'report_first_received_date', 'name' : 'report_first_received_date', 'title' : '获知时间', 'sorting' : false, 'class': 'text-center'},
                {'data' : 'drug_name', 'name' : 'drug_name', 'title' : '药物名称', 'class' : 'text-center', 'sorting' : false, 'class': 'text-center'},
                {'data' : 'first_event_term', 'name' : 'first_event_term', 'title' : '不良事件', 'sorting' : false, 'class': 'text-center'},
                {'data' : 'seriousness', 'name' : 'seriousness', 'title' : '严重性', 'sorting' : false, 'class': 'text-center'},
                {'data' : 'standard_of_seriousness', 'name' : 'standard_of_seriousness', 'title' : '严重性标准', 'sorting' : false, 'class': 'text-center'},
                {'data' : 'case_causality', 'name' : 'case_causality', 'title' : '因果关系', 'sorting' : false, 'class': 'text-center'},
                {'data' : 'received_from_id', 'name' : 'received_from_id', 'title' : '首次/随访', 'sorting' : false, 'class': 'text-center'},
                {'data' : 'task_user_name', 'name' : 'task_user_name', 'title' : '处理人', 'sorting' : false, 'class': 'text-center'},
                {'data' : 'organize_role_name', 'name' : 'organize_role_name', 'title' : '任务进度', 'sorting' : false, 'class': 'text-center'},
                {'data' : 'task_countdown', 'name' : 'task_countdown', 'title' : '任务倒计时', 'sorting' : false, 'class': 'text-center'},
                {'data' : 'report_countdown', 'name' : 'report_countdown', 'title' : '报告倒计时', 'sorting' : false, 'class': 'text-center'},
                {'data' : 'action', 'name' : 'action', 'title' : '操作', 'sorting' : false, 'class': 'text-center'}
            ]
        };
        var table = PVJs.datatable(tableEl,datatables_cfg,form);
        PVJs.modal(tableEl);
        //保存数据分发
        $(document).on('click','.modal-submit-btn',function(){
            var that = $(this);
            var form = that.parents('form');
            var data = form.serializeArray();
            PVJs.ajax({
                url: form.attr('data-url'),
                type: form.attr('data-method'),
                jsonType: form.attr('data-type'),
                data: data,
                success: function(resp){
                    if(resp.result){
                        table.ajax.reload();
                        form.find('[data-dismiss="modal"]').trigger('click');
                    }
                    layer.msg(resp.message);
                }

            })
        })
    });
</script>
@endpush