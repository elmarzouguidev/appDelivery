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
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            {{--<th style="width: 20px;" class="align-middle">
                                <div class="form-check font-size-16">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                    <label class="form-check-label" for="checkAll"></label>
                                </div>
                            </th>--}}
                            <th scope="col">Code</th>
                            <th scope="col">Client</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($products as $product)
                            <tr>
                                {{--<td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox"
                                            id="client-{{ $client->id }}">
                                        <label class="form-check-label" for="client-{{ $client->id }}"></label>
                                    </div>
                                </td>--}}
                                <td>
                                    <a href="{{--$client->url--}}" class="text-body fw-bold">
                                        {{ $product->code }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{--$client->url--}}" class="text-body fw-bold">
                                        {{ optional($product->client)->full_name }}
                                    </a>
                                </td>
                                <td>
                                    {{ $product->name }}
                                    <p class="text-muted mb-0"></p>
                                </td>
                                <td>
                                    {{ $product->formated_price }} DH
                                </td>
                                <td>
                                    {{ $product->qte_global }}
                                </td>
            
                                <td>
                                    <div class="d-flex gap-3">

                                        <a href="{{ $product->edit_url }}" class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                        <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this product ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-prod-{{ $product->uuid }}').submit();
                                                }">
                                            <i class="mdi mdi-delete font-size-18"></i>
                                        </a>
                                    </div>
                                </td>
                                 <form id="delete-prod-{{ $product->uuid }}" method="post"
                                    action="{{ $product->delete_url }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="productId" value="{{ $product->uuid }}">
                                </form>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
