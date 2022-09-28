@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Stock.__title')

        @include('Sameleon.Admin.Stock.__normal_table.table_delivery_entreprise')

    </div>
@endsection

