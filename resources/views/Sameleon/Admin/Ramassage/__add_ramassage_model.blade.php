<div class="modal fade addRamassageModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter une demande de ramassage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('admin:ramassage.store') }}">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-lg-10">
                            <input class="form-check-input" name="newproduct" type="checkbox" id="newproduct"
                                onclick="myFunction()">
                            <label class="form-check-label" for="newproduct">
                                nouveau produit ?
                            </label>
                        </div>
                    </div>
                    <div class="row mb-4">

                        <label class="form-label col-lg-2">Choisir le produit *</label>
                        <div class="col-lg-10">
                            <select name="product" id="selectProduct"
                                class="form-control @error('product') is-invalid @enderror" required >
                                <option value="" >Choisir le produit</option>
                                @foreach ($products as $product)
                                    <option wire:key="{{ $product->id }}" value="{{ $product->id }}">
                                        {{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('product')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="row mb-4">
                        <label for="newProduct" class="col-form-label col-lg-2">Produit *</label>
                        <div class="col-lg-10">
                            <input id="newProduct" name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Entrer le nom de produit" disabled >
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="frais" class="col-form-label col-lg-2">Qte *</label>
                        <div class="col-lg-10">
                            <input id="number" name="qte" type="text"
                                class="form-control @error('qte') is-invalid @enderror"
                                placeholder="Entrer la quantité de produit" required>
                            @error('qte')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="priceProduct" class="col-form-label col-lg-2">Prix unitaire (DH) *</label>
                        <div class="col-lg-10">
                            <input id="priceProduct" name="price" type="text"
                                class="form-control @error('price') is-invalid @enderror"
                                placeholder="Entrer le prix du produit" disabled>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="profit" class="col-form-label col-lg-2">Adresse *</label>
                        <div class="col-lg-10">
                            <textarea class="form-control @error('addresse') is-invalid @enderror" id="addresse" name="addresse" rows="8"
                                placeholder="Entrer l'adresse du ramassage" required></textarea>
                            @error('addresse')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="profit" class="col-form-label col-lg-2">Note</label>
                        <div class="col-lg-10">
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="8"></textarea>
                            @error('notes')
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
