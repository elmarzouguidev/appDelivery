<div class="templating-select mb-4">

    <label class="form-label">Ville *</label>

    <select name="city" class="form-control select2-templating @error('city') is-invalid @enderror" required>
        <option value="1">casablanca</option>

    </select>
    @error('city')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>
