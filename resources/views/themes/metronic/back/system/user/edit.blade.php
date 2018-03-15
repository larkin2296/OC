@extends(getThemeTemplate('layout.admin'))

@section('content')
    <div class="portlet light bordered form-fit">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">@lang('module/user.edit.title')</span>
            </div>
        </div>
        <div class="portlet-body form">
            @include(getThemeTemplate('layout.partical.admin.error'))
            <form action="{{ route('admin.user.update', [$user->id_hash]) }}" method="post" class="form-horizontal form-bordered form-row-stripped">
            	{{ csrf_field() }}
				{{ method_field('PUT')}}
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">账号</label>
                        <div class="col-md-9">
                            <input type="text" name="name" value="{{old('name', $user->name)}}" placeholder="@lang('field/user.name.placeholder')" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">真实姓名</label>
                        <div class="col-md-9">
                            <input type="text" name="truename" value="{{old('truename', $user->truename)}}" placeholder="@lang('field/user.truename.placeholder')" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">角色</label>
                        <div class="col-md-9">
                            @include(getThemeTemplate('back.system.role.select-by-user'), ['roles' => $roles, 'selected' => old('role', $userRoles) ])
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">性别</label>
                        <div class="col-md-9">
                            <select class="form-control" name="sex" id="">
								@include(getThemeTemplate('layout.partical.admin.option'), ['options' => $sexes, 'selected' => old('sex', $user->sex)])
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">手机号</label>
                        <div class="col-md-9">
                            <input type="text" name="mobile" value="{{old('mobile', $user->mobile)}}" placeholder="@lang('field/user.mobile.placeholder')" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">邮箱</label>
                        <div class="col-md-9">
                            <input type="text" name="email" value="{{old('email', $user->email)}}" placeholder="@lang('field/user.email.placeholder')" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">公司</label>
                        <div class="col-md-9">
                            <select class="form-control" name="company" id="">
								@include(getThemeTemplate('layout.partical.admin.option'), ['options' => $companies->pluck('display_name', 'id'), 'selected' => old('company', $user->company_id)])
							</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">是否邮箱验证</label>
                        <div class="col-md-9">
                            <select class="form-control" name="is_check_email" id="">
        						@include(getThemeTemplate('layout.partical.admin.option'), ['options' => $commonChecks, 'selected' => old('is_check_email', $user->is_check_email)])
        					</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">备注</label>
                        <div class="col-md-9">
                            <textarea class="form-control" rows="3" name="notes" placeholder="@lang('field/user.notes.placeholder')">{{old('notes', $user->notes)}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">
                                <i class="fa fa-check"></i> @lang('module/user.edit.submit') </button>
                            <button type="button" class="btn default" onclick="javascript:window.history.go(-1);">取消</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection