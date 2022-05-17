<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">Statistiques livreures</h4>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle">livreure</th>
                                <th class="align-middle">Total commands Livé</th>
                                <th class="align-middle">Date</th>
                                <th class="align-middle">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deliviers as $delivery)
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body fw-bold">{{$delivery->full_name}}</a> </td>
                                    <td class="text-body fw-bold">{{$delivery->commands_delivery_sum_count}}</td>
                                    <td class="text-body fw-bold">
                                        {{now()->format('d-m-Y')}}
                                    </td>
                                    <td class="text-body fw-bold">
                                        {{$delivery->items_sum_prix_total}}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
            </div>
        </div>
    </div>
</div>