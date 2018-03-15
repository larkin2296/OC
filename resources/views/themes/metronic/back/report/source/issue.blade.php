<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-layers font-green"></i>
            <span class="caption-subject font-green sbold uppercase">源数据分发</span>
        </div>
    </div>
    <div class="portlet-body form">
        <form action="{{ route('admin.source.issue', $id) }}" method="post" class="form-horizontal form-bordered form-row-stripped">
            {{ csrf_field() }}
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">录入人员</label>
                    <div class="col-md-9">
                        <select name="" id="" class="form-control">
                            @foreach($data_insert_users as $user)
                                <option value="{{$user->id_hash}}">{{$user->truename}}</option>
                            @endforeach    
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">报告严重性</label>
                    <div class="col-md-9">
                        <div class="md-radio-list">
                            <div class="md-radio-inline">
                                <div class="md-radio">
                                    <input type="radio" id="radio5_1-3" name="radio5_1-3" class="md-check">
                                    <label for="radio5_1-3">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span>  死亡</label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="radio5_1-4" name="radio5_1-3" class="md-check">
                                    <label for="radio5_1-4">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span>  严重</label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="radio5_1-4" name="radio5_1-3" class="md-check">
                                    <label for="radio5_1-4">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span>  一般</label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="radio5_1-4" name="radio5_1-3" class="md-check">
                                    <label for="radio5_1-4">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span>  其他</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn green">
                            <i class="fa fa-check"></i> 发送 </button>
                        <button type="button" class="btn default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>