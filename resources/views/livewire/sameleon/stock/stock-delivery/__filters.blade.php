<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Filters</h5>

                <form class="row gy-2 gx-3 align-items-center">
                    <div class="col-lg-2 col-md-2">
                        <label class="visually-hidden" for="delivery">Livreure</label>
                        <select wire:model.defer="data.delivery" class="form-control select2 chk-filter-city"
                            name="delivery" id="delivery">
                            <option value="">Livreure</option>

                            @foreach ($delivries as $delivery)
                                <option value="{{ $delivery->id }}">{{ $delivery->full_name }}</option>
                            @endforeach


                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <label class="visually-hidden" for="city">Ville</label>
                        <select wire:model.defer="data.city" class="form-control select2 chk-filter-city" name="city"
                            id="city">
                            <option value="">Ville</option>

                            @foreach ($citiesList as $city)
                                <option value="{{ $city->id }}">
                                    {{ $city->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <label class="visually-hidden" for="product">Produit</label>
                        <select wire:model.defer="data.product" class="form-control select2 chk-filter-product"
                            name="product" id="product">
                            <option value="">Produit</option>

                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <label class="visually-hidden" for="clienter">Client</label>
                        <select wire:model.defer="data.client" class="form-control select2 chk-filter-client"
                            name="client" id="clienter">
                            <option value="">Client</option>

                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">

                                    {{ $client->full_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <label class="visually-hidden" for="clienter">Quantité Rest</label>
                        <input wire:model.defer="data.qte" type="number" min="1" class="form-control" placeholder="Quantité Rest">
                    </div>
                    <div class="col-sm-auto">
                        <button wire:click.prevent="setfilter()" class="btn btn-primary w-md">filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
