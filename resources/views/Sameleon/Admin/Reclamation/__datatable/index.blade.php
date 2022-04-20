@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="commands_list">

        @include('Sameleon.Admin.Reclamation.__title')

        {{-- @include('Sameleon.Admin.Reclamation.__datatable.__with_options') --}}

        @livewire('sameleon.reclamation.reclamation')

        {{--@include('Sameleon.Admin.Reclamation.__datatable.__add_reclamation_modal')--}}
        
        {{-- @each('Sameleon.Admin.Reclamation.__datatable.__command_detail',$commands ,'command' ) --}}

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

    <script>
        //Warning Message
        $('.deleteCommandBtn').click(function() {
            Swal.fire({
                title: "Est-ce que vous êtes sûr ?",
                text: "vous ne pouvez pas annuler la suppression de cette Commande !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Oui, supprimer le!"
            }).then(function(result) {
                if (result.value) {
                    Swal.fire("Supprimé!", "La Commande est supprimé avec succès.", "success");


                    setTimeout(function() {
                        document.getElementById('delete-invoice-single-')
                            .submit();
                    }, 2000);
                }
            });
        });
    </script>
@endpush
