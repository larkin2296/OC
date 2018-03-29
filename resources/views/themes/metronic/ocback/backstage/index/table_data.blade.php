<table class="table table-striped table-bordered dataTable no-footer" width="100%" cellspacing="0"  style="width: 100%;">
    <thead>
    <tr role="row">
        @foreach($panel as $val)
            <th class="sorting_asc"style="width: 60px;" data-key="{{$val['ckey']}}">{{$val['c_name']}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    <tr role="row" class="odd">
        <td class="sorting_1">Airi Satou</td>
        <td>Accountant</td>
        <td>Tokyo</td>
        <td>33</td>
        <td>2008/11/28</td>
    </tr>
    </tbody>
</table>