@if ($order)
    <div class="modal fade orderdetailsModal-{{ $order->id }}" tabindex="-1" role="dialog"
        aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=orderdetailsModalLabel">COMMANDE N° : {{ $order->code }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{--<p class="mb-2">Produits : <span class="text-primary">{{ $order->code }}</span></p>--}}
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prix</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($order->products as $product)
                                    <tr>
                                        <th scope="row">
                                            <div>
                                                <img src="{{ $product->getFirstMediaUrl('products_photos', 'normal') }}"
                                                    alt="" class="avatar-sm">
                                            </div>
                                        </th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14">{{ $product->name }}</h5>
                                                <p class="text-muted mb-0">{{ $product->price }}(DH) x
                                                    {{ $product->pivot->quantity }}</p>
                                            </div>
                                        </td>
                                        <td>{{ $product->pivot->price_ht }} DH</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Frais : </h6>
                                    </td>
                                    <td>
                                        Free
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <h6 class="m-0 text-right">Total : </h6>
                                    </td>
                                    <td>
                                   
                                        {{ $order->total_price }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif
