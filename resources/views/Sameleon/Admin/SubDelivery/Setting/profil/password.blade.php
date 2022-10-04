<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Changer Votre mot de pass</h4>

                <form method="POST" action="{{ route('delivery:profil.update.password') }}">
                    <input type="hidden" name="hasPassword" value="{{ $user->uuid }}">
                    <div class="mb-3 row">
                        <label for="oldpassword" class="col-md-2 col-form-label">Ancien mot de passe *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="oldpassword" id="oldpassword"
                                placeholder="Entrer votre ancien mot de pass" required>
                        </div>
                    </div>
                    @csrf
                    <div class="mb-3 row">
                        <label for="new_password" class="col-md-2 col-form-label">Nouveau mot de passe *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="new_password" id="new_password"
                                placeholder="Entrer votre nouveau mot de pass">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="new_confirm_password" class="col-md-2 col-form-label">Confirmer le mot de passe
                            *</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="new_confirm_password"
                                id="new_confirm_password" placeholder="confirmé votre nouveau mot de pass">
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
