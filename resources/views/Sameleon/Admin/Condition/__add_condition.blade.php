<div class="modal fade addConditionModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter une Condition </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('admin:conditions.store') }}">
                    @csrf
                    <div class="row mb-4">
                        <label for="type" class="col-form-label col-lg-2">type *</label>
                        <div class="col-lg-10">
                            <select name="type" class="form-control select2-templating @error('type') is-invalid @enderror" required>
                                <option value="">Choisir le type</option>
                   
                                <option value="produits">Produits</option>
                                <option value="factures">Factures</option>
                                <option value="commands">Commands</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="title" class="col-form-label col-lg-2">Titre *</label>
                        <div class="col-lg-10">
                            <input id="title" name="title" type="text"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="Entrer le titre de la condition" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="description" class="col-form-label col-lg-2">Description </label>
                        <div class="col-lg-10">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="8"></textarea>
                            @error('description')
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
