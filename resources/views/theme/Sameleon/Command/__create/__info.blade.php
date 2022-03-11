<div class="row">
    <div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label">Nom du client *</label>
            <input type="text" class="form-control @error('client_name') is-invalid @enderror" name="client_name"
            value="" required>
            @error('client_name')
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
    <div class="col-lg-6">
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
    </div>

</div>

<div class="docs-options">
    <label class="form-label">Numéro de command</label>
    <div class="input-group mb-4">

        <span class="input-group-text" id="invoice_prefix">
       
        </span>
        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
            value="" aria-describedby="invoice_prefix" readonly>
        @error('code')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
