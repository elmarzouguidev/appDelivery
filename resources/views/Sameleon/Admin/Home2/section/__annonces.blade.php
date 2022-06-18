<div class="modal fade" id="annoncesModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button data-user="{{auth()->user()->uuid}}" type="button" class="btn-close closeAnnonce" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @php
                $user = auth()->user()->uuid;
            @endphp
            <form id="viewAnnonceForm" method="post"
                action="{{ route('admin:home.viewAnnonce') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="annonceId" value="{{$annonces->uuid}}">
                <input type="hidden" name="userId" value="{{$user}}">
            </form>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="avatar-md mx-auto mb-4">
                        <div class="avatar-title bg-light rounded-circle text-primary h1">
                            <i class="bx bx-volume-full"></i>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <h4 class="text-primary">Annonce !</h4>
                            <h5 class="text-primary">{{$annonces->title}}</h5>
                            <p class="text-muted font-size-14 mb-4">{{$annonces->description}}</p>

                            {{--<div class="input-group bg-light rounded">
                                <input type="email" class="form-control bg-transparent border-0" placeholder="Enter Email address" aria-label="Recipient's username" aria-describedby="button-addon2">
                                
                                <button class="btn btn-primary" type="button" id="button-addon2">
                                    <i class="bx bxs-paper-plane"></i>
                                </button>
                                
                            </div>--}}
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>