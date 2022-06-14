<div class="row">
    <div class="row">
        @foreach ($apps as $app)
            <div class="col-sm-4">
                <div class="card p-1 border shadow-none">
                    <div class="p-3">
                        <h5><a href="blog-details.html" class="text-dark">{{ $app->name }}</a></h5>
                        <p class="text-muted mb-0">10 Apr, 2020</p>
                    </div>
                    
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $app->logo) }}" alt="" class="img-thumbnail">
                    </div>

                    <div class="p-3">
                        <ul class="list-inline">
                            <li class="list-inline-item me-3">
                                <a href="javascript: void(0);" class="text-muted">
                                    <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i> Project
                                </a>
                            </li>
                            <li class="list-inline-item me-3">
                                <a href="javascript: void(0);" class="text-muted">
                                    <i class="bx bx-comment-dots align-middle text-muted me-1"></i> 12 Comments
                                </a>
                            </li>
                        </ul>
                        <p>{{ $app->desciption }}</p>

                        <div>
                            <a href="javascript: void(0);" class="text-primary">Read more <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
