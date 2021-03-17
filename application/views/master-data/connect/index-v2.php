<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php $config = $this->Default_m->getWhere('tabel_config', ['id_config' => 1])->row(); ?>
    <meta name="description" content="<?= $config->description; ?>">
    <meta name="keywords" content="<?= $config->keywords; ?>">
    <meta name="author" content="<?= $config->author; ?>">
    <link rel="icon" href="<?= base_url('assets/img/' . $config->logo); ?>">

    <title><?= $title; ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/animate/animate.css'); ?>">
</head>

<body style="
background: linear-gradient(rgba(0, 0, 0, 0.7),rgba(0, 0, 0, 0.2)),url(<?= base_url('assets/img/' . $config->background); ?>); 
background-repeat: no-repeat;
background-size: cover;
background-position: center;
background-attachment: fixed;
">

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <a href="<?= base_url(''); ?>">
                        <img src="<?= base_url('assets/img/' .  $config->logo); ?>" alt="<?= $config->login_title; ?>">
                    </a>
                </div>

                <form class="login100-form validate-form" method="post" action="">
                    <span class="login100-form-title text-white">
                        <?= $config->login_title; ?>
                    </span>

                    <?= cekSessionCSRF(); ?>

                    <input type="hidden" name="<?= csrfName(); ?>" value="<?= $this->session->csrf_token; ?>">

                    <div class="wrap-input100">
                        <input class="input100" type="text" name="username" placeholder="Username" autocomplete="off">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    <span style="font-size: 13px; font-weight: bold;"><?= form_error('username'); ?></span>

                    <div class="wrap-input100">
                        <input id="password-field" class="input100 <?= form_error('password') ? 'is-invalid' : null; ?>" type="password" name="password" placeholder="Password" autocomplete="off">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    <span style="font-size: 13px; font-weight: bold;"><?= form_error('password'); ?></span>

                    <div class="text-right">
                        <span class="toggle-password text-white font-italic" toggle="#password-field" style="cursor: pointer; font-size: 12px; ">Show Password</span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn js-tilt" type="submit" data-tilt>
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/vendor/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/dist/js/adminlte.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/tilt/tilt.jquery.min.js'); ?>"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/vendor/sweet-alert-2/sweetalert2.all.min.js'); ?>"></script>
    <script>
        const flashError = $('.flash-error').data('flashdata');
        if (flashError) {
            Swal({
                title: 'Error',
                text: flashError,
                type: 'error'
            });
        }

        const flashData = $('.flash-data').data('flashdata');
        if (flashData) {
            Swal({
                title: 'Success',
                text: flashData,
                type: 'success'
            });
        }

        $('.js-tilt').tilt({
            scale: 1.1
        })

        $(".toggle-password").click(function() {
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
                $('.toggle-password').html('Hide Password');
            } else {
                input.attr("type", "password");
                $('.toggle-password').html('Show Password');
            }
        });
    </script>

</body>

</html>