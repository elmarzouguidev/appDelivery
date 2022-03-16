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
        <form  action="{{ route('sameleon:commands.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">

                    <p class="card-title-desc">Entrer les information du client</p>

                    <div class="row">
                        <div class="col-lg-6">

                            @include('theme.Sameleon.Command.__create.__info')

                            <div class="col-lg-12">
                                @include('theme.Sameleon.Command.__create.__date_commande')
                            </div>
                        </div>

                        <div class="col-lg-6">

                            @include('theme.Sameleon.Command.__create.__select_city')
                            
                            <div class=" mb-4">
                                <label>Adresse du client *</label>
                                <textarea name="client_address" id="textarea"
                                    class="form-control @error('client_address') is-invalid @enderror" maxlength="225"
                                    rows="5" required></textarea>

                                @error('client_address')
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
                    <p class="card-title-desc">Entrer les information de la commande</p>
                    <div class="row">
                        <div class="col-lg-12 mb-4">

                            {{--@include('theme.Sameleon.Command.__create.__add_articles')--}}
                            @livewire('sameleon.command.products')

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
