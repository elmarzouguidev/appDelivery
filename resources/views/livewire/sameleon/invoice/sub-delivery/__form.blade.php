<form wire:submit.prevent="storeBill('{{ $invoice->uuid }}')" method="post">
    @csrf

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    @include('livewire.sameleon.invoice.sub-delivery.__form_info')
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-wrap gap-2 justify-content-end mb-4">
        <div class="">
            <button {{$buttonClass}} type="submit" class="btn btn-primary waves-effect waves-light">
                {{ __('buttons.store') }}
            </button>
        </div>
    </div>

</form>
