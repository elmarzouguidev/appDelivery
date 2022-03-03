<div class="row">

    <div class="col-lg-12">
        <form class="repeater" action="{{ route('sameleon:commands.create') }}" method="post">
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
                            <div class="templating-select mb-4">
                                <label class="form-label">Ville *</label>
                                <select name="client_city"
                                    class="form-control select2-templating @error('client_city') is-invalid @enderror">
                                    <option value="casablanca">Casablanca</option>

                                </select>
                                @error('client_city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class=" mb-4">
                                <label>Adresse du client *</label>
                                <textarea name="client_address" id="textarea"
                                    class="form-control @error('client_address') is-invalid @enderror" maxlength="225"
                                    rows="5"></textarea>

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
                        <div class="col-lg-4">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            @include('theme.Sameleon.Command.__create.__add_articles')
                        </div>
                        <div class="col-lg-6">
                            <div class="justify-content-end">
                                <div class="card border border-primary">
                                    <div class="card-header bg-transparent border-primary">
                                        <h5 class="my-0 text-primary">
                                            <i class="mdi mdi-alarm-panel-outline me-3"></i>
                                            {{ __('invoice.form.total_ht') }} :
                                        </h5>
                                        <hr>
                                        <h5 class="my-0 text-danger">
                                            <i class="mdi mdi-alarm-panel-outline me-3"></i>
                                            {{ __('invoice.form.total_ttc') }} :
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <p class="card-title-desc">{{ __('invoice.form.title') }}</p>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="condition_general">{{ __('invoice.form.condition_general') }}</label>
                            <textarea name="condition_general" id="condition_general"
                                class="form-control @error('condition_general') is-invalid @enderror"></textarea>
                            @error('condition_general')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2 justify-content-end mb-4">
                <div class="">
                    <button type="submit" class="btn btn-primary waves-effect waves-light" {{-- onclick='document.getElementById("overlayy").style.display = "block"' --}}>
                        {{ __('buttons.store') }}

                    </button>
                    <button type="submit" class="btn btn-secondary waves-effect waves-light">
                        {{ __('buttons.store_draft') }}
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
