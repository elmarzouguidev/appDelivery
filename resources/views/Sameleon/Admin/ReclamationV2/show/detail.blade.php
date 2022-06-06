<div class="email-rightbar mb-3">

    <div class="card">
        <div class="btn-toolbar p-3" role="toolbar">
            <div class="btn-group me-2 mb-2 mb-sm-0">
                <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-inbox"></i></button>
                <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button>
                <button type="button" class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i></button>
            </div>
            <div class="btn-group me-2 mb-2 mb-sm-0">
                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Updates</a>
                    <a class="dropdown-item" href="#">Social</a>
                    <a class="dropdown-item" href="#">Team Manage</a>
                </div>
            </div>
            <div class="btn-group me-2 mb-2 mb-sm-0">
                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Updates</a>
                    <a class="dropdown-item" href="#">Social</a>
                    <a class="dropdown-item" href="#">Team Manage</a>
                </div>
            </div>

            <div class="btn-group me-2 mb-2 mb-sm-0">
                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    More <i class="mdi mdi-dots-vertical ms-2"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Mark as Unread</a>
                    <a class="dropdown-item" href="#">Mark as Important</a>
                    <a class="dropdown-item" href="#">Add to Tasks</a>
                    <a class="dropdown-item" href="#">Add Star</a>
                    <a class="dropdown-item" href="#">Mute</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="d-flex mb-4">
                @if(!is_null($reclamation->user->logo))
                    <div class="flex-shrink-0 me-3">
                        <img class="rounded-circle avatar-sm" src="{{ asset('storage/' . $reclamation->client->logo) }}" alt="Generic placeholder image">
                    </div>
                @endif
      
                <div class="flex-grow-1">
                    <h5 class="font-size-14 mt-1">{{$reclamation->user->full_name}}</h5>
                    <small class="text-muted">{{$reclamation->user->email}}</small>
                </div>
            </div>

            {{--<h4 class="font-size-16">This Week's Top Stories</h4>--}}

            <p>{!! $reclamation->message !!}</p>

            <hr/>

            {{--<div class="row">
                <div class="col-xl-2 col-6">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="assets/images/small/img-3.jpg" alt="Card image cap">
                        <div class="py-2 text-center">
                            <a href="javascript: void(0);" class="fw-medium">Download</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-6">
                    <div class="card">
                        <img class="card-img-top img-fluid" src="assets/images/small/img-4.jpg" alt="Card image cap">
                        <div class="py-2 text-center">
                            <a href="javascript: void(0);" class="fw-medium">Download</a>
                        </div>
                    </div>
                </div>
            </div>--}}
            <form method="post" action="{{ route('admin:complaints.update',$reclamation->uuid) }}">
                @csrf
                <div class="modal-body">
                    <div>
                        <div class="mb-3">

                            <textarea rows="10" class="form-control @error('message') is-invalid @enderror" {{-- id="email-editor" --}} name="message"></textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>
  
            </form>
            <a href="javascript: void(0);" class="btn btn-secondary waves-effect mt-4"><i class="mdi mdi-reply"></i> Reply</a>
        </div>

    </div>
</div>