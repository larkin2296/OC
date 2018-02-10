@extends(getThemeTemplate('layout.admin'))

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">上市前药品添加</span>
            </div>
        </div>
        <div class="portlet-body">
            @include(getThemeTemplate('layout.partical.admin.error'))
            <form data-url="" data-method="put" data-type="json">
                <input type="hidden" name="type" value="1">
                {{ csrf_field() }}
                {{ method_field('PUT')}}
                {{-- 主明细 --}}
                <div class="horizontal-form">
                    <div class="form-body">
                        <h4 class="form-section font-green">主明细</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">通用名称（中文）<em class="font-red">*</em></label>
                                    <input required type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">通用名称（英文）<em class="font-red">*</em></label>
                                    <input required type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">标准化通用名称<em class="font-red">*</em></label>
                                    <input required type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">活性成分<em class="font-red">*</em></label>
                                    <input required type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">药品分类<em class="font-red">*</em></label>
                                    <select class="form-control" name="" id="">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">生产厂商<em class="font-red">*</em></label>
                                    <select class="form-control" name="" id="">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">剂型<em class="font-red">*</em></label>
                                    <select class="form-control" name="" id="">
                                        
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>  
                <hr>
                {{-- 主明细 end --}}
                {{-- 附件上传 --}}
                <div class="horizontal-form">
                    <div class="form-body">
                        <h4 class="form-section font-green">附件上传</h4>
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a href="javascript:;" class="btn sbold green"><i class="fa fa-upload"></i>上传附件</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead >
                                <tr>
                                    <th>名称</th>
                                    <th>大小</th>
                                    <th>分类</th>
                                    <th>类型</th>
                                    <th>上传时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>source.pdf</td>
                                    <td>130.00 KB</td>
                                    <td>重症病</td>
                                    <td>0</td>
                                    <td>2017-11-11 13:13:13</td>
                                    <td>
                                        <div class="table-tr-buttons">
                                            <a data-toggle="tooltip" data-placement="bottom" title="删除"><span class="fa fa-trash font-green"></span></a>
                                            <a data-toggle="tooltip" data-placement="bottom" title="修改"><span class="fa fa-pencil font-green"></span></a>    
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="form-actions text-center margin-top-20">
                        <button type="submit" class="btn green">保存</button>
                        <button type="button" class="btn default" onclick="javascript:window.history.go(-1);">取消</button>
                    </div>
                </div>  
            </form>
            {{-- 附件上传end --}}
        </div>
    </div>
@endsection
