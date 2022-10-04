<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Les information de votre compte bancaire</h4>

                <form method="POST" action="{{ route('delivery:profil.update.bank') }}">
                    <input type="hidden" name="hasBank" value="{{ $user->uuid }}">
                    <div class="mb-3 row">
                        <label for="bank" class="col-md-2 col-form-label">Choisir la banque *</label>
                        <div class="col-md-10">
   
                            <select name="bank" class="form-control select2-templating @error('bank') is-invalid @enderror"
                            >
                                <option value="">Choisir la banque </option>
                                @foreach ($banks as $bank)
                                     @if($bankAccount)
                                      <option {{$bankAccount->account->bank_id == $bank->id ? 'selected' :''}} value="{{ $bank->id }}">{{ $bank->name }}</option>
                                     @else
                                      <option  value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('bank')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @csrf
                    <div class="mb-3 row">
                        <label for="code_rib" class="col-md-2 col-form-label">RIB *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="code_rib" id="code_rib"
                              value="{{$bankAccount->account->rib ?? ''}}"   placeholder="Entrer votre RIB">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
