@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.SubDelivery.Delivery.__title')

        @include('Sameleon.Admin.SubDelivery.Delivery.__datatable.__with_options')

    </div>
@endsection

@include('layouts._parts.__datatables')
