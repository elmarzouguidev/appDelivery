<div class="row">
    <div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label">Nom du société *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{$company->name}}" required>
            @error('name')
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
            <label class="form-label">Téléphone *</label>

            <input type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone"
            value="{{$company->telephone}}"  required>
            @error('telephone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>

</div>

<div class="docs-options">
    <label class="form-label">E-mail *</label>
    <div class="input-group mb-4">

        <span class="input-group-text" id="email_prefix">
       
        </span>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
         value="{{$company->email}}" aria-describedby="email_prefix" >
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
