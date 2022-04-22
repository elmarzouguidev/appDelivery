@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.History.__title')
        
        @include('Sameleon.Admin.History.section')

    </div>
@endsection

@once
    @push('scripts')

    @endpush
@endonce
