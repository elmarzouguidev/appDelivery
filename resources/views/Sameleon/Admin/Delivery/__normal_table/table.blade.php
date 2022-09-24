<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-4 mb-4">

                            <a href="{{ route('admin:delivery.create') }}" type="button" class="btn btn-info">
                                Ajouter un livreur
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
                                <th class="align-middle">type</th>
                                <th class="align-middle">Adresse</th>
                                <th class="align-middle">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliveries as $delivery)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="client-{{ $delivery->id }}">
                                            <label class="form-check-label" for="client-{{ $delivery->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{-- $delivery->url --}}" class="text-body fw-bold">
                                            {{ $delivery->full_name }}
                                        </a>
                                        @if ($delivery->type == 'particulier')
                                            <br>
                                            {{ $delivery->cnie }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $delivery->email }}
                                    </td>
                                    <td>
                                        {{ $delivery->telephone }}
                                    </td>
                                    <td>
                                        {{ $delivery->type }}
                                        <p class="text-muted mb-0"></p>
                                    </td>
                                    <td>
                                        {{ $delivery->addresse }}
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3">

                                            <a href="{{ route('admin:delivery.edit', $delivery->uuid) }}"
                                                class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this delivery ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-delivery-{{ $delivery->uuid }}').submit();
                                                }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-delivery-{{ $delivery->uuid }}" method="post"
                                        action="{{ route('admin:delivery.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="deliveryId" value="{{ $delivery->uuid }}">
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
