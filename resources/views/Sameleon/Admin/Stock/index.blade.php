@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Stock.__title')

        @include('Sameleon.Admin.Stock.add_stock_modal')

        @livewire('sameleon.stock.stock')


    </div>
@endsection

@section('css')
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
@endsection


@push('scripts')
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        window.addEventListener('show-edit-stock', event => {
            $('.editstockModal').modal('show');
        });

        window.addEventListener('show-stock-detail', event => {
            $('.showStockDetailsModal').modal('show');
        });

        window.addEventListener('hidden.bs.modal', event => {

            window.location.reload();
        });
    </script>
@endpush
