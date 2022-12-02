@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Testimonial.__title')


        @include('Sameleon.Admin.Testimonial.__table')

        @include('Sameleon.Admin.Testimonial.__add_testimonial_modal')

    </div>
@endsection

@section('javascript')
@include('Sameleon.Admin.Testimonial.__js')
@endsection