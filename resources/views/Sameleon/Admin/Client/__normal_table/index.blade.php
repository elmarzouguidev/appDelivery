@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.Client.__title')

        @include('Sameleon.Admin.Client.__normal_table.table')

        @each('Sameleon.Admin.Client.__normal_table.__edit_permissions', $clients, 'client')
        
    </div>

@endsection

@include('Sameleon.Admin.Client.__js')