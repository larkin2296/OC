<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i> 相关病史</div>
        <div class="tools">
            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
        </div>
    </div>
    <div class="portlet-body">
        {{-- tools  --}}
        <div class="table-toolbar">
            <div class="btn-group">
                <a href="javascript:;" class="btn sbold green"><i class="fa fa-upload"></i>导入</a>
            </div>
        </div>
        {{-- tools end --}}
        {{-- form info --}}
        <div class="horizontal-form">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">相关重要信息</label>
                            <div class="md-checkbox-list">
                                <div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="checkbox3_4-1" class="md-check">
                                        <label for="checkbox3_4-1">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>  吸烟史</label>
                                    </div>
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="checkbox3_4-2" class="md-check">
                                        <label for="checkbox3_4-2">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>  饮酒史</label>
                                    </div>
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="checkbox3_4-3" class="md-check">
                                        <label for="checkbox3_4-3">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>  妊娠史</label>
                                    </div>
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="checkbox3_4-4" class="md-check">
                                        <label for="checkbox3_4-4">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>  肝病史</label>
                                    </div>
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="checkbox3_4-5" class="md-check">
                                        <label for="checkbox3_4-5">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>  肾病史</label>
                                    </div>
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="checkbox3_4-6" class="md-check">
                                        <label for="checkbox3_4-6">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>  过敏史</label>
                                    </div>
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="checkbox3_4-7" class="md-check">
                                        <label for="checkbox3_4-7">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>  其他</label>
                                    </div>
                                    <div class="md-checkbox">
                                       <input type="text" class="form-control">
                                    </div>
                                    
                                </div>    
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{-- form info end --}}
        {{-- table --}}
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th class="text-center">疾病名称</th>
                        <th class="text-center">PT值</th>
                        <th class="text-center">开始日期</th>
                        <th class="text-center">病史类型</th> 
                        <th class="text-center">药品名称</th> 
                        <th class="text-center">WHODD编码值</th>
                        <th class="text-center">用药原因</th>
                        <th class="text-center">用药原因PT</th>
                        <th class="text-center">不良反应</th>
                        <th class="text-center">不良反应PT</th>
                        <th class="text-center" style="width: 130px;">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>疾病名称</td>
                        <td>PT值</td>
                        <td>开始日期</td>
                        <td>病史类型</td> 
                        <td>药品名称</td> 
                        <td>WHODD编码值</td>
                        <td>用药原因</td>
                        <td>用药原因PT</td>
                        <td>不良反应</td>
                        <td>不良反应PT</td>
                        <td>
                            <div class="table-tr-buttons">
                                <a href="javascript:;" data-toggle="tooltip" data-placement="bottom" title="修改"><span class="fa fa-pencil font-green"></span></a>
                                <a data-url="" data-toggle="tooltip" data-placement="bottom" data-method="delete" data-reload="true" data-confirm="" data-type="json" title="删除"><span class="fa fa-trash font-green"></span></a>
                                <a data-url="" data-toggle="tooltip" data-placement="bottom" data-method="put" data-confirm="" data-type="json" title="复制"><span class="fa fa-clipboard font-green"></span></a>
                                <a  data-toggle="tooltip" data-placement="bottom" data-method="put" data-confirm="" data-type="json" title="上移"><span class="fa fa-arrow-up font-blue"></span></a>
                                <a  data-toggle="tooltip" data-placement="bottom" data-method="put" data-confirm="" data-type="json" title="下移"><span class="fa fa-arrow-down font-blue"></span></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>疾病名称</td>
                        <td>PT值</td>
                        <td>开始日期</td>
                        <td>病史类型</td> 
                        <td>药品名称</td> 
                        <td>WHODD编码值</td>
                        <td>用药原因</td>
                        <td>用药原因PT</td>
                        <td>不良反应</td>
                        <td>不良反应PT</td>
                        <td>
                            <div class="table-tr-buttons">
                                <a href="javascript:;" data-toggle="tooltip" data-placement="bottom" title="修改"><span class="fa fa-pencil font-green"></span></a>
                                <a data-url="" data-toggle="tooltip" data-placement="bottom" data-method="delete" data-reload="true" data-confirm="" data-type="json" title="删除"><span class="fa fa-trash font-green"></span></a>
                                <a data-url="" data-toggle="tooltip" data-placement="bottom" data-method="put" data-confirm="" data-type="json" title="复制"><span class="fa fa-clipboard font-green"></span></a>
                                <a  data-toggle="tooltip" data-placement="bottom" data-method="put" data-confirm="" data-type="json" title="上移"><span class="fa fa-arrow-up font-blue"></span></a>
                                <a  data-toggle="tooltip" data-placement="bottom" data-method="put" data-confirm="" data-type="json" title="下移"><span class="fa fa-arrow-down font-blue"></span></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- table end --}}
    </div>
</div>