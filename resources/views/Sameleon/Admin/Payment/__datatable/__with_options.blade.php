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
                            <th scope="col">Facture N°</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Mode de paiment</th>
                            <th scope="col">Date de paiment</th>
                            <th scope="col">Note</th>
                            <th scope="col">Bordereau</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($payments as $payment)
                            <tr>
                                {{-- <td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox"
                                            id="invoice-{{ $invoice->id }}">
                                        <label class="form-check-label" for="invoice-{{ $invoice->id }}"></label>
                                    </div>
                                </td> --}}
                                <td>
                                    <a 
                                        target="_blank" 
                                        href="#{{--route('public.show.invoice', [$payment->uuid, 'has_header' => true]) --}}" 
                                        class="text-body fw-bold"
                                        style="color:blue !important"
                                    >
                                        {{ $payment->full_number }}
                                    </a>

                                </td>
                                <td>
                                    {{ $payment->billable->full_number }}
                                    <p class="text-muted mb-0"></p>
                                </td>

                                <td>
                                    {{ $payment->price_total }} DH
                                </td>
                                <td>
                                    {{ $payment->bill_mode }}
                                </td>
                                <td>
                                    {{ $payment->bill_date->format('d-m-Y') }}
                                </td>
                                <td>
                                    {{ $payment->notes }}
                                </td>

                                <td>
                                    <div>

                                        <a class="image-popup-no-margins" href="{{$payment->getFirstMediaUrl('bills_recu','normal')}}">
                                            <img class="img-fluid" alt="" src="{{$payment->getFirstMediaUrl('bills_recu','normal')}}" width="75">
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    {{--<div class="d-flex gap-3">

                                        <a href="{{ $payment->edit_url }}" class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                        <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this payment ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-payment-{{ $payment->uuid }}').submit();
                                                }">
                                            <i class="mdi mdi-delete font-size-18"></i>
                                        </a>
                                    </div>--}}
                                </td>
                                {{--<form id="delete-invoice-{{ $payment->uuid }}" method="post"
                                    action="{{ $payment->delete_url }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="paymentId" value="{{ $payment->uuid }}">
                                </form>--}}
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
