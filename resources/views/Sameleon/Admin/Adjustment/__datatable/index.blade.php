@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Product.__title')

        @include('Sameleon.Admin.Product.__datatable.__with_options')

    </div>
@endsection

@include('layouts._parts.__datatables')
