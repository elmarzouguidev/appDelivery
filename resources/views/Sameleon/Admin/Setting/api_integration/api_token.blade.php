<div class="row">
    <div class="col-6">
        @php
            $disabled = '';
            
            if (
                auth()
                    ->user()
                    ->hasApiKey()
            ) {
                $disabled = 'disabled';
            }
        @endphp
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">API</h4>

                <form method="POST" action="{{ route('admin:api.update.token') }}">
                    <input type="hidden" name="hasToekn" value="{{ auth()->user()->uuid }}">

                    @csrf
                    <div class="mb-3 row">
                        <label for="public_key_api" class="col-md-2 col-form-label">Public key</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="public_key_api" id="public_key_api"
                                value="{{ auth()->user()->public_key_api ?? '' }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="secret_key_api" class="col-md-2 col-form-label">Secret key
                        </label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="secret_key_api" id="secret_key_api"
                                value="{{ auth()->user()->secret_key_api ?? '' }}" readonly>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button {{$disabled}}  type="submit" class="btn btn-primary waves-effect waves-light">Générer</button>
                        {{-- <a href="#" class="btn btn-info waves-effect waves-light">comment utiliser l'api</a> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel"
                        aria-labelledby="v-pills-gen-ques-tab">
                        <div class="faq-box d-flex mb-4">
                            <div class="flex-shrink-0 me-3 faq-icon">
                                <i class="bx bx-help-circle font-size-20 text-success"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="font-size-15">Comment utiliser l'API ?</h5>
                                <p class="text-muted">New common language will be more simple and regular than
                                    the existing European languages. It will be as simple as occidental.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
