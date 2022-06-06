<form method="post" action="{{ route('admin:ramassage.store') }}" enctype="multipart/form-data">
    @csrf

    @php
        $productsIds = $products->pluck('id')->toJson();
    @endphp
    <div class="row mb-4">
        <input type="hidden" name="products" value="{{ $productsIds }}">
        <div class="col-lg-12">
            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="8"
                placeholder="Entrer la adresse de ramassage "></textarea>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </div>
</form>
