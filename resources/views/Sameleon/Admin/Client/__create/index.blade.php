@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Client.__title')

        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('admin:clients.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">

                            <p class="card-title-desc">Entrer les information du client</p>

                            <div class="row">
                                <div class="col-lg-6">

                                    @include('Sameleon.Admin.Client.__create.__info')
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" name="generate_password" type="checkbox" id="generate_password">
                                        <label class="form-check-label" for="generate_password">
                                            Générer un mot de passe est envoyer le par mail
                                        </label>
                                    </div> 
                                </div>

                                <div class="col-lg-6">

                                   @include('Sameleon.Admin.Client.__create.__select_city')

                                    <div class=" mb-4">
                                        <label>Adresse *</label>
                                        <textarea name="addresse" id="textarea" class="form-control @error('addresse') is-invalid @enderror"
                                            maxlength="225" rows="5" placeholder="Entrer l'adresse du client" required>{{old('addresse')}}</textarea>

                                        @error('addresse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                         
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 justify-content-end mb-4">
                        <div class="">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" {{-- onclick='document.getElementById("overlayy").style.display = "block"' --}}>
                                {{ __('buttons.store') }}

                            </button>

                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection

@section('css')
@endsection

@push('scripts')
@endpush
