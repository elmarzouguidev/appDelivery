<div class="modal fade responseReclamationModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Repondu a la réclamation </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form wire:submit.prevent="saveResponse()" method="post">
                    @csrf
                    <div class="row mb-4">
                        <label for="message" class="col-form-label col-lg-2">N° du Command *</label>
                        <div class="col-lg-10">
                        
                            <input type="text" class="form-control" value="{{$reclamation->command->code}}" readonly>

                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="message" class="col-form-label col-lg-2">Nom du client *</label>
                        <div class="col-lg-10">
                        
                            <input type="text" class="form-control" value="{{optional($reclamation->user)->full_name}}" readonly>

                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="message" class="col-form-label col-lg-2">Message du client *</label>
                        <div class="col-lg-10">
                        
                            <textarea class="form-control" readonly>{{$reclamation->message}}</textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <label for="response" class="col-form-label col-lg-2">Votre réponse *</label>
                        <div class="col-lg-10">
                        
                            <textarea class="form-control" name="response" wire:model.defer="response" required></textarea>
                            @error('response')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
