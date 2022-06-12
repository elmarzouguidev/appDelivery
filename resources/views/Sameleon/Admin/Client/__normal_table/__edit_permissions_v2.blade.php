@foreach ($clients as $client)
    <div class="modal fade EditPermissions-{{ $client->uuid }} " data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=orderdetailsModalLabel">Permissions de {{ $client->full_name }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin:clients.permissions.sync') }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="clientId" value="{{ $client->uuid }}">
                                <div class="row">
                                    @php
                                        $selected = $client->getPermissionNames()->toArray();
                                    @endphp
                                    @foreach ($permissions as $model => $permission)
                                        <div class="col-xl-3 col-sm-6">
                                            <div class="mt-4 mt-xl-0">
                                                <h4 class="font-size-14 mb-3">{{ __('permission.' . $model) }}</h4>
                                                <div class="docs-toggles">
                                                    <ul class="list-group">
                                                        @foreach ($permission as $per)
                                                            <li class="list-group-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input"
                                                                        id="permission-{{ $per['id'] }}"
                                                                        type="checkbox" name="permissions[]"
                                                                        value="{{ $per['name'] }}"
                                                                        {{ in_array($per['name'], $selected) ? 'checked' : '' }}>

                                                                    <label class="form-check-label"
                                                                        for="permission-{{ $per['id'] }}">
                                                                        {{-- $permission->name --}}
                                                                        {{ __('permission.' . $per['name']) }}
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="mt-5">
                                    <button type="submit" class="btn btn-primary w-md">
                                        synchroniser les permissions
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
