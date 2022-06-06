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

    </script>

@endpush