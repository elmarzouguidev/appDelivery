@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Setting.source_integration.__title')

        @include('Sameleon.Admin.Setting.source_integration.source')


        @include('Sameleon.Admin.Setting.source_integration.__add_source_modal')
    </div>
@endsection