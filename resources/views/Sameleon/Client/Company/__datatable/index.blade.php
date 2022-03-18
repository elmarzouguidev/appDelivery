@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Client.Company.__title')

        @include('Sameleon.Client.Company.__datatable.__with_options')

        @if(!$company)
          @include('Sameleon.Client.Company.__datatable.__add_company_modal')
        @endif

        @if($company)
          @include('Sameleon.Client.Company.__datatable.__edit_company_modal')
        @endif

    </div>
@endsection

@section('css')

@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/datatables.js') }}"></script>
    <script src="{{ asset('js/pages/datatables.init.js') }}"></script>
@endpush