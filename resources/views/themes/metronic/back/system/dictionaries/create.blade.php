<div class="portlet light bordered form-fit">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-layers font-green"></i>
            <span class="caption-subject font-green sbold uppercase">字典修改</span>
        </div>
    </div>
    <div class="portlet-body form">
        @include(getThemeTemplate('layout.partical.admin.error'))
        <form data-url="{{ route('admin.dictionaries.create') }}" data-method="POST" data-type="json" method="post" class="form-horizontal form-bordered form-row-stripped">
            {{ csrf_field() }}
            <input type="hidden" name="dict_id" value="{{ $dict_id }}" >
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
                        <button type="button" class="btn green" id="modal-submit-btn">
                            <i class="fa fa-check"></i>确定</button>
                        <button type="button" class="btn default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function(){
        $('#modal-submit-btn').click(function(){
            var that = $(this);
            var form = that.parents('form');
            var data = form.serializeArray();
            var dict_id = $('input[name=dict_id]').val();
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