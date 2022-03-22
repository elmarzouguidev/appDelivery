@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="commands_list">

        @include('Sameleon.Admin.Command.__title')

        {{-- @include('Sameleon.Admin.Command.__datatable.__with_options') --}}

        @livewire('sameleon.command.commands')

        @include(
            'Sameleon.Admin.Command.__datatable.__add_command_modal'
        )

        {{--@each('Sameleon.Admin.Command.__datatable.__command_detail',$commands ,'command' )--}}

    </div>
@endsection

@section('css')
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.js') }}"></script>
    <script src="{{ asset('js/pages/datatables.init.js') }}"></script>
    
@endpush
