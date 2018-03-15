@extends(getThemeTemplate('layout.admin'))

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">上市后药品修改</span>
            </div>
        </div>
        <div class="portlet-body">
            {{-- 主明细 --}}
            @include(getThemeTemplate('layout.partical.admin.error'))
            <form data-url="" data-method="PUT" data-type="json">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="type" value="2">
                
                <div class="horizontal-form">
                    <div class="form-body">
                        <h4 class="form-section font-green">主明细</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">批准文号</label>
                                    <input required name="approval_number" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">商品名称（中文）</label>
                                    <input required name="product_zh_name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">商品名称（英文）</label>
                                    <input required name="product_en_name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">通用名称（中文）</label>
                                    <input required name="common_zh_name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">通用名称（英文）</label>
                                    <input required name="common_en_name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">标准化通用名称</label>
                                    <input required name="common_standard_name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">活性成分</label>
                                    <input required name="active_ingredients" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">药品分类</label>
                                    <select class="form-control" name="drug_class" id="">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">生产厂家名称</label>
                                    <select name="manufacturer" id="" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">剂型</label>
                                    <select class="form-control" name="formulation" id="">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">进口/国产</label>
                                    <select class="form-control" name="is_import" id="">
                                        <option value="1">进口</option>
                                        <option value="2">国产</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">规格</label>
                                    <input required name="specification" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">用法用量</label>
                                    <textarea name="dosage" id="" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">适应症</label>
                                    <textarea name="indications" id="" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">注册批准日</label>
                                    <input type="date" name="reg_approval_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">首次销售时间</label>
                                    <input type="date" name="first_sale_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">换证日期</label>
                                    <input type="date" name="replacement_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">给药途径</label>
                                    <select name="medication_way" id="" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">治疗人群</label>
                                    <input type="text" name="treatment_person" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">汉语拼音</label>
                                    <input type="text" name="pinyin" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">化学名</label>
                                    <input type="text" name="chemical_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">分子式</label>
                                    <input type="text" name="molecular_formula" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">分子量</label>
                                    <input type="text" name="molecular_weight" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">性状</label>
                                    <input type="text" name="trait" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">批准文号到期日</label>
                                    <input type="text" name="approval_end_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">国家</label>
                                    <select name="country" class="form-control" id=""></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">生产批号</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">生产量</label>
                                    <input type="text" name="production_quantity" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">销量</label>
                                    <input type="text" name="sales" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">销售地</label>
                                    <input type="text" name="sales_zone" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">召回数量</label>
                                    <input type="text" name="recall_num" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">实际召回数量</label>
                                    <input type="text" name="real_recall_num" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">不良反应</label>
                                    <textarea name="adverse_reactions" id="" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>  
                {{-- 主明细 end --}}          
                <hr>
                {{-- 药品管理状态 begin --}}
                <div class="horizontal-form">
                    <div class="form-body">
                        <h4 class="form-section font-green">药品管理状态</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">国家基本药物</label>
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="base_drug" name="base_drug" class="md-radiobtn" value="1">
                                            <label for="base_drug">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> 是 </label>
                                        </div>
                                        <div class="md-radio has-error">
                                            <input type="radio" id="base_drug2" name="base_drug" class="md-radiobtn" checked value="2">
                                            <label for="base_drug2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> 否 </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">国家医疗保险药品</label>
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="medical_insurance_drug" name="medical_insurance_drug" class="md-radiobtn" value="1">
                                            <label for="medical_insurance_drug">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> 是 </label>
                                        </div>
                                        <div class="md-radio has-error">
                                            <input type="radio" id="medical_insurance_drug2" name="medical_insurance_drug" class="md-radiobtn" checked value="2">
                                            <label for="medical_insurance_drug2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> 否 </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">国家非处方药</label>
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="non_prescription_drug" name="non_prescription_drug" class="md-radiobtn" value="1">
                                            <label for="non_prescription_drug">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> 是 </label>
                                        </div>
                                        <div class="md-radio has-error">
                                            <input type="radio" id="non_prescription_drug2" name="non_prescription_drug" class="md-radiobtn" checked value="2">
                                            <label for="non_prescription_drug2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> 否 </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">中药保护品种</label>
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input type="radio" id="chinese_medicine_protection_varieties" name="chinese_medicine_protection_varieties" class="md-radiobtn" value="1">
                                            <label for="radio533">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> 是 </label>
                                        </div>
                                        <div class="md-radio has-error">
                                            <input type="radio" id="chinese_medicine_protection_varieties2" name="chinese_medicine_protection_varieties" class="md-radiobtn" checked value="2">
                                            <label for="chinese_medicine_protection_varieties2">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> 否 </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">注册时间</label>
                                    <input required type="date" name="reg_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">国际诞生日</label>
                                    <input required type="date" name="international_birth_day" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">国内首次注册日期</label>
                                    <input required type="date" name="first_reg_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">新药检测期截止时间</label>
                                    <input required type="date" name="drug_testing_deadline" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">首次再注册时间</label>
                                    <input required type="date" name="first_reg_date_again" class="form-control">
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>
                {{-- 药品管理状态 end --}}
                <hr>
                {{-- 附件上传 --}}
                <div class="horizontal-form">
                    <div class="form-body">
                        <h4 class="form-section font-green">附件上传</h4>
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-4">
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
            {{-- 附件上传end --}}
            </form>
        </div>
    </div>
@endsection
