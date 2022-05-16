<div class="col-xl-12">
    <div class="row">
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">En cours & Expédié</p>
                            <h4 class="mb-0">{{ $total_command_encours }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">

                                <a href="{{ route('admin:commands.index', ['encours' => true]) }}">
                                    <span class="avatar-title">
                                        <i class="bx bx-time-five font-size-24"></i>
                                    </span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">PDR & Injoignable</p>
                            <h4 class="mb-0">{{ $total_command_p_reponse }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <a href="{{ route('admin:commands.index', ['pdr' => true]) }}">
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
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Reporté & Interessé</p>
                            <h4 class="mb-0">{{ $total_command_p_reported }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <a href="{{ route('admin:commands.index', ['reported' => true]) }}">
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
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Annulé & Refusé</p>
                            <h4 class="mb-0">{{ $total_command_cancled }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <a href="{{ route('admin:commands.index', ['cancled' => true]) }}">
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
