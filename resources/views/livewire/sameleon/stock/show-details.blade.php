<div class="modal fade showStockDetailsModal " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=orderdetailsModalLabel">Détails de stock : {{ $product->name }} </h5>
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
                                        <th>Ville</th>
                                        <th>Livreur</th>
                                        <th>Quantité</th>
                                        <th>Date d'ajustement</th>
                                        <th>Notes</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->stocks as $stock)
                                        <tr>
                                            <th scope="row">{{ $stock->id }}</th>
                                            <td>{{ $stock->city->name }}</td>
                                            <td>{{ $stock->delivery->full_name }}</td>
                                            <td>{{ $stock->qte_global }}</td>
                                            <td>{{ $stock->adjustment_date }}</td>
                                            <td>{{ $stock->notes }}</td>
                                            <td>
                                                <div class="d-flex gap-3">

                                                    {{--<a href="#" wire:click="editRegion('{{ $region->uuid }}')"
                                                        class="text-success">
                                                        <i class="mdi mdi-pencil font-size-18"></i>
                                                    </a>--}}
                                                    <a href="#" class="text-danger" onclick="
                                                        var result = confirm('Are you sure you want to delete this stock ?');
        
                                                        if(result){
                                                            event.preventDefault();
                                                            document.getElementById('delete-stock-{{ $stock->uuid }}').submit();
                                                        }">
                                                        <i class="mdi mdi-delete font-size-18"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <form id="delete-stock-{{ $stock->uuid }}" method="post"
                                                action="{{ route('admin:stock.deletee') }}">
                                                @csrf
                                             
                                                <input type="hidden" name="stockId" value="{{ $stock->uuid }}">
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
