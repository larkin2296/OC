<div class="portlet light bordered form-fit">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-layers font-green"></i>
            <span class="caption-subject font-green sbold uppercase">数据分发</span>
        </div>
    </div>
    <div class="portlet-body form">
        @include(getThemeTemplate('layout.partical.admin.error'))
        <form data-url="{{route('admin.report.task.reassign.store', [$reportTask->id_hash])}}" data-method="post" data-type="json" method="post" class="form-horizontal form-bordered form-row-stripped">
            {{ csrf_field() }}
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">人员<em class="font-red">*</em></label>
                    <div class="col-md-9">
                        <select name="task_user_id" class="form-control">
							@forelse($taskUsers as $taskUser)
								<option value="{{$taskUser->id_hash}}">{{$taskUser->name}}</option>
							@empty
								<option value="0">无数据</option>
							@endforelse
						</select>
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
