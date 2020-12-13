<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $('.change-akses').on('click', function() {
        const id_profil = $(this).data('profil');
        const id_navigasi = $(this).data('navigasi');
        const url = $(this).data('url');

        $.ajax({
            url: base_url + 'profil/' + url,
            type: 'post',
            data: {
                id_profil: id_profil,
                id_navigasi: id_navigasi
            },

            success: function() {
                document.location.href = base_url + 'profil/akses/' + id_profil;
            }
        });
    });
</script>