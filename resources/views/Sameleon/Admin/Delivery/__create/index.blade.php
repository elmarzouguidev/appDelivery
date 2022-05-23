@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Delivery.__title')

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
                <form action="{{ route('admin:delivery.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">

                            <p class="card-title-desc">Entrer les information du livreur</p>

                            <div class="row">
                                <div class="col-lg-6">

                                    @include('Sameleon.Admin.Delivery.__create.__info')
                                       
                                </div>
                                <div class="col-lg-6">
                                    @livewire('sameleon.delivery.create')
                                </div>
                                <div class="col-lg-6">

                                   {{--@include('Sameleon.Admin.Delivery.__create.__select_city')--}}

                                    <div class=" mb-4">
                                        <label>Adresse *</label>
                                        <textarea name="addresse" id="textarea" class="form-control @error('addresse') is-invalid @enderror"
                                            maxlength="225" rows="5" placeholder="Entrer l'adresse du livreur" required>{{old('addresse')}}</textarea>

                                        @error('addresse')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" name="generate_password" type="checkbox" id="generate_password">
                                        <label class="form-check-label" for="generate_password">
                                            Générer un mot de passe est envoyer le par mail
                                        </label>
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

   <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@push('scripts')
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
<script>
            $(".select2").select2({
            width: '100%'
        });
</script>
@endpush
