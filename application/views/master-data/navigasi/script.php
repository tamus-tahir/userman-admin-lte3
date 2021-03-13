<script>
    $('.addForm').on('click', function() {
        modalStatic();
        $('.btn-send').html('Tambah <i class="fas fa-paper-plane ml-2"></i>');
        $('#token').val('');
        $('#keyword-icon').val('');
        $('#id_navigasi').val('');
        $('#my-form')[0].reset();
        getIcon();
    });

    $('.btn-cancel').on('click', function() {
        $(".is-valid").removeClass('is-valid');
        $(".text-red").removeClass('text-red');
        $(".is-invalid").removeClass('is-invalid');
    });

    $('#myTable').on('click', '.updateForm', function() {
        modalStatic();
        $('#keyword-icon').val('');
        getIcon();
        $('.btn-send').html('Ubah <i class="fas fa-paper-plane ml-2"></i>');
        const id = $(this).data('id');
        const token = $(this).data('token');
        $.ajax({
            url: base_url + 'navigasi/getWhere',
            method: "POST",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $('#id_navigasi').val(data.id_navigasi);
                $('#navigasi').val(data.navigasi);
                $('#heading').val(data.heading);
                $('#url').val(data.url);
                $('#icon').val(data.icon);
                $('#url').val(data.url);
                $('#dropdown').val(data.dropdown);
                $('#urutan').val(data.urutan);
                $('#aktif').val(data.aktif);
                $('#cud').val(data.cud);
                $('#token').val(token);
            }
        });
    });


    //  icon
    $('#data-icon').on('click', '.get-icon', function() {
        $('#id_icon').val($(this).data('id'));
        $('#icon').val($(this).data('icon'));
    });

    $('#keyword-icon').on('keyup', function() {
        let keyword = $('#keyword-icon').val();
        $.ajax({
            url: base_url + 'navigasi/getSearch',
            method: "POST",
            dataType: 'json',
            data: {
                keyword: keyword
            },
            success: (data) => {
                let box = '';
                data.forEach(d => box += show(d));
                const icon = $('#data-icon').html(box);
            }
        });
    });

    function getIcon() {
        $.ajax({
            url: base_url + 'navigasi/getIcon',
            method: "POST",
            dataType: 'json',
            success: (data) => {
                let box = '';
                data.forEach(d => box += show(d));
                const icon = $('#data-icon').html(box);
            }
        });
    }

    function show(d) {
        return `
            <div class="d-inline-flex">
                <button type="button" class="btn btn-outline-secondary get-icon m-2" data-id="${d.id_icon}" data-icon="${d.icon}" data-dismiss="modal">
                    <i class="${d.icon} fa-2x"></i>
                </button>
            </div>
        `
    }
</script>