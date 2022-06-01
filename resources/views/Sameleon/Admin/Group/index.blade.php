@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.Group.__title')

        @include('Sameleon.Admin.Group.__table')

    </div>

    @include('Sameleon.Admin.Group.__add_group_modal')
    
@endsection

