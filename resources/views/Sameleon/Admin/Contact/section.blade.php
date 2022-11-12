<div class="checkout-tabs">
    <div class="row">
        <div class="col-lg-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                {{--<a class="nav-link active" id="v-pills-gen-ques-tab" data-bs-toggle="pill" href="#v-pills-gen-ques"
                    role="tab" aria-controls="v-pills-gen-ques" aria-selected="true">
                    <i class="bx bx-question-mark d-block check-nav-icon mt-4 mb-2"></i>
                    <p class="fw-bold mb-4">General Questions</p>
                </a>--}}
                <a class="nav-link" id="v-pills-privacy-tab" data-bs-toggle="pill" href="#v-pills-privacy"
                    role="tab" aria-controls="v-pills-privacy" aria-selected="false">
                    <i class="bx bx-check-shield d-block check-nav-icon mt-4 mb-2"></i>
                    <p class="fw-bold mb-4">Condition général</p>
                </a>
                <a class="nav-link" id="v-pills-support-tab" data-bs-toggle="pill" href="#v-pills-support"
                    role="tab" aria-controls="v-pills-support" aria-selected="false">
                    <i class="bx bx-support d-block check-nav-icon mt-4 mb-2"></i>
                    <p class="fw-bold mb-4">Support</p>
                </a>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade " id="v-pills-gen-ques" role="tabpanel"
                            aria-labelledby="v-pills-gen-ques-tab">
                            <h4 class="card-title mb-5">General Questions</h4>
                            <div class="faq-box d-flex mb-4">
                                <div class="flex-shrink-0 me-3 faq-icon">
                                    <i class="bx bx-help-circle font-size-20 text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15">Comment ajouter un produit ?</h5>
                                    <p class="text-muted">New common language will be more simple and regular than
                                        the existing European languages. It will be as simple as occidental.</p>
                                </div>
                            </div>
                            <div class="faq-box d-flex">
                                <div class="flex-shrink-0 me-3 faq-icon">
                                    <i class="bx bx-help-circle font-size-20 text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15">Comment ajouter une command ?</h5>
                                    <p class="text-muted">To an English person, it will seem like simplified
                                        English, as a skeptical Cambridge friend of mine told me what Occidental</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="v-pills-privacy" role="tabpanel"
                            aria-labelledby="v-pills-privacy-tab">
                            
                            @if($globalCondition)

                             <h4 class="card-title mb-5">{{$globalCondition->title}} </h4>

                            @else
                                <h4 class="card-title mb-5">Condition général </h4>
                            @endif

                            <div class="faq-box d-flex   ">
                                <div class="flex-shrink-0 me-3 faq-icon">
                                    <i class="bx bx-help-circle font-size-20 text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                  @if($globalCondition)

                                   {!! $globalCondition->description !!}

                                  @else
                                    <h5 class="font-size-15">Condition général !</h5>
                                  @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-support" role="tabpanel"
                            aria-labelledby="v-pills-support-tab">
                            <h4 class="card-title mb-5">Support</h4>

                            <div class="faq-box d-flex">
                                <div class="flex-shrink-0 me-3 faq-icon">
                                    <i class="bx bx-envelope  font-size-20 text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15">Envoyez nous un mail </h5>
                                    <p class="text-muted"><strong>info@sameleon-express.ma</strong></p>
                                </div>

                            </div>
                            <div class="faq-box d-flex">
                                <div class="flex-shrink-0 me-3 faq-icon">
                                    <i class="bx bx-phone  font-size-20 text-success"></i>
                                </div>

                                <div class="flex-grow-1">
                                    <h5 class="font-size-15">Appelez nous  </h5>
                                    <p class="text-muted">
                                        <strong> +2126 64 000 166 / +2126 64 000 165 </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
