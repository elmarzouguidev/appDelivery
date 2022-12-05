<div class="row">
    <div class="col-lg-12">

        {{-- <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-danger"> Supprimer cette command</button>
            </div>
        </div> --}}

        @include('layouts._parts.__messages')

        <form action="{{ $command->update_url }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">

                    <p class="card-title-desc">Entrer les information du client</p>

                    <div class="row">
                        <div class="col-lg-6">

                            @include('Sameleon.Admin.Command.__edit.__info')

                            <div class="col-lg-12">

                                @include('Sameleon.Admin.Command.__edit.__date_commande')

                            </div>
                        </div>

                        <div class="col-lg-6">

                            {{-- @include('Sameleon.Admin.Command.__edit.__select_city') --}}

                            @livewire('sameleon.command.create.select-city', ['command' => $command])

                            <div class=" mb-4">
                                <label>Adresse du client *</label>
                                <textarea name="client_address" id="textarea" class="form-control @error('client_address') is-invalid @enderror"
                                    maxlength="225" rows="5">{{ str_replace('<br>', '', $command->client_address) }}</textarea>

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
                            @livewire('sameleon.command.edit', ['command' => $command])
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="justify-content-end">
                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary">
                                        <i class="mdi mdi-alarm-panel-outline me-3"></i>
                                        Total du Command: {{ $command->items_sum_prix_total }} DH

                                    </h5>
                                    <hr>
                                    <h5 class="my-0 text-info">
                                        <i class="mdi mdi-alarm-panel-outline me-3"></i>
                                        Frais de Livraison : {{ $command->frais }} DH

                                    </h5>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @include('theme.Sameleon.Command.__create.__condition') --}}
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
