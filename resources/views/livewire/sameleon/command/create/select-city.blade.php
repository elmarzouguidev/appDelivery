<div>
    <div class="row">
        <div class="col-lg-6">
            <div class="templating-select mb-4">
                <label class="form-label">Ville *</label>
                <select wire:model="city" name="city"
                    class="form-control select2-templating @error('city') is-invalid @enderror" required>
                    @if (!$command)
                        <option value="">Choisir la ville</option>
                    @endif

                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" @if ($command && $command->city_id == $city->id) {{ 'selected' }} @endif>
                            {{ $city->name }}
                        </option>
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

                <label class="form-label">Région</label>

                <select wire:model.defer="region" name="region"
                    class="form-control select2-templating @error('region') is-invalid @enderror">
                    @if (!$command)
                        <option value="">Choisir la région</option>
                    @endif

                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}"
                            @if ($command && $command->region_id == $region->id) {{ 'selected' }} @endif>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
                @error('region')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>
