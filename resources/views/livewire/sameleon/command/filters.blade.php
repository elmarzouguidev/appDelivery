<div class="col-lg-2" id="filters-list">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Filters</h4>

            <div class="mt-4 pt-3">
                <h5 class="font-size-14 mb-3">Status</h5>
                <select class="form-select" name="client" id="clienter">
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

            <div class="mt-4">
                <h5 class="font-size-14 mb-3">Client</h5>
                <select class="form-control select2 chk-filter-client" name="client" id="clienter">
                    <option value=""></option>
                    <optgroup label="Clients">
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}"
                                {{ in_array($client->id, explode(',', request()->input('appFilter.GetClient'))) ? 'selected' : '' }}>
                                {{ $client->entreprise }}
                            </option>
                        @endforeach
                    </optgroup>
                </select>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <button href="#" type="button" class="btn btn-primary" id="filterData">
                        Appliquer le filtre
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>
