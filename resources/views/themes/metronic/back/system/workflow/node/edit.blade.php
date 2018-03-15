@extends(getThemeTemplate('layout.admin'))

@section('content')
<div class="portlet light bordered form-fit">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">@lang('module/workflow.node.edit.title')</span>
            </div>
        </div>
        <div class="portlet-body form">
            @include(getThemeTemplate('layout.partical.admin.error'))
            <form action="{{ route('admin.workflow.node.update', $workflowNode->id_hash) }}" method="post" class="form-horizontal form-bordered form-row-stripped">
            	{{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">流程名称</label>
                        <div class="col-md-9">
                            <input type="text" name="name" value="{{old('name', $workflowNode->name)}}" placeholder="@lang('field/workflownode.name.placeholder')" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">流程名称(英文)</label>
                        <div class="col-md-9">
                            <input type="text" name="en_name" value="{{old('en_name', $workflowNode->en_name)}}" placeholder="@lang('field/workflownode.en_name.placeholder')" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">是否启用短信通知</label>
                        <div class="col-md-9">
                            <select class="form-control" name="is_message_notice" id="">
                                @include(getThemeTemplate('layout.partical.admin.option'), ['options' => $commonChecks, 'selected' => old('is_message_notice', $workflowNode->is_message_notice)])
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">是否启用Email通知</label>
                        <div class="col-md-9">
                            <select class="form-control" name="is_email_notice" id="">
                                @include(getThemeTemplate('layout.partical.admin.option'), ['options' => $commonChecks, 'selected' => old('is_email_notice', $workflowNode->is_email_notice)])
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">组织结构</label>
                        <div class="col-md-9">
                            <select class="form-control" name="organize_role_id" id="">
                                @include(getThemeTemplate('layout.partical.admin.option'), ['options' => $roleOrganizes, 'selected' => old('organize_role_id', $workflowNode->organize_role_id)])
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">角色</label>
                        <div class="col-md-9">
                            <select class="form-control" name="role_id" id="">
                                @include(getThemeTemplate('layout.partical.admin.option'), ['options' => $roles, 'selected' => old('role_id', $workflowNode->role_id)])
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">规则</label>
                        <div class="col-md-9">
                            <textarea name="rule" class="form-control" placeholder="@lang('field/workflownode.rule.placeholder')">{{ old('rule', $workflowNode->rule) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">描述</label>
                        <div class="col-md-9">
                            <textarea name="description" rows="3" class="form-control" placeholder="@lang('field/workflownode.description.placeholder')">{{ old('description', $workflowNode->description) }}</textarea>
                        </div>
                    </div>
                    
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">
                                <i class="fa fa-check"></i> @lang('module/workflow.node.edit.submit') </button>
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
        var link_select_el = $('#link-select-event'),
            link_child_select_el = $('#link-child-select');
        var orgCache = {};

        //联动--组织结构联动角色
        link_select_el.change(function(){
            var el = $(this);
            var val = el.val();
            var url = el.attr('data-url');
            var method = el.attr('data-method');
            if(orgCache['org_'+val] == undefined){
                PVJs.ajax({
                    url: url + '/' + val,
                    type: method,
                    success: function(resp){
                       if(resp.result){
                            orgCache['org_'+val] = resp.data;
                            PVJs.rendre.optionFn(link_child_select_el,resp.data,{
                                name: 'id',
                                value: 'name'
                            });
                       }
                    }
                })
            }else{
                PVJs.rendre.optionFn(link_child_select_el,orgCache['org_'+val],{
                    name: 'id',
                    value: 'name'
                })
            }
        })
    })
</script>
@endpush