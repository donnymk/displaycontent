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
                        <a href="<?= base_url('public/home_ao') ?>">Display Content</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="<?= base_url() ?>/public/uploads/<?= $session->foto_outlet ?>" alt="Foto Outlet"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="<?= base_url() ?>/public/uploads/<?= $session->foto_outlet ?>" alt="Foto Outlet"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?= $session->nama_outlet ?></div>
                                <div class="profile-data-title">Admin Outlet</div>
                            </div>
                        </div>
                    </li>
                    <li class="xn-title">Navigation</li>
                    <li>
                        <a href="<?= base_url('public/home_ao') ?>"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
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
                    <h2><span class="fa fa-cloud-upload"></span> Kelola Konten</h2>
                </div>
                <!-- END PAGE TITLE -->

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <div class="row">
                        <div class="col-md-12">

                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Daftar konten</h3>
                                    <!--                                    <ul class="panel-controls">
                                                                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                                                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                                                        </ul>                                -->
                                </div>
                                <div class="panel-body">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modal_basic">
                                        <span class="fa fa-plus"></span> Tambah konten
                                    </button>
                                    <br><br>
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Jenis content</th>
                                                <th>Screen orientation</th>
                                                <th>Nama content</th>
                                                <th>Status</th>
                                                <th>Ditambahkan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE -->
                        </div>
                    </div>

                </div>

                <!-- END PAGE CONTENT WRAPPER -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MODALS -->
        <div class="modal" id="modal_basic" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?= form_open(base_url('public/input_outlet'), 'class="form-horizontal"') ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead">Tambah Konten</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Jenis konten</label>
                            <div class="col-md-6 col-xs-12">
                                <select class="form-control select">
                                    <option value="Video">Video</option>
                                    <option value="Gambar">Gambar</option>
                                </select>
                                <span class="help-block">Jenis konten</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Screen orientation</label>
                            <div class="col-md-6 col-xs-12">
                                <select class="form-control select">
                                    <option value="landscape">Lanscape</option>
                                    <option value="portrait">Portrait</option>
                                </select>
                                <span class="help-block">Orientasi layar sesuai konten dan perangkat</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Nama konten</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control"/>
                                </div>
                                <!--<span class="help-block">Nama konten</span>-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">File konten</label>
                            <div class="col-md-6 col-xs-12">
                                <input type="file" class="fileinput btn-primary" name="filename" id="filename" title="Browse file"/>
                                <!--<span class="help-block">Input type file</span>-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
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

        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>

        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="<?= base_url() ?>/js/settings.js"></script>

        <script type="text/javascript" src="<?= base_url() ?>/js/plugins.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/actions.js"></script>
        <!-- END TEMPLATE -->
        <!-- END SCRIPTS -->

    </body>
</html>