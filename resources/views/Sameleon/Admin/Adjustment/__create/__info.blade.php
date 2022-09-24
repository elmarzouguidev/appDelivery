<div class="row">
    <div class="col-lg-12">
        <div class="mb-4">
            <label class="form-label">Livreur *</label>
            <select name="delivery" class="form-control select2-templating @error('delivery') is-invalid @enderror"
                required>
                <option value="">Choisir le Livreur</option>
                @foreach ($deliveries as $delivery)
                    <option value="{{ $delivery->id }}">{{ $delivery->full_name }}</option>
                @endforeach
            </select>
            @error('delivery')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
    {{--<div class="col-lg-4">
        <div class="mb-4">
            <label class="form-label">Email du client </label>
            <input type="text" class="form-control @error('client_email') is-invalid @enderror" name="client_email"
            value="" >
            @error('client')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>--}}
    {{--<div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label">Téléphone du client *</label>

            <input type="text" class="form-control @error('client_phone') is-invalid @enderror" name="client_phone"
            value=""  required>
            @error('ticket')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>--}}

</div>

<div class="docs-options">
    <label class="form-label">Numéro d'ajustement</label>
    <div class="input-group mb-4">

        <span class="input-group-text" id="command_number">
            <i class="bx bx-cart-alt"></i>
        </span>
        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
            value="" aria-describedby="command_number" readonly>

    </div>
</div>
