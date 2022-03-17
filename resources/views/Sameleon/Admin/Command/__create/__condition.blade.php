<div class="card">
    <div class="card-body">
        <p class="card-title-desc">{{ __('invoice.form.title') }}</p>
        <div class="row">
            <div class="col-lg-12">
                <label for="condition_general">{{ __('invoice.form.condition_general') }}</label>
                <textarea name="condition_general" id="condition_general"
                    class="form-control @error('condition_general') is-invalid @enderror"></textarea>
                @error('condition_general')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>