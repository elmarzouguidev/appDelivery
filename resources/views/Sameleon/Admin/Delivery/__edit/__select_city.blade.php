<div class="templating-select mb-4">

    <label class="form-label">Ville *</label>

    <select name="city" class="form-control select2-templating @error('city') is-invalid @enderror" required>
        <option value="">Choisir la ville</option>
        @foreach ($cities as $city)
            <option value="{{ $city->id }}" {{ $delivery->city_id == $city->id ? 'selected' : '' }}>
                {{ $city->name }}</option>
        @endforeach
    </select>
    @error('city')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>
