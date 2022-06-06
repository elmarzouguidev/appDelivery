<div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="composemodalTitle">Créer une nouvelle réclamation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('admin:complaints.store') }}">
                @csrf
                <div class="modal-body">
                    <div>
                        <div class="mb-3">
                            <input type="text" name="object" class="form-control" placeholder="Objet">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Command lié</label>
                            <select name="command"
                                class="form-control select2-templating @error('command') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($commands as $command)
                                    <option value="{{ $command->id }}">{{ $command->code }}</option>
                                @endforeach
                            </select>
                            @error('command')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Priorité</label>
                            <select name="priority"
                                class="form-control select2-templating @error('priority') is-invalid @enderror">
                                <option value="high">Haute</option>
                                <option value="medium" selected>Moyenne</option>
                                <option value="low">Faible</option>
                            </select>
                            @error('priority')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            <textarea rows="10" class="form-control @error('message') is-invalid @enderror" {{-- id="email-editor" --}} name="message"></textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="row justify-content-start">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </div>
                </div>
  
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
