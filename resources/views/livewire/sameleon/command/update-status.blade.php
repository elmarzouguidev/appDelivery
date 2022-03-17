<div>
    <div class="modal fade updateStatus"  tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="button-items">
                                    <button type="button"
                                        class="btn btn-sm btn-primary waves-effect waves-light">Primary</button>
                                    <button type="button"
                                        class="btn btn-sm btn-secondary waves-effect waves-light">Secondary</button>
                                    <button type="button"
                                        class="btn btn-sm btn-success waves-effect waves-light">Success</button>
                                    <button type="button" class="btn btn-info waves-effect waves-light">Info</button>
                                    <button type="button"
                                        class="btn btn-sm btn-warning waves-effect waves-light">Warning</button>
                                    <button type="button"
                                        class="btn btn-sm btn-danger waves-effect waves-light">Danger</button>
                                    <button type="button" class="btn btn-sm btn-dark waves-effect waves-light">Dark</button>
                                    <button type="button" class="btn btn-sm btn-link waves-effect">Link</button>
                                    <button type="button" class="btn btn-sm btn-light waves-effect">Light</button>
                                </div>
                                <div wire:loading wire:target="editStatus('{{$command->uuid}}')">
                                    Updating Bob...
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
