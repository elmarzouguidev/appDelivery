<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="col-lg-4 mb-4">
                            {{--<a href="#" type="button" onclick="openFilters()" class="btn btn-primary" >
                                Filters
                            </a>--}}
                            <a href="{{route('sameleon:commands.create')}}" type="button" class="btn btn-info">
                                Ajouter un commande
                            </a>
                        </div>
                    </div>
                </div>
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            {{--<th style="width: 20px;" class="align-middle">
                                <div class="form-check font-size-16">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                    <label class="form-check-label" for="checkAll"></label>
                                </div>
                            </th>--}}
                            <th scope="col">Numéro</th>
                            <th scope="col">Distinataire</th>
                            <th scope="col">Prix Total</th>
                            <th scope="col">Détails</th>
                            <th scope="col">Date de commande</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($orders as $order)
                            <tr>
                                {{--<td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox"
                                            id="client-{{ $client->id }}">
                                        <label class="form-check-label" for="client-{{ $client->id }}"></label>
                                    </div>
                                </td>--}}
                                <td>
                                    <a href="{{--$client->url--}}" class="text-body fw-bold">
                                        {{ $order->code }}
                                    </a>
                                </td>
                                <td>
                                    {{ $order->client_name }}
                                    <p class="text-strong mb-0"><strong>{{$order->client_phone}}</strong></p>
                                    <p class="text-strong mb-0">{{$order->client_address}}</p>
                                    <p class="text-strong mb-0">{{$order->client_city}}</p>
                                </td>
                                <td>
                                    {{ $order->total_price }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                                            data-bs-target=".orderdetailsModal-{{ $order->id }}">
                                        Détails
                                    </button>
                                </td>
                                <td>
                                    {{ $order->created_at->format('d-m-Y') }}
                                </td>
                                <td>
                                    <i class="mdi mdi-circle text-info font-size-10"></i>
                                    {{ __('status.statuses.'. $order->status) }}
                                </td>

                                <td>
                                    <div class="d-flex gap-3">

                                        <a href="{{ $order->edit }}" class="text-success">
                                            <i class="mdi mdi-pencil font-size-18"></i>
                                        </a>
                                        <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this client ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-order-{{ $order->uuid }}').submit();
                                                }">
                                            <i class="mdi mdi-delete font-size-18"></i>
                                        </a>
                                    </div>
                                </td>
                                <form id="delete-order-{{ $order->uuid }}" method="post"
                                    action="{{ route('admin:clients.delete') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="orderId" value="{{ $order->uuid }}">
                                </form>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
