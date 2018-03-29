@foreach($query as $key=>$value)
    @if($key % 4 == 0)
        <div class="form-group">
    @endif

        @if($value['type'] == 'submit')
            <div class="col-sm-2">
                <input class="submit btn btn-danger" type="submit" value="{{$value['c_name']}}">
            </div>
        @else
            <label class="col-sm-1 control-label text-right">{{$value['c_name']}}</label>
            <div class="col-sm-2">

            @if($value['type'] == 'select')
            <select class="form-control" name="{{$value['name']}}">
                @foreach($value['option'] as $order)
                <option value="{{$order['value']}}" id="{{$order['key_word']}}">{{$order['chinese']}}</option>
                @endforeach
            </select>
            @else
                <input type="text" class="form-control" name="{{$value['name']}}">
            @endif

        @endif


    </div>
    @if($key % 4 == 3)
        </div>
    @endif
@endforeach