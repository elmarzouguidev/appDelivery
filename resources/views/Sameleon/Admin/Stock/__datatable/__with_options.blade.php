<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-4 mb-4">
                            {{--<a href="#" type="button" onclick="openFilters()" class="btn btn-primary" >
                                Filters
                            </a>--}}
                            <a href="{{route('admin:products.create')}}" type="button" class="btn btn-info">
                                Ajouter un Produit
                            </a>
                        </div>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th style="width: 20px;" class="align-middle">
                                <div class="form-check font-size-16">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                    <label class="form-check-label" for="checkAll"></label>
                                </div>
                            </th>
                            <th scope="col">Produit</th>
                            <th scope="col">Qté initial</th>
                            <th scope="col">Qté Livré</th>
                            <th scope="col">Qté Expédié</th>
                            <th scope="col">Qté Endommagé</th>
                            <th scope="col">Qté Restant</th>
                            <th scope="col">Détail</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($stocks as $stock)
                            <tr>
                                <td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox"
                                            id="client-{{ $stock->id }}">
                                        <label class="form-check-label" for="client-{{ $stock->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{--$client->url--}}" class="text-body fw-bold">
                                        {{ optional($stock->product)->name }}
                                    </a>
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
                                <td>
                                    {{ $stock->notes }}
                                </td>
                                <td>
                                    {{ $stock->created_at }}
                                </td>
                                <td>
                                    <div class="d-flex gap-3">

                                        <a href="{{ $stock->edit_url }}" class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                        <a href="#" class="text-danger" onclick="
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
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
