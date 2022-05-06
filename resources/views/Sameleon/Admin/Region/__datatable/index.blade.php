@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Region.__title')

        {{--@include('Sameleon.Admin.City.__datatable.__with_options')--}}

        @include('Sameleon.Admin.Region.__datatable.__add_region_modal')

        @livewire('sameleon.city.city')

    </div>
@endsection

@section('css')

@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/datatables.js') }}"></script>
    <script src="{{ asset('js/pages/datatables.init.js') }}"></script>

    <script>


        window.addEventListener('show-edit', event => {
            $('.editCityModal').modal('show');
        });

        window.addEventListener('hidden.bs.modal', event => {
            //$("#commands_list").load(window.location.href + " #commands_list");

            window.location.reload();
        });

        window.addEventListener('show-edit-status', event => {
            $('.updateStatus').modal('show');
        });

        window.addEventListener('status-updated', event => {
            //$("#commands_list").load(window.location.href + " #commands_list");
            setTimeout(function() {
                window.location.reload();
            }, 3000);

        });

        window.addEventListener('status-reported', event => {
            $('.isReportedModal').modal('show');
        });

        window.addEventListener('notify-change', event => {

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Le Status est modifier avec succès. ',
                showConfirmButton: false,
                timer: 1900
            })

        });
    </script>

@endpush