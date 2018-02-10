@extends(getThemeTemplate('layout.admin'))
@push('css')
<link href="{{ asset('/vendor/jstree/dist/themes/default/style.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/vendor/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css">
<style>
    .tree-note{min-height: 200px;}
</style>
@endpush
@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">原始资料</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group">
                            <a href="{{route('admin.source.create')}}" data-target="#php-ajax-modal-small" data-toggle="modal" class="btn sbold green"><i class="fa fa-plus"></i>添加</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-container">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="note note-info tree-note">
                            <div id="tree"></div>
                        </div>
                    </div>
                    {{-- right panel --}}
                    <div class="col-md-9 col-sm-9">
                        {{-- search  --}}
                        <div class="datatable-search_wrapper note note-info margin-bottom-0">
                            <form class="horizontal-form" id="question-list-form">
                                <div class="form-body">
                                    <div class="row">
                                        <input type="hidden" value="" name="tree">
                                        <div class="col-md-3 col-sm-4 col-xs-6">
                                            <div class="form-group">
                                                <label class="control-label">报告编号:</label>
                                                <input type="text" name="report_num" class="form-control" placeholder="请输入质疑编号">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-xs-6">
                                            <div class="form-group">
                                                <label class="control-label">分类:</label>
                                                <select name="" id="" class="form-control" data-dict="分类"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-md-offset-3 col-sm-4 col-sm-offset-4 col-xs-6">
                                            <label class="control-label">&nbsp;</label>
                                            <a href="javascript:;" class="btn blue btn-block pv-search-event">搜索</a>
                                        </div>  
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- search end --}}
                        {{-- datatables --}}
                        <div class="dataTables_wrapper dataTables_extended_wrapper no-footer margin-top-0">
                            <table id="datatable_ajax" class="table table-striped table-bordered table-hover dataTable no-footer white-space-nowrap"></table>
                        </div>
                        {{-- datatables end --}}
                    </div>
                    {{-- right panel end --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('/vendor/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/vendor/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/vendor/bootstrap-fileinput/bootstrap-fileinput.js') }}"></script>
    <script src="{{ asset('/vendor/jstree/dist/jstree.min.js') }}"></script>
    <script>
    $(function(){
        var form = $('#question-list-form');
        var datatables_cfg = {
            ajax: {
                url: "{{ route('admin.source.index') }}",
                data: function (d) {
                    d.report_num = $('input[name=report_num]',form).val();
                    d.type = $('input[name=type]',form).val();
                    d.tree = $('input[name=tree]',form).val();
                }
            },
            columns:[
                {'data' : 'company', 'name' : 'company', 'title' : '文件名', 'class': 'text-center'},
                {'data' : 'report_number', 'name' : 'report_number', 'title' : '报告编号', 'class': 'text-center'},
                {'data' : 'accept_report_date', 'name' : 'accept_report_date', 'title' : '接受报告时间', 'class': 'text-center'},
                {'data' : 'solution_number', 'name' : 'solution_number', 'title' : '研究方案编号', 'class': 'text-center'},
                {'data' : 'created_at', 'name' : 'created_at', 'title' : '创建时间', 'class': 'text-center'},
                {'data' : 'creator_name', 'name' : 'creator_name', 'title' : '创建人', 'class': 'text-center'},
                {'data' : 'action', 'name' : 'action', 'title' : '操作', 'class': 'text-center','sorting': false},
            ]
        };
        var table = PVJs.datatable($('#datatable_ajax'),datatables_cfg,form);

        //tree
        var tree = PVJs.jsTree($('#tree'),'url');
        tree.bind('select_node.jstree',function(e,data){
            $('[name="tree"]').val(data.node.id);
        })
    });
</script>
@endpush