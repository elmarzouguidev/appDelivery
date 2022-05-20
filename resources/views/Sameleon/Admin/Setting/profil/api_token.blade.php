<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">API</h4>

                <form method="POST" action="{{ route('admin:profil.update.token') }}">
                    <input type="hidden" name="hasToekn" value="{{ auth()->user()->uuid }}">

                    @csrf
                    <div class="mb-3 row">
                        <label for="public_key_api" class="col-md-2 col-form-label">Public key</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="public_key_api" id="public_key_api"
                            value="{{ auth()->user()->public_key_api }}"   >
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="secret_key_api" class="col-md-2 col-form-label">Secret key
                            *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="secret_key_api"
                                id="secret_key_api" value="{{ auth()->user()->secret_key_api }}">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Générer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
