<div>
    <div>
        @if (isAdmin())
            @include('livewire.sameleon.command.__new_filters')
        @endif
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Actions Disponible</h4>
                        <p class="card-title-desc"></p>
                        <div class="button-items">
                            @if (isClient())

                                @if (auth()->user()->products()->count() <= 0)
                                    <a href="{{ route('admin:products.create') }}" class="btn btn-info mr-3 mb-2">
                                        Ajouter un produit
                                    </a>
                                @else
                                    <button class="btn btn-info mr-3 mb-2" type="button" data-bs-toggle="modal"
                                        data-bs-target=".addCommandModal">
                                        Ajouter une commande
                                    </button>
                                @endif

                            @endif

                            @if (isClient() || isAdmin())
                                <button class="btn btn-warning mr-3 mb-2" type="button" data-bs-toggle="modal"
                                    data-bs-target=".importCommandModal">
                                    Importer des commands
                                </button>
                            @endif

                            @if (isAdmin())
                                <button {{ count($selectedCommands) ? '' : 'disabled' }}
                                    class="btn btn-primary mr-3 mb-2" type="button" data-bs-toggle="modal"
                                    data-bs-target=".attachCommandModal">
                                    Envoyer au Livreur {{-- : @json($selectedCommands) --}}
                                </button>
                            @endif

                            @if (isAdmin())
                                {{-- <button {{ count($selectedCommands) ? '' : 'disabled' }}
                                    class="btn btn-primary mr-3 mb-2" type="button" 

                                    wire:click="generateBl()"
                                    >
                                    Générer un Bon de livraison 
                                </button> --}}
                                <button {{ count($selectedCommands) ? '' : 'disabled' }}
                                    class="btn btn-primary mr-3 mb-2" type="button" data-bs-toggle="modal"
                                    data-bs-target=".generateBlModal">
                                    Générer un Bon de livraison
                                </button>
                                {{-- <button {{ count($selectedCommands) ? '' : 'disabled' }}
                                    class="btn btn-primary mr-3 mb-2" type="button" 
        
                                    wire:click="generateBR()"
                                    >
                                    Générer un Bon de retour
                                </button> --}}

                                <button {{ count($selectedCommands) ? '' : 'disabled' }}
                                    class="btn btn-primary mr-3 mb-2" type="button" data-bs-toggle="modal"
                                    data-bs-target=".generateBRModal">
                                    Générer un Bon de retour {{-- : @json($selectedCommands) --}}
                                </button>
                            @endif
                            {{-- @if (isAdmin())
                                <button {{ count($selectedCommands) ? '' : 'disabled' }}
                                    class="btn btn-info mr-3 mb-2" type="button" 
                                    data-bs-toggle="modal"
                                    data-bs-target=".generateBL"
                                    wire:click="printCommands()"
                                    >
                                    Impression 
                                </button>
                                @endif --}}

                            <a href="{{ route('admin:commands.archived') }}" class="btn btn-secondary mr-3 mb-2">
                                <i class="bx bx-archive font-size-16 align-middle me-2"></i>
                                Archive
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('layouts._parts.__messages')
                        <div class="table-responsive">
                            <table
                                class="table table-bordered border-danger table-hover align-middle table-nowrap table-check">
                                <thead class="table-light">
                                    <tr>
                                        @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
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
                                        @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                            <th class="align-middle">Client</th>
                                        @endif
                                        <th class="align-middle">Etat</th>
                                        <th class="align-middle">Notes</th>

                                        <th class="align-middle">Date</th>
                                        <th class="align-middle">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($commands as $command)
                                        <tr wire:key="{{ $command->id }}">
                                            @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
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
                                                        @if (($command->invoice_count > 0 && $command->status == App\Status\Status::LIVRE) ||
                                                            $command->status == App\Status\Status::REFUSE)
                                                            <a target="_blank"
                                                                title="Facture : {{ optional($command->invoice)->full_number }}"
                                                                style="color:#2f5393 !important"
                                                                href="{{ $command->invoice ? route('public.show.invoice', [$command->invoice->uuid, 'has_header' => true]) : '#' }}">
                                                                {{ $command->code }}</a>
                                                        @else
                                                            <a style="color:#2f5393 !important"
                                                                href="{{ $command->is_closed ? '#' : route('admin:commands.edit', $command->uuid) }}">
                                                                {{ $command->code }}</a>
                                                        @endif
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
                                                    <b>{{ $command->city?->name ?? ($command->client_city ?? '') }}</b>
                                                </p>
                                                <p class="text-strong mb-0" style="color:#f1b44c !important">
                                                    <b>{{ $command->region?->name ?? '' }}</b>
                                                </p>
                                                <p class="text-strong mb-0">{!! $command->client_address !!}</p>
                                            </td>
                                            <td>
                                                @include('livewire.sameleon.command.__items_normal')
                                            </td>
                                            <td>
                                                {{-- $command->products->sum('pivot.price_total') --}}
                                                {{ number_format($command->items_sum_prix_total, 2) }}
                                                DH
                                            </td>
                                            @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                                <td>
                                                    @if (optional($command->client)->type == 'entreprise')
                                                        <i class="fas fa-building me-1"></i>
                                                    @else
                                                        <i class="fas fa-user me-1"></i>
                                                    @endif
                                                    {{ optional($command->client)->full_name }}
                                                </td>
                                            @endif
                                            <td>
                                                @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                                    @php
                                                        $disabled = '';
                                                        $command->invoice && optional($command->invoice)->cloture == 1 ? ($disabled = 'disabled') : '';
                                                    @endphp
                                                    <button id="editStatus" {{ $disabled }}
                                                        wire:click="editStatus('{{ $command->uuid }}')"
                                                        type="button"
                                                        class="btn btn-sm {{ __('status.classes.' . $command->status) }} waves-effect waves-light">
                                                        {{ __('status.statuses.' . $command->status) }}
                                                        <br>
                                                        @if ($command->status == App\Status\Status::ENCOURS && $command->delivery)
                                                            {{ $command->status == App\Status\Status::ENCOURS ? $command->delivery->full_name : '' }}
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

                                            {{-- <td>
                                            <button type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                                                data-bs-target=".orderdetailsModal-{{ $command->id }}">
                                                Détails
                                            </button>
                                        </td> --}}
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
                                            <td>
                                                <div class="d-flex gap-3">
                                                    {{-- @if ($command->invoice)
                                                    <a title="Facture : {{$command->invoice->full_number}}" style="color:#2f5393 !important" target="_blank"
                                                        href="{{ route('public.show.invoice', [$command->invoice->uuid, 'has_header' => true]) }}"
                                                        class="btn btn-sm text-success">

                                                        <i class="mdi mdi-file-pdf-box font-size-24"></i>
                                                    </a>
     
                                                @endif --}}

                                                    {{-- <a href="#" wire:click="editCommand('{{ $command->uuid }}')"
                                                    class="text-success">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                                <a href="#" class="text-danger deleteCommandBtn" >
                                                    <i class="mdi mdi-delete font-size-18"></i>
                                                </a> --}}


                                                    @if ($command->status == App\Status\Status::NON_TRAITE &&
                                                        $command->user_id == auth()->id() &&
                                                        $command->user_uuid == auth()->user()->uuid)
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm deleteCommandBtn"
                                                            data-command="{{ $command->uuid }}">
                                                            <i class="mdi mdi-delete font-size-18"></i>
                                                        </button>
                                                    @endif
                                                    <button type="button"
                                                        {{ $command->status == App\Status\Status::LIVRE || optional($command->invoice)->cloture == 1 ? 'disabled' : '' }}
                                                        wire:click="editCommand('{{ $command->uuid }}')"
                                                        class="btn btn-info btn-sm">
                                                        Edit
                                                    </button>
                                                </div>
                                            </td>
                                            @if ($command->user_id == auth()->id() && $command->user_uuid == auth()->user()->uuid)
                                                <form id="{{ $command->uuid }}" method="post"
                                                    action="{{ route('admin:commands.delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="commandId"
                                                        value="{{ $command->uuid }}">
                                                </form>
                                            @endif
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
    @if ($showEdit)
        @include('livewire.sameleon.command.edit-command', [
            'command' => $commandEdit,
        ])
    @endif

    @if ($showEditStatus)
        @include('livewire.sameleon.command.update-status-2', [
            'command' => $commandEdit,
        ])
    @endif

    {{-- @if ($isRepoted)
        @include('livewire.sameleon.command.reported-status', [
            'command' => $commandEdit,
        ])
    @endif --}}

    @if (count($selectedCommands))
        @include('livewire.sameleon.command.attache_to_delivery')
    @endif

    @if (count($selectedCommands))
        @include('livewire.sameleon.command.__generate_bl_modal')
    @endif

    @if (count($selectedCommands))
        @include('livewire.sameleon.command.__generate_br_modal')
    @endif
</div>
