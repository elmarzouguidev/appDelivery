<div class="row">
    <div class="col-lg-12">
        <label>Date de commande</label>
        <div class="input-group" id="datepicker1">
            <input type="text" name="commande_date"
                class="form-control @error('commande_date') is-invalid @enderror"
                data-date-format="dd-mm-yyyy" value="{{ now()->format('d-m-Y') }}"
                data-date-container='#datepicker1' data-provide="datepicker" readonly>

            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
            @error('commande_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    {{--<div class="col-lg-6">
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
    </div>--}}
</div>