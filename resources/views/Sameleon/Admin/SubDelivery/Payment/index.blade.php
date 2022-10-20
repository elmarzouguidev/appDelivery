@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.SubDelivery.Payment.__title')

        @include('Sameleon.Admin.SubDelivery.Payment.__table')

    </div>

@endsection

@include('Sameleon.Admin.Payment.__js')