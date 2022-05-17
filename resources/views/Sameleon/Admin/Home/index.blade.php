@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include(
            'Sameleon.Admin.Home.sections.section_0_page_title'
        )

        {{--<div class="row">

            @include('Sameleon.Admin.Home.sections.section_a_period')
        </div>--}}

        <div class="row">

            @include(
                'Sameleon.Admin.Home.sections.section_b_commands'
            )

        </div>

        <div class="row">

            @include(
                'Sameleon.Admin.Home.sections.section_b_commands_a'
            )

        </div>
        <div class="row">

            @include('Sameleon.Admin.Home.sections.section_b_b')
        </div> 

        <div class="row">
            @include('Sameleon.Admin.Home.sections.section_a_chart')
        </div>


        {{-- <div class="row">

            @include('Sameleon.Admin.Home.sections.section_c_c')

        </div> --}}
        <div class="row">

            {{-- @include('Sameleon.Admin.Home.sections.section_a_a') --}}
        </div>

 
        @include('Sameleon.Admin.Home.sections.section_f_delivery')
  

    </div>
@endsection

@once
    @push('scripts')
    @endpush
@endonce
