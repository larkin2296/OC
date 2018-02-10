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
                <span class="caption-subject font-green sbold uppercase">个例报告</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                {{-- search  --}}
                <div class="portlet box green margin-bottom-0">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>基本信息
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="展开/收起" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body padding-0 margin-0">
                        <div class="horizontal-form note note-info margin-bottom-0">
                            <div class="form-body ">
                                <div class="row ">
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">首次获悉时间</label>
                                            <input type="text" name="report_num" class="form-control" placeholder="请输入首次获悉时间">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">PV获悉时间</label>
                                            <input type="text" name="report_num" class="form-control" placeholder="请输入PV获悉时间">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">事件发生国家</label>
                                            <select name="" class="form-control" data-dict="事件发生国家"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">企业报告类型</label>
                                            <select name="" class="form-control" data-dict="企业报告类型"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">项目编号</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">不良事件发生时间</label>
                                            <span class="input-group-btn">
                                                <select name="" id="" class="form-control">
                                                    <option value="1">年</option>
                                                </select>
                                            </span>
                                            <span class="input-group-btn">
                                                <select name="" id="" class="form-control">
                                                    <option value="1">月</option>
                                                </select>
                                            </span>
                                            <span class="input-group-btn">
                                                <select name="" id="" class="form-control">
                                                    <option value="1">日</option>
                                                </select>
                                            </span>
                                            <input type="hidden" name="y-m-d">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">中心编号</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">迟报原因</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">商品名称</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">通用名称</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">不良事件</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">是否严重</label>
                                            <div class="md-radio-list">
                                                <div class="md-radio-inline">
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio5_1-4" name="radio5_1-3" class="md-check">
                                                        <label for="radio5_1-3">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>  是</label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio5_1-4" name="radio5_1-3" class="md-check">
                                                        <label for="radio5_1-3">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>  否</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">报告严重性</label>
                                            <div class="md-radio-list">
                                                <div class="md-radio-inline">
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio_mainpage_1" name="radio_mainpage_1" class="md-check">
                                                        <label for="radio_mainpage_1">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>  死亡</label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio_mainpage_1-2" name="radio_mainpage_1" class="md-check">
                                                        <label for="radio_mainpage_1-2">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>  严重</label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio_mainpage_1-2" name="radio_mainpage_1" class="md-check">
                                                        <label for="radio_mainpage_1-2">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>  一般</label>
                                                    </div>
                                                    <div class="md-radio">
                                                        <input type="radio" id="radio_mainpage_1-2" name="radio_mainpage_1" class="md-check">
                                                        <label for="radio_mainpage_1-2">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>  其他</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
                {{-- search 1 end --}}
                <div class="portlet box green margin-bottom-0">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>报告者信息
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="展开/收起" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body padding-0 margin-0">
                        <div class="horizontal-form note note-info margin-bottom-0">
                            <div class="form-body ">
                                <div class="row ">
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">报告者姓名</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">单位名称</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">部门</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">生产厂商</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">国家</label>
                                            <select name="" id="" class="form-control" data-dict="国家"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">省</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">市</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">邮编</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">电话</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- search 2 end --}}
                <div class="portlet box green margin-bottom-0">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>患者信息
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="展开/收起" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body padding-0 margin-0">
                        <div class="horizontal-form note note-info margin-bottom-0">
                            <div class="form-body ">
                                <div class="row ">
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">姓名</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">患者编号</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">出生年月</label>
                                            <span class="input-group-btn">
                                                <select name="" id="" class="form-control">
                                                    <option value="1">年</option>
                                                </select>
                                            </span>
                                            <span class="input-group-btn">
                                                <select name="" id="" class="form-control">
                                                    <option value="1">月</option>
                                                </select>
                                            </span>
                                            <span class="input-group-btn">
                                                <select name="" id="" class="form-control">
                                                    <option value="1">日</option>
                                                </select>
                                            </span>
                                            <input type="hidden" name="y-m-d">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">年龄</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">年龄单位</label>
                                            <select name="" id="" class="form-control" data-dict="年龄单位"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">性别</label>
                                            <select name="" id="" class="form-control" data-dict="性别"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">电话</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- search 3 end --}}
                <div class="portlet box green margin-bottom-0">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>文献信息
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="展开/收起" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body padding-0 margin-0">
                        <div class="horizontal-form note note-info margin-bottom-0">
                            <div class="form-body ">
                                <div class="row ">
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">文献发表年</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">文献作者</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">期刊名</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <label class="control-label">文献标题</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- search 4 --}}
                
                {{-- search bar--}}
                <div class="datatable-search_wrapper  margin-bottom-0 margin-top-20">
                    <form class="horizontal-form" id="question-list-form">
                        <div class="form-body">
                            <div class="row clearfix">
                               <div class="col-md-6 col-sm-6 col-xs-6">
                                   <div class="btn-group btn-group-solid">
                                       <a href="javascript:;" class="btn green"><i class="fa fa-plus"></i>新建</a>
                                       <a href="javascript:;" class="btn blue"><i class="fa fa-link"></i>LineListing</a>
                                   </div>
                               </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <a href="javascript:;" class="btn green btn-outline pull-right"><i class=""></i>重置</a>
                                    <a href="javascript:;" class="btn blue pv-search-event pull-right"><i class="fa fa-search"></i>搜索</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- search bar end --}}
                {{-- datatables --}}
                <div class="dataTables_wrapper dataTables_extended_wrapper no-footer margin-top-0">
                    <table id="datatable_ajax" class="table table-striped table-bordered table-hover dataTable no-footer white-space-nowrap"></table>
                </div>
                {{-- datatables end --}}
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
                url: "{{ route('admin.report.mainpage.index') }}",
                method: 'GET',
                data: function (d) {
                    d.report_num = $('input[name=report_num]',form).val();
                    d.type = $('input[name=type]',form).val();
                    d.tree = $('input[name=tree]',form).val();
                    d._token = "{{ csrf_token() }}"
                }
            },
            columns:[
            {'data' : 'report_first_received_date', 'name' : 'report_first_received_date', 'title' : '首次获悉的时间'},
            {'data' : 'report_drug_safety_date', 'name' : 'report_drug_safety_date', 'title' : 'pv获悉的时间'},
            {'data' : 'received_from_id', 'name' : 'received_from_id', 'title' : '报告类型值'},
            {'data' : 'research_id', 'name' : 'research_id', 'title' : '项目编号'},
            {'data' : 'center_number', 'name' : 'center_number', 'title' : '中心编号'},
            {'data' : 'first_drug_name', 'name' : 'first_drug_name', 'title' : '药品名称'},
            {'data' : 'event_term', 'name' : 'event_term', 'title' : '不良事件'},
            {'data' : 'report_identifier', 'name' : 'report_identifier', 'title' : '报告编号'},
            {'data' : 'patient_name', 'name' : 'patient_name', 'title' : '患者姓名'},
            {'data' : 'subject_number', 'name' : 'subject_number', 'title' : '患者编号'},
            {'data' : 'role_organize_status', 'name' : 'role_organize_status', 'title' : '状态'},
            {'data' : 'action', 'name' : 'action', 'title' : '操作', 'class' : 'text-center', 'sorting' : false},
            ]
        };
        var table = PVJs.datatable($('#datatable_ajax'),datatables_cfg,form);

    });
</script>
@endpush