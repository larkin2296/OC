@extends(getThemeTemplate('layout.admin'))
@push('css')
<style>
    #child-table{display: none;}
</style>
@endpush
@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">字典管理</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-6 parent-table">
                    {!! $html->table() !!}
                </div>
                <div class="col-md-6">
                    <div class="child-table" id="child-table">
                        <div class="table-toolbar" style="margin-bottom: 10px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <ae data-target="#local-modal" data-toggle="modal" class="btn sbold green add-new-dict-btn"><i class="fa fa-plus"></i>@lang('module/user.index.create')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">序号</th>
                                        <th class="text-center">中文名</th>
                                        <th class="text-center">英文名</th>
                                        <th class="text-center">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal add dict begin --}}
    <div class="modal fade bs-example-modal-lg" id="local-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="portlet light bordered form-fit">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-layers font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">字典添加</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        @include(getThemeTemplate('layout.partical.admin.error'))
                        <form data-url="{{ route('admin.dictionaries.create') }}" data-method="POST" data-type="json" method="post" class="form-horizontal form-bordered form-row-stripped">
                            {{ csrf_field() }}
                            <input type="hidden" name="dict_id" value="" >
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">中文名称<em class="font-red">*</em></label>
                                    <div class="col-md-9">
                                        <input type="text" name="sub_chinese" value="" required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">英文名称<em class="font-red">*</em></label>
                                    <div class="col-md-9">
                                        <input type="text" name="sub_english" value="" required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">E2B名称</label>
                                    <div class="col-md-9">
                                        <input type="text" name="e_name" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">E2B格式</label>
                                    <div class="col-md-9">
                                        <input type="text" name="e_formate" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">排序</label>
                                    <div class="col-md-9">
                                        <input type="tel" name="sort" value="" class="form-control">
                                        <span class="help-block">数值越大排序优先级越高</span>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="button" class="btn green modal-submit-btn">
                                            <i class="fa fa-check"></i>确定</button>
                                        <button type="button" class="btn default" data-dismiss="modal">取消</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal add dict end --}}
@endsection

@push('js')
<script src="{{asset('/vendor/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/vendor/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>

{!! $html->scripts() !!}
<script>
    (function($, win){
        var child_table = $('#child-table');
        var add_btn = $('.add-new-dict-btn');
        var page = {
            /**
             * parent table 点击后显示 child table
             * @param  {[type]} resp [description]
             * @return {[type]}      [description]
             */
            dictCallback: function(el,resp){
                var resp = resp[0];
                if(resp.result){
                    var id = el.attr('data-id');
                    $('#local-modal').find('input[name=dict_id]').val(id);
                    page.renderTable(resp.data);
                    child_table.show();
                }
            },
            /**
             * 渲染table
             * @param  {[type]} data [description]
             * @return {[type]}      [description]
             */
            renderTable: function(data){
                var buff = '';
                for(var i = 0; i < data.length; i++){
                    var d = data[i];
                    buff += '<tr>'+
                                '<td class="text-center">'+(i+1)+'</td>'+
                                '<td class="text-center">'+d.sub_chinese+'</td>'+
                                '<td class="text-center">'+(d.sub_english||"")+'</td>'+
                                '<td>'+
                                    '<div class="text-center table-inner-btn">'+
                                        '<a class="green" data-target="#php-ajax-modal" data-toggle="modal tooltip" data-placement="bottom" href="'+d.edit+'" title="修改"><i class="fa fa-pencil font-green"></i></a>'+
                                        '<a class="green" href="javascript:;" data-url="'+d.delete+'" data-method="delete" data-confirm="" data-callback="page.removeChildTbale" data-type="json" data-toggle="tooltip" data-placement="bottom" title="删除"><span class="fa fa-trash font-green"></span></a>'+
                                    '</div>'+
                                '</td>'+
                            '</tr>';
                }
                child_table.find('table>tbody').html(buff);

                PVJs.modal(child_table);
                PVJs.tooltip(child_table);
                PVJs.tableAction(child_table);
            },
            /**
             * table tr 删除
             * @return {[type]} [description]
             */
            removeChildTbale: function(){

            }
        };

        if(win.page == undefined){
            window.page = page;
        }else{
            window.page = $.extend({},window.page, page);
        }
    })(jQuery,window);
    $(function(){
        // 字典添加和修改
        $(document).on('click','.modal-submit-btn', function(){
            var that = $(this);
            var form = that.parents('form');
            var data = form.serializeArray();
            var dict_id = $('input[name=dict_id]',form).val();
            var params = {};
            for(var i = 0; i < data.length; i++){
                var d = data[i];
                params[d.name] = d.value;
            }
            PVJs.ajax({
                url: form.attr('data-url'),
                type: form.attr('data-method'),
                jsonType: form.attr('data-type'),
                data: params,
                success: function(resp){
                    layer.msg(resp.message);
                    if(resp.result){
                        $('.parent-table a[data-callback="page.dictCallback"][data-id="'+dict_id+'"]').trigger('click');
                        form.find('[data-dismiss="modal"]').trigger('click');
                    }
                }
            })
        })
    });
</script>
@endpush