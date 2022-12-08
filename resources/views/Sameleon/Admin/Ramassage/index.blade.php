@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Ramassage.__title')


        @if (isAdmin() || isClient())
            @include('Sameleon.Admin.Ramassage.products_admin')
        @endif

        {{-- @if (isClient())
            @include('Sameleon.Admin.Ramassage.products_client')
        @endif --}}

        @if (isClient())
            @include('Sameleon.Admin.Ramassage.__add_ramassage_model')
        @endif
    </div>
@endsection


@push('scripts')
    <script>
        function myFunction() {

            // Get the checkbox
            var checkBox = document.getElementById("newproduct");

            var selectProduct = document.getElementById("selectProduct");
            var newProduct = document.getElementById("newProduct");
            var priceProduct = document.getElementById("priceProduct");

            if (checkBox.checked == true) {

                newProduct.setAttribute("required", "required");
                newProduct.removeAttribute("disabled");

                priceProduct.setAttribute("required", "required");
                priceProduct.removeAttribute("disabled");

                selectProduct.removeAttribute("required");

                selectProduct.setAttribute("disabled", "disabled");

            } else {

                selectProduct.setAttribute("required", "required");
                selectProduct.removeAttribute("disabled");

                newProduct.removeAttribute("required");
                newProduct.setAttribute("disabled", "disabled");

                priceProduct.removeAttribute("required");
                priceProduct.setAttribute("disabled", "disabled");

            }
        }
    </script>
@endpush
