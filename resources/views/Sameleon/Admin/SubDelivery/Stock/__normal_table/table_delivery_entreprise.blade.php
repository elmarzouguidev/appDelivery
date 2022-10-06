<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-4 mb-4">

                            {{-- <a href="{{ route('admin:adjustments.create') }}" type="button" class="btn btn-info">
                                Créér un ajustement
                            </a
                            <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                data-bs-toggle="modal" data-bs-target=".addStockModal">
                                Créér un ajustement
                            </button>> --}}
                        </div>
                    </div>
                </div>

                @include('layouts._parts.__messages')

                <div class="table-responsive">
                    <table class="table table-bordered border-danger table-hover align-middle table-nowrap table-check">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 20px;" class="align-middle">
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th class="align-middle">Produit</th>
                                <th class="align-middle">Qté initial</th>
                                <th class="align-middle">Qté Livré</th>
                                <th class="align-middle">Qté Restant</th>
                                <th class="align-middle">Date d'envoi</th>
                                <th class="align-middle">Notes</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($stocks as $stock)
    
                                @php
                                    if (request()->has('isOut')) {
                                        $selected = request()->isOut;
                                    
                                        // dd($selected);
                                    } else {
                                        $selected = '';
                                    }
                                @endphp
                                <tr 
                                    {{ $selected == $stock->uuid ? 'bgcolor=#50a5f1' : '' }}>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="client-{{ $stock->id }}">
                                            <label class="form-check-label" for="client-{{ $stock->id }}"></label>
                                        </div>
                                    </td>
                                    <td>

                                        {{ $stock->product->name }}

                                    </td>

                                    <td>
                                        {{ $stock->qte_global }}
                                    </td>

                                    <td>
                                        {{ $stock->qte_livre }}
                                    </td>
                                    <td>
                                        {{ $stock->qte_rest }}

                                    </td>

                                    <td>
                                        {{ $stock->adjustment_date }}
                                    </td>
                                    <td>
                                        {{ $stock->notes }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
