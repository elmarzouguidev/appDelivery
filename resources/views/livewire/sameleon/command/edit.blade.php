<div>
    @php
        $readonly = '';
        $disabled = '';
        if (auth()->user()->hasAnyRole('Admin','SuperAdmin')) {
            $readonly = 'readonly';
            $disabled = 'disabled';
        }
    @endphp
    @foreach ($orderProducts as $index => $orderProduct)
        <div class="row">
            <div class="mb-3 col-lg-3">
                <label for="designation">{{ __('invoice.form.article_designation') }} *</label>
                <textarea name="orderProducts[{{ $index }}][designation]" rows="3"
                    class="form-control @error('articles.*.designation') is-invalid @enderror"
                    required disabled > {{ $orderProduct->designation }}</textarea>

                @error('articles.*.designation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 col-lg-3">
                <label for="product">Produit *</label>
                <select wire:ignore class="form-control" name="orderProducts[{{ $index }}][product_id]"
                    data-indexer="{{ $index }}" disabled >

                    <option value="{{ $orderProduct->id }}">
                        {{ $orderProduct->product }}
                    </option>

                </select>

                @error('orderProducts.product_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 col-lg-1">
                <label for="quantity">{{ __('invoice.form.article_qte') }} *</label>

                <input type="number" name="orderProducts[{{ $index }}][quantity]" min="1"
                    value="{{ $orderProduct->quantity }}"
                    class="form-control @error('articles.*.quantity') is-invalid @enderror" disabled required />

                @error('orderProducts.quantity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 col-lg-2">
                <label for="prix_unitaire">Prix U.T *</label>
                <input type="number" name="orderProducts[{{ $index }}][prix_unitaire]"
                    value="{{ $orderProduct->prix_uni }}"
                    class="form-control @error('articles.*.prix_unitaire') is-invalid @enderror" disabled />

                @error('prix_unitaire')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3 col-lg-2">
                <label for="price_total">Prix TOTAL *</label>
                <input type="text" name="orderProducts[{{ $index }}][price_total]"
                    value="{{ $orderProduct->prix_total }}"
                    class="form-control @error('articles.*.price_total') is-invalid @enderror" readonly disabled />

                @error('price_total')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 col-lg-1">

                <button {{$disabled}} wire:click.prevent="removeProduct('{{ $orderProduct->uuid }}')" type="button"
                    class="mt-4 btn btn-danger waves-effect waves-light">
                    <i class="fas fa-trash-alt font-size-16"></i>
                </button>

            </div>
        </div>
    @endforeach
    @if (auth()->user()->hasRole('Client'))
        <hr>
        @foreach ($newOrderProducts as $indexer => $newOrderProduct)
            <div class="row">
                <div class="mb-3 col-lg-3">
                    <label for="designation">{{ __('invoice.form.article_designation') }} *</label>
                    <textarea name="newOrderProducts[{{ $indexer }}][designation]" rows="3"
                        wire:model="newOrderProducts.{{ $indexer }}.designation"
                        class="form-control @error('articles.*.designation') is-invalid @enderror"></textarea>
                    @error('articles.*.designation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 col-lg-3">
                    <label for="product">Produit *</label>
                    <select wire:ignore class="form-control" name="newOrderProducts[{{ $indexer }}][product_id]"
                        data-indexer="{{ $indexer }}" wire:model="newOrderProducts.{{ $indexer }}.product_id">
                        <option value=""></option>
                        <optgroup label="Produits">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>

                    @error('newOrderProducts.product_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 col-lg-1">
                    <label for="quantity">{{ __('invoice.form.article_qte') }} *</label>

                    <input type="number" name="newOrderProducts[{{ $indexer }}][quantity]" min="1"
                        wire:model="newOrderProducts.{{ $indexer }}.quantity"
                        class="form-control @error('articles.*.quantity') is-invalid @enderror" />

                    @error('newOrderProducts.quantity')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 col-lg-2">
                    <label for="prix_unitaire">Prix U.T *</label>
                    <input type="text" name="newOrderProducts[{{ $indexer }}][prix_unitaire]"
                        wire:model="newOrderProducts.{{ $indexer }}.prix_unitaire"
                        wire:click="getPrice({{ $indexer }})"
                        class="form-control @error('articles.*.prix_unitaire') is-invalid @enderror" />

                    @error('prix_unitaire')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 col-lg-2">
                    <label for="price_total">Prix TOTAL *</label>
                    <input type="text" name="newOrderProducts[{{ $indexer }}][price_total]"
                        wire:model="newOrderProducts.{{ $indexer }}.price_total"
                        class="form-control @error('articles.*.price_total') is-invalid @enderror" readonly />

                    @error('price_total')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 col-lg-1">

                    <button wire:click.prevent="removeItem({{ $indexer }})" type="button"
                        class="mt-4 btn btn-danger waves-effect waves-light">
                        <i class="fas fa-trash-alt font-size-16"></i>
                    </button>

                </div>
            </div>
        @endforeach
        <button wire:click.prevent="addNewProduct" type="button" class="btn btn-success waves-effect waves-light">
            <i class="bx bx-check-double font-size-16 align-middle"></i>
        </button>
    @endif
</div>
