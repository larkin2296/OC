@extends('layouts.master')

@section('content')
    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Serial</th>
            <th>Chinese</th>
            <th>English</th>
            <th>Forpage</th>
            <th>Structure</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.dictionaries.builder') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'serial', name: 'serial' },
                { data: 'chinese', name: 'chinese' },
                { data: 'english', name: 'english' },
                { data: 'forpage', name: 'forpage' },
                { data: 'structure', name: 'structure' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' }
            ]
        });
    });
</script>
@endpush