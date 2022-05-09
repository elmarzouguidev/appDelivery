@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Delivery.__title')

        @include('Sameleon.Admin.Delivery.__datatable.__with_options')

    </div>
@endsection

@include('layouts._parts.__datatables')
