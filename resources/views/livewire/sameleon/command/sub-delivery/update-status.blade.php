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

                                    <button {{$command->status == App\Status\Status::ANNULE ? 'disabled' :' '}}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::ANNULE }})"
                                        type="button"
                                        class="btn btn-sm btn-primary waves-effect waves-light">Annulé</button>

                                    <button {{$command->status == App\Status\Status::LIVRE ? 'disabled' :' '}}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::LIVRE }})"
                                        type="button"
                                        class="btn btn-sm btn-secondary waves-effect waves-light">Livré</button>
                                        

                                    <button {{$command->status == App\Status\Status::INJOIGNABLE ? 'disabled' :' '}}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::INJOIGNABLE }})"
                                        type="button"
                                        class="btn btn-sm btn-danger waves-effect waves-light">Injoignable</button>

      
                                    <button {{$command->status == App\Status\Status::MANQUE_DE_STOCK ? 'disabled' :' '}}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::MANQUE_DE_STOCK }})"
                                        type="button" class="btn btn-sm btn-light waves-effect">Manque De Stock</button>

                                    <button {{$command->status == App\Status\Status::PAS_DE_REPONSE ? 'disabled' :' '}}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::PAS_DE_REPONSE }})"
                                        type="button" class="btn btn-sm btn-light waves-effect">Pas de réponse</button>
            
                                    <button {{$command->status == App\Status\Status::REFUSE ? 'disabled' :' '}}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::REFUSE }})"
                                        type="button" class="btn btn-sm btn-danger waves-effect">Refusé</button>

                                    <button {{$command->status == App\Status\Status::REPORTE ? 'disabled' :' '}}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::REPORTE }})"
                                        type="button" class="btn btn-sm btn-danger waves-effect">Reporté</button>

                                    <button {{$command->status == App\Status\Status::RETOURNE ? 'disabled' :' '}}
                                        wire:click="changeStatus('{{ $command->uuid }}',{{ App\Status\Status::RETOURNE }})"
                                        type="button" class="btn btn-sm btn-danger waves-effect">
                                        Retourné
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
