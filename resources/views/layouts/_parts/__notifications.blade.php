<div class="dropdown d-inline-block">

    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bx bx-bell {{ auth()->user()->unreadNotifications->count()? 'bx-tada': '' }}"></i>
        <span class="badge bg-danger rounded-pill">{{ auth()->user()->unreadNotifications->count() }}</span>
    </button>

    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
        aria-labelledby="page-header-notifications-dropdown">
        <div class="p-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0" key="t-notifications"> Notifications </h6>
                </div>
                {{-- <div class="col-auto">
                    <a href="#!" class="small" key="t-view-all"> View All</a>
                </div> --}}
            </div>
        </div>
        @forelse (auth()->user()->unreadNotifications as $notification)
            @if ($notification->type == 'App\Notifications\ProductCreated')
                <div data-simplebar style="max-height: 230px;">
                    <a href="#" class="text-reset notification-item">
                        <div class="d-flex">

                            <div class="flex-grow-1">
                                <h6 class="mb-1" key="t-your-order">Nouveau produit créer</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1" key="t-grammer">
                                        <b>{{ $notification->data['client'] }}</b> a crée le produit :
                                        <b>{{ $notification->data['name'] }}</b>
                                    </p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                    </p>

                                </div>

                            </div>

                        </div>
                    </a>
                </div>
            @endif

        @empty

            <div class="p-2 border-top d-grid">
                aucune notification pour le moment
            </div>
        @endforelse
        <div class="p-2 border-top d-grid">

            <form id="readAllNotifications" method="post" action="{{ route('admin:home.read.notifications') }}">
                @csrf
                @method('PUT')

            </form>
            <a class="btn btn-sm btn-link font-size-14 text-center" href="#"
                onclick="document.getElementById('readAllNotifications').submit();">
                <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">
                    tout marquer comme lu</span>
            </a>
        </div>
    </div>
</div>
