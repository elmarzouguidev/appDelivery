@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.City.__title')

        @include('Sameleon.Admin.City.__datatable.__add_city_modal')

        @livewire('sameleon.city.city')

    </div>
@endsection

@section('css')

@endsection

@push('scripts')

    <script>

        window.addEventListener('show-edit', event => {
            $('.editCityModal').modal('show');
        });

        window.addEventListener('show-region', event => {
            $('.showRegionModal').modal('show');
        });

        window.addEventListener('hidden.bs.modal', event => {
            window.location.reload();
        });

        function myFunction() {

            // Get the checkbox
            var checkBox = document.getElementById("has_profit");

            var profitInput = document.getElementById("profit");

            if (checkBox.checked == true) {

                profitInput.removeAttribute("disabled");
                profitInput.setAttribute("required", "required");

            } else {
                profitInput.setAttribute("disabled");
                profitInput.removeAttribute("required", "required");
            }
        }

    </script>

@endpush