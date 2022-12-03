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
