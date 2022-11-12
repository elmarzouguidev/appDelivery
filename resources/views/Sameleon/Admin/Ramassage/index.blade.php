@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Ramassage.__title')

        @if(isAdmin() || isClient())
            @include('Sameleon.Admin.Ramassage.products_admin')
        @endif

        {{--@if(isClient())
            @include('Sameleon.Admin.Ramassage.products_client')
        @endif--}}

        @if(isClient())

         @include('Sameleon.Admin.Ramassage.__add_ramassage_model')

        @endif
    </div>
@endsection

@once
    @push('scripts')

    @endpush
@endonce
