<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-4 mb-4">
                            <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                data-bs-toggle="modal" data-bs-target=".addAnnonceModal">
                                Ajouter une Annonce
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

                                <th class="align-middle">Titre</th>
                                <th class="align-middle">Contenu</th>
                                <th class="align-middle">Etat</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($annonces as $annonce)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="annonce-{{ $annonce->id }}">
                                            <label class="form-check-label" for="annonce-{{ $annonce->id }}"></label>
                                        </div>
                                    </td>

                                    <td>
                                        {{ $annonce->title }}
                                    </td>
                                    <td>
                                        {{ $annonce->description }}
                                    </td>
                                
                                    <td>

                                        <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                            <input data-annonce="{{ $annonce->uuid }}" class="form-check-input activeAnnonce"
                                                type="checkbox" id="SwitchCheckSizelg"
                                                {{ $annonce->active == true ? 'checked' : '' }}>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3">

                                            {{--<a href="{{ route('admin:banks.edit', $annonce->uuid) }}"
                                                class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>--}}
                                            <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this annonce ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-annonce-{{ $annonce->uuid }}').submit();
                                                }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-annonce-{{ $annonce->uuid }}" method="post"
                                        action="{{ route('admin:annonces.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="annonceId" value="{{ $annonce->uuid }}">
                                    </form>

                                    <form id="activate-annonce-{{ $annonce->uuid }}" method="post"
                                        action="{{ route('admin:annonces.activate') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="annonceId" value="{{ $annonce->uuid }}">
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
