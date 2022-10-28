@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.Condition.__title')

        @include('Sameleon.Admin.Condition.__table')

        @include('Sameleon.Admin.Condition.__add_condition')
    </div>
    
@endsection

@include('Sameleon.Admin.Condition.__js')