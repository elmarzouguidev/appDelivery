<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Filters</h5>

                <form class="row gy-2 gx-3 align-items-center">

                    {{--<div class="col-lg-2 col-md-2">
                        <label class="visually-hidden" for="product">Produit</label>
                        <select wire:model.defer="data.product" class="form-control select2 chk-filter-product" name="product" id="product">
                            <option value="">Produit</option>
    
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" >
                                    {{ $product->name }}
                                </option>
                            @endforeach
    
                        </select>
                    </div>--}}

                    <div class="col-lg-3 col-md-2">
                        <label class="visually-hidden" for="statusList">Etat</label>
                        <select wire:model.defer="data.status" class="form-select" name="status" id="statusList">
                            <option value="">Etat</option>
                            <option value="{{ App\Status\Status::ANNULE }}">Annulé</option>
                            <option value="{{ App\Status\Status::LIVRE }}">Livré</option>
                            <option value="{{ App\Status\Status::ENCOURS }}">En cours</option>
                            <option value="{{ App\Status\Status::EXPEDIE }}">Non traité</option>
                            <option value="{{ App\Status\Status::INJOIGNABLE }}">Injoignable</option>
                            <option value="{{ App\Status\Status::MANQUE_DE_STOCK }}">Manque De Stock</option>
                            <option value="{{ App\Status\Status::PAS_DE_REPONSE }}">Pas de réponse</option>
                            <option value="{{ App\Status\Status::REFUSE }}">Refusé</option>
                            <option value="{{ App\Status\Status::REPORTE }}">Reporté</option>
                            <option value="{{ App\Status\Status::RETOURNE }}">Retourné</option>
                        </select>
                    </div>

                    <div class="col-sm-auto">
                        <button wire:click.prevent="setfilter()" class="btn btn-primary w-md">filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
