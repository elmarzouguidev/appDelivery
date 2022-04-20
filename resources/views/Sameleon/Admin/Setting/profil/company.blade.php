<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <h4 class="card-title">Société info</h4>
                <p class="card-title-desc">
                    Entrer les informations de votre société
                </p>
                <form method="POST" action="{{ route('admin:profil.update.company') }}">
                    <div class="mb-3 row">
                        <label for="name" class="col-md-2 col-form-label">Nom *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="name" value="{{ $company->name ?? old('name') ??'' }}"
                                id="name" placeholder="Nom de votre société" required>
                        </div>
                    </div>
                    <input type="hidden" name="hasCompany" value="{{ $user->uuid }}">
                    @csrf
                    <div class="mb-3 row">
                        <label for="website" class="col-md-2 col-form-label">website</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="website"
                                value="{{ $company->website ?? '' }}" id="website"
                                placeholder="Site web de votre société">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-2 col-form-label">E-mail *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="email" name="email" value="{{ $company->email ??  old('email') ?? '' }}"
                                placeholder="E-mail" id="email" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="rc" class="col-md-2 col-form-label">RC *</label>
                        <div class="col-md-10">
                            <input class="form-control" name="rc" type="number" value="{{ $company->rc ?? old('rc') ?? '' }}"
                                placeholder="RC" id="rc" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ice" class="col-md-2 col-form-label">ICE *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="ice" value="{{ $company->ice ?? old('ice') ?? '' }}"
                                placeholder="ICE" id="ice" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cnss" class="col-md-2 col-form-label">CNSS </label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="cnss" value="{{ $company->cnss ?? old('cnss') ?? '' }}"
                                placeholder="CNSS" id="cnss">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="patente" class="col-md-2 col-form-label">PATENTE</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="patente"
                                value="{{ $company->patente ?? '' }}" placeholder="PATENTE" id="patente">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="if" class="col-md-2 col-form-label">IF *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="if" value="{{ $company->if ?? old('if') ?? '' }}"
                                placeholder="IF" id="if" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telephone" class="col-md-2 col-form-label">Telephone *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="tel" name="telephone"
                                value="{{ $company->telephone ?? old('telephone') ?? '' }}" id="telephone" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="city" class="col-md-2 col-form-label">Ville *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="tel" name="city"
                                value="{{ $company->city ?? old('city') ?? '' }}" id="city" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="addresse" class="col-md-2 col-form-label">Adresse *</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="addresse" id="addresse" required>{{ $company->addresse ?? old('addresse') ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
