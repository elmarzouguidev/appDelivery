<div class="modal fade addGroupModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter un Group </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('admin:groups.store') }}">
                    @csrf
                    <div class="row mb-4">
                        <label for="name" class="col-form-label col-lg-2">Nom *</label>
                        <div class="col-lg-10">
                            <input id="name" name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Entrer le nom du group" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">

                        <label class="form-label col-lg-2">Responsable *</label>
                        <div class="col-lg-10">
                            <select name="admin" class="form-control @error('admin') is-invalid @enderror"
                                required>
                                <option value="">Choisir le Responsable</option>
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->full_name }}</option>
                                @endforeach
                            </select>
                            @error('admin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                    </div>
                    <div class="row mb-4">
                        <label for="description" class="col-form-label col-lg-2">Description </label>
                        <div class="col-lg-10">
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="10" rows="10"></textarea>
                     
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
