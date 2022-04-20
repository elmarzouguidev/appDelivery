@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Setting.__section_title')
        
        @include('Sameleon.Admin.Setting.Profil.profile')

        @include('Sameleon.Admin.Setting.Profil.password')

    </div>
@endsection
