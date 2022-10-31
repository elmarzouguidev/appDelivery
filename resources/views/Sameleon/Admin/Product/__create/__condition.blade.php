<div class="modal fade" id="conditionsModal" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button data-user="{{auth()->user()->uuid}}" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @php
                $user = auth()->user()->uuid;
            @endphp
            <form id="viewConditionForm" method="post"
                action="{{ route('admin:products.condition') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="conditionId" value="{{$conditions->uuid}}">
                <input type="hidden" name="userId" value="{{$user}}">
            </form>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="avatar-md mx-auto mb-4">
                        <div class="avatar-title bg-light rounded-circle text-primary h1">

                            <i class="bx bx-check-shield"></i>
                            
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <h4 class="text-danger">Attention !</h4>
                            <h5 class="text-primary">{{$conditions->title}}</h5>
                            <p class="text-muted font-size-14 mb-4">{!! $conditions->description !!}</p>

                            {{--<div class="input-group rounded">
                                <input type="email" class="form-control bg-transparent border-0" placeholder="Enter Email address" aria-label="Recipient's username" aria-describedby="button-addon2">
                                
                                <button class="btn btn-primary" type="button" id="button-addon2">
                                     <i class="bx bxs-paper-plane"></i>
                                </button>
                                
                            </div>--}}

                            <div class="d-grid gap-2 col-4 mx-auto">
                                <button class="btn btn-primary closeCondition" type="button">J'accepte</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>