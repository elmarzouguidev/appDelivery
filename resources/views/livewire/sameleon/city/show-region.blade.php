<div class="modal fade showRegionModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Régions de : {{ $city->name }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom Du Région</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cityEdit->regions as $region)
                                        <tr>
                                            <th scope="row">{{ $region->id }}</th>
                                            <td>{{ $region->name }}</td>
                                            <td>
                                                <div class="d-flex gap-3">

                                                    {{--<a href="#" wire:click="editRegion('{{ $region->uuid }}')"
                                                        class="text-success">
                                                        <i class="mdi mdi-pencil font-size-18"></i>
                                                    </a>--}}
                                                    {{--<a href="#" class="text-danger" onclick="
                                                        var result = confirm('Are you sure you want to delete this region ?');
        
                                                        if(result){
                                                            event.preventDefault();
                                                            document.getElementById('delete-region-{{ $region->uuid }}').submit();
                                                        }">
                                                        <i class="mdi mdi-delete font-size-18"></i>
                                                    </a>--}}
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
        </div>
    </div>

</div>
