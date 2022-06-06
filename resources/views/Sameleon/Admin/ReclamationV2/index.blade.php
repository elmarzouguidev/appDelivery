@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        @include('Sameleon.Admin.ReclamationV2.__title')

        @include('Sameleon.Admin.ReclamationV2.content.content')

        @include('Sameleon.Admin.ReclamationV2.content.__add_reclamation_modal')
        
    </div>

@endsection

