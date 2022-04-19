<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Filters</h5>

                <form class="row gy-2 gx-3 align-items-center">
                    <div class="col-lg-2 col-md-2">
                        <label class="visually-hidden" for="autoSizingInput">Name</label>
                        <input type="text" class="form-control" id="autoSizingInput" placeholder="">
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <label class="visually-hidden" for="city">Ville</label>
                        <select  class="form-control select2 chk-filter-city" name="city" id="city">
                            <option value="">Ville</option>
    
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" >
                                    {{ $city->name }}
                                </option>
                            @endforeach
    
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <label class="visually-hidden" for="product">Produit</label>
                        <select class="form-control select2 chk-filter-product" name="product" id="product">
                            <option value="">Produit</option>
    
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" >
                                    {{ $product->name }}
                                </option>
                            @endforeach
    
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <label class="visually-hidden" for="clienter">Client</label>
                        <select  class="form-control select2 chk-filter-client" name="client" id="clienter">
                            <option value="">Client</option>
    
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" >
        
                                    {{ $client->full_name }}
                                </option>
                            @endforeach
    
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-2">
                        <label class="visually-hidden" for="statusList">Etat</label>
                        <select  class="form-select" name="status" id="statusList">
                            <option value="">Etat</option>
                            <option value="{{ App\Status\Status::ANNULE }}">Annulé</option>
                            <option value="{{ App\Status\Status::LIVRE }}">Livré</option>
                            <option value="{{ App\Status\Status::CHANGE }}">Change</option>
                            <option value="{{ App\Status\Status::ENCOURS }}">En cours</option>
                            <option value="{{ App\Status\Status::EXPEDIE }}">Expédié</option>
                            <option value="{{ App\Status\Status::INJOIGNABLE }}">Injoignable</option>
                            <option value="{{ App\Status\Status::INTERESSE }}">Interessé</option>
                            <option value="{{ App\Status\Status::MANQUE_DE_STOCK }}">Manque De Stock</option>
                            <option value="{{ App\Status\Status::PAS_DE_REPONSE }}">Pas de réponse</option>
                            <option value="{{ App\Status\Status::PAS_DE_REPONSE_2 }}">Pas de réponse 2 fois</option>
                            <option value="{{ App\Status\Status::PAS_DE_REPONSE_3 }}">Pas de réponse 3 fois</option>
                            <option value="{{ App\Status\Status::PAS_DE_REPONSE_4 }}">Pas de réponse 4 fois</option>
                            <option value="{{ App\Status\Status::PAS_DE_REPONSE_5 }}">Pas de réponse 5 fois</option>
                            <option value="{{ App\Status\Status::RECONFIRMER }}">Reconfirmer</option>
                            <option value="{{ App\Status\Status::REFUSE }}">Refusé</option>
                            <option value="{{ App\Status\Status::REPORTE }}">Reporté</option>
                            <option value="{{ App\Status\Status::RETOURNE }}">Retourné</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="input-daterange input-group" data-provide="datepicker">
                            <input type="text" 
                                class="form-control @error('date_depart') is-invalid @enderror" name="start" placeholder="Date de début"
                                onchange="this.dispatchEvent(new InputEvent('input'))">

                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="input-daterange input-group" data-provide="datepicker">
                            <input type="text" 
                                class="form-control @error('date_fin') is-invalid @enderror" name="end" placeholder="Date de fin"
                                onchange="this.dispatchEvent(new InputEvent('input'))">
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <button class="btn btn-primary w-md">filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
