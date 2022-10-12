@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Stock.__title')

        @include('Sameleon.Admin.Stock.add_stock_modal')

        @livewire('sameleon.stock.stock')

        {{--<h1>Stock en mode maintennace ... </h1>--}}

    </div>
@endsection

@section('css')
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
@endsection


@push('scripts')
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        function myFunction() {


            // Get the checkbox
            var checkBox = document.getElementById("default_stock");

            var deliverySelect = document.getElementById("delivery_select");
            // If the checkbox is checked, display the output text
            if (checkBox.checked == true) {
                //deliverySelect.removeAttribute("disabled");
                deliverySelect.removeAttribute("required");
                deliverySelect.setAttribute("disabled", "disabled");
                $('#select_city').val(1);
                $('#select_city').trigger('change');
            } else {
    
                deliverySelect.setAttribute("required", "required");
                deliverySelect.removeAttribute("disabled");
                $('#select_city').val(null);
                $('#select_city').trigger('change');
            }
        }

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
