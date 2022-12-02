@extends('layouts.app')

@section('content')
    <div class="container-fluid">
  
        @include('Sameleon.Admin.Stock.StockDelivery.__title')

        {{--@include('Sameleon.Admin.Stock.StockDelivery.add_stock_modal')--}}

        @livewire('sameleon.stock.stock-delivery.stock-delivery')

    </div>
@endsection

@section('css')

@endsection

@push('scripts')

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
