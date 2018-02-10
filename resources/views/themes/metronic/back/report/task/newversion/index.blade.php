<div class="portlet light bordered form-fit">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-layers font-green"></i>
            <span class="caption-subject font-green sbold uppercase">创建新版本</span>
        </div>
    </div>
    <div class="portlet-body form">
        <form action="{{route('admin.report.task.newversion.store', [$reportTask->id_hash])}}" method="post" class="form-horizontal form-bordered form-row-stripped">
			{{ csrf_field() }}
			<div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">报告编号 <em class="font-red">*</em></label>
                    <div class="col-md-9">
                        <input type="text" name="report_identify" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">接受报告时间 <em class="font-red">*</em></label>
                    <div class="col-md-9">
                        <input type="date" name="report_first_received_date" value="{{ $source ? $source->accept_report_date : ''}}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">pv部门获知时间 <em class="font-red">*</em></label>
                    <div class="col-md-9">
                        <input type="date" name="report_drug_safety_date" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                	<label class="control-label col-md-3">创建新版本原因</label>
                    <div class="col-md-9">
                        <select name="new_version_reason" id="" class="form-control">
							<option value="1">修正</option>	
							<option value="2">更新信息</option>	
						</select>
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