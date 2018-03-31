<table class="table table-striped table-bordered dataTable no-footer" width="100%" cellspacing="0"  style="width: 100%;">
    <thead>
    <tr role="row">
        @foreach($panel as $val)
            <th class="sorting_asc"style="width: 60px;" data-key="{{$val['ckey']}}">{{$val['c_name']}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @if($data != null)
        @foreach($data as $v)
    <tr role="row" class="odd">
        @foreach($table as $d)
        <td>{{$v["{$d['ckey']}"]}}</td>
            @endforeach
     </tr>
        @endforeach
        @endif

    </tbody>
</table>