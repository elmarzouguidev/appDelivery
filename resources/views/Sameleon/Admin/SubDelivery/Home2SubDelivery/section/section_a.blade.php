<div class="row">
    <div class="col-xl-4">
        <div class="card overflow-hidden mb-80">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">Bienvenue !</h5>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{ asset('assets/images/profile-img.png') }}" alt="{{ delivery()->full_name }}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="avatar-md profile-user-wid">
                            @if (!is_null(delivery()->logo))
                                <img class="img-thumbnail rounded-circle" alt="{{ delivery()->full_name }}"
                                    src="{{ asset('storage/' . delivery()->logo) }}" width="50">
                            @else
                                <img src="{{ asset('images/logo.png') }}" alt=""
                                    class="img-thumbnail rounded-circle" width="60">
                            @endif
                        </div>

                        <h5 class="font-size-15"">{{ delivery()->full_name }}</h5>

                    </div>

                    <div class="col-sm-8">
                        <div class="pt-4">

                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-size-15">{{ $total_command }}</h5>
                                    <p class="text-muted mb-0">commands</p>
                                </div>
                                <div class="col-6">
                                    <h5 class="font-size-15">{{ number_format(0000, 2) }}</h5>
                                    <p class="text-muted mb-0">chiffre d'affaires</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="row">
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Total Commands</p>
                                <h4 class="mb-0">{{ $total_command }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <a href="{{ route('delivery:commands.index') }}">
                                        <span class="avatar-title">
                                            <i class="bx bx-cart-alt font-size-24"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Total Commands Livré</p>
                                <h4 class="mb-0">{{ $total_command_livred }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center ">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <a href="{{ route('delivery:commands.index', ['livred' => true]) }}">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-check-square font-size-24"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">PDR & Injoignable</p>
                                <h4 class="mb-0">{{ $total_command_p_reponse }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <a href="{{ route('delivery:commands.index', ['pdr' => true]) }}">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-phone-incoming font-size-24"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Reporté & Interessé</p>
                                <h4 class="mb-0">{{ $total_command_p_reported }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <a href="{{ route('delivery:commands.index', ['reported' => true]) }}">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-history font-size-24"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Annulé & Refusé</p>
                                <h4 class="mb-0">{{ $total_command_cancled }}</h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <a href="{{ route('delivery:commands.index', ['cancled' => true]) }}">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-window-close font-size-24"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
