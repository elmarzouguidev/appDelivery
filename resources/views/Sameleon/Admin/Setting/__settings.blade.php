<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Société info</h4>
                <p class="card-title-desc">
                    Entrer les informations de la société
                </p>
                <form method="POST" action="{{route('admin:settings.store')}}">
                    <div class="mb-3 row">
                        <label for="name" class="col-md-2 col-form-label">Nom *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="name" value="{{ $setting->name }}" id="name" required>
                        </div>
                    </div>
                    @csrf
                    <div class="mb-3 row">
                        <label for="website" class="col-md-2 col-form-label">website</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="website" value="{{ $setting->website }}"
                                id="website">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-2 col-form-label">E-mail *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="email" name="email" value="{{ $setting->email }}"
                                placeholder="E-mail" id="email" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="rc" class="col-md-2 col-form-label">RC</label>
                        <div class="col-md-10">
                            <input class="form-control" name="rc" type="number" value="{{ $setting->rc }}" placeholder="RC"
                                id="rc">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ice" class="col-md-2 col-form-label">ICE *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="ice" value="{{ $setting->ice }}"
                                placeholder="ICE" id="ice" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cnss" class="col-md-2 col-form-label">CNSS *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="cnss" value="{{ $setting->cnss }}"
                                placeholder="CNSS" id="cnss">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="patente" class="col-md-2 col-form-label">PATENTE *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="patente" value="{{ $setting->patente }}"
                                placeholder="PATENTE" id="patente" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="if" class="col-md-2 col-form-label">IF *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="if" value="{{ $setting->if }}"
                                placeholder="IF" id="if" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telephone" class="col-md-2 col-form-label">Telephone *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="tel" name="telephone" value="{{ $setting->telephone }}"
                                id="telephone" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="addresse" class="col-md-2 col-form-label">Adresse *</label>
                        <div class="col-md-10">
                          <textarea class="form-control" name="addresse" id="addresse" required>{{$setting->addresse}}</textarea>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
