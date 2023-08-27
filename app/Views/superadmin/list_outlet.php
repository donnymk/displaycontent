<!DOCTYPE html>
<html lang="en">
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
        <!-- START PAGE CONTAINER -->
        <div class="page-container">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="index.html">Display Content</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="<?= base_url() ?>/assets/images/users/no-image.jpg" alt="John Doe"/>
                        </a>
                        <div class="profile">
                            <div class="profile-data">
                                <div class="profile-data-name">Ryzal Pahlevy</div>
                                <div class="profile-data-title">Superadmin</div>
                            </div>
                            <!--                            <div class="profile-controls">
                                                            <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                                                            <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                                                        </div>-->
                        </div>
                    </li>
                    <li class="xn-title">Outlet</li>
                    <li>
                        <a href="index.html"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
                    </li>
                    <li class="active">
                        <a href="pages-address-book.html"><span class="fa fa-map-marker"></span> Daftar Outlet</a>
                    </li>
                    <li class="xn-title">Client & content</li>
                    <li>
                        <a href="maps.html"><span class="fa fa-users"></span> <span class="xn-text">Daftar client & content</span></a>
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

                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
                    </li>
                    <!-- END SIGN OUT -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Daftar outlet</li>
                </ul>
                <!-- END BREADCRUMB -->

                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h2><span class="fa fa-users"></span> Daftar Outlet <small><?= $jumlah_outlet ?> outlet</small></h2>
                </div>
                <!-- END PAGE TITLE -->

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            // cek flash data untuk memberitahu status input outlet
                            if (isset($_SESSION['inputOutletStatus'])) {
                                ?>
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <?= $session->getFlashdata('inputOutletStatus') ?>
                                </div>
                                <?php
                            }
                            // cek flash data untuk memberitahu status reset password outlet
                            if (isset($_SESSION['resetPasswOutletStatus'])) {
                                ?>
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <?= $session->getFlashdata('resetPasswOutletStatus') ?>
                                </div>
                                <?php
                            }
                            // cek flash data untuk memberitahu status delete outlet
                            if (isset($_SESSION['delOutletStatus'])) {
                                ?>
                                <div class="alert alert-default" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <?= $session->getFlashdata('delOutletStatus') ?>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <p>Ketikkan data outlet di form berikut ini untuk menambahkan outlet baru. Data outlet yang sudah ada berada pada item kotak di bawah form ini.</p>
                                    <?= form_open_multipart(base_url('public/input_outlet'), 'class="form-horizontal"') ?>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    Nama outlet *
                                                </div>
                                                <input type="text" name="namaOutlet" class="form-control" required=""/>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    Alamat *
                                                </div>
                                                <input type="text" name="alamatOutlet" class="form-control" required=""/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    Kota *
                                                </div>
                                                <select name="kotaOutlet" class="form-control" required="">
                                                    <option value="">--- Pilih Kota ---</option>
                                                    <option value="Kabupaten Banjarnegara">Kabupaten Banjarnegara</option>
                                                    <option value="Kabupaten Banyumas">Kabupaten Banyumas</option>
                                                    <option value="Kabupaten Batang">Kabupaten Batang</option>
                                                    <option value="Kabupaten Blora">Kabupaten Blora</option>
                                                    <option value="Kabupaten Boyolali">Kabupaten Boyolali</option>
                                                    <option value="Kabupaten Brebes">Kabupaten Brebes</option>
                                                    <option value="Kabupaten Cilacap">Kabupaten Cilacap</option>
                                                    <option value="Kabupaten Demak">Kabupaten Demak</option>
                                                    <option value="Kabupaten Grobogan">Kabupaten Grobogan</option>
                                                    <option value="Kabupaten Jepara">Kabupaten Jepara</option>
                                                    <option value="Kabupaten Karanganyar">Kabupaten Karanganyar</option>
                                                    <option value="Kabupaten Kebumen">Kabupaten Kebumen</option>
                                                    <option value="Kabupaten Kendal">Kabupaten Kendal</option>
                                                    <option value="Kabupaten Klaten">Kabupaten Klaten</option>
                                                    <option value="Kabupaten Kudus">Kabupaten Kudus</option>
                                                    <option value="Kabupaten Magelang">Kabupaten Magelang</option>
                                                    <option value="Kabupaten Pati">Kabupaten Pati</option>
                                                    <option value="Kabupaten Pekalongan">Kabupaten Pekalongan</option>
                                                    <option value="Kabupaten Pemalang">Kabupaten Pemalang</option>
                                                    <option value="Kabupaten Purbalingga">Kabupaten Purbalingga</option>
                                                    <option value="Kabupaten Purworejo">Kabupaten Purworejo</option>
                                                    <option value="Kabupaten Rembang">Kabupaten Rembang</option>
                                                    <option value="Kabupaten Semarang">Kabupaten Semarang</option>
                                                    <option value="Kabupaten Sragen">Kabupaten Sragen</option>
                                                    <option value="Kabupaten Sukoharjo">Kabupaten Sukoharjo</option>
                                                    <option value="Kabupaten Tegal">Kabupaten Tegal</option>
                                                    <option value="Kabupaten Temanggung">Kabupaten Temanggung</option>
                                                    <option value="Kabupaten Wonogiri">Kabupaten Wonogiri</option>
                                                    <option value="Kabupaten Wonosobo">Kabupaten Wonosobo</option>
                                                    <option value="Kota Magelang">Kota Magelang</option>
                                                    <option value="Kota Pekalongan">Kota Pekalongan</option>
                                                    <option value="Kota Salatiga">Kota Salatiga</option>
                                                    <option value="Kota Semarang">Kota Semarang</option>
                                                    <option value="Kota Surakarta">Kota Surakarta</option>
                                                    <option value="Kota Tegal">Kota Tegal</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    Foto outlet
                                                </div>
                                                <input type="file" name="fotoOutlet" class="form-control"/>
                                            </div>                                            
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    Username **
                                                </div>
                                                <input type="text" name="usernameOutlet" class="form-control" required=""/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    Password **
                                                </div>
                                                <input type="text" name="passwordOutlet" class="form-control" required=""/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            * <small>Harus diisi.</small><br>
                                            ** <small>Pastikan username dan password tidak berisi karakter spasi.</small>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-block"><span class="fa fa-floppy-o"></span> Tambahkan outlet</button>
                                    <?= form_close() ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <?php
                        if (count($list_outlet) == 0) {
                            ?>
                            <div class="col-md-12">
                                <p class="text-center">Belum ada data outlet.</p>
                            </div>
                            <?php
                        }
                        foreach ($list_outlet as $key => $value):
                            ?>
                            <div class="col-md-3">
                                <!-- CONTACT ITEM -->
                                <div class="panel panel-default">
                                    <div class="panel-body profile">
                                        <div class="profile-image">
                                            <?php
                                            // jika ada foto outlet
                                            if ($value->foto_outlet != '') {
                                             ?>
                                                <img src="<?= base_url() ?>/public/uploads/<?= $value->foto_outlet ?>" alt="<?= $value->nama_outlet ?>"/>
                                            <?php
                                            }
                                            // jika tidak pakai foto
                                            else {
                                                ?>
                                                <img src="<?= base_url() ?>/assets/images/users/no-image.jpg" alt="<?= $value->nama_outlet ?>"/>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <div class="profile-data">
                                            <div class="profile-data-name"><?= $value->nama_outlet ?></div>
                                            <!--<div class="profile-data-title"></div>-->
                                        </div>
                                        <div class="profile-controls">
                                            <a href="<?= base_url('public/reset_passw_outlet') . '/' . $value->id_outlet ?>" class="profile-control-left" title="Reset password" onclick="return confirm('Reset password outlet <?= $value->nama_outlet ?>? Setelah direset password akan menjadi \'12345678\'')">
                                                <span class="fa fa-refresh"></span>
                                            </a>
                                            <a href="<?= base_url('public/del_outlet') . '/' . $value->id_outlet ?>" class="profile-control-right" title="Hapus outlet" onclick="return confirm('Yakin menghapus outlet <?= $value->nama_outlet ?>?')">
                                                <span class="fa fa-trash-o"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="contact-info">
                                            <p><small>Username</small><br/><?= $value->username ?></p>
                                            <p><small>Alamat</small><br/><?= $value->alamat_outlet ?></p>
                                            <p><small>Kota</small><br/><?= $value->kota ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- END CONTACT ITEM -->
                            </div>
                            <?php
                        endforeach
                        ?>
                    </div>
                    <!--                    <div class="row">
                                            <div class="col-md-12">
                                                <ul class="pagination pagination-sm pull-right push-down-10 push-up-10">
                                                    <li class="disabled"><a href="#">«</a></li>
                                                    <li class="active"><a href="#">1</a></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">4</a></li>
                                                    <li><a href="#">»</a></li>
                                                </ul>
                                            </div>
                                        </div>-->

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
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong></div>
                    <div class="mb-content">
                        <p>Keluar dari Superadmin?</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="<?= base_url() ?>/public/logout_sa" class="btn btn-success btn-lg">Ya</a>
                            <button class="btn btn-default btn-lg mb-control-close">Batal</button>
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

        <!-- START THIS PAGE PLUGINS-->
        <script type='text/javascript' src='<?= base_url() ?>/js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <!-- END THIS PAGE PLUGINS-->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="<?= base_url() ?>/js/settings.js"></script>

        <script type="text/javascript" src="<?= base_url() ?>/js/plugins.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>/js/actions.js"></script>
        <!-- END TEMPLATE -->

        <!-- END SCRIPTS -->
    </body>
</html>
