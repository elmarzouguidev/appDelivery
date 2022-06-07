@section('css')
   <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
   
@endsection

@push('scripts')

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        //Warning Message
        $('.activeIntegration').change(function() {

                let messageTitle ='';
                let messageText ='';
                let messageConfirm ='';
                let messageRetour ='';

                if(this.checked == true)
                {
                    messageTitle = "Est-ce que vous êtes sûr ?";
                    messageText  = "Activé le module d'intégration";

                    messageConfirm  = "Oui, activer le!";

                    messageRetour  = "Activé!";
                }
                else{

                    messageTitle = "Est-ce que vous êtes sûr ?";
                    messageText = "Désactivé le module d'intégration";
                    messageConfirm  = "Oui, Désactivé le!";

                    messageRetour  = "Désactivé !";
                }

                let inetgrationId = this.getAttribute('data-integration');

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

                        //console.log(`activate-client-${inetgrationId}`);

                        setTimeout(function() {
                            document.getElementById(`activate-integration-${inetgrationId}`)
                                .submit();
                        }, 1000);

                        Swal.fire(messageRetour, `Le module est ${messageRetour} avec succès.`, "success");
                    }
                });
            
        });
    </script>
@endpush