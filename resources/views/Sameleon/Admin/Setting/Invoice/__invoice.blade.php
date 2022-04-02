<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Facturation</h4>
                <p class="card-title-desc">
                    Entrer les informations de la Facturation
                </p>
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
                <form method="POST" action="{{ route('admin:settings.invoice.store') }}">
                    <div class="mb-3 row">
                        <label for="invoice_prefix" class="col-md-2 col-form-label">Préfix de la facture *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="invoice_prefix"
                                value="{{ $setting->invoice_prefix }}" id="name" required>
                        </div>
                    </div>
                    @csrf
                    <div class="mb-3 row">
                        <label for="invoice_start" class="col-md-2 col-form-label">Numérotation de la facture</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="invoice_start"
                                value="{{ $setting->invoice_start }}" id="invoice_start">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
