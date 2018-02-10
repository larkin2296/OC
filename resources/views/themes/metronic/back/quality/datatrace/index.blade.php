@extends(getThemeTemplate('layout.admin'))

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">@lang('module/quality.datatrace.index.title')</span>
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
                                        <label class="control-label">标签页:</label>
                                        <select name="" id="" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">字段:</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">报告编号:</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">操作人:</label>
                                        <input type="text" name="organize_role_id" class="form-control" placeholder="请输入任务进度">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">状态:</label>
                                        <select name="causal_relationship" id="" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label">操作时间:</label>
                                        <input type="text" class="form-control">
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

                {!! $html->table() !!}
            </div>

        </div>
    </div>
@endsection

@push('js')
<script src="{{asset('/vendor/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/vendor/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>

    <script>
        {{-- $(function(){

            var form = $('#question-list-form');
            var tableEl = $('#datatable_ajax');
            var datatables_cfg = {
                ajax: {
                    url: "{{ route('admin.datatrace.index') }}",
                    data: function (d) {
                        $.each(["report_identify","drug_name","adverse_event","organize_role_id","causal_relationship","received_from_id","task_user_id","status"],function(index, item){
                            d[item] = $('input[name="'+item+'"]', form).val();
                        });
                    }
                },
                columns:[
                    {'data': 'name', 'name': 'name', 'title': '用户名'},
                    {'data': 'email', 'name': 'email', 'title': '邮箱'},
                    {'data': 'status', 'name': 'status', 'title': '状态', 'class': 'text-center'},
                    {'data': 'created_at', 'name': 'created_at', 'title': '创建时间'},
                    {'data': 'updated_at', 'name': 'updated_at', 'title': '修改时间'},
                    {'data': 'action', 'name': 'action', 'title': '操作', 'class': 'text-center', 'sorting': false},
                ]
            };
            var table = PVJs.datatable(tableEl,datatables_cfg,form);
        }); --}}
    </script>

    {!! $html->scripts() !!}

@endpush