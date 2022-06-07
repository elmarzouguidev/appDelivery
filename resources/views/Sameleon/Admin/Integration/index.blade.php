@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.Integration.__title')

        @include('Sameleon.Admin.Integration.integration2')

        @include('Sameleon.Admin.Integration.__add_integration_modal')

    </div>
    
@endsection

@include('Sameleon.Admin.Integration.js')