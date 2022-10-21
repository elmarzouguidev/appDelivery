<script>
    $('.closeAnnonce').click(function() {


        let userCompte = this.getAttribute('data-user');

        setTimeout(function() {
            document.getElementById('viewAnnonceForm')
                .submit();
        }, 1000);
    });
</script>
@if(auth()->user()->is_admin)
    <script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('delivery:home.read.notifications') }}", {
            method: 'PUT',
            data: {
                _token,
                id
            }
        });
    }
    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                $(this).parents('div.alert').remove();
            });
        });
        $('#mark-all').click(function() {
            let request = sendMarkRequest();
            request.done(() => {
                $('div.alert').remove();
            })
        });
    });
    </script>
@endif