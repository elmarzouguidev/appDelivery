@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="commands_list">

        @include('Sameleon.Client.Command.__title')

        {{-- @include('Sameleon.Client.Command.__datatable.__with_options') --}}

        @livewire('sameleon.command.commands',['commands'=>$commands])

        @include('Sameleon.Client.Command.__datatable.__add_command_modal')
            
        @each('Sameleon.Client.Command.__datatable.__command_detail',$commands ,'command' )

    </div>
@endsection

@section('css')

@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/datatables.js') }}"></script>
    <script src="{{ asset('js/pages/datatables.init.js') }}"></script>

    <script>
   
        window.addEventListener('show-edit', event => {
            $('.editCommandModal').modal('show');
        });

        window.addEventListener('hidden.bs.modal', event => {
            //$("#commands_list").load(window.location.href + " #commands_list");
            window.location.reload();
        });

        window.addEventListener('show-edit-status', event => {
            $('.updateStatus').modal('show');
        });

    </script>
@endpush
