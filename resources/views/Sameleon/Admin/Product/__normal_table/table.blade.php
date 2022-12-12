<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="mb-4">
                                <a href="{{ route('admin:products.create') }}" type="button" class="btn btn-info">
                                    Ajouter un Produit
                                </a>

                                @if (isClient() || isAdmin())
                                    <button class="btn btn-warning" type="button" data-bs-toggle="modal"
                                        data-bs-target=".importProductModal">
                                        Importer des produits
                                    </button>
                                @endif
                            </div>
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

                                <th class="align-middle">Image</th>
                                <th class="align-middle">Nom</th>
                                <th class="align-middle">Prix</th>
                                <th class="align-middle">Quantité</th>
                                @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                    <th scope="col">Client</th>
                                @endif
                                <th class="align-middle">Date de creation</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="product-{{ $product->id }}">
                                            <label class="form-check-label" for="product-{{ $product->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        {{-- <div>
                                            <img class="img-fluid rounded" alt=""
                                                src="{{ $product->getFirstMediaUrl('products_photos', 'normal') }}"
                                                width="50">
                                        </div> --}}
                                        <div>
                                            @php
                                                $url = $product->getFirstMediaUrl('products_photos', 'normal');
                                                
                                            @endphp

                                            <a class="image-popup-no-margins" href="{{ $url }}">
                                                <img class="img-fluid" alt="" src="{{ $url }}"
                                                    width="50">
                                            </a>

                                        </div>
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
                                    @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                        <td>
                                            <a href="{{-- $client->url --}}" class="text-body fw-bold">
                                                {{ optional($product->client)->full_name }}
                                            </a>
                                        </td>
                                    @endif
                                    <td>
                                        {{ $product->created_at->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">

                                            <a href="{{ $product->edit_url }}" class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="#" class="text-danger"
                                                onclick="
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
        </div>
    </div>
</div>
