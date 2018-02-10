<div class="portlet light bordered form-fit">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-layers font-green"></i>
            <span class="caption-subject font-green sbold uppercase">上传原始资料</span>
        </div>
    </div>
    <div class="portlet-body form">
        <form data-url="{{ route('admin.source.store') }}" data-method="post" data-type="json" class="form-horizontal form-bordered form-row-stripped" >
            {{ csrf_field() }}
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">接受报告时间</label>
                    <div class="col-md-9">
                        <input type="date" name="accept_report_date" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">研究方案编号</label>
                    <div class="col-md-9">
                        <input type="text" name="solution_number" class="form-control">
                    </div>
                </div>
                <div class="form-group" id="fileupload-wrap">
                    <label class="control-label col-md-3">附件</label>
                    <input type="hidden" name="attach_ids">
                    <div class="col-md-9">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="input-group input-large">
                                <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                    <span class="fileinput-filename"> </span>
                                </div>
                                <span class="input-group-addon btn default btn-file">
                                    <span class="fileinput-new" id="select-file">选择文件 </span>
                                    <span class="fileinput-exists"> 修改文件 </span>
                                    <input type="file" data-name="attach_ids"> </span>
                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> 删除 </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">文件存放目录</label>
                    <div class="col-md-9 pr">
                        <input type="text" class="form-control" readonly data-tree="#modal-tree">
                        <input type="hidden" data-tree-value="#modal-tree">
                        <div class="tree-modal-wrap">
                            <div id="modal-tree" class="tree-modal-item"></div>
                            <div class="pv-form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="button" class="btn green btn-small" id="tree-submit-btn">
                                            <i class="fa fa-check"></i>确定</button>
                                        <button type="button" class="btn default btn-small" data-close=".tree-modal-wrap">关闭</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">文件分类</label>
                    <div class="col-md-9">
                        <select name="file_class" class="form-control" data-dict="文件分类"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">文件来源</label>
                    <div class="col-md-9">
                        <select name="file_source" class="form-control" data-dict="文件来源"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">描述</label>
                    <div class="col-md-9">
                        <textarea name="remark" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3"></label>
                    <div class="col-md-9">
                        <p class="margin-bottom-10"><span>提示：</span>请上传一下格式的文件</p>
                        <p class="margin-bottom-10">pdf, doc, docx, xls, xlsx, txt, bmp, gif, jpg, jpeg, png, mp3</p> 
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="button" class="btn green modal-save-event">
                            <i class="fa fa-check"></i>确定</button>
                        <button type="button" class="btn default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    (function(){
        var tree = PVJs.jsTree($('#modal-tree'));
        var saveBtn = $('.modal-save-event');
        var form = saveBtn.parents('form');
        
        PVJs.rendre.renderDict(form);

        $('[data-tree]').click(function(){
            $('.tree-modal-wrap').slideDown();
        });
        
        $('[data-close]').click(function(){
            var sel = $(this).attr('data-close');
            $(sel).slideUp();
        });
        
        tree.click(function(e){
            e.stopPropagation();
        });
        //tree 确定
        $('#tree-submit-btn').click(function(){
            var t = tree.jstree(true);
            var node = t.get_selected(true);
            if(node.length <=0){
                layer.msg("请选择相关节点！");
            }else{
                var data = node[0];
                $('[data-tree-value]').val(data.id);
                $('[data-tree]').val(data.text);
                $('.tree-modal-wrap').slideUp();
            }
        });
        // 监听文件改变
        // modal 数据保存
        var uploader = PVJs.uploadFile($('#fileupload-wrap'),{},{
            opts:{
                "file": "input[data-name=attach_ids]",
                "value": "input[name=attach_ids]"
            }
        });
        //保存form 表单
        var saveForm = function(form){
            var data = form.serializeArray();
            var url = form.attr("data-url");
            var method = form.attr("data-method");
            var type = form.attr("data-type");

            PVJs.ajax({
                url: url,
                type: method,
                jsonType: type,
                data: data,
                success: function(resp){
                    layer.msg(resp.message);
                    if(resp.result){
                        form.find('[data-dismiss="modal"]').trigger('click');
                        $('.pv-search-event').trigger('click');
                    }
                }
            });
        }
        //保存原始资料
        saveBtn.click(function(){
            var that = $(this),
                form = that.parents('form');
            
            // 开始上传
            uploader.upload(function(file, resp){
                if(resp.result){
                    $('input[name=attach_ids]',form).val(resp.data.id_hash);
                    saveForm(form);
                }
            });
        }); 

    })();
</script>