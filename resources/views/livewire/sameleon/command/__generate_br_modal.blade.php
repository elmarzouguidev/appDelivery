<div class="modal fade generateBRModal" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">
                    Générer un Bon de Retour
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  wire:submit.prevent="generateBR" method="post" action="{{ route('admin:commands.index') }}">
                    @csrf
                    @if(isAdmin())
                        <div class="row mb-4">

                            <label class="form-label col-lg-2">Client *</label>
                            <div class="col-lg-10">
                                <select wire:model="brClient" name="client" class="form-control @error('client') is-invalid @enderror"
                                    required>
                                    <option value="">Choisir le client</option>
                                    @foreach ($clients as $client)
                                        <option data-client-uuid="{{ $client->uuid }}" value="{{ $client->uuid }}">{{ $client->full_name }}</option>
                                    @endforeach
                                </select>
                                @error('client')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        </div>
                    @endif
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2"></label>
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary">Générer</button>
                        </div>
    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
