@foreach($register as $key=>$value)
    @switch($value['type'])
        @case('text')
        <div class="form-group{{ $errors->has($key) ? 'has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">{{$value['c_name']}}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="{{$key}}" value="{{ old($key) }}" required autofocus>

                @if ($errors->has($key))
                    <span class="help-block">
                                        <strong>{{ $errors->first($key) }}</strong>
                                    </span>
                @endif
            </div>
        </div>
            @break
        @case('select')
            @break
        @case('radio')
        <div class="form-group{{ $errors->has($key) ? ' has-error' : '' }}">
            <label for="sex" class="col-md-4 control-label">{{$value['c_name']}}</label>

            <div class="col-md-6">
                @foreach($value['content'] as $v)
                {{$v['c_name']}}：<input id="{{$v['key']}}" type="radio" class="form-control" name="{{$key}}" value="{{$v['value']}}" required autofocus>
                @endforeach
                @if ($errors->has($key))
                    <span class="help-block">
                                        <strong>{{ $errors->first($key) }}</strong>
                                    </span>
                @endif
            </div>
        </div>
            @break
        @case('checkbox')
            @break
        @case('password')
        <div class="form-group{{ $errors->has($key) ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">{{$value['c_name']}}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has($key))
                    <span class="help-block">
                                        <strong>{{ $errors->first($key) }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">确认密码</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>
            @break
        @default
        @endswitch
    @endforeach
