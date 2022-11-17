<div class="modal fade addRegionModal" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter une Région </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form  method="post" action="{{ route('admin:regions.store') }}">
                    @csrf
                    <div class="row mb-4">

                        <label class="form-label col-lg-2">Ville *</label>
                        <div class="col-lg-10">
                            <select wire:model="city" name="city" class="form-control @error('city') is-invalid @enderror"
                                required>
                                <option value="0" disabled>Choisir la ville</option>
                                @foreach ($cities as $city)
                                    <option wire:key="{{ $city->id }}" value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                    </div>
                    <div class="row mb-4">
                        <label for="cityPrice" class="col-form-label col-lg-2">Prix de ville</label>
                        <div class="col-lg-10">
                            <input id="number" wire:model="total" type="text"
                                class="form-control @error('cityPrice') is-invalid @enderror"
                                  disabled>
                            @error('cityPrice')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="code" class="col-form-label col-lg-2">Référence </label>
                        <div class="col-lg-10">
                            <input id="code" name="code" type="text"
                                class="form-control @error('code') is-invalid @enderror"
                                placeholder="Entrer le référence de la région">
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="name" class="col-form-label col-lg-2">Nom *</label>
                        <div class="col-lg-10">
                            <input id="name" name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Entrer le nom de la région" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="frais" class="col-form-label col-lg-2">Frais *</label>
                        <div class="col-lg-10">
                            <input id="frais" name="frais" type="number"
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
