<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Derniers règlements</h4>

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

                                <th class="align-middle">RÈGLEMENT N°</th>
                                <th class="align-middle">Facture N°</th>
                                {{--<th class="align-middle">Montant FACTURE (hors frais)</th>--}}
                                <th class="align-middle">Montant payé</th>
                                <th class="align-middle">Mode de paiment</th>
                                <th class="align-middle">Date de paiment</th>
                                <th class="align-middle">Note</th>
                                {{--<th class="align-middle">Bordereau</th>--}}
                                {{--<th class="align-middle">Action</th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="payment-{{ $payment->id }}">
                                            <label class="form-check-label" for="payment-{{ $payment->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a 
                                            target="_blank" 
                                            href="{{route('delivery.public.show.bill',[$payment->uuid,'has_header'=>true])}}" 
                                            class="text-body fw-bold"
                                            style="color:blue !important"
                                        >
                                           {{ $payment->full_number }}
                                        </a>
                                        {{-- $payment->full_number --}}
                                    </td>
                                    <td>
                                        {{-- $payment->billable->full_number --}}
                                         {{--<p class="text-muted mb-0"></p>--}}
                                        <a 
                                            target="_blank" 
                                            href="{{route('delivery.public.show.invoice',[$payment->billable->uuid,'has_header'=>true])}}" 
                                            class="text-body fw-bold"
                                            style="color:blue !important"
                                        >
                                        {{ $payment->billable->full_number }}
                                        </a>
                                    </td>

                                    {{--<td>

                                        {{ number_format($payment->price_total, 2) }} DH

                                    </td>--}}

                                    <td>
                                     {{ $payment->formated_price_total }} DH
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

                                    {{--<td>
                                        <div>
                                            <a class="image-popup-no-margins"
                                                href="{{ $payment->getFirstMediaUrl('bills_delivery_recu', 'normal') }}">
                                                <img class="img-fluid" alt=""
                                                    src="{{ $payment->getFirstMediaUrl('bills_delivery_recu', 'normal') }}"
                                                    width="75">
                                            </a>
                                        </div>
                                    </td>--}}
                                    {{--<td>
                                    </td>--}}

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
