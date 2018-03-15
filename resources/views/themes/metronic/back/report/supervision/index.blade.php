@extends(getThemeTemplate('layout.admin'))

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">上报监管</span>
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
                                        <label class="control-label">企业报告类型:</label>
                                        <select name="" id="" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">上报状态:</label>
                                        <select name="" id="" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">物流单号:</label>
                                        <input type="text" name="organize_role_id" class="form-control" placeholder="请输入任务进度">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">国家ADR系统编号:</label>
                                        <select name="causal_relationship" id="" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">上报时间:</label>
                                        <select name="received_from_id" id="" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-md-offset-3 col-sm-4 col-sm-offset-8 col-xs-6 col-xs-offset-6">
                                    <label class="control-label hidden-xs hidden-sm">&nbsp;</label>
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
    <div class="portlet light bordered">
        <div class="portlet-body">
            <p>
                <span><i class="fa-trash"></i>待上报ADR</span>
                <span><i class="fa-trash"></i>待上报</span>
                <span><i class="fa-trash"></i>无需上报</span>
                <span><i class="fa-trash"></i>上报成功</span>
                <span><i class="fa-trash"></i>上报失败</span>
            </p>
            <p><span>提示：</span>1. 立即上报只适合用于首次报告，随访报告只能通过国家ADR在线系统上报。2. 立即上报成功</p>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('/vendor/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/vendor/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
    <script>
        $(function(){

            var form = $('#question-list-form');
            var tableEl = $('#datatable_ajax');
            var datatables_cfg = {
                ajax: {
                    url: "{{ route('admin.supervision.index') }}",
                    data: function (d) {
                        $.each(["report_identify","drug_name","adverse_event","organize_role_id","causal_relationship","received_from_id","task_user_id","status"],function(index, item){
                            d[item] = $('input[name="'+item+'"]', form).val();
                        });
                    }
                },
                columns:[
                    {'data' : 'report_identifier', 'name' : 'report_identifier', 'title' : '报告编号'},
                    {'data' : 'received_from_id', 'name' : 'received_from_id', 'title' : '企业报告类型'},
                    {'data' : 'report_first_received_date', 'name' : 'report_first_received_date', 'title' : '收到报告日期'},
                    {'data' : 'first_drug_name', 'name' : 'first_drug_name', 'title' : '药品名称'},
                    {'data' : 'first_event_term', 'name' : 'first_event_term', 'title' : '不良事件'},
                    {'data' : 'received_fromid_id', 'name' : 'received_fromid_id', 'title' : '报告类型'},
                    {'data' : 'regulation_id', 'name' : 'regulation_id', 'title' : '严重性标准'},
                    {'data' : 'id', 'name' : 'id', 'title' : '因果关系'},
                    {'data' : 'id', 'name' : 'id', 'title' : '上报状态'},
                    {'data' : 'id', 'name' : 'id', 'title' : '国家ADR编号'},
                    {'data' : 'id', 'name' : 'id', 'title' : '上报时间'},
                    {'data' : 'action', 'name' : 'action', 'title' : '操作'},
                ]
            };
            var table = PVJs.datatable(tableEl,datatables_cfg,form);
        });
    </script>
@endpush