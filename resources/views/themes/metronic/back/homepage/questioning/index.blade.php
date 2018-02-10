@extends(getThemeTemplate('layout.admin'))

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-green"></i>
                <span class="caption-subject font-green sbold uppercase">质疑任务</span>
            </div>
        </div>
        <div class="portlet-body">
            {!! $html->table() !!}
        </div>
    </div>
@endsection

@push('js')
<script src="{{asset('/vendor/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/vendor/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>

{!! $html->scripts() !!}

<script>
    $(function(){
        window.page = {
            reloadTable: function(){
                LaravelDataTables.dataTableBuilder.ajax.reload();
            }
        }
    });
</script>

@endpush