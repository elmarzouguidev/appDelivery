<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="col-lg-12 mb-4">

                            {{-- @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                <button class="btn btn-danger deleteCMD" type="button">

                                    Supprimer
                                </button>
                            @endif --}}
                        </div>
                    </div>
                </div>
                @include('layouts._parts.__messages')

                <div class="table-responsive">
                    <table class="table table-bordered border-danger table-hover align-middle table-nowrap table-check">
                        <thead class="table-light">
                            <tr>

                                <th style="width: 20px;" class="align-middle">
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>

                                {{-- <th scope="col">Numéro / client</th> --}}
                                <th class="align-middle">Destinataire</th>
                                <th class="align-middle">Produits</th>
                                <th class="align-middle">Prix</th>
    
                                <th class="align-middle">Etat</th>

                                {{-- <th class="align-middle">Détails</th> --}}
                                <th class="align-middle">Notes</th>

                                <th class="align-middle">Date</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($commands as $command)
                                <tr>

                                    <td>
                                        <div class="form-check font-size-16">
                                            <input {{ $command->is_closed ? 'disabled' : '' }}
                                                class="form-check-input" type="checkbox"
                                                id="command-{{ $command->id }}" value="{{ $command->id }}">
                                            <label {{ $command->is_closed ? 'disabled' : '' }}
                                                class="form-check-label" for="command-{{ $command->id }}"></label>
                                        </div>
                                    </td>

                                    <td>
                                        <p class="text-strong mb-0">
                                            <strong>

                                                <a style="color:#2f5393 !important"
                                                    href="{{ $command->is_closed ? '#' : route('admin:commands.index') }}">
                                                    {{ $command->code }}
                                                </a>

                                            </strong>
                                        </p>
                                        {{ $command->client_name }}
                                        <p class="text-strong mb-0">
                                            <strong>
                                                <a style="color:#2f5393 !important"
                                                    href="#">{{ $command->client_phone }}</a>
                                            </strong>
                                        </p>
                                        <p class="text-strong mb-0">
                                            <b>{{ $command->city->name ?? ($command->client_city ?? '') }}</b>
                                        </p>
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

                                            </div>
                                        @endforeach

                                    </td>
                                    <td>

                                        {{ number_format($command->items_sum_prix_total, 2) }}
                                        DH
                                    </td>
                                    <td>

                                        <button type="button" disabled
                                            class="btn btn-sm {{ __('status.classes.' . $command->status) }} waves-effect waves-light">
                                            {{ __('status.statuses.' . $command->status) }}
                                        </button>

                                        @if ($command->comment != null && $command->reported_at != null)
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
                                    <td>
                                        <div class="d-flex gap-3">

                                            <button disabled type="button"
                                                class="btn btn-danger btn-sm deleteCommandBtn"
                                                data-command="{{ $command->uuid }}">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </button>

                                            <button type="button" disabled class="btn btn-info btn-sm">
                                                Edit
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                {{-- $commands->links() --}}
            </div>
        </div>
    </div>
</div>
