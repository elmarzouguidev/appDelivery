<div class="row">
    <div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label">Nom *</label>
            <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" placeholder="Entrer le nom du client" required>
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
            <input type="text" class="form-control @error('prenom') is-invalid @enderror" placeholder="Entrer le prénom du client" name="prenom" value="">
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

            <input type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" placeholder="Entrer le Tél du client" value=""
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
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Entrer l'email du client" value="">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label">Type *</label>

            <select name="type" class="form-control select2-templating @error('type') is-invalid @enderror" required>
                <option value="">Choisir le type</option>
                <option value="particulier">Particulier</option>
                <option value="entreprise">Entreprise</option>
            </select>
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>


    <div class="col-lg-6">
        <label class="form-label">CNIE ( requis c'est le type est particulier )</label>
        <div class="input-group mb-4">
            <span class="input-group-text" id="cnie_prefix">

            </span>
            <input type="cnie" class="form-control @error('cnie') is-invalid @enderror" name="cnie" value="">
            @error('cnie')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

</div>
