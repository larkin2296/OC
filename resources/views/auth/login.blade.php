@extends('layouts.app')

@section('content')
    <!-- BEGIN LOGIN FORM -->
    <div class="content-wrap">
        <h1 class="login-title">Login</h1>
        <div class="form-box">
            <form class="login-form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label visible-ie8 visible-ie9">用户名</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="请输入用户名" name="name" value="{{ old('name') }}" required autofocus />
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">密码</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="请输入密码" name="password" />
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn blue btn-block uppercase">登陆</button>
                </div>
                <div class="form-actions">
                    <div class="pull-left">
                        <label class="rememberme check">
                            <input type="checkbox" name="remember" value="1" />记住密码 </label>
                    </div>
                    <div class="pull-right forget-password-block">
                        <a href="{{ url('/password/reset') }}" id="forget-password" class="forget-password">忘记密码?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- END LOGIN FORM -->
@endsection