@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.Bank.__title')

        @include('Sameleon.Admin.Bank.__table')

    </div>

@endsection

@include('Sameleon.Admin.Bank.__js')