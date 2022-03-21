@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Command.__title')

        @include('Sameleon.Admin.Command.__edit.__form_edit')

    </div>
@endsection

@section('css')
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">

@endsection

@once

    @push('scripts')
        <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

        <script>

            /*$('#select-product').select2({
                placeholder: 'choisir le produit',
                allowClear: true
            });*/
            /*$('#select-product').on('change', function(e) {
                setTimeout(function() {
                    livewire.emit('selectedProduct', e.target.value)
                    console.log(e.target.dataset.indexer);
                }, 1000);
            });*/
        </script>
    @endpush

@endonce
