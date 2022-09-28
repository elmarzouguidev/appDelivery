<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="product-{{ $product->product->id }}">
                                            <label class="form-check-label" for="product-{{ $product->product->id }}"></label>
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
                                                $url = $product->product->getFirstMediaUrl('products_photos', 'normal');
                                                
                                            @endphp

                                            <a class="image-popup-no-margins" href="{{ $url }}">
                                                <img class="img-fluid" alt="" src="{{ $url }}" width="50">
                                            </a>

                                        </div>
                                    </td>
                                    <td>
                                        {{ $product->product->name }}
                                        <p class="text-muted mb-0"></p>
                                    </td>
                                    <td>
                                        {{ $product->product->formated_price }} DH
                                    </td>
                                    <td>
                                        {{ $product->qte_global }}
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
