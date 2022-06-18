<div class="row">
    <div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label">Nom *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ $bank->name ?? old('name') }}"  required>
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
                value="{{ $bank->code_bank ?? old('code_bank') }}" name="code_bank">
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
                value="{{ $bank->code_swift ?? old('code_swift') }}" name="code_swift">
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
                value="{{ $bank->code_rib ?? old('code_rib') }}" name="code_rib">
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
                value="{{ $bank->email ?? old('email') }}" name="email">
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
                value="{{ $bank->telephone ?? old('telephone') }}" name="telephone">
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
