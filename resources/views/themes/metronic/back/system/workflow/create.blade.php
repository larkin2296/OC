@extends(getThemeTemplate('layout.admin'))

@section('content')
<div class="portlet light bordered form-fit">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">@lang('module/workflow.create.title')</span>
            </div>
        </div>
        <div class="portlet-body form">
            @include(getThemeTemplate('layout.partical.admin.error'))
            <form action="{{ route('admin.workflow.store') }}" method="post" class="form-horizontal form-bordered form-row-stripped">
            	{{ csrf_field() }}
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">名称</label>
                        <div class="col-md-9">
                            <input type="text" name="name" value="{{old('name')}}" placeholder="@lang('field/workflow.name.placeholder')" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">是否有效</label>
                        <div class="col-md-9">
                            <select class="form-control" name="status" id="">
                                @include(getThemeTemplate('layout.partical.admin.option'), ['options' => $commonChecks, 'selected' => old('status')])
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">是否默认</label>
                        <div class="col-md-9">
                            <select class="form-control" name="is_use" id="">
                                @include(getThemeTemplate('layout.partical.admin.option'), ['options' => $commonChecks, 'selected' => old('is_use')])
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">
                                <i class="fa fa-check"></i> @lang('module/workflow.create.submit') </button>
                            <button type="button" class="btn default" onclick="javascript:window.history.go(-1);">取消</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection