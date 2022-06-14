@push('scripts')
    {{--<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>--}}
    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <script src="{{ asset('js/pages/lightbox.init.js') }}"></script>

    <script>
        window.addEventListener('hidden.bs.modal', event => {
            window.location.reload();
        });
    </script>

    <script>
        function getChecked(checkboxName) {
            let checkBoxes = document.getElementsByName(checkboxName);
            let ids = Array.prototype.slice.call(checkBoxes)
                .filter(ch => ch.checked == true)
                .map(ch => ch.value);
            return ids;
        }

        function getStock() {
            let stock = document.getElementById("stockList");
            console.log(stock.value);
            return stock.value;
        }
        function getClient() {
            let client = document.getElementById("clientList");
            console.log(client.value);
            return client.value;
        }

        function getDateFilter() {
            let date = document.getElementById("dateFilter");
            console.log(date.value);
            return date.value;
        }

        function filterResults() {

 
            let stock = getStock();

            let clientId = getClient();

            let getDate = getDateFilter();

            let href = '{{ collect(request()->segments())->last() }}?';

            if (clientId.length) {
                href += '&appFilter[GetClient]=' + clientId;
            }
            if (stock.length) {
                href += '&appFilter[GetStock]=' + stock;
            }
            if (getDate.length) {
                href += '&appFilter[GetDate]=' + getDate;
            }
            document.location.href = href;
            // return href;
        }

        document.getElementById("filterData").addEventListener("click", function(event) {

            event.preventDefault();
            filterResults();

            /*$.ajax({
                url: filterResults(),
                type: 'GET',
                success: function() {
                    console.log("it Works");
                    $("#invoices_lister").load(window.location.href + " #invoices_lister");
                }
            });*/
        });

        /*$(".chk-filter").on("click", function() {
            if (this.checked) {
               // $('#filter').click();
                filterResults()
            }
        });*/
    </script>
@endpush
