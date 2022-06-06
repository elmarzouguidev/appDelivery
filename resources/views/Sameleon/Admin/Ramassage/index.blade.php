@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Ramassage.__title')

        @hasanyrole('SuperAdmin|Admin')
            @include('Sameleon.Admin.Ramassage.products_admin')
        @endhasanyrole

        @role('Client')
            @include('Sameleon.Admin.Ramassage.products_client')
        @endrole
        
    </div>
@endsection

@once
    @push('scripts')
    @endpush
@endonce
