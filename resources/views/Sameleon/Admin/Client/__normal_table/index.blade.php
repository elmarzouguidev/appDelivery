@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.Client.__title')

        @include('Sameleon.Admin.Client.__normal_table.table')

    </div>

@endsection

@include('Sameleon.Admin.Client.__js')