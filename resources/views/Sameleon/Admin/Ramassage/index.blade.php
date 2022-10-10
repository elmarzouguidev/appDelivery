@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Ramassage.__title')

        @if(isAdmin())
            @include('Sameleon.Admin.Ramassage.products_admin')
        @endif

        @if(isClient())
            @include('Sameleon.Admin.Ramassage.products_client')
        @endif
        
    </div>
@endsection

@once
    @push('scripts')
    @endpush
@endonce
