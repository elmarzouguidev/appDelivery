@foreach ($deliveries as $delivery)
    <div class="modal fade deliveryCompanyTeam-{{ $delivery->uuid }} " data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=orderdetailsModalLabel">L'Équipe de {{ $delivery->full_name }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">

                                    <thead>
                                        <tr>
                                            <th>Nom complet</th>
                                            <th>Tél</th>
                                            <th>E-mail</th>
                                            <th>Adresse</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($delivery->childrens as $child)
                                            <tr>
                                                
                                                <td>{{ $child->full_name }}</td>
                                                <td>{{ $child->telephone }}</td>
                                                <td>{{ $child->email  }}</td>
                                                <td>{{ $child->addresse  }}</td>
                                                <td>
                                                    <div class="d-flex gap-3">


                                                        <a href="#" class="text-danger"
                                                            onclick="
                                                            var result = confirm('Are you sure you want to delete this delivery ?');
            
                                                            if(result){
                                                                event.preventDefault();
                                                                document.getElementById('delete-child-{{ $child->uuid }}').submit();
                                                            }">
                                                            <i class="mdi mdi-delete font-size-18"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <form id="delete-child-{{ $child->uuid }}" method="post"
                                                    action="{{ route('admin:delivery.delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="deliveryId" value="{{ $child->uuid }}">
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
@endforeach
