@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="commands_list">

        @include('Sameleon.Admin.Command.__title')

        {{--@include('Sameleon.Admin.Command.__datatable.__with_options')--}}

        @livewire('sameleon.command.commands')

        @include('Sameleon.Admin.Command.__datatable.__add_command_modal')
            
        @include('Sameleon.Admin.Command.__datatable.__import_command')
            

        {{-- @each('Sameleon.Admin.Command.__datatable.__command_detail',$commands ,'command' ) --}}

    </div>
@endsection

@section('css')
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />

<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />

{{--<link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />--}}
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>


    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    
    <script src="{{ asset('js/pages/datatables.init.js') }}"></script>
    {{--<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>--}}

    <script>
           /* $(".select2").select2({
            width: '100%'
        });*/

        $(window).blur(function() {

            // Livewire.emit('runPoll');
            // console.log('run');
        });

        $(window).focus(function() {

            // Livewire.emit('closePoll');
            console.log('close');
        });

        window.addEventListener('show-edit', event => {

              $('.editCommandModal').modal('show');
          
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

    {{--@include('Sameleon.Admin.Command.js')--}}
@endpush

