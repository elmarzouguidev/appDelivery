<div class="modal fade attachCommandModal" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Envoyer les commands au livreur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="attachToDelivery" method="post" action="{{ route('admin:commands.index') }}">
                    @csrf
                    <div class="row mb-4">

                        <label class="form-label col-lg-4">Choisir le livreuer *</label>
                        <div class="col-lg-8">
                            <select wire:model.defer="selectedDelivery" name="selectedDelivery" class="form-control @error('selectedDelivery') is-invalid @enderror"
                                required>
                                <option value="">Choisir le livreuer *</option>
                                @foreach ($delivries as $delivery)
                                    <option value="{{ $delivery->id }}">{{ $delivery->full_name }} ({{$delivery->type}})</option>
                                @endforeach
                            </select>
                            @error('selectedDelivery')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
