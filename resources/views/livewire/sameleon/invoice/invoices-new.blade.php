<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">

                            <div class="col-lg-4 mb-4">
                                {{-- <a href="#" type="button" onclick="openFilters()" class="btn btn-primary" >
                                    Filters
                                </a>
                                <a href="{{route('admin:invoices.index')}}" type="button" class="btn btn-info">
                                    Ajouter une facture
                                </a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table table-bordered border-danger table-hover align-middle table-nowrap table-check">
                            <thead class="table-light">
                                <tr>

                                    <th style="width: 20px;" class="align-middle">
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                            <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                    </th>


                                    <th class="align-middle">Code</th>
                                    @if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin'))
                                        <th class="align-middle">Client</th>
                                    @endif
                                    <th class="align-middle">N° Commands</th>
                                    <th class="align-middle">Montant Total</th>
                                    <th class="align-middle">Montant a payé</th>
                                    <th class="align-middle">Date création</th>
                                    {{-- <th class="align-middle">Date versement</th> --}}
                                    <th class="align-middle">Cloturé</th>
                                    <th class="align-middle">Règlement</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16">
                                                <input class="form-check-input" type="checkbox"
                                                    id="invoice-{{ $invoice->id }}">
                                                <label class="form-check-label"
                                                    for="invoice-{{ $invoice->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a target="_blank"
                                                href="{{ route('public.show.invoice', [$invoice->uuid, 'has_header' => true]) }}"
                                                class="text-body fw-bold" style="color:blueviolet !important">

                                                <i class="mdi mdi-file-pdf-box font-size-18"></i>
                                                {{ $invoice->full_number }}
                                            </a>

                                        </td>
                                        @if (isAdmin())
                                            <td>
                                                <a href="{{-- $invoice->url --}}" class="text-body fw-bold">
                                                    {{ optional($invoice->client)->full_name }}
                                                </a>
                                            </td>
                                        @endif
                                        <td>
                                            {{ $invoice->commands_count }}
                                            <p class="text-muted mb-0"></p>
                                        </td>
                                        <td>
                                            {{ number_format($invoice->articles_sum_price_total,2) }} DH
                                        </td>
                                        <td>
                                            {{ number_format($invoice->articles_sum_price_total-($invoice->articles_sum_frais + $invoice->articles_sum_profit),2) }} DH
                                        </td>
                                        <td>
                                            {{ $invoice->created_at->format('d-m-Y') }}
                                        </td>
                                        {{-- <td>
                                            {{ $invoice->created_at->format('d-m-Y') }}
                                        </td> --}}

                                        <td>
                                            @if (auth()->user()->hasAnyRole('SuperAdmin', 'Admin'))
                                                <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                    <input {{--wire:click="clotureInvoice('{{ $invoice->uuid }}')"--}}
                                                        class="form-check-input" type="checkbox" id="SwitchCheckSizelg"
                                                        {{ $invoice->cloture == true ? 'checked' : '' }} disabled>

                                                </div>
                                            @else
                                                @if ($invoice->cloture)
                                                    Oui
                                                @else
                                                    Non
                                                @endif
                                            @endif

                                        </td>
                                        <td>
                                            @if (auth()->user()->hasAnyRole('SuperAdmin', 'Admin'))
                                                @if ($invoice->bill_count && $invoice->cloture)
                                                    {{--<strong> {{ optional($invoice->bill)->full_number }}</strong>--}}

                                                    <a target="__blank" href="{{ route('public.show.bill', [$invoice->bill->uuid,'has_header'=>true]) }}"
                                                        type="button"
                                                        class="btn btn-info btn-sm">
                                                        <i class="mdi mdi-file-pdf-box font-size-16 align-middle me-2"></i>
                                                        {{ optional($invoice->bill)->full_number }}
                                                    </a>

                                                @else
                                                    <button {{ $invoice->cloture == true ? '' : 'disabled' }}
                                                        wire:click="addBill('{{ $invoice->uuid }}')" type="button"
                                                        class="btn btn-warning btn-sm">
                                                        Régler
                                                    </button>
                                                @endif
                                            @else
                                                @if ($invoice->bill_count && $invoice->cloture)
                                                    {{--<strong>

                                                        {{ optional($invoice->bill)->full_number }}

                                                    </strong>--}}

                                                    <a target="__blank" href="{{ route('public.show.bill', [$invoice->bill->uuid,'has_header'=>true]) }}"
                                                        type="button"
                                                        class="btn btn-info btn-sm">
                                                        <i class="mdi mdi-file-pdf-box font-size-16 align-middle me-2"></i>
                                                        {{ optional($invoice->bill)->full_number }}
                                                    </a>
                                                @else
                                                    Non Régler
                                                @endif
                                            @endif
                                        </td>

                                        <td>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($addBiller)
        @include('livewire.sameleon.invoice.__add_bill', [
            'invoice' => $invoicer,
        ])
    @endif
</div>

