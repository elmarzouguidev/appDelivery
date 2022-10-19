@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.SubDelivery.Invoice.__title')

        @livewire('sameleon.invoice.sub-delivery.invoices')

    </div>
@endsection

@section('css')

<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@push('scripts')

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>

        window.addEventListener('add-bill', event => {
            $('.addPaymentToInvoice').modal('show');
        });

        window.addEventListener('hidden.bs.modal', event => {

            window.location.reload();
        });

        window.addEventListener('invoice-paid', event => {

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Le règlement  a éte ajouter avec succès. ',
                showConfirmButton: false,
                timer: 1900
            })

            setTimeout(function() {
                window.location.reload();
            }, 3000);

        });
        
    </script>

@endpush
