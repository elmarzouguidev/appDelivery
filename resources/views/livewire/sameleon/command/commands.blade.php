<div>
    <div>
        @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
            @include('livewire.sameleon.command.__new_filters')
        @endif
        <div class="row">

            {{-- @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin') &&
    $showFilters)
                @include('livewire.sameleon.command.filters')
            @endif --}}

            <div class="col-lg-12" wire:key="appCommands">
                <div class="card">
                    <div class="card-body" {{ $canPolled ? 'wire:poll.10s' : '' }}>
                        <div class="row">
                            <div class="col-lg-8">

                                <div class="col-lg-8 mb-4">

                                    {{-- @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                        <button wire:click="showUpFilter()" type="button" class="btn btn-primary">
                                            Filters
                                        </button>
                                    @endif --}}
                                    <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                        data-bs-toggle="modal" data-bs-target=".addCommandModal">
                                        Ajouter une commande
                                    </button>
                                </div>
                            </div>
                        </div>
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
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif
                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    {{-- <th style="width: 20px;" class="align-middle">
                                <div class="form-check font-size-16">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                    <label class="form-check-label" for="checkAll"></label>
                                </div>
                            </th> --}}
                                    {{-- <th scope="col">Numéro / client</th> --}}
                                    <th scope="col">Destinataire</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Prix Total</th>
                                    <th scope="col">Détails</th>
                                    @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                        <th scope="col">Client</th>
                                    @endif
                                    <th scope="col">Date de commande</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($commands as $command)
                                    <tr>
                                        {{-- <td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox"
                                            id="client-{{ $client->id }}">
                                        <label class="form-check-label" for="client-{{ $client->id }}"></label>
                                    </div>
                                </td> --}}
                                        {{-- <td>
                                    <a href="$client->url" class="text-body fw-bold">
                                        {{ $order->code }}
                                    </a>
                                    <p class="text-strong mb-0">{{$order->client->full_name}}</p>
                                </td> --}}
                                        <td>

                                            <p class="text-strong mb-0"><strong>{{ $command->code }}</strong></p>
                                            {{ $command->client_name }}
                                            <p class="text-strong mb-0"><strong>{{ $command->client_phone }}</strong>
                                            </p>
                                            <p class="text-strong mb-0">{{ $command->city->name }}</p>
                                            <p class="text-strong mb-0">{{ $command->client_address }}</p>
                                        </td>
                                        <td>
                                            @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                                <button wire:click="editStatus('{{ $command->uuid }}')" type="button"
                                                    class="btn btn-sm {{ __('status.classes.' . $command->status) }} waves-effect waves-light">
                                                    {{ __('status.statuses.' . $command->status) }}
                                                </button>
                                            @else
                                                <button type="button"
                                                    class="btn btn-sm {{ __('status.classes.' . $command->status) }} waves-effect waves-light">
                                                    {{ __('status.statuses.' . $command->status) }}
                                                </button>
                                            @endif

                                        </td>
                                        <td>
                                            {{-- $command->products->sum('pivot.price_total') --}}
                                            {{ number_format($command->products_sum_product_commandprice_total, 2) }}
                                            DH
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                                                data-bs-target=".orderdetailsModal-{{ $command->id }}">
                                                Détails
                                            </button>
                                        </td>
                                        @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                            <td>
                                                @if (optional($command->client)->type === 'entreprise')
                                                    <i class="fas fa-building me-1"></i>
                                                @endif
                                                @if (optional($command->client)->type === 'particulier')
                                                    <i class="fas fa-user me-1"></i>
                                                @endif
                                                {{ optional($command->client)->full_name }}
                                            </td>
                                        @endif
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
                                                @if ($command->invoice)
                                                    <a target="_blank"
                                                        href="{{ route('public.show.invoice', [$command->invoice->uuid, 'has_header' => true]) }}"
                                                        class="text-success">
                                                        <i class="mdi mdi-file-pdf-box font-size-18"></i>
                                                    </a>
                                                @endif
                                                {{-- <a href="#" wire:click="editCommand('{{ $command->uuid }}')"
                                                    class="text-success">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                                <a href="#" class="text-danger deleteCommandBtn" >
                                                    <i class="mdi mdi-delete font-size-18"></i>
                                                </a> --}}

                                                <button type="button" class="btn btn-danger btn-sm deleteCommandBtn">
                                                    Supp
                                                </button>
                                                <button type="button"
                                                    wire:click="editCommand('{{ $command->uuid }}')"
                                                    class="btn btn-info btn-sm">
                                                    Edit
                                                </button>
                                            </div>
                                        </td>
                                        <form id="delete-order-{{ $command->uuid }}" method="post"
                                            action="{{ route('admin:commands.delete') }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="commandId" value="{{ $command->uuid }}">
                                        </form>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if ($showEdit)
                @include('livewire.sameleon.command.edit-command', [
                    'command' => $commandEdit,
                ])
            @endif

            @if ($showEditStatus)
                @include('livewire.sameleon.command.update-status', [
                    'command' => $commandEdit,
                ])
            @endif

            @if ($isRepoted)
                @include('livewire.sameleon.command.reported-status', [
                    'command' => $commandEdit,
                ])
            @endif

        </div>
        @each('Sameleon.Admin.Command.__datatable.__command_detail',$commands ,'command' )
    </div>
</div>
