@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Ramassage.__title')
        @
        @include('Sameleon.Admin.Ramassage.products_2')
      
        
    </div>
@endsection

@once
    @push('scripts')
    @endpush
@endonce
