@extends('theme.layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Client.Company.__title')

        @include('Sameleon.Client.Company.__create.__form_create')

    </div>
@endsection

@section('css')
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    {{--<link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />--}}
@endsection

@once

    @push('scripts')
        {{--<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>--}}

        <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

        <script>
            /*$('.select2').select2({
                placeholder: 'choisir le produit',
                       
            });*/

        </script>
    @endpush

@endonce
