<div>
    <div class="modal fade updateStatus" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="button-items d-flex align-content-start flex-wrap">

                                    @php
                                        $locked = false;
                                        if ($command->status == App\Status\Status::REFUSE || $command->status == App\Status\Status::LIVRE) {
                                            $locked = true;
                                        }
                                    @endphp
                                    <button
                                        {{ $command->status == App\Status\Status::ENCOURS || $locked ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::ENCOURS }})"
                                        type="button" class="btn btn-sm btn-info waves-effect waves-light">En
                                        cours</button>

                                    <button
                                        {{ $command->status == App\Status\Status::EXPEDIE || $locked ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::EXPEDIE }})"
                                        type="button"
                                        class="btn btn-sm btn-warning waves-effect waves-light">Expédié</button>

                                    <button
                                        {{ $command->status == App\Status\Status::ANNULE || $locked ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::ANNULE }})"
                                        type="button"
                                        class="btn btn-sm btn-primary waves-effect waves-light">Annulé</button>
                                    <button {{ $command->status == App\Status\Status::REFUSE ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::REFUSE }})"
                                        type="button" class="btn btn-sm btn-danger waves-effect">Refusé</button>



                                    <button
                                        {{ $command->status == App\Status\Status::CHANGE || $locked ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::CHANGE }})"
                                        type="button"
                                        class="btn btn-sm btn-success waves-effect waves-light">Change</button>



                                    <button
                                        {{ $command->status == App\Status\Status::INJOIGNABLE || $locked ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::INJOIGNABLE }})"
                                        type="button"
                                        class="btn btn-sm btn-danger waves-effect waves-light">Injoignable</button>

                                    <button
                                        {{ $command->status == App\Status\Status::INTERESSE || $locked ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::INTERESSE }})"
                                        type="button"
                                        class="btn btn-sm btn-dark waves-effect waves-light">Interessé</button>

                                    <button
                                        {{ $command->status == App\Status\Status::NON_INTERESSE || $locked ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::NON_INTERESSE }})"
                                        type="button" class="btn btn-sm btn-dark waves-effect waves-light">Non
                                        interessé</button>

                                    <button
                                        {{ $command->status == App\Status\Status::MANQUE_DE_STOCK || $locked ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::MANQUE_DE_STOCK }})"
                                        type="button" class="btn btn-sm btn-light waves-effect">Manque De
                                        Stock</button>

                                    <button
                                        {{ $command->status == App\Status\Status::PAS_DE_REPONSE || $locked ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::PAS_DE_REPONSE }})"
                                        type="button" class="btn btn-sm btn-light waves-effect">Pas de réponse</button>


                                    <button
                                        {{ $command->status == App\Status\Status::RECONFIRMER || $locked ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::RECONFIRMER }})"
                                        type="button" class="btn btn-sm btn-light waves-effect">Reconfirmer</button>



                                    <button
                                        {{ $command->status == App\Status\Status::REPORTE || $locked ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::REPORTE }})"
                                        type="button" class="btn btn-sm btn-danger waves-effect">Reporté</button>

                                    <button
                                        {{ $command->status == App\Status\Status::RETOURNE || $locked ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::RETOURNE }})"
                                        type="button" class="btn btn-sm btn-danger waves-effect">
                                        Retourné
                                    </button>

                                    <button {{ $command->status == App\Status\Status::LIVRE ? 'disabled' : ' ' }}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::LIVRE }})"
                                        type="button"
                                        class="btn btn-sm btn-secondary waves-effect waves-light">Livré</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
