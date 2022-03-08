<div>
    @foreach ($orderProducts as $index => $orderProduct)
            <div class="row">
                <div class="mb-3 col-lg-3">
                    <label for="designation">{{ __('invoice.form.article_designation') }} *</label>
                    <textarea name="orderProducts[{{ $index }}][designation]"
                        wire:model="orderProducts.{{$index}}.designation"
                        class="form-control @error('articles.*.designation') is-invalid @enderror" required></textarea>
                    @error('articles.*.designation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 col-lg-2">
                    <label for="description">{{ __('invoice.form.article_description') }}</label>
                    <textarea name="orderProducts[{{ $index }}][description]"
                        wire:model="orderProducts.{{$index}}.description"
                        class="form-control @error('articles.*.description') is-invalid @enderror"></textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 col-lg-3">
                    <label for="product">Produit *</label>
                    <select class="form-control select2" name="orderProducts[{{ $index }}][product_id]"
                        wire:model="orderProducts.{{ $index }}.product_id">
                        <option value=""></option>
                        <optgroup label="Produits">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                    @error('orderProducts.product_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 col-lg-1">
                    <label for="quantity">{{ __('invoice.form.article_qte') }} *</label>

                    <input type="number" name="orderProducts[{{ $index }}][quantity]"  min="1"
                        wire:model="orderProducts.{{ $index }}.quantity"
                        class="form-control @error('articles.*.quantity') is-invalid @enderror" required />

                    @error('orderProducts.quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 col-lg-2">
                    <label for="prix_unitaire">{{ __('invoice.form.article_prix_unitaire') }} *</label>
                    <input type="number" name="orderProducts[{{ $index }}][prix_unitaire]" id="prix_unitaire" min="1"
                        wire:model="orderProducts.{{$index}}.prix_unitaire"
                        class="form-control @error('articles.*.prix_unitaire') is-invalid @enderror" required />

                    @error('prix_unitaire')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 col-lg-1">

                    <button wire:click.prevent="removeProduct({{ $index }})" type="button"
                        class="mt-4 btn btn-danger waves-effect waves-light">
                        <i class="fas fa-trash-alt font-size-16"></i>
                    </button>

                </div>
            </div>

 
    @endforeach
    <button wire:click.prevent="addProduct" type="button" class="btn btn-success waves-effect waves-light">
        <i class="bx bx-check-double font-size-16 align-middle"></i>
    </button>
</div>
