<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Filters</h5>

                <form class="row gy-2 gx-3 align-items-center">
                    <div class="col-lg-2 col-md-2">
                        <label class="visually-hidden" for="clientList">Client</label>
                        <select  class="form-control" name="client" id="clientList">
                            <option value="">Client</option>
    
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" >
        
                                    {{ $client->full_name }}
                                </option>
                            @endforeach
    
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-2">
                        <label class="visually-hidden" for="stockList">Stock</label>
                        <select class="form-select" name="stock" id="stockList">
                            <option value="">Stock</option>
                            <option value="1">In stock</option>
                            <option value="2">Out of stock</option>

                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <div class="input-daterange input-group" data-provide="datepicker">
                            <input type="text" 
                                class="form-control @error('date_depart') is-invalid @enderror" id="dateFilter" name="created_at" placeholder="Date de creation"
                                onchange="this.dispatchEvent(new InputEvent('input'))">

                        </div>
                    </div>

                    <div class="col-sm-auto">
                        <button id="filterData"  class="btn btn-primary w-md">filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
