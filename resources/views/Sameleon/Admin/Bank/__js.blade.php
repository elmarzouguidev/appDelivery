@section('css')
   <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
   
@endsection

@push('scripts')

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        //Warning Message
        $('.activeBank').change(function() {

                let messageTitle ='';
                let messageText ='';
                let messageConfirm ='';
                let messageRetour ='';

                if(this.checked == true)
                {
                    messageTitle = "Est-ce que vous êtes sûr ?";
                    messageText  = "Activé la banque";

                    messageConfirm  = "Oui, activer la !";

                    messageRetour  = "Activé !";
                }
                else{

                    messageTitle = "Est-ce que vous êtes sûr ?";
                    messageText = "Désactivé la banque "  ;
                    messageConfirm  = "Oui, Désactivé la!";

                    messageRetour  = "Désactivé !";
                }

                let bankCompte = this.getAttribute('data-bank');

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

                        //console.log(`activate-bank-${bankCompte}`);

                        setTimeout(function() {
                            document.getElementById(`activate-bank-${bankCompte}`)
                                .submit();
                        }, 1000);

                        Swal.fire(messageRetour, `La banque est ${messageRetour} avec succès.`, "success");
                    }
                });
            
        });
    </script>
@endpush