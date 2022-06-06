<div class="email-rightbar mb-3">

    <div class="card">
        <div class="btn-toolbar p-3" role="toolbar">
            <div class="btn-group me-2 mb-2 mb-sm-0">
                <button type="button" class="btn btn-primary waves-light waves-effect"><i
                        class="fa fa-inbox"></i></button>
                <button type="button" class="btn btn-primary waves-light waves-effect"><i
                        class="fa fa-exclamation-circle"></i></button>
                <button type="button" class="btn btn-primary waves-light waves-effect"><i
                        class="far fa-trash-alt"></i></button>
            </div>
            <div class="btn-group me-2 mb-2 mb-sm-0">
                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Updates</a>
                    <a class="dropdown-item" href="#">Social</a>
                    <a class="dropdown-item" href="#">Team Manage</a>
                </div>
            </div>
            <div class="btn-group me-2 mb-2 mb-sm-0">
                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Updates</a>
                    <a class="dropdown-item" href="#">Social</a>
                    <a class="dropdown-item" href="#">Team Manage</a>
                </div>
            </div>

            <div class="btn-group me-2 mb-2 mb-sm-0">
                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
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
        <ul class="message-list">
            @foreach ($complaints as $complaint)
                <li>
                    <div class="col-mail col-mail-1">
                        <div class="checkbox-wrapper-mail">
                            <input type="checkbox" id="chk20">
                            <label for="chk20" class="toggle"></label>
                        </div>
                        <a href="{{route('admin:complaints.show',$complaint->uuid)}}" class="title"> {{ $complaint->user->full_name }} (7)</a><span
                            class="star-toggle far fa-star"></span>
                    </div>
                    <div class="col-mail col-mail-2">
                        <a href="{{route('admin:complaints.show',$complaint->uuid)}}" class="subject"><span
                                class="bg-warning badge me-2">{{ $complaint->priority }}</span>
                                {{ $complaint->message }}
                        </a>
                        <div class="date">{{ $complaint->created_at->diffForHumans()}}</div>
                    </div>
                </li>
            @endforeach
        </ul>

    </div><!-- card -->

    <div class="row">
        <div class="col-7">
            Showing 1 - 20 of 1,524
        </div>
        <div class="col-5">
            <div class="btn-group float-end">
                <button type="button" class="btn btn-sm btn-success waves-effect"><i
                        class="fa fa-chevron-left"></i></button>
                <button type="button" class="btn btn-sm btn-success waves-effect"><i
                        class="fa fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

</div>
