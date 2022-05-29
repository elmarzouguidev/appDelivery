<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-4 mb-4">
                            <a href="{{ route('admin:admins.create') }}" type="button" class="btn btn-info">
                                Ajouter un utilisateur
                            </a>
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
                                <th class="align-middle">Nom complet</th>
                                <th class="align-middle">E-mail</th>
                                <th class="align-middle">Tél</th>
                                <th class="align-middle">Role</th>
                                <th class="align-middle">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="user-{{ $user->id }}">
                                            <label class="form-check-label" for="user-{{ $user->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $user->full_name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->telephone }}
                                    </td>
                                    <td>
                                        {{ $user->getRoleNames()->first() ?? 'User' }}
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3">
                                            @if ($user->email !== 'abdelgha4or@gmail.com')
                                                <a href="{{ route('admin:admins.edit', $user->uuid) }}"
                                                    class="text-success">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                                <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this admin ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-admin-{{ $user->uuid }}').submit();
                                                }">
                                                    <i class="mdi mdi-delete font-size-18"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    @if ($user->email !== 'abdelgha4or@gmail.com')
                                        <form id="delete-admin-{{ $user->uuid }}" method="post"
                                            action="{{ route('admin:admins.delete') }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="userId" value="{{ $user->uuid }}">
                                        </form>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
