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
        <form  action="{{ route('client:company.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">

                    <p class="card-title-desc">Entrer les information du société</p>

                    <div class="row">
                        <div class="col-lg-6">

                            @include('Sameleon.Client.Company.__create.__info')

                            <div class="col-lg-12">
                                @include('Sameleon.Client.Company.__create.__date_commande')
                            </div>
                        </div>

                        <div class="col-lg-6">

                            @include('Sameleon.Client.Company.__create.__select_city')
                            
                            <div class=" mb-4">
                                <label>Siège social *</label>
                                <textarea name="addresse" id="textarea"
                                    class="form-control @error('addresse') is-invalid @enderror" maxlength="225"
                                    rows="5"  required></textarea>

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
            <div class="card">
                <div class="card-body">
                    <p class="card-title-desc">Les informations ce dessus ne sont pas obligatoires</p>
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            @include('Sameleon.Client.Company.__create.__other')
                        </div>
                    </div>

                </div>
            </div>
            {{--@include('theme.Sameleon.Command.__create.__condition')--}}
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
