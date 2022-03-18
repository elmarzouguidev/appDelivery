<div class="templating-select mb-4">

    <label class="form-label">Ville *</label>

    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" required
        aria-describedby="city">
    @error('city')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>
