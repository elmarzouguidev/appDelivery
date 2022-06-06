<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>Produit</th>
                                <th>Description</th>
                                <th>Etat</th>
                                <th>Client</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ $product->getFirstMediaUrl('products_photos', 'normal') }}"
                                            alt="product-img" title="product-img" class="avatar-md" />
                                    </td>
                                    <td>
                                        <h5 class="font-size-14 text-truncate"><a href="{{ $product->edit_url }}"
                                                class="text-dark">{{ $product->name }}</a></h5>
                                        {{--<p class="mb-0">Color : <span class="fw-medium">Maroon</span></p>--}}
                                    </td>
                                    <td>
                                      
                                        Rupture de stock
                                    </td>
                                    <td>
                                     {{optional($product->client)->full_name}}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="action-icon text-danger"> <i
                                                class="bx bx-check-square font-size-24"></i></a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Adresse de ramassage</h5>

                <div class="card mb-0">
                    
                        <form method="post" action="{{route('admin:products.store')}}">
                                @csrf
                            <div>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="8" placeholder="Entrer la adresse de ramassage"></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </form>
                    
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6">
                <div class=" mt-2 mt-sm-0">
                    <button type="submit" class="btn btn-success">
                        Confirmer l'adresse </button>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end card -->
    </div>
</div>
