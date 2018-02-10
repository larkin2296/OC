<div class="portlet light bordered form-fit">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-layers font-green"></i>
            <span class="caption-subject font-green sbold uppercase">发送质疑</span>
        </div>
    </div>
    <div class="portlet-body form">
        @include(getThemeTemplate('layout.partical.admin.error'))
        <form data-url="{{ route('admin.questioning.create') }}" data-method="POST" data-type="json" method="post" class="form-horizontal form-bordered form-row-stripped">
            {{ csrf_field() }}
            <input type="hidden" name="question_id" value="{{ $data->id }}">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">联系方式<em class="font-red">*</em></label>
                    <div class="col-md-9">
                        <select name="status" id="select-link-event" class="form-control" data-link=".select-link">
                            <option value="1">邮件</option>
                            <option value="2">电话联系</option>
                            <option value="3">快递</option>
                            <option value="4">EMS</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">截止日期<em class="font-red">*</em></label>
                    <div class="col-md-9">
                        <input type="date" name="end_date" value="{{ $data->end_date }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">质疑内容<em class="font-red">*</em></label>
                    <div class="col-md-9">
                        <textarea name="content" class="form-control" rows="5">{{$data->content }}</textarea>
                    </div>
                </div>
                <div class="form-group select-link pv-hide" data-val="1">
                    <label class="control-label col-md-3">收件人<em class="font-red">*</em></label>
                    <div class="col-md-9">
                        <input type="text" name="email" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group select-link pv-hide" data-val="3">
                    <label class="control-label col-md-3">运单号<em class="font-red">*</em></label>
                    <div class="col-md-9">
                        <input type="text" name="express" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group select-link pv-hide" data-val="4">
                    <label class="control-label col-md-3">运单号<em class="font-red">*</em></label>
                    <div class="col-md-9">
                        <input type="text" name="ems_express" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group select-link pv-hide" data-val="2">
                    <label class="control-label col-md-3">电话号码<em class="font-red">*</em></label>
                    <div class="col-md-9">
                        <input type="text" name="phone_number" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group select-link pv-hide" data-val="1">
                    <label class="control-label col-md-3">邮件主题<em class="font-red">*</em></label>
                    <div class="col-md-9">
                        <input type="text" name="email_theme" value="" class="form-control">
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
        //联系方式选择
        $('#select-link-event').change(function(){
            var that = $(this);
            var link = that.attr('data-link');
            var val = that.val();
            $(link).hide().each(function(){
                var el = $(this);
                if(el.attr('data-val').indexOf(val) > -1){
                    el.show();
                }else{
                    el.find('input').val("");
                }
            })
        }).trigger('change');
        
        //发送
        $('#modal-submit-btn').click(function(){
            var that = $(this);
            var form = that.parents('form');
            var url = form.attr('data-url');
            var method = form.attr('data-method');
            var type = form.attr('data-type');
            var form_data = form.serializeArray();
            var params = {};

            for(var i = 0; i < form_data.length; i++){
                params[form_data[i].name] = form_data[i].value;
            }
            
            PVJs.ajax({
                url: url,
                type: method,
                jsonType: type,
                data: params,
                success: function(resp){
                    layer.msg(resp.message);
                    if(resp.result){
                        form.find('[data-dismiss="modal"]').trigger('click');
                        LaravelDataTables.dataTableBuilder.ajax.reload();
                    }
                }
            })
        });
        // 设置截止日期
        var date = moment($('input[name=end_data]').attr('value')).add(7,'d').format('YYYY-MM-DD');
        $('input[name=end_data]').val(date);
    })
</script>