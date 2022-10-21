                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body bg-gradient">

                                        <div class="alert alert-warning" role="alert">
                                            nous vous invitons à compléter votre profil 
                                            @if(isDelivery())
                                                <a href="{{route('delivery:profil')}}" class="alert-link">
                                                    Cliquez-ici ! 
                                                </a>
                                            @else
                                                <a href="{{route('admin:profil')}}" class="alert-link">
                                                    Cliquez-ici ! 
                                                </a>
                                            @endif.
                                        </div>

                                    </div>
                                </div>
                            </div>
