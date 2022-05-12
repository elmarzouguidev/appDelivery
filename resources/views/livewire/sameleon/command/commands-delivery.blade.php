<div>
    <div class="row">
        @foreach ($commands as $command)
            <div class="col-xl-3 col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class=" mx-auto mb-4">
                            <span class="avatar-title bg-primary bg-soft text-primary font-size-20">
                            
                                {{ number_format($command->products_sum_product_commandprice_total, 2) }}DH
                                
                            </span>
                        </div>
                        <p class="font-size-15"><strong>{{ $command->client_name }}</strong></p> 
                        <hr>
                        <p class="font-size-15">{{ $command->client_address }}</p>
                        <hr>
                        <h5 class="font-size-15 mb-1">
                            <a href="tel:{{ $command->client_phone }}" class="text-primary">
                             {{ $command->client_phone }}
                            </a>
                        </h5>
                    
                        <hr>
                        <div>
                            <a href="javascript: void(0);" class="badge bg-success font-size-18 m-1">Livré</a>
                            <a href="javascript: void(0);" class="badge bg-danger font-size-18 m-1">Non livre</a>
                            <a href="javascript: void(0);" class="badge bg-warning font-size-18 m-1">Non interese</a>
                            <a href="javascript: void(0);" class="badge bg-primary font-size-18 m-1">Pas de reponse</a>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <div class="contact-links d-flex font-size-17">
                            <div class="flex-fill">
                                @foreach ($command->products as $product)
                                
                                <div>

                                    <p class="text-strong mb-0">
                                        <strong>{{ $product->name }}</strong>
                                    </p>

                                    <p class="text-muted mb-0">{{ $product->price }} (DH) x
                                        {{ $product->pivot->quantity }}
                                    </p>
                                    <br>

                                </div>
                                <hr>
                            @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
