<div class="row">
    @if ($showFilters)

        @include('livewire.sameleon.command.filters')

    @endif
    <div class="{{$class}}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-8 mb-4">
                            <button wire:click="showFilter()"  type="button"  class="btn btn-primary" >
                                Filters
                            </button>
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
                            <th scope="col">Client</th>
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
                                    <p class="text-strong mb-0"><strong>{{ $command->client_phone }}</strong></p>
                                    <p class="text-strong mb-0">{{ $command->client_address }}</p>
                                    <p class="text-strong mb-0">{{ $command->client_city }}</p>
                                </td>
                                <td>
                                    {{-- <i class="mdi mdi-circle text-info font-size-10"></i>
                                    {{ __('status.statuses.' . $command->status) }} --}}

                                    <button wire:click="editStatus('{{ $command->uuid }}')" type="button"
                                        class="btn btn-sm {{ __('status.classes.' . $command->status) }} waves-effect waves-light">
                                        {{ __('status.statuses.' . $command->status) }}
                                    </button>

                                </td>
                                <td>
                                    {{-- $command->products->sum('pivot.price_total') --}}
                                    {{ number_format($command->products_sum_product_commandprice_total, 2) }} DH
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                                        data-bs-target=".orderdetailsModal-{{ $command->id }}">
                                        Détails
                                    </button>
                                </td>
                                <td>
                                    @if (optional($command->client)->type === 'entreprise')
                                        <i class="fas fa-building me-1"></i>
                                    @endif
                                    @if (optional($command->client)->type === 'particulier')
                                        <i class="fas fa-user me-1"></i>
                                    @endif
                                    {{ optional($command->client)->full_name }}
                                </td>
                                <td>
                                    <strong>date d'ajoute</strong>
                                    <p class="text-strong mb-0">{{ $command->created_at->format('d-m-Y H:i') }}</p>
                                    <strong>date de modification</strong>
                                    <p class="text-strong mb-0">{{ $command->updated_at->format('d-m-Y H:i') }}</p>
                                </td>
                                <td>
                                    <div class="d-flex gap-3">

                                        {{-- <a href="{{ $command->edit_url }}" class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a> --}}
                                        <a href="#" wire:click="editCommand('{{ $command->uuid }}')"
                                            class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                        <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this command ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-order-{{ $command->uuid }}').submit();
                                                }">
                                            <i class="mdi mdi-delete font-size-18"></i>
                                        </a>
                                    </div>
                                </td>
                                <form id="delete-order-{{ $command->uuid }}" method="post"
                                    action="{{ route('client:commands.delete') }}">
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
    {{$errors}}
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
            'command' => $commandEdit
           
        ])
    @endif
</div>
