<div>
    <div class="row">

        <div class="mb-3 col-lg-3">
            <label for="if">IF </label>
            <input type="number" name="if" id="if" min="1" value="{{$company->if}}" class="form-control @error('if') is-invalid @enderror" />
            @error('if')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 col-lg-3">
            <label for="rc">RC </label>
            <input type="number" name="rc" id="rc" min="1" value="{{$company->rc}}" class="form-control @error('rc') is-invalid @enderror" />

            @error('rc')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 col-lg-3">
            <label for="cnss">CNSS </label>
            <input type="number" name="cnss" id="cnss" value="{{$company->cnss}}" class="form-control @error('cnss') is-invalid @enderror" />

            @error('cnss')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 col-lg-3">
            <label for="patente">PATENTE</label>
            <input type="number" name="patente" id="patente" value="{{$company->patente}}"
                class="form-control @error('patente') is-invalid @enderror" />
            @error('patente')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

</div>
