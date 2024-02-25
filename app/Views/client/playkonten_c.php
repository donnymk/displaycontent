<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title>Client</title>
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

        <!--
        Add some CSS rules to style the image element when it is in full screen mode
        Use the :fullscreen pseudo-class selector to target the element in full screen mode
        Set the width and height to 100% to fill the entire viewport
        Set the object-fit property to contain to preserve the aspect ratio of the image
        Set the object-position property to center to align the image in the center of the viewport
        -->
        <style>
            #my-img:fullscreen {
                width: 100%;
                height: 100%;
                object-fit: contain;
                object-position: center;
            }
            @keyframes marquee {
                0% {
                    transform: translateX(0);
                }
                100% {
                    transform: translateX(-90%);
                }
            }
            .marquee {
                width: 100%;
                overflow: hidden;
                white-space: nowrap;
                background-color: #000000;
                color: #ffffff
            }
            .marquee div {
                display: inline-block;
                animation: marquee 10s linear infinite;
                font-size: 18pt
            }
            /*            #my-running-text {
                            border: 1px solid red;
                            border-radius: 0.5em;
                            padding: 10px;
                        }*/
            #my-running-text:fullscreen {
                width: 100vw;
                height: 100vh;
                object-fit: contain;
                object-position: center;
            }
        </style>
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
                                <!--<div class="profile-data-title">Admin Outlet</div>-->
                            </div>
                        </div>
                    </li>
                    <li class="xn-title">Navigation</li>
                    <li>
                        <a href="<?= base_url('public/') ?>"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
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

                <!-- END BREADCRUMB -->

                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h2><span class="fa fa-cloud-upload"></span> Play Konten</h2>
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
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_playall">
                                        <span class="fa fa-play"></span> Putar video
                                    </button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#modal_slideshow_images">
                                        <span class="fa fa-image"></span> Slideshow gambar
                                    </button>
                                    <br><br>
                                    <div class="table-responsive">
                                        <table class="table" id="datakonten">
                                        </table>
                                    </div>
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

        <!--Modal play single video-->
        <div class="modal" id="modal_play" tabindex="-1" role="dialog" aria-labelledby="defModalHead2" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 id="content-name" class="modal-title" id="defModalHead2">Play Konten</h4>
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
                        <button type="button" class="btn btn-block btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Modal view single image-->
        <div class="modal" id="modal_view_img" tabindex="-1" role="dialog" aria-labelledby="defModalHead3" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 id="img-name" class="modal-title" id="defModalHead3">View Image</h4>
                    </div>
                    <div class="modal-body" style="text-align: center">
                        <img id="my-img">
                        <p></p>
                        <a id="fullscreen-img" href="#" class="btn btn-block btn-danger"><span class="fa fa-arrows-alt"></span> Fullscreen</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-block btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal view running text -->
        <!--        <div class="modal" id="modal_view_text" tabindex="-1" role="dialog" aria-labelledby="defModalHead4" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 id="text-name" class="modal-title" id="defModalHead4">View Running Text</h4>
                            </div>
                            <div class="modal-body" style="text-align: center">
                                <div class="marquee">
                                    <div id="my-running-text"></div>
                                </div>
                                <p></p>
                                <a id="fullscreen-txt" href="#" class="btn btn-danger"><span class="fa fa-arrows-alt"></span> Fullscreen</a>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>-->

        <!--Modal play all active video-->
        <div class="modal" id="modal_playall" tabindex="-1" role="dialog" aria-labelledby="defModalHead5" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead5">Play All Active Video</h4>
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
                        <button type="button" class="btn btn-block btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal slideshow active images -->
        <div class="modal" id="modal_slideshow_images" tabindex="-1" role="dialog" aria-labelledby="defModalHead6" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead6">Slideshow Active Images (10 seconds)</h4>
                    </div>
                    <div class="modal-body">
<!--                        <p>
                            <span class="fa fa-info"></span> Klik gambar untuk masuk ke layar penuh. Klik gambar lagi untuk keluar dari layar penuh.
                        </p>-->
                        <div style="text-align: center; padding-bottom: 8px">
                            <button class="btn btn-block btn-primary" id="btn-slideshow-images" onclick="return play_slideshow()">
                                <span class="fa fa-play"></span> Start slideshow
                            </button>                            
                        </div>
                        <div id="ck_slide">
                            <!--                            <div>
                                                            <img src="uploads/contents/gambar1.jpg">
                                                        </div>
                                                        <div>
                                                            <img src="uploads/contents/gambar2.jpg">
                                                        </div>-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-block btn-default" data-dismiss="modal">Tutup</button>
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
                        <p>Keluar?</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="<?= base_url() ?>/public/logout_c" class="btn btn-success btn-lg">Yes</a>
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

        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/datatables/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="<?= base_url() ?>/js/settings-client.js"></script>

        <script type="text/javascript" src="<?= base_url() ?>/js/plugins.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/actions.js"></script>
        <!-- END TEMPLATE -->

        <!-- START video.js -->
        <script src="<?= base_url() ?>/node_modules/video.js/dist/video.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>/node_modules/videojs-playlist/dist/videojs-playlist.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/vid-settings-client.js"></script>
        <!-- END video.js -->
        <!-- END SCRIPTS -->

    </body>
</html>
