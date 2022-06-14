@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.Apps.__title')

        @include('Sameleon.Admin.Apps.apps')

    </div>

@endsection

@section('css')
<style>
    .appimg {
        float: center;
        width:  100%;
        height: auto;
        object-fit: cover;
    }
 </style>
@endsection