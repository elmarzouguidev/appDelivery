<form method="post" action="{{ route('admin:ramassage.store') }}">
    @csrf

    @php
        $productsIds = $products->pluck('id')->toJson();
        count($products) <= 0 ? ($disabled = 'disabled') : ($disabled = '');
        count($products) <= 0 ? ($readonly = 'readonly') : ($readonly = '');
    @endphp
    <div class="row mb-4">
        <label class="form-check-label mb-5">Entrer la adresse de ramassage</label>
        <input type="hidden" name="products" value="{{ $productsIds }}">
        <div class="col-lg-12">
            <textarea {{ $readonly }} class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                rows="8" required></textarea>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-lg-12">
            <button {{ $disabled }} type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </div>
</form>
