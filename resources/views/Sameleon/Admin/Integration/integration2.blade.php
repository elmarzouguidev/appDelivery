<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="col-lg-4 mb-4">
                            <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                data-bs-toggle="modal" data-bs-target=".addIntegrationModal">
                                Ajouter une integration
                            </button>
                        </div>
                    </div>
                </div>
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
                <div class="table-responsive">
                    <table class="table table-bordered border-danger table-hover align-middle table-nowrap table-check">
                        <thead class="table-light">
                            <tr>

                                <th style="width: 20px;" class="align-middle">
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>

                                <th class="align-middle">Logo</th>
                                <th class="align-middle">Nom</th>
                                <th class="align-middle">Description</th>
                                <th class="align-middle">Etat</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($integrations as $integration)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="integration-{{ $integration->id }}">
                                            <label class="form-check-label"
                                                for="integration-{{ $integration->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        @if (!is_null($integration->logo))
                                            <div>
                                                <img class="img-fluid rounded" alt=""
                                                    src="{{ asset('storage/' . $integration->logo) }}" width="50">
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{-- $client->url --}}" class="text-body fw-bold">
                                            {{ $integration->name }}<br>
                                            <p class="text-muted mb-0">
                                                users : {{ $integration->users_count }}
                                            </p>
                                        </a>
                                    </td>
                                    <td>
                                        {{ $integration->short_description }}
                                    </td>
                                    <td>

                                        <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                            <input data-integration="{{ $integration->uuid }}"
                                                class="form-check-input activeIntegration" type="checkbox"
                                                id="SwitchCheckSizelg"
                                                {{ $integration->active == true ? 'checked' : '' }}>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3">

                                            <a href="{{ route('admin:integrations.edit', $integration->uuid) }}"
                                                class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this bank ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-integration-{{ $integration->uuid }}').submit();
                                                }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-integration-{{ $integration->uuid }}" method="post"
                                        action="{{ route('admin:integrations.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="integrationId" value="{{ $integration->uuid }}">
                                    </form>

                                    <form id="activate-integration-{{ $integration->uuid }}" method="post"
                                        action="{{ route('admin:integrations.activate') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="integrationId" value="{{ $integration->uuid }}">
                                    </form>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
