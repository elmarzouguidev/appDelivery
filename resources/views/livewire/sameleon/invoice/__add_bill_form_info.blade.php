<div class="row">
    <div class="col-lg-12">
        <div class="mb-4">
            <label class="form-label">Montant a payé *</label>

            <input type="text" wire:model.defer="price" class="form-control @error('price') is-invalid @enderror"
                value="{{ $invoice->articles_sum_price_total }}" readonly>
            @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-4">
            <label class="form-label">Date de règlement *</label>


            <input type="date" wire:model.defer="date" class="form-control @error('date') is-invalid @enderror"
                value="{{ now()->format('d-m-Y') }}" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">

            @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


        </div>
    </div>
    <div class="col-lg-12">
        <div class="mb-4">
            <label class="form-label">Mode de règlement *</label>

            <select wire:model.defer="mode" class="form-select @error('mode') is-invalid @enderror">
                <option value="espece">Espèce</option>
                <option value="virement">Virement</option>
                <option value="cheque">Chèque</option>
            </select>
            @error('mode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
</div>
<div class="docs-options">
    <label class="form-label">Référence de transaction</label>
    <div class="input-group mb-4">

        <input type="text" wire:model.defer="reference" class="form-control @error('reference') is-invalid @enderror" value=""
            aria-describedby="ref" placeholder="exemple : CHEQUE N° 4552154221">
        @error('reference')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class=" mb-4">
    <label>Note</label>
    <textarea wire:model.defer="notes" id="textarea" class="form-control @error('notes') is-invalid @enderror" maxlength="225"
        rows="2"></textarea>

    @error('notes')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>