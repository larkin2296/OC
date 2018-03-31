<table class="table table-striped table-bordered dataTable no-footer" width="100%" cellspacing="0"  style="width: 100%;">
    <thead>
    <tr role="row">
        @foreach($panel as $val)
            <th class="sorting_asc"style="width: 60px;" data-key="{{$val['ckey']}}">{{$val['c_name']}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>

        @foreach($data as $v)
    <tr role="row" class="odd">
        <td>{{$v['oc_number']}}</td>
        <td>{{$v['name']}}</td>
        <td>{{$v['oc_code']}}</td>
        <td>{{$v['identity']}}</td>
        <td>{{$v['web_account']}}</td>
        <td>{{$v['status']}}</td>
     </tr>
        @endforeach


    </tbody>
</table>