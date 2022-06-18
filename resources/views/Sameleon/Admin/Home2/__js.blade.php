<script>
    $('.closeAnnonce').click(function() {


        let userCompte = this.getAttribute('data-user');

        setTimeout(function() {
            document.getElementById('viewAnnonceForm')
                .submit();
        }, 1000);
    });
</script>
