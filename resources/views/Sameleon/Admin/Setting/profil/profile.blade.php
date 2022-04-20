<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
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
                <h4 class="card-title">Information du Profil</h4>
                <p class="card-title-desc">
                    Editer les informations de votre Profile
                </p>
                <form method="POST" action="{{route('admin:profil.update')}}">
                    <input type="hidden" name="userId" value="{{$user->uuid}}">
                    <div class="mb-3 row">
                        <label for="nom" class="col-md-2 col-form-label">Nom *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="nom" value="{{ $user->nom ?? old('nom')  }}" id="nom" required>
                        </div>
                    </div>
                    @csrf
                    <div class="mb-3 row">
                        <label for="prenom" class="col-md-2 col-form-label">Prénom</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="prenom" value="{{ $user->prenom ?? old('prenom') }}"
                                id="prenom">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telephone" class="col-md-2 col-form-label">Tél</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="telephone" value="{{ $user->telephone ?? old('telephone') }}"
                                id="telephone">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-2 col-form-label">E-mail *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="email" name="email" value="{{ $user->email ?? old('email') }}"
                                placeholder="E-mail" id="email" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="addresse" class="col-md-2 col-form-label">Adresse *</label>
                        <div class="col-md-10">
                          <textarea class="form-control" name="addresse" id="addresse" required>{{$user->addresse ?? old('addresse')}}</textarea>
                        </div>
                    </div>

                    @if(auth()->user()->type === 'particulier')
                        <div class="mb-3 row">
                            <label for="cnie" class="col-md-2 col-form-label">CNIE *</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="cnie" value="{{ $user->cnie ?? old('cnie') }}"
                                    placeholder="CNIE" id="cnie">
                            </div>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2">Logo *</label>
                        <div class="col-lg-10">
                            <input class="form-control @error('logo') is-invalid @enderror" name="logo" type="file"
                                accept="image/*"/>
                            @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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

