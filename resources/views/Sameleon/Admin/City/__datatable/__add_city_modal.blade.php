<div class="modal fade addCityModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter une ville </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('admin:cities.store') }}">
                    @csrf
                    <div class="row mb-4">
                            <div class="col-lg-10">
                                <input class="form-check-input"
                                name="has_profit" 
                                type="checkbox" 
                                id="has_profit"
                                onclick="myFunction()"
                              
                            >
                            <label class="form-check-label" for="has_profit">
                                ajouter le profit ?
                            </label>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="name" class="col-form-label col-lg-2">Nom *</label>
                        <div class="col-lg-10">
                            <input id="name" name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Entrer le nom de la ville" required>
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
                    
                    <div class="row mb-4">
                        <label for="profit" class="col-form-label col-lg-2">Profit</label>
                        <div class="col-lg-10">
                            <input id="profit" name="profit" type="text"
                                class="form-control @error('profit') is-invalid @enderror"
                                placeholder="Entrer le profit de livraison" disabled>
                            @error('profit')
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
