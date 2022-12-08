<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button data-user="{{ auth()->user()->uuid }}" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            @php
                $user = auth()->user()->uuid;
            @endphp
            <form id="readRamassageNotifications" method="post"
                action="{{ route('admin:home.notifications.ramassage') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="userId" value="{{ $user }}">
            </form>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="avatar-md mx-auto mb-4">
                        <div class="avatar-title bg-light rounded-circle text-primary h1">
                            <i class="bx bx-volume-full"></i>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <h4 class="text-primary">Ramassage accepté !</h4>
                            <ul class="list-group">
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                    @if (null !== $notification->data['product_id'] && null !== $notification->data['product_uuid'])
                                        <li class="list-group-item text-muted font-size-14 mb-4">
                                            Voir le produit

                                            <a href="{{ route('admin:products.edit', [$notification->data['product_uuid']]) }}"
                                                class="">
                                                <b>{{ $notification->data['name'] }}</b>
                                            </a>

                                        </li>
                                    @else
                                        <li class="list-group-item text-muted font-size-14 mb-4">
                                            vous pouvez ajouter le produit

                                            <a href="{{ route('admin:products.create', ['fromRamassage' => $notification->data['uuid']]) }}"
                                                class="">
                                                <b>{{ $notification->data['name'] }}</b>
                                            </a>


                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn btn-primary" type="button"
                                    onclick="document.getElementById('readRamassageNotifications').submit();">
                                    je confirme
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
