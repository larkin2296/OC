@foreach($arr as $key=>$value)
    @if($key % 4 == 0)
        <div class="form-group">
            @endif
                <div class="col-sm-2">
                    <input class="submit btn btn-danger p_choose" id="{{$value['platform_code']}}" type="button" value="{{$value['platform_name']}}">
                </div>
                @if($key % 4 == 3)
        </div>
    @endif
@endforeach