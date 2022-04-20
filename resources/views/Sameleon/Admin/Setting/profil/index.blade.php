@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Setting.__section_title')
        
        @include('Sameleon.Admin.Setting.profil.profile')

        @include('Sameleon.Admin.Setting.profil.password')

    </div>
@endsection
