<script>
    $(document).ready(function() {
        $('#change-navbar').on('change', function() {
            changeConfig();
        });
        $('#change-brandlogo').on('change', function() {
            changeConfig();
        });
        $('#change-sidebar').on('change', function() {
            changeConfig();
        });
    });

    function changeConfig() {
        let navbar = $('#change-navbar').val();
        let brandlogo = $('#change-brandlogo').val();
        let sidebar = $('#change-sidebar').val();

        $.ajax({
            url: base_url + 'config/update',
            method: "POST",
            data: {
                navbar: navbar,
                brandlogo: brandlogo,
                sidebar: sidebar
            },
            success: function() {
                document.location.href = base_url + 'config'
            }
        });
    }
</script>