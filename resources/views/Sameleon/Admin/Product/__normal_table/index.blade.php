@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Product.__title')

        {{-- @include('Sameleon.Admin.Product.__normal_table.__filters') --}}
        @hasrole('DeliveryEntreprise')

            @include('Sameleon.Admin.Product.__normal_table.table_delivery_entreprise')
        @else

            @include('Sameleon.Admin.Product.__normal_table.table')
            
        @endhasrole

    </div>
@endsection

@include('Sameleon.Admin.Product.__js')
