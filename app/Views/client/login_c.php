<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <!-- META SECTION -->
        <title>Display Content</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="<?= base_url() ?>/css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>

        <div class="login-container lightmode">

            <div class="login-box animated fadeInDown">
                <!--<div class="login-logo"></div>-->
                <h1 style="color: white; text-align: center">Display Content</h1>
                <div class="login-body">
                    <div class="login-title"><strong>Masukkan username outlet</strong></div>
                    <?php
                    // tampilkan flash data jika login gagal
                    if (isset($_SESSION['loginGagal'])) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <?= $session->getFlashdata('loginGagal') ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?= form_open(base_url('public/login_c'), 'class="form-horizontal"') ?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="username_ao" placeholder="Username" required=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info btn-block">Masuk</button>
                    </div>
                    <?= form_close() ?>
                </div>
                <div class="login-footer">
                    <div class="pull-right" style="font-size: smaller">
                        &copy; 2023 Made with <span class="fa fa-coffee"></span> by <a href="mailto:bossdony@gmail.com">donnymk</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/bootstrap/bootstrap.min.js"></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->

        <!-- END THIS PAGE PLUGINS-->

        <!-- START TEMPLATE -->

        <!-- END TEMPLATE -->

        <!-- END SCRIPTS -->
    </body>
</html>






