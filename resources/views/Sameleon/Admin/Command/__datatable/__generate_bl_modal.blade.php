<div class="modal fade generateBlModal" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">
                    Générer un Bon de livraison
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  wire:submit.prevent="generateBl" method="post" action="{{ route('admin:commands.index') }}">
                    @csrf
                    @if(isAdmin())
                        <div class="row mb-4">

                            <label class="form-label col-lg-2">Ville *</label>
                            <div class="col-lg-10">
                                <select wire:model.defer="city" name="city" class="form-control @error('city') is-invalid @enderror"
                                    required>
                                    <option value="">Choisir la ville</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->uuid }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        </div>
                    @endif

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2"></label>
                        <div class="col-lg-5">
                            <button type="submit" class="btn btn-primary">Générer</button>
                        </div>
    
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
