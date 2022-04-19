@if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
    @include('Sameleon.Admin.Command.__datatable.__new_filters')
@endif
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-12 mb-4">
                            <button class="btn btn-info" type="button" data-bs-toggle="modal"
                                data-bs-target=".addCommandModal">
                                Ajouter une commande
                            </button>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target=".importCommandModal">
                                Importer des commands
                            </button>
                        </div>
                    </div>
                </div>

                @include('layouts._parts.__messages')
                
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
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
                            <th scope="col">Produits</th>
                            <th scope="col">Prix</th>
                            @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                <th scope="col">Client</th>
                            @endif
                            <th scope="col">Etat</th>

                            {{-- <th scope="col">Détails</th> --}}
                            <th scope="col">Notes</th>

                            <th scope="col">Date de commande</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($commands as $command)
                            <tr>
                                <td>
                                    <p class="text-strong mb-0"><strong>{{ $command->code }}</strong></p>
                                    {{ $command->client_name }}
                                    <p class="text-strong mb-0"><strong>{{ $command->client_phone }}</strong>
                                    </p>
                                    <p class="text-strong mb-0">
                                        {{ $command->city->name ?? $command->client_city }}</p>
                                    <p class="text-strong mb-0">{!! $command->client_address !!}</p>
                                </td>
                                <td>
                                    @foreach ($command->products as $product)
                                        <p class="text-strong mb-0">
                                            <strong>{{ $product->name }}</strong>
                                        </p>
                                        <div>

                                            <p class="text-muted mb-0">{{ $product->price }}(DH) x
                                                {{ $product->pivot->quantity }}
                                            </p>
                                        </div>
                                    @endforeach

                                </td>
                                <td>
                                    {{-- $command->products->sum('pivot.price_total') --}}
                                    {{ number_format($command->products_sum_product_commandprice_total, 2) }}
                                    DH
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
                                    @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                        <button type="button"
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

                                {{-- <td>
                                 <button type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                                     data-bs-target=".orderdetailsModal-{{ $command->id }}">
                                     Détails
                                 </button>
                             </td> --}}
                                <td>
                                    <p class=" mb-0">
                                        {{ $command->comments()->latest()->value('content') }}
                                    </p>
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

                                        @if ($command->user_id === auth()->id() && $command->user_uuid === auth()->user()->uuid)
                                            <button type="button" class="btn btn-danger btn-sm deleteCommandBtn">
                                                Supp
                                            </button>
                                        @endif
                                        <button type="button" class="btn btn-info btn-sm">
                                            Edit
                                        </button>
                                    </div>
                                </td>
                                @if ($command->user_id === auth()->id() && $command->user_uuid === auth()->user()->uuid)
                                    <form id="delete-order-{{ $command->uuid }}" method="post"
                                        action="{{ route('admin:commands.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="commandId" value="{{ $command->uuid }}">
                                    </form>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
