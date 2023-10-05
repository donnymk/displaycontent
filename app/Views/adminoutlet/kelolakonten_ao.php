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

        <!-- video.js -->
        <link href="<?= base_url() ?>/node_modules/video.js/dist/video-js.css" rel="stylesheet" type="text/css"/>
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
                            <?php
                            // cek flash data untuk memberitahu status input konten
                            if (isset($_SESSION['inputKontenStatus'])) {
                                ?>
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <?= $session->getFlashdata('inputKontenStatus') ?>
                                </div>
                                <?php
                            }
                            // cek flash data untuk memberitahu status delete konten
                            if (isset($_SESSION['delKontenStatus'])) {
                                ?>
                                <div class="alert alert-default" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <?= $session->getFlashdata('delKontenStatus') ?>
                                </div>
                                <?php
                            }
                            ?>
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
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_playall">
                                        <span class="fa fa-play"></span> Play all active content
                                    </button>
                                    <br><br>
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Jenis content</th>
                                                <th>Screen orientation</th>
                                                <th>Nama content</th>
                                                <th>Content</th>
                                                <th>Status</th>
                                                <th>Ditambahkan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            // tampilkan data konten
                                            foreach ($content as $key => $value) {
                                                $no++;
                                                ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $value->jenis_content ?></td>
                                                    <td><?= $value->screen_orientation ?></td>
                                                    <td><?= $value->nama_content ?></td>
                                                    <td>
                                                        <a href="" data-toggle="modal" data-target="#modal_play" onclick="return play_video('<?= $value->nama_content ?>','uploads/contents/<?= $value->data ?>')" title="Putar konten">
                                                            <span class="fa fa-2x fa-play"></span>
                                                        </a>
                                                    </td>
                                                    <td><?= $value->aktif ?></td>
                                                    <td><?= $value->timestamp ?></td>
                                                    <td>
                                                        <a href="<?= base_url('public/delkonten_ao/' . $value->id_content) ?>" onclick="return confirm('Yakin hapus konten <?= $value->nama_content ?>?')">
                                                            <span class="fa fa-trash-o"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

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
        <!--Modal tambah konten-->
        <div class="modal" id="modal_basic" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?= form_open_multipart(base_url('public/input_konten'), 'class="form-horizontal"') ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead">Tambah Konten</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Jenis konten</label>
                            <div class="col-md-6 col-xs-12">
                                <select name="jenisKonten" class="form-control select" required="">
                                    <option value="">--- Pilih ---</option>
                                    <option value="gambar">Gambar</option>
                                    <option value="video">Video</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Orientasi layar</label>
                            <div class="col-md-6 col-xs-12">
                                <select name="screenOrientation" class="form-control select" required="">
                                    <option value="">--- Pilih ---</option>
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
                                    <input name="namaKonten" type="text" class="form-control" required=""/>
                                </div>
                                <!--<span class="help-block">Nama konten</span>-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">File konten</label>
                            <div class="col-md-6 col-xs-12">
                                <input type="file" class="fileinput btn-primary" name="konten" id="konten" title="Browse file" required=""/>
                                <!--<span class="help-block">Input type file</span>-->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary pull-right">Tambahkan</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>

        <!--Modal play single konten-->
        <div class="modal" id="modal_play" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 id="content-name" class="modal-title" id="defModalHead">Play Konten</h4>
                    </div>
                    <div class="modal-body" style="text-align: center">                     
                        <video
                            id="my-video"
                            class="video-js"
                            controls
                            loop="loop"
                            preload="auto"
                            width="640"
                            height="360"
                            data-setup="{}"
                            >

                            <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that
                                <a href="https://videojs.com/html5-video-support/" target="_blank"
                                   >supports HTML5 video</a
                                >
                            </p>
                        </video>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Modal play all konten-->
        <div class="modal" id="modal_playall" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead">Play All Active Content</h4>
                    </div>
                    <div class="modal-body" style="text-align: center">
                        <h5>Currently playing: <span id="current-content-name"></span></h5>
                        <video
                            id="all-video"
                            class="video-js"
                            controls
                            preload="auto"
                            width="640"
                            height="360"
                            data-setup="{}"
                            >
                            <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that
                                <a href="https://videojs.com/html5-video-support/" target="_blank"
                                   >supports HTML5 video</a
                                >
                            </p>
                        </video>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
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

        <!-- START video.js -->
        <script src="<?= base_url() ?>/node_modules/video.js/dist/video.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>/node_modules/videojs-playlist/dist/videojs-playlist.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/video-settings.js"></script>
        <!-- END video.js -->
        <!-- END SCRIPTS -->

    </body>
</html>
