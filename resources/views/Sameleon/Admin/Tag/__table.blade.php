<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-4 mb-4">
                            <button class="btn btn-info" type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                                data-bs-target=".addTagModal">
                                Ajouter un Tag
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

                                <th class="align-middle">Nom</th>
                                <th class="align-middle">Color</th>
                                <th class="align-middle">Etat</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="tag-{{ $tag->id }}">
                                            <label class="form-check-label" for="tag-{{ $tag->id }}"></label>
                                        </div>
                                    </td>

                                    <td>
                                        {{ $tag->name }}
                                    </td>

                                    <td>
                                        {{ $tag->color }}
                                    </td>
                                    <td>

                                        <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                            <input data-tag="{{ $tag->uuid }}" class="form-check-input activeTag"
                                                type="checkbox" id="SwitchCheckSizelg"
                                                {{ $tag->active == true ? 'checked' : '' }}>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3">

                                            <a href="#" class="text-danger"
                                                onclick="
                                                var result = confirm('Are you sure you want to delete this tag ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-tag-{{ $tag->uuid }}').submit();
                                                }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-tag-{{ $tag->uuid }}" method="post"
                                        action="{{ route('admin:tags.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="tagId" value="{{ $tag->uuid }}">
                                    </form>

                                    <form id="activate-tag-{{ $tag->uuid }}" method="post"
                                        action="{{ route('admin:tags.activate') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="tagId" value="{{ $tag->uuid }}">
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
