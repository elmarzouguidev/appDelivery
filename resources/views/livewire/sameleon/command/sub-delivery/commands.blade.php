<div>
    <div>
        @include('livewire.sameleon.command.sub-delivery.__filters')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">

                                    @if (auth()->user()->hasAnyRole('DeliveryEntreprise'))
                                        <button {{ count($selectedCommands) ? '' : 'disabled' }}
                                            class="btn btn-primary mr-3 mb-2" type="button" data-bs-toggle="modal"
                                            data-bs-target=".attachCommandModal">
                                            Envoyer au sous Livreur {{-- : @json($selectedCommands) --}}
                                        </button>
                                    @endif

                                    <a href="{{ route('delivery:commands.archived') }}"
                                        class="btn btn-secondary mr-3 mb-2">
                                        <i class="bx bx-archive font-size-16 align-middle me-2"></i>
                                        Archive
                                    </a>
                                </div>

                            </div>
                        </div>

                        @include('layouts._parts.__messages')

                        <div class="table-responsive">
                            <table
                                class="table table-bordered border-danger table-hover align-middle table-nowrap table-check">
                                <thead class="table-light">
                                    <tr>
                                        @if (auth()->user()->hasAnyRole('DeliveryEntreprise'))
                                            <th style="width: 20px;" class="align-middle">
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                                    <label class="form-check-label" for="checkAll"></label>
                                                </div>
                                            </th>
                                        @endif
                                        <th class="align-middle">Destinataire</th>
                                        <th class="align-middle">Produits</th>
                                        <th class="align-middle">Prix</th>
                                        <th class="align-middle">Etat</th>
                                        <th class="align-middle">Notes</th>
                                        <th class="align-middle">Date</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($commands as $command)
                                        <tr wire:key="{{ $command->id }}">
                                            @if (auth()->user()->hasAnyRole('DeliveryEntreprise'))
                                                <td>
                                                    <div class="form-check font-size-16">
                                                        <input {{ $command->is_closed ? 'disabled' : '' }}
                                                            wire:model="selectedCommands" class="form-check-input"
                                                            type="checkbox" id="command-{{ $command->id }}"
                                                            value="{{ $command->id }}">
                                                        <label {{ $command->is_closed ? 'disabled' : '' }}
                                                            class="form-check-label"
                                                            for="command-{{ $command->id }}"></label>
                                                    </div>
                                                </td>
                                            @endif
                                            <td>
                                                <p class="text-strong mb-0">
                                                    <strong>

                                                        <a style="color:#2f5393 !important" href="#">
                                                            {{ $command->code }}
                                                        </a>

                                                    </strong>
                                                </p>
                                                {{ $command->client_name }}
                                                <p class="text-strong mb-0">
                                                    <strong>
                                                        <a style="color:#2f5393 !important"
                                                            href="tel:{{ $command->client_phone }}">{{ $command->client_phone }}</a>
                                                    </strong>
                                                </p>
                                                <p class="text-strong mb-0">
                                                    <b>{{ optional($command->city)->name ?? ($command->client_city ?? '') }}</b>
                                                </p>
                                                <p class="text-strong mb-0" style="color:#f1b44c !important">
                                                    <b>{{ $command->region?->name ?? '' }}</b>
                                                </p>
                                                <p class="text-strong mb-0">{!! $command->client_address !!}</p>
                                            </td>
                                            <td>
                                                @include('livewire.sameleon.command.sub-delivery.__items')
                                            </td>
                                            <td>
                                                {{-- $command->products->sum('pivot.price_total') --}}
                                                {{ number_format($command->items_sum_prix_total, 2) }}
                                                DH
                                            </td>
                                            <td>
                                                @if (auth()->user()->hasRole('DeliveryEntreprise'))
                                                    @php
                                                        $disabled = '';
                                                        $command->invoice && optional($command->invoice)->cloture == 1 ? ($disabled = 'disabled') : '';
                                                    @endphp
                                                    <button id="editStatus" {{ $disabled }}
                                                        wire:click="editStatus('{{ $command->uuid }}')" type="button"
                                                        class="btn btn-sm {{ __('status.classes.' . $command->status) }} waves-effect waves-light">
                        
                                                        @if ($command->status == App\Status\Status::EXPEDIE &&

                                                             $command->delivery_status == App\Status\DeliveryStatus::D_NON_TRAITE
                                                            )

                                                             {{ __('delivery_status.statuses.' . $command->delivery_status) }}

                                                        @else

                                                             {{ __('status.statuses.' . $command->status) }}

                                                        @endif
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-sm {{ __('status.classes.' . $command->status) }} waves-effect waves-light">
                                                        {{ __('status.statuses.' . $command->status) }}
                                                    </button>
                                                @endif
                                                @if ($command->status == App\Status\Status::REPORTE && $command->reported_at != null)
                                                    <p class="text-strong mb-0 mt-2" style="color:red">
                                                        <b>{{ $command->reported_at->format('d-m-Y') ?? '' }}</b>
                                                    </p>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($command->comment != null)
                                                    <p class=" mb-0">
                                                        {!! $command->comment !!}
                                                    </p>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>date d'ajoute</strong>
                                                <p class="text-strong mb-0">
                                                    {{ $command->created_at->format('d-m-Y H:i') }}
                                                </p>
                                                <strong>date de modification</strong>
                                                <p class="text-strong mb-0">
                                                    {{ $command->updated_at->format('d-m-Y H:i') }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        {{ $commands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($showEditStatus)
        @include('livewire.sameleon.command.sub-delivery.update-status', [
            'command' => $commandEdit,
        ])
    @endif

    @if ($isRepoted)
        @include('livewire.sameleon.command.sub-delivery.reported-status', [
            'command' => $commandEdit,
        ])
    @endif

    @if (count($selectedCommands))
        @include('livewire.sameleon.command.sub-delivery.attach_sub_delivery')
    @endif

</div>
