@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Region.__title')

        {{--@include('Sameleon.Admin.City.__datatable.__with_options')--}}

        {{--@include('Sameleon.Admin.Region.__datatable.__add_region_modal')--}}

        @livewire('sameleon.region.region')

    </div>
@endsection

@section('css')

@endsection

@push('scripts')

    <script>

        window.addEventListener('show-edit', event => {
            $('.editRegionModal').modal('show');
        });

        window.addEventListener('hidden.bs.modal', event => {
            
            window.location.reload();
        });

    </script>

@endpush