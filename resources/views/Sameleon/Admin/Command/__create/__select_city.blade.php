<div class="row">
    <div class="col-lg-6">
        <div class="templating-select mb-4">

            <label class="form-label">Ville *</label>

            <select name="city" class="form-control select2-templating @error('city') is-invalid @enderror" required>
                <option value="">Choisir la ville</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
    <div class="col-lg-6">
        <div class="templating-select mb-4">

            <label class="form-label">Région *</label>

            <select name="region" class="form-control select2-templating @error('region') is-invalid @enderror"
                required>
                <option value="">Choisir la région</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
</div>
