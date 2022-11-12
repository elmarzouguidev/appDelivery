@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.Product.__title')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Ajouter un Produit</h4>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('notice'))
                            <div class="alert alert-warning">
                                {{ session('notice') }}
                            </div>
                        @endif
                        <form method="post" action="{{route('admin:products.store')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="ramassageId" value="{{ $product->uuid }}">
                            <div class="row mb-4">
                                <label for="name" class="col-form-label col-lg-2">Nom *</label>
                                <div class="col-lg-10">
                                    <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="description" class="col-form-label col-lg-2">Description </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="8" placeholder="Entrer la discription du produit "></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="price" class="col-form-label col-lg-2">Prix unitaire *</label>
                                <div class="col-lg-10">
                                    <input id="price" name="price" type="number" min="1" value="{{$product->price}}" class="form-control @error('price') is-invalid @enderror" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{--<div class="row mb-4">
                                <label for="qte_global" class="col-form-label col-lg-2">Quantité initial  *</label>
                                <div class="col-lg-10">
                                    <input id="qte_global" name="qte_global" type="number" min="1" placeholder="Entrer la quantité du produit" class="form-control @error('qte_global') is-invalid @enderror" required>
                                    @error('qte_global')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>--}}
                            <div class="row mb-3">
                                <label class="col-form-label col-lg-2">Photo *</label>
                                <div class="col-lg-10">
                                    <input class="form-control @error('photo') is-invalid @enderror" name="photo" type="file"
                                        accept="image/*" required />
                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            @if(isAdmin())
                                <div class="row mb-3">

                                    <label class="col-lg-2 form-label">Client</label>
                                    <div class="col-lg-10">
                                        <select name="client" class="form-control select2-templating @error('client') is-invalid @enderror"
                                            >
                                            <option value="">Choisir le client</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->full_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('client')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                
                                </div>
                            @endif
                            <div class="row justify-content-end">
                                <div class="col-lg-10">
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('css')
@endsection

@push('scripts')
<script>
    $('.closeCondition').click(function() {

        let userCompte = this.getAttribute('data-user');

        setTimeout(function() {
            document.getElementById('viewConditionForm')
                .submit();
        }, 1000);
    });
</script>

<script>
    setTimeout(function() {
        $("#conditionsModal").modal("show");
    }, 2e3);
</script>

@endpush

@if($conditions->count())  
    @php

     $viewedIds = $conditions->viewed ?? [];

    @endphp

    @if (auth()->id() && !in_array(auth()->id(), $viewedIds))

        @include('Sameleon.Admin.Product.__create.__condition')
        
    @endif
@endif