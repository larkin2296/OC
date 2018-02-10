@extends(getThemeTemplate('layout.admin'))

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">质疑管理</span>
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
                                        <label class="control-label">质疑编号:</label>
                                        <input type="text" name="question_num" class="form-control" placeholder="请输入质疑编号">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">报告编号:</label>
                                        <input type="text" name="report_num" class="form-control" placeholder="请输入报告编号">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">状态:</label>
                                        <select name="status" class="form-control">
                                            <option value="0">已关闭</option>
                                            <option value="1">已发送</option>
                                            <option value="2">进行中</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">操作人:</label>
                                        <input type="text" name="operation_name" class="form-control" placeholder="请输入操作人">
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
                    <table id="datatable_ajax" class="table table-striped table-bordered table-hover dataTable no-footer"></table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="{{asset('/vendor/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/vendor/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script>
    $(function(){
        var form = $('#question-list-form');
        var datatables_cfg = {
            ajax: {
                url: "{{ route('admin.question.index') }}",
                data: function (d) {
                    d.question_num = $('input[name=question_num]',form).val();
                    d.report_num = $('input[name=report_num]',form).val();
                    d.status = $('input[name=status]',form).val();
                    d.operation_name = $('input[name=operation_name]',form).val();
                }
            },
            columns:[
            {'data': 'question_num', 'name': 'question_num', 'title': '质疑编号', 'class': 'text-center'},
            {'data': 'report_num', 'name': 'report_num', 'title': '报告编号', 'class': 'text-center'},
            {'data': 'operation_name', 'name': 'operation_name', 'title': '操作人', 'class': 'text-center'},
            {'data': 'status', 'name': 'status', 'title': '状态'},
            {'data': 'operation_date', 'name': 'operation_date', 'title': '操作时间', 'class': 'text-center'},
            {'data': 'content', 'name': 'content', 'title': '内容'},
            {'data': 'end_date', 'name': 'end_date', 'title': '截止时间', 'class': 'text-center'},
            {'data': 'sending', 'name': 'sending', 'title': '发送次数', 'class': 'text-center'},
            {'data': 'action', 'name': 'action', 'title': '操作', 'class': 'text-center', 'sorting': false}
            ]
        };
        var table = PVJs.datatable($('#datatable_ajax'),datatables_cfg,form);
    });
</script>
@endpush