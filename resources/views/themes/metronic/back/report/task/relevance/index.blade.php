    <div class="portlet light bordered form-fit">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">创建新版本</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form action="{{route('admin.report.task.relevance.store', [$reportTask->id_hash])}}" method="post">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">报告编号 <em class="font-red">*</em></label>
                        <div class="col-md-9">
                            <input type="text" name="report_identify" class="form-control">
                        </div>
                    </div>
                </div>
               <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">
                                <i class="fa fa-check"></i> @lang('module/user.edit.submit') </button>
                            <button type="button" class="btn default" data-dismiss="modal">取消</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
