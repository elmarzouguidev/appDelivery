@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Reclamation.__title')

        @livewire('sameleon.reclamation.reclamation')

    </div>
@endsection

@section('css')

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@push('scripts')

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    {{--<script src="{{ asset('assets/libs/datatables.js') }}"></script>
    <script src="{{ asset('js/pages/datatables.init.js') }}"></script>--}}

    <script>

        window.addEventListener('response-modal', event => {
            $('.responseReclamationModal').modal('show');
        });

        window.addEventListener('hidden.bs.modal', event => {

            window.location.reload();
        });

        window.addEventListener('reloadbrowser', event => {

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'La réponse a été  est enregistrer avec succès. ',
                showConfirmButton: false,
                timer: 1900
            })

        });

    </script>

@endpush
