<div class="row">
    <div class="col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-body">

                @if(isClient())
                    <div class="row">
                        <div class="col-lg-8">

                            <div class="col-lg-4 mb-4">
                                <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                    data-bs-toggle="modal" data-bs-target=".addRamassageModal">
                                    Demande de ramassage
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
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

                                <th class="align-middle">Nom</th>
                                <th class="align-middle">Prix</th>
                                <th class="align-middle">Quantité</th>
                                @if(isAdmin())
                                <th scope="col">Client</th>
                                @endif
                                <th class="align-middle">Adresse de ramassage</th>
                                <th class="align-middle">Note</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ramassages as $product)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="product-{{ $product->id }}">
                                            <label class="form-check-label" for="product-{{ $product->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $product->name }}
                                        <p class="text-muted mb-0"></p>
                                    </td>
                                    <td>
                                        {{ $product->price }} DH
                                    </td>
                                    <td>
                                        {{ $product->qte }}
                                    </td>
                                    @if(isAdmin())
                                    <td>

                                        <a href="{{-- $client->url --}}" class="text-body fw-bold">
                                            {{ optional($product->client)->full_name }}
                                        </a>
                                    </td>
                                    @endif
                                    <td>

                                        {!! $product->addresse !!}

                                    </td>
                                    <td>

                                        {!! $product->notes !!}

                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
      
                                            @if(isClient())
                                                @php
                                                    $disabled = '';
                                                    $text = 'envoyer la demande';
                                                    if ($product->active && !$product->accepted) {
                                                        $disabled = 'disabled';
                                                        $text = 'déja envoyé';
                                                    }
                                                    if($product->active && $product->accepted)
                                                    {
                                                        $disabled = 'disabled';
                                                        $text = 'Traité';
                                                    }
                
                                                @endphp
                                                <button {{ $disabled }} class="btn btn-info" type="button"
                                                    class="btn btn-info  btn-sm"
                                                    onclick=" document.getElementById('active-demande-{{ $product->uuid }}').submit();">
                                                    {{ $text }}
                                                </button>
                                            @endif
                                            @if(isAdmin())
                                                @php
                                                    $disabled = '';
                                                    $text = 'accepter la demande';
                                                    if ($product->accepted) {
                                                        $disabled = 'disabled';
                                                        $text = 'déja accepté';
                                                    }
                
                                                @endphp
                                                <button {{ $disabled }} class="btn btn-info" type="button"
                                                    class="btn btn-info  btn-sm"
                                                    onclick=" document.getElementById('accept-demande-{{ $product->uuid }}').submit();">
                                                    {{ $text }}
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                    @if(isClient())
                                        <form id="active-demande-{{ $product->uuid }}" method="post"
                                            action="{{ route('admin:ramassage.demande.active') }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="ramassageId" value="{{ $product->uuid }}">
                                        </form>
                                    @endif
                                    @if(isAdmin())
                                        <form id="accept-demande-{{ $product->uuid }}" method="post"
                                            action="{{ route('admin:ramassage.demande.accept') }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="ramassageId" value="{{ $product->uuid }}">
                                        </form>
                                    @endif

                                    <td>
                                        <button {{isAdmin() ? 'disabled' :''}} class="btn btn-danger" type="button"
                                            class="btn btn-info btn-sm"
                                            onclick=" document.getElementById('delete-ramassage-{{ $product->uuid }}').submit();">
                                            Supprimer
                                        </button>
                                        <form id="delete-ramassage-{{ $product->uuid }}" method="post"
                                            action="{{ route('admin:ramassage.delete') }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="ramassageDeleteId" value="{{ $product->uuid }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                @include('Sameleon.Admin.Ramassage.__address')
            </div>
        </div>
    </div> --}}
</div>
