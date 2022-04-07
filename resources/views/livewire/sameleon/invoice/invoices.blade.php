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
                    {{--$errors--}}
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                {{-- <th style="width: 20px;" class="align-middle">
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th> --}}
                                <th scope="col">Code</th>
                                <th scope="col">Client</th>
                                <th scope="col">N° Commands</th>
                                <th scope="col">Montant</th>
                                <th scope="col">Date création et cloture</th>
                                <th scope="col">Date versement</th>
                                <th scope="col">Cloturé</th>
                                <th scope="col">Versé</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($invoices as $invoice)
                                <tr>
                                    {{-- <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="invoice-{{ $invoice->id }}">
                                            <label class="form-check-label" for="invoice-{{ $invoice->id }}"></label>
                                        </div>
                                    </td> --}}
                                    <td>
                                        <a target="_blank"
                                            href="{{ route('public.show.invoice', [$invoice->uuid, 'has_header' => true]) }}"
                                            class="text-body fw-bold" style="color:blueviolet !important">

                                            <i class="mdi mdi-file-pdf-box font-size-18"></i>
                                            {{ $invoice->full_number }}
                                        </a>

                                    </td>
                                    <td>
                                        <a href="{{-- $invoice->url --}}" class="text-body fw-bold">
                                            {{ optional($invoice->client)->full_name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $invoice->commands_count }}
                                        <p class="text-muted mb-0"></p>
                                    </td>
                                    <td>
                                        {{ $invoice->articles_sum_price_total }} DH
                                    </td>
                                    <td>
                                        {{ $invoice->created_at->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        {{ $invoice->created_at->format('d-m-Y') }}
                                    </td>

                                    <td>
                                        {{ $invoice->cloture }}
                                    </td>
                                    <td>
                                        @if ($invoice->bill_count && $invoice->cloture)
                                            <button type="button" class="btn btn-info  btn-sm"
                                                wire:click="billDetail('{{ $invoice->uuid }}')"
                                            >
                                                Détails
                                            </button>
                                        @else
                                            <button wire:click="addBill('{{ $invoice->uuid }}')" type="button"
                                                class="btn btn-warning btn-sm">
                                                Régler
                                            </button>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3">

                                            <a href="{{ $invoice->edit_url }}" class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="#" class="text-danger" onclick="
                                                    var result = confirm('Are you sure you want to delete this Invoice ?');
    
                                                    if(result){
                                                        event.preventDefault();
                                                        document.getElementById('delete-invoice-{{ $invoice->uuid }}').submit();
                                                    }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-invoice-{{ $invoice->uuid }}" method="post"
                                        action="{{ $invoice->delete_url }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="invoiceId" value="{{ $invoice->uuid }}">
                                    </form>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
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
