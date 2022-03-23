<div>
    <div class="modal fade editCommandModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=orderdetailsModalLabel">Editer la commande N° : {{$command->code }} </h5>
                    
                  
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    @include('Sameleon.Admin.Command.__edit.__form_edit')
                        
                </div>
            </div>
        </div>

    </div>
</div>
