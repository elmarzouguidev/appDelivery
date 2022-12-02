@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Stock.__title')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Créér un ajustement</h4>

                        @include('layouts._parts.__messages')

                        <form  method="post" action="{{ route('admin:stock.store') }}">
                            @csrf
                            {{--<div class="form-check mb-3">
                                <input class="form-check-input" name="default_stock" type="checkbox" id="default_stock"
                                    onclick="myFunction()">
                                <label class="form-check-label" for="default_stock">
                                    Stock principal ?
                                </label>
                            </div>--}}
                            <div class="row mb-4">
                                <label for="select_city" class="col-form-label col-lg-2">Ville *</label>
                                <div class="col-lg-10">
                                    <select  name="city" id="select_city"
                                        class="form-control select2-templating @error('city') is-invalid @enderror"
                                        required>
                                        <option value="">Choisir la ville</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4" >
                                <label for="delivery_select" class="col-form-label col-lg-2">Livreur</label>
                                <div class="col-lg-10">
                                    <select  name="deliveryy" id="delivery_select"
                                        class="form-control select2-templating @error('delivery') is-invalid @enderror"
                                        required>
                                        <option value="">Choisir le Livreur</option>
                                        @foreach ($deliveries as $delivery)
                                            <option value="{{ $delivery->id }}">{{ $delivery->full_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('delivery')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4" >
                                <label for="client" class="col-form-label col-lg-2">Client *</label>
                                <div class="col-lg-10">
                                    <select  name="client"
                                        class="form-control select2-templating @error('client') is-invalid @enderror"
                                        required>
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
                            <div class="row mb-4" >
                                <label for="product" class="col-form-label col-lg-2">Produit *</label>
                                <div class="col-lg-10">
                                    <select wire:model.defer="product" name="product"
                                        class="form-control select2-templating @error('product') is-invalid @enderror"
                                        required>
                                        <option value="">Choisir le produit</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="qte" class="col-form-label col-lg-2">Quantité *</label>
                                <div class="col-lg-10">
                                    <input id="qte" name="qte" type="number"
                                        class="form-control @error('qte') is-invalid @enderror" required>
                                    @error('qte')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="sent_at" class="col-form-label col-lg-2">Date d'ajustement </label>
                                <div class="col-lg-10">
                                    <div class="input-group" id="datepicker1">
                                        <input type="text" name="sent_at"
                                            class="form-control @error('sent_at') is-invalid @enderror"
                                            data-date-format="dd-mm-yyyy" value="{{ now()->format('d-m-Y') }}"
                                            data-date-container='#datepicker1' data-provide="datepicker">

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        @error('sent_at')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="sent_at" class="col-form-label col-lg-2">Notes </label>
                                <div class="col-lg-10">
                                    <textarea name="notes" rows="3" class="form-control @error('notes') is-invalid @enderror"></textarea>
                                    @error('notes')
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
