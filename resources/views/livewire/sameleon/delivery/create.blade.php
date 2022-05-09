<div>

    <div class="templating-select mb-4">

        <label class="form-label">Ville *</label>

        <select wire:model="city" name="city" class="form-control select2-templating @error('city') is-invalid @enderror" required>
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

    {{--<div class=" mb-4">
        <label>Regions *</label>
        <textarea name="regions" id="textarea" class="form-control @error('regions') is-invalid @enderror" maxlength="225"
            rows="5" placeholder="Entrer l'adresse du livreur" required>{{ old('regions') }}</textarea>

        @error('regions')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>--}}
    <div class="mb-4 ">
        @if(count($regions))
        <label>Regions</label>
        
            <select name="regions[]" class="select2 form-control select2-multiple @error('regions') is-invalid @enderror"
                multiple="multiple" data-placeholder="Select ...">
    
                <optgroup label="regions">
    
                    @foreach ($regions as $region)
    
                     <option 
                       value="{{$region->id}}"
                     >
                        {{$region->name}}
    
                    </option>
    
                    @endforeach
    
                </optgroup>
    
            </select>
            @error('regions')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        @endif
    </div>

</div>
