<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-4 mb-4">
                            {{--<a href="{{ route('admin:groups.create') }}" type="button" class="btn btn-info">
                                Ajouter un group
                            </a>--}}
                            <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                data-bs-toggle="modal" data-bs-target=".addGroupModal">
                                Ajouter un group
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
                    
                                <th class="align-middle">Nom</th>
                                <th class="align-middle">Responsable</th>
                                <th class="align-middle">Description</th>
                                <th class="align-middle">Clients N°</th>
                                <th class="align-middle">Etat</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="group-{{ $group->id }}">
                                            <label class="form-check-label" for="group-{{ $group->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{-- $group->url --}}" class="text-body fw-bold">
                                            {{ $group->name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $group->moderator->full_name }}
                                    </td>
                                    <td>
                                        {{ $group->description }}
                                    </td>
                                    <td>
                                        {{ $group->clients_count }}
                                    </td>
                                    <td>

                                        <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                            <input data-group="{{ $group->uuid }}" class="form-check-input activeGroup"
                                                type="checkbox" id="SwitchCheckSizelg"
                                                {{ $group->active == true ? 'checked' : '' }}>

                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3">

                                            <a href="{{ route('admin:groups.edit', $group->uuid) }}"
                                                class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this group ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-group-{{ $group->uuid }}').submit();
                                                }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-group-{{ $group->uuid }}" method="post"
                                        action="{{ route('admin:groups.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="groupId" value="{{ $group->uuid }}">
                                    </form>

                                    <form id="activate-group-{{ $group->uuid }}" method="post"
                                        action="{{ route('admin:groups.activate') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="groupId" value="{{ $group->uuid }}">
                                    </form>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
