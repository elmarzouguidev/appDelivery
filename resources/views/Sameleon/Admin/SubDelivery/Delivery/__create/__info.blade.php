<div class="row">
    <div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label">Nom *</label>
            <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                value="{{ old('nom') }}" placeholder="Entrer le nom du livreur" required>
            @error('nom')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label">Prénom * </label>
            <input type="text" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom') }}"
                placeholder="Entrer le prénom du livreur" name="prenom" value="">
            @error('prenom')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label">Téléphone *</label>

            <input type="text" class="form-control @error('telephone') is-invalid @enderror"
                value="{{ old('telephone') }}" name="telephone" placeholder="Entrer le Tél du livreur" value=""
                required>
            @error('telephone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
    <div class="col-lg-6">
        <label class="form-label">E-mail *</label>
        <div class="input-group mb-4">
            <span class="input-group-text" id="email_prefix">

            </span>
            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                name="email" placeholder="Entrer l'email du livreur" value="">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-check mb-3">
            <input class="form-check-input" name="generate_password" type="checkbox" id="generate_password">
            <label class="form-check-label" for="generate_password">
                Générer un mot de pass est envoyer le par mail
            </label>
        </div>
    </div>
</div>
