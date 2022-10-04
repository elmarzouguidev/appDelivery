@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Setting.__section_title')

        @include('Sameleon.Admin.SubDelivery.Setting.profil.profile')

        @include('Sameleon.Admin.SubDelivery.Setting.profil.password')

       {{-- @include('Sameleon.Admin.SubDelivery.Setting.profil.bank') --}} 

    </div>
@endsection
