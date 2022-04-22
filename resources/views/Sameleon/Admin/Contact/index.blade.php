@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Contact.__title')
        
        @include('Sameleon.Admin.Contact.section')

    </div>
@endsection

@once
    @push('scripts')
    @endpush
@endonce
