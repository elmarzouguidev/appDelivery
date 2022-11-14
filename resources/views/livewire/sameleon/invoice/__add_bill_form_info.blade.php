<div class="row">
    <div class="col-lg-12">
        <div class="mb-4">
            <label class="form-label">Montant a payé *</label>

            <input type="text" wire:model.defer="price" class="form-control @error('price') is-invalid @enderror"
                value="{{$formatedPrice}}" readonly>
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


            <input type="date" wire:model.defer="date" id="bill-date" class="form-control @error('date') is-invalid @enderror"
               value="{{$date}}"  required >

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

            <select wire:model.defer="mode" class="form-select @error('mode') is-invalid @enderror" required>
                <option value=""></option>
                <option value="Espèce">Espèce</option>
                <option value="Virement">Virement</option>
                <option value="Chèque">Chèque</option>
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

        <input type="text" wire:model.defer="reference" class="form-control @error('reference') is-invalid @enderror"
            value="" aria-describedby="ref" placeholder="exemple : CHEQUE N° 4552154221">
        @error('reference')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class=" mb-4">
    <label>Note</label>
    <textarea wire:model.defer="notes" id="textarea" class="form-control @error('notes') is-invalid @enderror"
        maxlength="225" rows="2"></textarea>

    @error('notes')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
@if ($recu)
    <div class="col-lg-12">
        <div class="mb-4">
            Preview:

            @if ($recu)
                <img src="{{ $recu->temporaryUrl() }}" class="img-fluid" width="400" height="400">
            @else
                <img src="{{ $recu->avatarUrl() }}" class="img-fluid" width="400" height="400">
            @endif

        </div>
    </div>
@endif

{{--<div class="row mb-3" wire:ignore>
    <label class="col-form-label col-lg-2">Reçu</label>
    <div class="col-lg-10">
        <input class="form-control @error('recu') is-invalid @enderror" wire:model.lazy="recu" type="file"
            accept="image/*" />
        @error('recu')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

</div>--}}
<div class=" mb-4" wire:ignore>
    <label>Reçu</label>
    <input class="form-control @error('recu') is-invalid @enderror" wire:model.lazy="recu" type="file"
     accept="image/*" />
    @error('recu')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>