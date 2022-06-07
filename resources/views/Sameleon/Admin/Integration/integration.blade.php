<div class="row">

    <div class="row">
        <div class="col-lg-8">
            <div class="col-lg-4 mb-4">
                <button class="btn btn-info" type="button" class="btn btn-info  btn-sm" data-bs-toggle="modal"
                    data-bs-target=".addIntegrationModal">
                    Ajouter une integration
                </button>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    @foreach ($integrations as $integration)
        <div class="col-xl-4 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="text-lg-center">
                                {{-- <img src="assets/images/users/avatar-4.jpg"
                                        class="avatar-sm me-3 mx-lg-auto mb-3 mt-1 float-start float-lg-none rounded-circle"
                                        alt="img" /> --}}

                                @if (!is_null($integration->logo))
                                    <div>
                                        <img class="img-fluid rounded" alt=""
                                            src="{{ asset('storage/' . $integration->logo) }}" width="100">
                                    </div>
                                @endif
                                <h5 class="mb-1 font-size-15 text-truncate">{{ $integration->name }}</h5>
                                <a href="javascript: void(0);" class="text-muted">@ {{ $integration->name }}</a>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div>
                                <a href="invoices-detail.html"
                                    class="d-block text-primary text-decoration-underline mb-2">Invoice #14259</a>
                                <h5 class="text-truncate mb-4 mb-lg-5">Email Template UI</h5>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3">
                                        <h5 class="font-size-14" data-toggle="tooltip" data-placement="top"
                                            title="Amount"><i class="bx bx-user me-1 text-muted"></i>25</h5>
                                    </li>
                                    <li class="list-inline-item">
                                        <h5 class="font-size-14" data-toggle="tooltip" data-placement="top"
                                            title="Due Date"><i class="bx bx-calendar me-1 text-muted"></i>
                                            {{ $integration->created_at->format('d/m/Y') }}
                                        </h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>
