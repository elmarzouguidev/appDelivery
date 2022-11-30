<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">

                            <div class="col-lg-4 mb-4">

                                {{-- <a href="{{ route('admin:adjustments.create') }}" type="button" class="btn btn-info">
                                    Créér un ajustement
                                </a> --}}
                                @if(isAdmin())
                                    <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                        data-bs-toggle="modal" data-bs-target=".addStockModal">
                                        Créér un ajustement
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    @include('layouts._parts.__messages')

                    <div class="table-responsive">
                        <table
                            class="table table-bordered border-danger table-hover align-middle table-nowrap table-check">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 20px;" class="align-middle">
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                            <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    @if (isAdmin())
                                        <th class="align-middle">Ville</th>
                                        <th class="align-middle">Client</th>
                                    @endif

                                    <th class="align-middle">Produit</th>
                                    <th class="align-middle">Qté initial</th>
                                    <th class="align-middle">Qté Livré</th>
                                    <th class="align-middle">Qté Expédié</th>

                                    <th class="align-middle">Qté Endommagé</th>

                                    <th class="align-middle">Qté Restant</th>
                                    {{-- @if (isAdmin())
                                        <th class="align-middle">Détail de stock</th>
                                    @endif --}}
                                    <th class="align-middle">Date</th>
                                    <th class="align-middle">Note</th>
                                    @if (isAdmin())
                                        <th class="align-middle">Action</th>
                                    @endif
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
                                    <tr {{ $selected == $stock->uuid ? 'bgcolor=#50a5f1' : '' }}>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox"
                                                    id="client-{{ $stock->id }}">
                                                <label class="form-check-label"
                                                    for="client-{{ $stock->id }}"></label>
                                            </div>
                                        </td>
                                        @if (isAdmin())
                                            <td>
                                                {{ optional($stock->city)->name }}

                                            </td>
                                            <td>

                                                {{ optional($stock->client)->full_name }}

                                            </td>
                                        @endif
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
                                            {{ $stock->qte_expidite }}
                                        </td>
                                        <td>
                                            {{ $stock->qte_endomage }}
                                        </td>
                                        <td>

                                            {{ $stock->qte_rest }}

                                        </td>
                                        {{-- @if (isAdmin())
                                            <td>
                                               
                                                <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                                    wire:click="showStockDetail('{{ $stock->uuid }}')">
                                                    détailes
                                                </button>
                                            </td>
                                        @endif --}}
                                        <td>
                                            {{ $stock->created_at }}
                                        </td>
                                        <td>
                                            {{ $stock->notes }}
                                        </td>
                                        @if (isAdmin())
                                            <td>
                                                <div class="d-flex gap-3">

                                                    <a href="#" wire:click="editStock('{{ $stock->uuid }}')"
                                                        class="text-success">
                                                        <i class="mdi mdi-pencil font-size-18"></i>
                                                    </a>
                                                    <a href="#" class="text-danger"
                                                        onclick="
                                                            var result = confirm('Are you sure you want to delete this stock ?');
            
                                                            if(result){
                                                                event.preventDefault();
                                                                document.getElementById('delete-stock-{{ $stock->uuid }}').submit();
                                                            }">
                                                        <i class="mdi mdi-delete font-size-18"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <form id="delete-stock-{{ $stock->uuid }}" method="post"
                                                action="{{ route('admin:stock.delete') }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="stockId" value="{{ $stock->uuid }}">
                                            </form>
                                        @endif
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($showEditStock)
        @include('livewire.sameleon.stock.edit-stock', [
            'stock' => $stockEdit,
        ])
    @endif
    @if ($showDetail)
        @include('livewire.sameleon.stock.show-details', [
            'product' => $product,
        ])
    @endif

    @include('livewire.sameleon.stock.__add_stock_modal')

</div>
