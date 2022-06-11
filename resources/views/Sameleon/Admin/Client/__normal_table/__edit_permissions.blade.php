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
                            <div class="col-xl-12 col-sm-6">
                                <form action="{{ route('admin:clients.permissions.sync') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="clientId" value="{{ $client->uuid }}">
                                    @php
                                        $selected = $client->getPermissionNames()->toArray();
                                        
                                    @endphp
                                    <div class="row">
                                        @foreach ($permissions as $permission)
                                            <div class="mt-4 col-xl-3">
                                                <div class="docs-toggles">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input class="form-check-input"
                                                                    id="permission-{{ $permission->id }}"
                                                                    type="checkbox" name="permissions[]"
                                                                    value="{{ $permission->name }}"
                                                                    {{ in_array($permission->name, $selected) ? 'checked' : '' }}>

                                                                <label class="form-check-label"
                                                                    for="permission-{{ $permission->id }}">
                                                                    {{-- $permission->name --}}
                                                                    {{__('permission.'.$permission->name)}}
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="mt-5">
                                            <button type="submit" class="btn btn-primary w-md">Sync Permissions</button>
                                        </div>
                                    </div>
                      
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
