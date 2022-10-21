<div class="modal fade addAnnonceModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter une Annonce </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('admin:annonces.store') }}">
                    @csrf
                    <div class="row mb-4">
                        <label for="group" class="col-form-label col-lg-2">Group *</label>
                        <div class="col-lg-10">
                            <select name="group" class="form-control select2-templating @error('group') is-invalid @enderror" required>
                                <option value="">Choisir le group</option>
                                <option value="all">Tous</option>
                                <option value="admins">Admins</option>
                                <option value="clients">Clients</option>
                                <option value="delivery">Livreurs</option>
                            </select>
                            @error('group')
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
                                placeholder="Entrer le titre de la annince" required>
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
                            <textarea class="form-control @error('description') is-invalid @enderror" id="descriptionii" name="description" rows="8"></textarea>
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
