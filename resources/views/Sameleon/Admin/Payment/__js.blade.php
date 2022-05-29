
@push('scripts')

    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <script src="{{ asset('js/pages/lightbox.init.js') }}"></script>

    <script>

        window.addEventListener('hidden.bs.modal', event => {
            //$("#commands_list").load(window.location.href + " #commands_list");

            window.location.reload();
        });

    </script>

@endpush