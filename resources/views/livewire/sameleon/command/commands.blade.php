<div>
    <div>
        @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
            @include('livewire.sameleon.command.__new_filters')
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div   class="card-body" {{ $canPolled ? 'wire:poll.10s' : '' }}>
                        <div class="row">
                            <div class="col-lg-8">

                                <div class="col-lg-12 mb-4">

                                    {{-- @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                        <button wire:click="showUpFilter()" type="button" class="btn btn-primary">
                                            Filters
                                        </button>
                                    @endif --}}
                                    @if(auth()->user()->hasRole('Client'))

                                        @if(auth()->user()->products()->count() <= 0)
                                            <a href="{{route('admin:products.create',['shoud_product' => true])}}" class="btn btn-info">
                                                Ajouter un produit
                                            </a>
                                        @else

                                        <button class="btn btn-info" type="button" data-bs-toggle="modal"
                                            data-bs-target=".addCommandModal">
                                            Ajouter une commande
                                        </button>
                                        
                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                            data-bs-target=".importCommandModal">
                                            Importer des commands
                                        </button>

                                        @endif

                                    @endif
                                    
                                    @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                    
                                            <button {{count($selectedCommands) ? '' : 'disabled' }} class="btn btn-primary" type="button" data-bs-toggle="modal"
                                                data-bs-target=".attachCommandModal">
                                                Envoyer au Livreur {{--: @json($selectedCommands)--}}
                                            </button>
                                        
                                    @endif

                                    {{--@if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                      
                                            <button class="btn btn-danger deleteCMD" type="button">
                                              
                                                Supprimer
                                            </button>
                                    @endif--}}
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
                        <table data-auto-responsive="false"  id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr >
                                    @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                    <th style="width: 20px;" class="align-middle">
                                      
                                    </th>
                                    @endif
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

                                    {{--<th scope="col">Date de commande</th>--}}
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($commands as $command)
                                    <tr wire:key="{{ $command->id }}">
                                        @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input wire:model="selectedCommands" class="form-check-input" type="checkbox"
                                                        id="command-{{ $command->id }}" value="{{$command->id}}" >
                                                    <label class="form-check-label" for="command-{{ $command->id }}"></label>
                                                </div>
                                            </td>
                                        @endif
                                        <td>
                                            <p class="text-strong mb-0">
                                                <strong>
                                                    @if($command->status == App\Status\Status::LIVRE && $command->invoice)
                                                     <a target="_blank" title="Facture : {{$command->invoice->full_number}}" style="color:#2f5393 !important" href="{{ route('public.show.invoice', [$command->invoice->uuid, 'has_header' => true]) }}"> {{ $command->code }}</a>
                                                     @else
                                                     <a style="color:#2f5393 !important" href="{{route('admin:commands.edit',$command->uuid)}}"> {{ $command->code }}</a>
                                                    @endif
                                                </strong>
                                            </p>
                                            {{ $command->client_name }}
                                            <p class="text-strong mb-0">
                                                <strong>
                                                    <a style="color:#2f5393 !important" href="tel:{{ $command->client_phone }}">{{ $command->client_phone }}</a>
                                                </strong>
                                            </p>
                                            <p class="text-strong mb-0">
                                                {{ $command->city->name ?? $command->client_city ?? '' }}</p>
                                            <p class="text-strong mb-0">{!! $command->client_address !!}</p>
                                        </td>
                                        <td>
                                            @foreach ($command->items as $item)

                                                <p class="text-strong mb-0">
                                                    <strong>{{ $item->product }}</strong>
                                                </p>
                                              
                                                <div>

                                                    <p class="text-muted mb-0">{{ $item->prix_uni }} (DH) x
                                                        {{ $item->quantity }}
                                                    </p>
                                                    <hr>
                                                    <p class="text-muted mb-0">
                                                        {{ $item->designation }}
                                                    </p>
                                                    @if($item->is_out)
                                                    {{--<p style="color:red">rupture de stock</p>--}}
                            
                                                    <a class="btn btn-primary btn-sm"  href="{{route('admin:stock.index',['isOut' => $item->uuid])}}">
                                                        augmenter le stock
                                                    </a>
                                                    @endif
                                                </div>
                                            @endforeach

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
                                                @endif
                                                @if (optional($command->client)->type == 'particulier')
                                                    <i class="fas fa-user me-1"></i>
                                                @endif
                                                {{ optional($command->client)->full_name }}
                                            </td>
                                        @endif
                                        <td>
                                            @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin','Delivery'))
                                               
                                                  @php
                                                      $disabled = '';
                                                      $command->invoice && optional($command->invoice)->cloture == 1 ? $disabled = "disabled" : '' 
                                                  @endphp
                                                    <button id="editStatus" {{$disabled}}
                                                       
                                                        wire:click="editStatus('{{ $command->uuid }}')" type="button"
                                                        class="btn btn-sm {{ __('status.classes.' . $command->status) }} waves-effect waves-light">
                                                        {{ __('status.statuses.' . $command->status) }}
                                                        <br>
                                                        @if($command->status == App\Status\Status::ENCOURS && $command->delivery)
                                                         {{$command->status == App\Status\Status::ENCOURS ? $command->delivery->full_name :'' }}
                                                        @endif
                                                    </button>
               
                                            @else
                                                <button type="button"
                                                    class="btn btn-sm {{ __('status.classes.' . $command->status) }} waves-effect waves-light">
                                                    {{ __('status.statuses.' . $command->status) }}
                                                </button>
                                            @endif
                                            @if ($command->status == App\Status\Status::REPORTE && $command->comment != null && $command->reported_at != null)
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
                                        {{--<td>
                                            <strong>date d'ajoute</strong>
                                            <p class="text-strong mb-0">
                                                {{ $command->created_at->format('d-m-Y H:i') }}
                                            </p>
                                            <strong>date de modification</strong>
                                            <p class="text-strong mb-0">
                                                {{ $command->updated_at->format('d-m-Y H:i') }}
                                            </p>
                                        </td>--}}
                                        <td>
                                            <div class="d-flex gap-3">
                                                {{--@if ($command->invoice)
                                                    <a title="Facture : {{$command->invoice->full_number}}" style="color:#2f5393 !important" target="_blank"
                                                        href="{{ route('public.show.invoice', [$command->invoice->uuid, 'has_header' => true]) }}"
                                                        class="btn btn-sm text-success">

                                                        <i class="mdi mdi-file-pdf-box font-size-24"></i>
                                                    </a>
     
                                                @endif--}}
                                                
                                                {{-- <a href="#" wire:click="editCommand('{{ $command->uuid }}')"
                                                    class="text-success">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                                <a href="#" class="text-danger deleteCommandBtn" >
                                                    <i class="mdi mdi-delete font-size-18"></i>
                                                </a> --}}


                                                @if ( $command->status == App\Status\Status::NON_TRAITE && $command->user_id == auth()->id() && $command->user_uuid == auth()->user()->uuid)
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm deleteCommandBtn" data-command="{{$command->uuid}}">
                                                        <i class="mdi mdi-delete font-size-18"></i>
                                                    </button>
                                                @endif
                                                <button type="button" {{$command->status == App\Status\Status::LIVRE || optional($command->invoice)->cloture == 1 ? 'disabled' :''}}
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

    @if (count($selectedCommands))
        @include('livewire.sameleon.command.attache_to_delivery')
    @endif

    {{-- @each('Sameleon.Admin.Command.__datatable.__command_detail',$commands ,'command' ) --}}
</div>
