@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.Annonce.__title')

        @include('Sameleon.Admin.Annonce.__table')

        @include('Sameleon.Admin.Annonce.__add_annonce')

    </div>

@endsection

@include('Sameleon.Admin.Annonce.__js')