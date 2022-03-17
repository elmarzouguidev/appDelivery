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
                        <form method="post" action="{{route('sameleon:products.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4">
                                <label for="name" class="col-form-label col-lg-2">Nom *</label>
                                <div class="col-lg-10">
                                    <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Entrer le nom du produit" required>
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
                                <label for="price" class="col-form-label col-lg-2">Prix *</label>
                                <div class="col-lg-10">
                                    <input id="price" name="price" type="number" min="1" placeholder="Entrer le prix du produit" class="form-control @error('price') is-invalid @enderror" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="qte_global" class="col-form-label col-lg-2">Quantité *</label>
                                <div class="col-lg-10">
                                    <input id="qte_global" name="qte_global" type="number" min="1" placeholder="Entrer la quantité du produit" class="form-control @error('qte_global') is-invalid @enderror" required>
                                    @error('qte_global')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
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

@endpush
