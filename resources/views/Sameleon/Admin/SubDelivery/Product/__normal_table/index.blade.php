@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.SubDelivery.Product.__title')

        @include('Sameleon.Admin.SubDelivery.Product.__normal_table.table_delivery_entreprise')

    </div>
@endsection

@include('Sameleon.Admin.Product.__js')
