<?php

namespace App\Controllers;

/**
 * Cek session apakah user sudah login
 */
class CekLogin {

    public function cek_login($jenisUser) {
        // initialize the session
        $session = \Config\Services::session();

        // halaman redirect sesuai jenis user
        if ($jenisUser == 'AO') {
            $halaman = base_url('public/formlogin_ao');
        } elseif ($jenisUser == 'Client') {
            $halaman = base_url('public/formlogin_c');
        }

        // jika belum login
        if (!$session->has('logged_in')) {
            echo '<script>window.location="' . $halaman . '"</script>';
            exit();
        }
        // cek login sesuai jenis user dan session role
        elseif ($jenisUser == 'AO' && $session->role != 'Admin Outlet') {
            echo '<script>window.location="' . $halaman . '"</script>';
            exit();
        }
        elseif ($jenisUser == 'Client' && $session->role != 'Client') {
            echo '<script>window.location="' . $halaman . '"</script>';
            exit();
        }
    }
}
