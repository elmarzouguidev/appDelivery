<div>
    <div class="row">
        @foreach ($commands as $command)
            <div class="col-xl-3 col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class=" mx-auto mb-4">
                            <span class="avatar-title bg-info bg-info text-soft font-size-20">

                                <strong> {{ $command->code }}</strong>

                            </span>
                        </div>
                        <div class=" mx-auto mb-4">
                            <span class="avatar-title bg-primary bg-soft text-primary font-size-20">

                                Prix : <strong> {{ number_format($command->items_sum_prix_total, 2) }} DH </strong>

                            </span>
                        </div>
                        <p class="font-size-17"><strong>{{ $command->client_name }}</strong></p>
                        <hr>
                        <p class="font-size-17">{{ $command->city->name ?? ($command->client_city ?? '') }}</p>
                        <br>
                        <p class="font-size-17">{!! $command->client_address !!}</p>
                        <hr>
                        <h5 class="font-size-17 mb-1">
                            <a href="tel:{{ $command->client_phone }}" class="text-primary">
                                {{ $command->client_phone }}
                            </a>
                        </h5>

                        <hr>
                        @php
                            $disabled = '';
                            if ($command->status == App\Status\Status::LIVRE) {
                                $disabled = 'disabled';
                            }
                        @endphp
                        <div>
                            <button {{ $disabled }} class="btn btn-success font-size-18 m-1"
                                wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::LIVRE }})">
                                Livré
                            </button>
                            <button {{ $disabled }} class="btn btn-danger font-size-18 m-1"
                                wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::ANNULE }})">

                                Non livré
                            </button>
                            <button {{ $disabled }} class="btn btn-warning font-size-18 m-1"
                                wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::NON_INTERESSE }})">
                                Non intéressé
                            </button>
                            <button {{ $disabled }} class="btn btn-primary font-size-18 m-1"
                                wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::PAS_DE_REPONSE }})">
                                Pas de reponse
                            </button>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <div class="contact-links d-flex font-size-17">
                            <div class="flex-fill">

                                @foreach ($command->items as $item)
                                    <div>
                                        <p class="text-strong mb-0">
                                            <strong>{{ $item->product }}</strong>
                                        </p>

                                        <p class="text-muted mb-0">{{ $item->prix_uni }} (DH) x
                                            {{ $item->quantity }}
                                        </p>

                                        <br>

                                    </div>
                                    <hr>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
