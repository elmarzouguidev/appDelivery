@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.Delivery.__title')

        @include('Sameleon.Admin.Delivery.__normal_table.table')

        @include('Sameleon.Admin.Delivery.__normal_table.delivery_teams')

    </div>

@endsection

