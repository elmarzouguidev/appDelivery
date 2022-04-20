<div>
    <div class="modal fade isReportedModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=orderdetailsModalLabel">commande N° : {{ $command->code }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="saveReportDetail" method="post">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Date</label>
                                    <div class="input-group" id="datepicker1">
                                        <input wire:model.defer="reportTime" type="text" name="reportTime"
                                                class="form-control @error('reportTime') is-invalid @enderror"
                                                data-date-format="dd-mm-yyyy" value="{{ $reportTime }}"
                                                data-date-container='#datepicker1' data-provide="datepicker" 
                                                onchange="this.dispatchEvent(new InputEvent('input'))"
                                                required
                                            >

                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        @error('reportTime')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label>Comment</label>
                                    <textarea wire:model.defer="reportComment" name="reportComment" id="textarea"
                                        class="form-control @error('reportComment') is-invalid @enderror"
                                         rows="5"></textarea>

                                    @error('reportComment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-flex flex-wrap gap-2 justify-content-start mt-4">

                                    <button type="submit" class="btn btn-primary waves-effect waves-light"
                                        {{-- onclick='document.getElementById("overlayy").style.display = "block"' --}}>
                                        {{ __('buttons.store') }}

                                    </button>

                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
