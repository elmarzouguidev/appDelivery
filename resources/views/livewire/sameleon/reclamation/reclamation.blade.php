<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">

                            <div class="col-lg-8 mb-4">
                                {{-- <a href="#" type="button" onclick="openFilters()" class="btn btn-primary" >
                                    Filters
                                </a> --}}
                                <button class="btn btn-info" type="button" class="btn btn-info  btn-sm"
                                    data-bs-toggle="modal" data-bs-target=".addReclamationModal">
                                    Ajouter une réclamation
                                </button>
                            </div>
                        </div>
                    </div>

                    @include('layouts._parts.__messages')

                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                {{-- <th style="width: 20px;" class="align-middle">
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th> --}}
                                {{-- <th scope="col">Numéro / client</th> --}}
                                <th scope="col">Command</th>
                                <th scope="col">Message</th>
                                <th scope="col">Client</th>
                                <th scope="col">Date de réclamation</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($complaints as $complaint)
                                <tr>
                                    {{-- <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="complaint-{{ $complaint->id }}">
                                            <label class="form-check-label" for="complaint-{{ $complaint->id }}"></label>
                                        </div>
                                    </td> --}}
                                    {{-- <td>
                                        <a href="$complaint->url" class="text-body fw-bold">
                                            {{ $complaint->code }}
                                        </a>
                                        <p class="text-strong mb-0">{{$complaint->complaint->full_name}}</p>
                                    </td> --}}
                                    <td>

                                        <p class="text-strong mb-0"><strong>{{ $complaint->command->code }}</strong>
                                        </p>
                                        <p class="text-strong mb-0">
                                            {{ $complaint->command->created_at->format('d-m-Y H:i') }}</p>
                                        <p class="text-strong mb-0">{{ $complaint->client_address }}</p>
                                        <p class="text-strong mb-0">{{ $complaint->client_city }}</p>
                                    </td>

                                    <td>
                                        {{ $complaint->message }}
                                    </td>
                                    <td>
                                        {{ $complaint->user->full_name }}
                                    </td>
                                    <td>
                                        <strong>date d'ajoute</strong>
                                        <p class="text-strong mb-0">{{ $complaint->created_at->format('d-m-Y H:i') }}
                                        </p>
                                        <strong>date de modification</strong>
                                        <p class="text-strong mb-0">{{ $complaint->updated_at->format('d-m-Y H:i') }}
                                        </p>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-circle text-info font-size-10"></i>
                                        {{ $complaint->status }}
                                    </td>

                                    <td>
                                        <div class="d-flex gap-3">

                                            <button wire:click="responseTo('{{$complaint->uuid}}')" class="btn btn-info btn-sm" type="button">
                                                Repondre
                                            </button>

                                            <a href="#" class="text-danger" onclick="
                                                    var result = confirm('Are you sure you want to delete this complaint ?');
    
                                                    if(result){
                                                        event.preventDefault();
                                                        document.getElementById('delete-complaint-{{ $complaint->uuid }}').submit();
                                                    }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-complaint-{{ $complaint->uuid }}" method="post"
                                        action="{{ route('admin:complaints.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="complaintId" value="{{ $complaint->uuid }}">
                                    </form>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.sameleon.reclamation.__add_reclamation')

    @if ($canResponse)
        @include('livewire.sameleon.reclamation.__response', [
            'reclamation' => $reclamation,
        ])
    @endif
</div>
