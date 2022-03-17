@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.City.__title')

        @include('Sameleon.Admin.City.__datatable.__with_options')

        @include('Sameleon.Admin.City.__datatable.__add_city_modal')

    </div>
@endsection

@section('css')

@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/datatables.js') }}"></script>
    <script src="{{ asset('js/pages/datatables.init.js') }}"></script>
@endpush