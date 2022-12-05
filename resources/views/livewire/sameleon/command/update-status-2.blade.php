<div>
    <div class="modal fade updateStatus" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=orderdetailsModalLabel">commande N° : {{ $command->code }}
                    </h5>

                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <div class="col-xl-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-2" id=orderdetailsModalLabel">statut actuel :
                                    {{ __('status.statuses.' . $command->status) }}
                                </h5>
                                @php
                                    $statuses = App\Status\Status::getStatus();
                                    $btnStatus = '';
                                    if ($commandStatus == App\Status\Status::NON_TRAITE) {
                                        $btnStatus = 'disabled';
                                    }
                                @endphp


                                <form wire:submit.prevent="changeStatus('{{ $command->uuid }}')" method="post">
                                    @csrf
                                    <div class="btn-group d-flex align-content-start flex-wrap" role="group"
                                        aria-label="Basic radio toggle button group">

                                        @foreach ($statuses as $status)
                                            @if ($status !== App\Status\Status::NON_TRAITE)
                                                <input type="radio" class="btn-check mr-1 ml-2" {{$command->status == $status ? 'disabled' :''}}  name="commandStatus"
                                                    value="{{ $status }}" id="status-{{ $status }}"
                                                    wire:model="commandStatus" autocomplete="off">
                                                <label
                                                    class="btn btn-secondary border-2 {{ __('status.classes.' . $status) }}"
                                                    for="status-{{ $status }}">
                                                    {{ __('status.statuses.' . $status) }}
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>

                                    @include('livewire.sameleon.command.update-status-detail')

                                    <div class="d-flex flex-wrap gap-2 justify-content-start mt-4">

                                        <button {{ $btnStatus }} type="submit"
                                            class="btn btn-primary waves-effect waves-light" {{-- onclick='document.getElementById("overlayy").style.display = "block"' --}}>
                                            {{ __('buttons.store') }}

                                        </button>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
