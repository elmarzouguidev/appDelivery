@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Bank.__title')

        @include('Sameleon.Admin.Bank.__table')

        @include('Sameleon.Admin.Bank.__add_bank_modal')

    </div>
@endsection

@include('Sameleon.Admin.Bank.__js')
