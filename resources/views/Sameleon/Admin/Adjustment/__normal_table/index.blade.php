@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Product.__title')

        {{--@include('Sameleon.Admin.Product.__normal_table.__filters')--}}
        
        @include('Sameleon.Admin.Product.__normal_table.table')

    </div>
@endsection

@include('Sameleon.Admin.Product.__js')