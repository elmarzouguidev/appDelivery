<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">

                            <div class="col-lg-4 mb-4">
                                {{-- <a href="#" type="button" onclick="openFilters()" class="btn btn-primary" >
                                    Filters
                                </a>
                                <a href="{{route('sameleon:cities.create')}}" type="button" class="btn btn-info">
                                    Ajouter une Ville
                                </a> --}}
                                <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                    data-bs-toggle="modal" data-bs-target=".addRegionModal">
                                    Ajouter une Région
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
                            {{ session('notice') }}
                        </div>
                    @endif
                 
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                {{-- <th style="width: 20px;" class="align-middle">
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th> --}}
                                <th scope="col">Nom</th>
                                <th scope="col">Ville</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($regions as $region)
                                <tr>
                                    {{-- <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="client-{{ $client->id }}">
                                            <label class="form-check-label" for="client-{{ $client->id }}"></label>
                                        </div>
                                    </td> --}}
                                    <td>
                                        {{ $region->name }}
                                        <p class="text-muted mb-0"></p>
                                    </td>
                                    <td>
                                        {{ optional($region->city)->name }}
                                        <p class="text-muted mb-0"></p>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">

                                            <a href="#" wire:click="editRegion('{{ $region->uuid }}')" class="text-success">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a href="#" class="text-danger" onclick="
                                                    var result = confirm('Are you sure you want to delete this region ?');
    
                                                    if(result){
                                                        event.preventDefault();
                                                        document.getElementById('delete-region-{{ $region->uuid }}').submit();
                                                    }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-region-{{ $region->uuid }}" method="post"
                                        action="{{ route('admin:regions.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="regionId" value="{{ $region->uuid }}">
                                    </form>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if ($showEdit)
        @include('livewire.sameleon.region.edit', [
            'region' => $regionEdit,
        ])
    @endif
</div>
