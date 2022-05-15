<div>
    <div class="modal fade editstockModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=orderdetailsModalLabel">Editer le stock N° : {{ $stock->code }}
                    </h5>


                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('admin:stock.update', $stock->uuid) }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label class="form-label">Nom du produit</label>
                                                    <input type="text"
                                                        class="form-control @error('client_name') is-invalid @enderror"
                                                        name="client_name" value="{{ $stock->name }}"
                                                        readonly>
                                                    @error('client_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    <label class="form-label">Nom du client </label>
                                                    <input type="text"
                                                        class="form-control @error('client_email') is-invalid @enderror"
                                                        name="client_email" value="{{ optional($stock->client)->full_name }}"
                                                        readonly>
                                                    @error('client')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mb-4">
                                                    <label class="form-label">Qté initial :
                                                        <strong>{{ $stock->qte_global }}</strong></label>

                                                    <input type="number"
                                                        class="form-control @error('qte_global') is-invalid @enderror"
                                                        name="qte_global" placeholder="Entrer ici la qté ajouté" min="1"
                                                        >
                                                    @error('qte_global')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mb-4">
                                                    <label class="form-label">Qté Livré *</label>

                                                    <input type="text"
                                                        class="form-control @error('qte_livre') is-invalid @enderror"
                                                        name="qte_livre" value="{{ $stock->qte_livre }}" readonly>
                                                    @error('qte_livre')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mb-4">
                                                    <label class="form-label">Qté Expédié *</label>

                                                    <input type="text"
                                                        class="form-control @error('qte_expidite') is-invalid @enderror"
                                                        name="qte_expidite" value="{{ $stock->qte_expidite }}"
                                                        readonly>
                                                    @error('qte_expidite')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mb-4">
                                                    <label class="form-label">Qté Endommagé *</label>

                                                    <input type="number"
                                                        class="form-control @error('qte_endomage') is-invalid @enderror"
                                                        name="qte_endomage" value="{{ $stock->qte_endomage }}"
                                                        min="0">
                                                    @error('qte_endomage')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mb-4">
                                                    <label class="form-label">Qté Restant *</label>

                                                    <input type="text"
                                                        class="form-control @error('qte_rest') is-invalid @enderror"
                                                        name="qte_rest" value="{{ $stock->qte_rest }}" readonly>
                                                    @error('qte_rest')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>

                                        <div class="docs-options">
                                            <label class="form-label">Numéro de stock</label>
                                            <div class="input-group mb-4">

                                                <span class="input-group-text" id="invoice_prefix">

                                                </span>
                                                <input type="text"
                                                    class="form-control @error('code') is-invalid @enderror" name="code"
                                                    value="{{ $stock->code }}" aria-describedby="invoice_prefix"
                                                    readonly>
                                                @error('code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Notes</label>
                                            <textarea  name="notes" id="textarea" class="form-control @error('notes') is-invalid @enderror"
                                                rows="5"
                                                placeholder="Plus de détails ...">{{ $stock->notes }}</textarea>

                                            @error('notes')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label>Date de modification</label>
                                                    <div class="input-group" id="datepicker1">
                                                        <input type="text" name="commande_date"
                                                            class="form-control"
                                                            data-date-format="dd-mm-yyyy"
                                                            value="{{ $stock->updated_at->format('d-m-Y') }}"
                                                            data-date-container='#datepicker1' data-provide="datepicker"
                                                            readonly>

                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-calendar"></i></span>
                       
                                                    </div>
                                                </div>

                                                {{-- <div class="col-lg-6">
                                                    <label> {{ __('invoice.form.date_due') }}</label>
                                                    <div class="input-group" id="datepicker2">
                                                        <input type="text"
                                                            class="form-control @error('due_date') is-invalid @enderror"
                                                            name="due_date" value="{{ \ticketApp::invoiceDueDate() }}"
                                                            data-date-format="yyyy-mm-dd" data-date-container='#datepicker2'
                                                            data-provide="datepicker" data-date-autoclose="true">
                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                        @error('due_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div> --}}
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-2 justify-content-end mb-4">
                            <div class="">
                                <button type="submit" class="btn btn-primary waves-effect waves-light"
                                    {{-- onclick='document.getElementById("overlayy").style.display = "block"' --}}>
                                    {{ __('buttons.store') }}

                                </button>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
