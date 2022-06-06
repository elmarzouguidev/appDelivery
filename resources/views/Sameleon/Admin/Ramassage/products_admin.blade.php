<div class="row">
    <div class="col-lg-12 col-sm-12">
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
                                <th class="align-middle">Quantité rest</th>
                                <th scope="col">Client</th>
                                <th class="align-middle">Adresse de ramassage</th>
                                <th class="align-middle"></th>
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
                                        <div>

                                            <img class="img-fluid" alt=""
                                                src="{{ $product->getFirstMediaUrl('products_photos', 'normal') }}"
                                                width="50">

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
                                        {{ $product->stock }}
                                    </td>
                             
                                     <td>
                                        
                                            <a href="{{-- $client->url --}}" class="text-body fw-bold">
                                                {{ optional($product->client)->full_name }}
                                            </a>
                                    </td>
                                    <td>
                                       
                                        {!! optional($product->ramassage)->addresse !!}
                                            
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">

                                            {{-- <a href="{{ $product->edit_url }}" class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this product ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-prod-{{ $product->uuid }}').submit();
                                                }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a> --}}
                                            @php
                                                $disabled = '';
                                                $text = 'Envoyer la demande';
                                                if ($product->can_ramassage) {
                                                    $disabled = 'disabled';
                                                    $text = 'déja Envoyé';
                                                }
                                                if($product->ramassage && optional($product->ramassage)->addresse !=null)
                                                {
                                                    $text = 'client répondu';   
                                                }
                                            @endphp
                                            <button {{$disabled}} class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                                onclick=" document.getElementById('send-demande-{{ $product->uuid }}').submit();">
                                                {{ $text }}
                                            </button>
                                        </div>
                                    </td>
                                    <form id="send-demande-{{ $product->uuid }}" method="post"
                                        action="{{ route('admin:ramassage.demande') }}">
                                        @csrf
                                        @method('PUT')
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
    {{--<div class="col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                @include('Sameleon.Admin.Ramassage.__address')
            </div>
        </div>
    </div>--}}
</div>
