@extends(getThemeTemplate('layout.admin'))

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">修改报告优先级规则</span>
            </div>
        </div>
         <div class="portlet-body form">
            @include(getThemeTemplate('layout.partical.admin.error'))
            <form action="{{ route('admin.rule.update', $regulation->id) }}" method="post" class="form-horizontal form-bordered form-row-stripped">
                {{ csrf_field() }}
                <input type="hidden" name="unit" class="unit-val" value="{{ $regulation->unit }}">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">规则名称<em class="font-red">*</em></label>
                        <div class="col-md-9">
                            <input type="text" name="title" value="{{ $regulation->title }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">严重性<em class="font-red">*</em></label>
                        <div class="col-md-9">
                            <select name="severity" class="form-control" id="">
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">优先级<em class="font-red">*</em></label>
                        <div class="col-md-9">
                            <input type="text" name="priority" value="{{ $regulation->priority }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">报告完成时间<em class="font-red">*</em></label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="text" name="finished_date" value="{{ $regulation->finished_date }}" class="form-control">
                                @include(getThemeTemplate('back.system.regulation.select'),['regulation' => $regulation])
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">数据录入<em class="font-red">*</em></label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="text" name="data_entry" value="{{ $regulation->data_entry }}" class="form-control">
                                @include(getThemeTemplate('back.system.regulation.select'),['regulation' => $regulation])
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">数据质控<em class="font-red">*</em></label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="text" name="data_qc" value="{{ $regulation->data_qc }}" class="form-control">
                                @include(getThemeTemplate('back.system.regulation.select'),['regulation' => $regulation])
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">医学审评<em class="font-red">*</em></label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="text" name="medical_review" value="{{ $regulation->medical_review }}" class="form-control">
                                @include(getThemeTemplate('back.system.regulation.select'),['regulation' => $regulation])
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">医学审评QC<em class="font-red">*</em></label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="text" name="medical_qc" value="{{ $regulation->medical_qc }}" class="form-control">
                                @include(getThemeTemplate('back.system.regulation.select'),['regulation' => $regulation])
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">报告递交<em class="font-red">*</em></label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="text" name="submit" value="{{ $regulation->submit }}" class="form-control">
                                @include(getThemeTemplate('back.system.regulation.select'),['regulation' => $regulation])
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">
                                <i class="fa fa-check"></i> 确定 </button>
                            <button type="button" class="btn default" onclick="javascript:window.history.go(-1);">取消</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(function(){
        var unitInput = $('.unit-val');

        $('.unit-select-event').change(function(){
            var that = $(this);
            var val = that.val();
            var unit_val = unitInput.val();

            if(val != unit_val){
                unitInput.val(val);
                $('.unit-select-event').val(val);
            }
        });
    });
</script>

@endpush