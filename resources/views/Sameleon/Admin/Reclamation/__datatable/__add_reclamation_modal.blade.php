<div class="modal fade addReclamationModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter une ville </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('admin:complaints.store') }}">
                    @csrf
                    <div class="col-lg-2 col-md-2">
                        <label class="visually-hidden" for="clienter">Client</label>
                        <select wire:model.defer="data.client" class="form-control select2 chk-filter-client" name="client" id="clienter">
                            <option value="">Client</option>
    
                            @foreach ($commands as $client)
                                <option value="{{ $client->id }}" >
        
                                    {{ $client->full_name }}
                                </option>
                            @endforeach
    
                        </select>
                    </div>
                    <div class="row mb-4">
                        <label for="frais" class="col-form-label col-lg-2">Frais *</label>
                        <div class="col-lg-10">
                            <input id="number" name="frais" type="text"
                                class="form-control @error('frais') is-invalid @enderror"
                                placeholder="Entrer le frais de livraison" required>
                            @error('frais')
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
