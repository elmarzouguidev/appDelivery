@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.Command.Archive.__title')

        @include('Sameleon.Admin.Command.Archive.table')

    </div>

@endsection
