<?php
foreach ($count_content as $key => $value) {
    $countAll = $value->countAll;
    $countActive = $value->countActive;
    $countImage = $value->countImage;
    $countVideo = $value->countVideo;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title>Admin Outlet</title>
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
        <!-- START PAGE CONTAINER -->
        <div class="page-container">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="<?= base_url('public/') ?>">Display Content</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <?php
                            // jika ada foto
                            if ($session->foto_outlet != '') {
                                ?>
                                <img src="<?= base_url() ?>/public/uploads/<?= $session->foto_outlet ?>" alt="Foto Outlet"/>
                                <?php
                            }
                            // jika tidak pakai foto
                            else {
                                ?>
                                <img src="<?= base_url() ?>/assets/images/users/no-image.jpg" alt="Tidak ada foto"/>
                                <?php
                            }
                            ?>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                            <?php
                            // jika ada foto
                            if ($session->foto_outlet != '') {
                                ?>
                                <img src="<?= base_url() ?>/public/uploads/<?= $session->foto_outlet ?>" alt="Foto Outlet"/>
                                <?php
                            }
                            // jika tidak pakai foto
                            else {
                                ?>
                                <img src="<?= base_url() ?>/assets/images/users/no-image.jpg" alt="Tidak ada foto"/>
                                <?php
                            }
                            ?>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?= $session->nama_outlet ?></div>
                                <div class="profile-data-title">Admin Outlet</div>
                            </div>
                        </div>
                    </li>
                    <li class="xn-title">Navigation</li>
                    <li>
                        <a href="<?= base_url('public/') ?>"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="<?= base_url('public/konten_ao') ?>"><span class="fa fa-cloud-upload"></span> <span class="xn-text">Kelola konten</span></a>
                    </li>
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->

            <!-- PAGE CONTENT -->
            <div class="page-content">

                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->

                    <!-- END SEARCH -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
                    </li>
                    <!-- END SIGN OUT -->
                    <!-- MESSAGES -->

                    <!-- END MESSAGES -->
                    <!-- TASKS -->

                    <!-- END TASKS -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">UI Kits</a></li>
                    <li class="active">Elements</li>
                </ul>
                <!-- END BREADCRUMB -->

                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h2><span class="fa fa-desktop"></span> Dashboard</h2>
                </div>
                <!-- END PAGE TITLE -->

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <div class="row">
                        <!-- PROFIL ADMIN OUTLET -->
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Profil Outlet</h3>
                                </div>
                                <div class="panel-body">
                                    <h6>Nama Outlet</h6>
                                    <p><?= $session->nama_outlet ?></p>
                                    <h6>Alamat</h6>
                                    <p><?= $session->alamat_outlet ?></p>
                                    <h6>Kota</h6>
                                    <p><?= $session->kota ?></p>
                                    <h6>Level</h6>
                                    <p><mark>Admin Outlet</mark></p>
                                    <h6>Username</h6>
                                    <p><mark><?= $session->username ?></mark></p>
                                </div>
                            </div>
                        </div>
                        <!-- END PROFIL ADMIN OUTLET -->

                        <!-- START WIDGET -->
                        <div class="col-md-3">
                            <div class="widget widget-default widget-item-icon" onclick="location.href = 'pages-messages.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-play-circle"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?= $countAll ?></div>
                                    <div class="widget-title">Jumlah konten</div>
                                    <div class="widget-subtitle">Semua</div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="widget widget-default widget-item-icon" onclick="location.href = 'pages-messages.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-picture-o"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?= $countImage ?></div>
                                    <div class="widget-title">Konten gambar</div>
                                    <div class="widget-subtitle"></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="widget widget-default widget-item-icon" onclick="location.href = 'pages-messages.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-video-camera"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?= $countVideo ?></div>
                                    <div class="widget-title">Konten video</div>
                                    <div class="widget-subtitle"></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="widget widget-default widget-item-icon" onclick="location.href = 'pages-messages.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-play-circle-o"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?= $countActive ?></div>
                                    <div class="widget-title">Jumlah konten</div>
                                    <div class="widget-subtitle">Aktif</div>
                                </div>

                            </div>
                        </div>
                        <!-- END WIDGET -->
                    </div>

                </div>
                <!-- END PAGE CONTENT WRAPPER -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Keluar dari Admin Outlet?</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="<?= base_url() ?>/public/logout_ao" class="btn btn-success btn-lg">Ya</a>
                            <button class="btn btn-default btn-lg mb-control-close">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="<?= base_url() ?>/audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="<?= base_url() ?>/audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->

        <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/bootstrap/bootstrap.min.js"></script>
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='<?= base_url() ?>/js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="<?= base_url() ?>/js/settings.js"></script>

        <script type="text/javascript" src="<?= base_url() ?>/js/plugins.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/actions.js"></script>
        <!-- END TEMPLATE -->
        <!-- END SCRIPTS -->

    </body>
</html>
