@extends(getThemeTemplate('layout.admin'))

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">工作流配置</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided" data-toggle="buttons">
                    <a href="javascript:;" onclick="javascript:window.history.go(-1);" class="btn blue btn-outline btn-circle btn-sm"><i class="fa fa-arrow-left"></i>返回</a>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            
            <div class="setting-wrap clearfix">
                {{-- BIGIN TIMELINE  --}}
                <div class="timeline">
                    <!-- TIMELINE ITEM -->
                    <div class="timeline-item">
                        <div class="timeline-badge">
                            <div class="timeline-icon">
                                <i class="glyphicon glyphicon-play-circle font-green-haze"></i>
                            </div>
                        </div>
                        <div class="timeline-body">
                            <div class="timeline-body-arrow"> </div>
                            <div class="timeline-body-head">
                                <div class="timeline-body-head-caption">
                                    <span class="timeline-body-alerttitle font-red-intense">开始</span>
                                </div>
                                <div class="timeline-body-head-actions">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.workflow.node.create') }}" class="btn btn-circle green btn-outline btn-sm"> <i class="fa fa-plus"></i>新增
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-body-content">
                                
                            </div>
                        </div>
                    </div>
                    <!-- END TIMELINE ITEM -->
                    @if($workflowNodes->isNotEmpty())
                        @foreach($workflowNodes as $workflowNode)

                            <div class="timeline-item">
                                <div class="timeline-badge">
                                    <div class="timeline-icon">
                                        <i class="glyphicon glyphicon-bookmark font-green-haze"></i>
                                    </div>
                                </div>
                                <div class="timeline-body">
                                    <div class="timeline-body-arrow"> </div>
                                    <div class="timeline-body-head">
                                        <div class="timeline-body-head-caption">
                                            <span class="timeline-body-alerttitle font-red-intense">{{ $workflowNode->name }}</span>
                                            <span class="timeline-body-time font-grey-cascade">创建时间：{{ $workflowNode->created_at }}</span>
                                        </div>
                                        <div class="timeline-body-head-actions">
                                            <div class="btn-group">
                                                <button class="btn btn-circle green btn-outline btn-sm dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> 操作
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li>
                                                        <a href="{{ route('admin.workflow.node.create',['prev_node'=>$workflowNode->id_hash]) }}" title="新增">新增 </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.workflow.node.edit', [$workflowNode->id_hash]) }}" title="修改">修改 </a>
                                                    </li>
                                                    <li class="divider"> </li>
                                                    <li>
                                                        <a href="javascript:;" data-url="{{ route('admin.workflow.node.destroy',[$workflowNode->id_hash]) }}" data-method="delete" data-confirm="" data-type="json" title="删除">删除 </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline-body-content">
                                        <div class="font-grey-cascade"> 
                                            <span class="margin-right-20">
                                                启用短信通知: 
                                                @if($workflowNode->is_message_notice == 1)
                                                <i class="badge badge-primary">是</i>
                                                @else
                                                <i class="badge badge-danger">否</i>
                                                @endif
                                            </span>
                                            <span class="margin-right-20">
                                                启用Email通知: 
                                                @if($workflowNode->is_email_notice == 1)
                                                <i class="badge badge-primary">是</i>
                                                @else
                                                <i class="badge badge-danger">否</i>
                                                @endif
                                            </span>
                                        </div>
                                        @if(isset($workflowNode->description))
                                        <div class="font-grey-cascade margin-top-10">
                                          <b>描述：</b> 
                                          <div>{{ $workflowNode->description }}</div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <!-- END TIMELINE ITEM -->
                    <div class="timeline-item">
                        <div class="timeline-badge">
                            <div class="timeline-icon">
                                <i class="glyphicon glyphicon-off font-green-haze"></i>
                                {{-- <span>结束</span> --}}
                            </div>
                        </div>
                    </div>
                    <!-- END -->
                </div>
                <!-- END TIMELINE -->
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    $(function(){
        PVJs.tableAction($('.setting-wrap'),function(resp,el){
            if(el.attr('data-method') == 'delete'){
                window.location.reload();
            }
        })
    })
</script>
@endpush