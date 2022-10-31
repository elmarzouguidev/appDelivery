@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.Admin.__title')

        @include('Sameleon.Admin.Admin.__normal_table.table')

        @include('Sameleon.Admin.Admin.__normal_table.__edit_permissions_v2')
    </div>

@endsection