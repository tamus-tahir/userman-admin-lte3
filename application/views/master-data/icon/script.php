<script>
    $('.addForm').on('click', function() {
        modalStatic();
        $('.btn-send').html('Tambah <i class="fas fa-paper-plane ml-2"></i>');
        $('#id_icon').val('');
        $('#token').val('');
        $('#my-form')[0].reset();
    });

    $('.btn-cancel').on('click', function() {
        $(".is-valid").removeClass('is-valid');
        $(".text-red").removeClass('text-red');
        $(".is-invalid").removeClass('is-invalid');
    });

    $('#myTable').on('click', '.updateForm', function() {
        modalStatic();

        $('.btn-send').html('Ubah <i class="fas fa-paper-plane ml-2"></i>');
        const id = $(this).data('id');
        const token = $(this).data('token');
        $.ajax({
            url: base_url + 'icon/getWhere',
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $('#id_icon').val(data.id_icon);
                $('#icon').val(data.icon);
                $('#token').val(token);
            }
        });
    });
</script>