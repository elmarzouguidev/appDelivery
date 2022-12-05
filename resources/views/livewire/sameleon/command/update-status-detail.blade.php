<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <label>Date</label>
            <div class="input-group" id="datepicker1">
                <input wire:model.defer="reportTime" type="text" name="reportTime"
                    class="form-control @error('reportTime') is-invalid @enderror" data-date-format="dd-mm-yyyy"
                    value="{{ $reportTime }}" data-date-container='#datepicker1' data-provide="datepicker"
                    onchange="this.dispatchEvent(new InputEvent('input'))" required>

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
                class="form-control @error('reportComment') is-invalid @enderror" rows="5">
              
                </textarea>

            @error('reportComment')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
