@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Stock.__title')

        {{-- @include('Sameleon.Admin.Stock.__datatable.__with_options') --}}

        @livewire('sameleon.stock.stock')

    </div>
@endsection

@section('css')

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.js') }}"></script>
    <script src="{{ asset('js/pages/datatables.init.js') }}"></script>

    <script>
        $(window).blur(function() {

            // Livewire.emit('runPoll');
            // console.log('run');
        });

        $(window).focus(function() {

            // Livewire.emit('closePoll');
            console.log('close');
        });

        window.addEventListener('show-edit-stock', event => {
            $('.editstockModal').modal('show');
        });

        window.addEventListener('hidden.bs.modal', event => {
            //$("#commands_list").load(window.location.href + " #commands_list");

            window.location.reload();
        });

        window.addEventListener('status-updated', event => {
            //$("#commands_list").load(window.location.href + " #commands_list");
            setTimeout(function() {
                window.location.reload();
            }, 3000);

        });

        window.addEventListener('notify-change', event => {

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Le Stock est modifier avec succès. ',
                showConfirmButton: false,
                timer: 1900
            })

        });
    </script>
@endpush
