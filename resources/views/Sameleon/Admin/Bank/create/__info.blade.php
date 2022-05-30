<div class="row">
    <div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label">Nom *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" placeholder="Entrer le nom du banque" required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label">Code Banque </label>
            <input type="text" class="form-control @error('code_bank') is-invalid @enderror"
                value="{{ old('code_bank') }}" placeholder="Entrer le code du banque" name="code_bank">
            @error('code_bank')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label">Swift Code</label>

            <input type="text" class="form-control @error('code_swift') is-invalid @enderror"
                value="{{ old('code_swift') }}" name="code_swift" placeholder="Entrer le Swift code du banque">
            @error('code_swift')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
    <div class="col-lg-6">
        <label class="form-label">Code RIB</label>
        <div class="input-group mb-4">
            <span class="input-group-text" id="email_prefix">

            </span>
            <input type="text" class="form-control @error('code_rib') is-invalid @enderror"
                value="{{ old('code_rib') }}" name="code_rib" placeholder="Entrer le code RIB du banque">
            @error('code_rib')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <label class="form-label">E-mail</label>
        <div class="input-group mb-4">
            <span class="input-group-text" id="email_prefix">

            </span>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" name="email" placeholder="Entrer l'email du banque">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <label class="form-label">Tél</label>
        <div class="input-group mb-4">
            <span class="input-group-text" id="email_prefix">

            </span>
            <input type="text" class="form-control @error('telephone') is-invalid @enderror"
                value="{{ old('telephone') }}" name="telephone" placeholder="Entrer Tél du banque">
            @error('telephone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <label class="form-label">Logo</label>
        <div class="col-lg-12">
            <input class="form-control @error('logo') is-invalid @enderror" name="logo" type="file" accept="image/*" />
            @error('logo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>
</div>
