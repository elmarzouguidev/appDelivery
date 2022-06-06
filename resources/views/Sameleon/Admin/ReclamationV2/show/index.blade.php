@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">

                @include('Sameleon.Admin.ReclamationV2.show.sidebar')

                @include('Sameleon.Admin.ReclamationV2.show.detail')

            </div>
        </div>

    </div>
@endsection
