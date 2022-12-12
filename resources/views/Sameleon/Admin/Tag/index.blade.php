@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Tag.__title')

        @include('Sameleon.Admin.Tag.__table')

        @include('Sameleon.Admin.Tag.__add_tag')
    </div>
@endsection

@include('Sameleon.Admin.Tag.__js')
