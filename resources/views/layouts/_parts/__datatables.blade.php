@section('css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

   <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />


@endsection

@push('scripts')

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

    <script>
        //Warning Message
        $('.activeUser').change(function() {

                let messageTitle ='';
                let messageText ='';
                let messageConfirm ='';
                let messageRetour ='';

                if(this.checked == true)
                {
                    messageTitle = "Est-ce que vous êtes sûr ?";
                    messageText  = "Activé le compte du client";

                    messageConfirm  = "Oui, activer le!";

                    messageRetour  = "Activé!";
                }
                else{

                    messageTitle = "Est-ce que vous êtes sûr ?";
                    messageText = "Désactivé le compte du client"  ;
                    messageConfirm  = "Oui, Désactivé le!";

                    messageRetour  = "Désactivé !";
                }

                let userCompte = this.getAttribute('data-client');

                Swal.fire({
                    title: messageTitle,
                    text: messageText,
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: messageConfirm

                }).then(function(result) {

                    if (result.value) {

                        //console.log(`activate-client-${userCompte}`);

                        setTimeout(function() {
                            document.getElementById(`activate-client-${userCompte}`)
                                .submit();
                        }, 1000);

                        Swal.fire(messageRetour, `Le client est ${messageRetour} avec succès.`, "success");
                    }
                });
            
        });
    </script>
@endpush
