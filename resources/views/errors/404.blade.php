@extends('themes.metronic.layout.admin')
@push('css')
<link rel="stylesheet" href="{{ asset('backend/css/error.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12 page-404">
            <div class="number font-green"> 404 </div>
            <div class="details">
                <h3>Oops! You're lost.</h3>
                <p> {{ $exception->getMessage() }}</p>
            </div>
        </div>
    </div>
@endsection

