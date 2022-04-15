<div class="modal fade addReclamationModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Ajouter une réclamation </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('admin:complaints.store') }}">
                    @csrf
                    <div class="row mb-4">
                        <label for="command" class="col-form-label col-lg-2">Command *</label>
                        <div class="col-lg-10">
                            <select wire:model.defer="command" class="form-control select2 chk-filter-client" name="command" id="clienter">
                                <option value="">choisir la command</option>
        
                                @foreach ($commands as $command)
                                    <option value="{{ $command->id }}">
                                        {{ $command->code }}
                                    </option>
                                @endforeach
        
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="message" class="col-form-label col-lg-2">Message *</label>
                        <div class="col-lg-10">
                        
                            <textarea class="form-control" name="message" wire:model.defer="message" ></textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
