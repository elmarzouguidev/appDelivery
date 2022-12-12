<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="col-lg-4 mb-4">
                            <button class="btn btn-info" type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                                data-bs-target=".addDataSourceModal">
                                Ajouter une source de données
                            </button>
                        </div>
                    </div>
                </div>

                @include('layouts._parts.__messages')

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
                                <th class="align-middle">platform</th>
                                <th class="align-middle">Nom</th>
                                <th class="align-middle">Domain</th>
                                <th class="align-middle">Secret</th>
                                <th class="align-middle">Url</th>
                                <th class="align-middle">Etat</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sources as $source)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="source-{{ $source->id }}">
                                            <label class="form-check-label" for="source-{{ $source->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{-- $client->url --}}" class="text-body fw-bold">
                                            {{ $source->platform }}<br>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{-- $client->url --}}" class="text-body fw-bold">
                                            {{ $source->name }}<br>
                                        </a>
                                    </td>
                                    <td>
                                        {{ $source->domain }}
                                    </td>
                                    <td>
                                        {{ $source->secret }}
                                    </td>
                                    <td>
                                        {{ $source->full_url }}
                                    </td>
                                    <td>

                                        <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                            <input data-source="{{ $source->uuid }}"
                                                class="form-check-input activeSource" type="checkbox"
                                                id="SwitchCheckSizelg" {{ $source->active == true ? 'checked' : '' }}>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3">

                                            <a href="#" class="text-danger"
                                                onclick="
                                                var result = confirm('Are you sure you want to delete this bank ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-source-{{ $source->uuid }}').submit();
                                                }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-source-{{ $source->uuid }}" method="post"
                                        action="{{ route('admin:profile.sources.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="sourceId" value="{{ $source->uuid }}">
                                    </form>

                                    <form id="activate-source-{{ $source->uuid }}" method="post"
                                        action="{{ route('admin:profile.sources.activate') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="sourceId" value="{{ $source->uuid }}">
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
