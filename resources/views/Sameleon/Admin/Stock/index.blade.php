@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Stock.__title')

        {{-- @include('Sameleon.Admin.Stock.__datatable.__with_options') --}}

        @livewire('sameleon.stock.stock')

    </div>
@endsection


@push('scripts')

    <script>

        window.addEventListener('show-edit-stock', event => {
            $('.editstockModal').modal('show');
        });

        window.addEventListener('hidden.bs.modal', event => {

            window.location.reload();
        });

    </script>
@endpush
