@extends('layouts.app')

@section('content')
<!-- BEGIN FORGOT PASSWORD FORM -->
    <div class="content-wrap">
        <h1 class="login-title">重置密码</h1>
        <div class="form-box">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="forget-form"  method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div class="form-title">
                    <span class="form-title">忘记密码 ?</span>
                    <span class="form-subtitle">请输入您注册时使用的邮箱地址.</span>
                </div>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix{{ $errors->has('email') ? ' has-error' : '' }}" type="text" autocomplete="off" placeholder="请输入邮箱"  name="email" value="{{ old('email') }}" required />
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-actions">
                    <a  href="{{ url('/login') }}" id="back-btn" class="btn btn-default">返回登陆</a>
                    <button type="submit" class="btn btn-primary uppercase pull-right disabled">确定</button>
                </div>
            </form>
        </div>
    </div>
    
<!-- END FORGOT PASSWORD FORM -->
@endsection
