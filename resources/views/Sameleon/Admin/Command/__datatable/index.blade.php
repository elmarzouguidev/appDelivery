@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Command.__title')

        @livewire('sameleon.command.commands')

        @include('Sameleon.Admin.Command.__datatable.__add_command_modal')
            
        @include('Sameleon.Admin.Command.__datatable.__import_command')
            
    </div>
@endsection

@section('css')
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

{{--<link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />--}}
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>


    <script>
           /* $(".select2").select2({
            width: '100%'
        });*/
        Livewire.hook('element.updated', (fromEl, toEl, component) => {
 
            //reload_js("{{ asset('js/pages/datatables.init.js') }}");

        })
        function reload_js(src) {
            $('script[src="' + src + '"]').remove();
            $('<script>').attr('src', src).appendTo('head');
        }
        //reload_js("{{ asset('js/pages/datatables.init.js') }}");

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

        window.addEventListener('out-of-stock', event => {

            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: `Le Produit : ${event.detail.product} est en Rupture de stock`,
                showConfirmButton: false,
                timer: 2000
            })

        });

        /****Global notofy ****/
        window.addEventListener('notify-global', event => {

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: `${event.detail.message}`,
                showConfirmButton: false,
                timer: 1900
            })

        });
    </script>

    <script>
        //Warning Message
        $('.deleteCommandBtn').click(function() {
           let command = this.getAttribute('data-command');
            Swal.fire({
                title: "Est-ce que vous êtes sûr ?",
                text: "vous ne pouvez pas annuler la suppression de cette Commande !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Oui, supprimer la!"
            }).then(function(result) {
                if (result.value) {
                   
                    setTimeout(function() {
                        document.getElementById(command)
                            .submit();
                    }, 1000);

                    Swal.fire("Supprimé!", "La Commande est supprimé avec succès.", "success");
                }
            });
        });

        $('.deleteCMD').click(function() {
            console.log('Oosodododod');
            Swal.fire({
                title: "Est-ce que vous êtes sûr ?",
                text: "vous ne pouvez pas annuler la suppression !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Oui, supprimer les !"
            }).then(function(result) {
                if (result.value) {
                   
                    setTimeout(function() {
                        Livewire.emit('deleteSelectedCommand');
                    }, 2000);

                    //Swal.fire("Supprimé!", "La Commande est supprimé avec succès.", "success");
                }
            });
        });
    </script>
   <script>
    /*Livewire.on('updateStock',function() {
        alert('A post was added with the id of: ');
    })*/
    </script>
    {{--@include('Sameleon.Admin.Command.js')--}}
@endpush

