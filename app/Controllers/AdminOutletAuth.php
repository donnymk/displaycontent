<?php

namespace App\Controllers;

use App\Models\SuperadmAuthModel;

class AdminOutletAuth extends BaseController {

    public function index() {
        // initialize the session
        $session = \Config\Services::session();

        // load the form helper
        helper('form');

        // default value
        //$data['username'] = null;
        // cek session login
//        if ($session->has('username')) {
//            $data['username'] = $session->username;
//            $data['role'] = $session->role;
//            $data['session'] = $session;
//        }
        //var_dump($session); exit();
        // QUERY MELALUI MODEL
        $model = new SuperadmAuthModel();
        $data['list_outlet'] = $model->getAdminOutlet()->getResult();
        $data['jumlah_outlet'] = count($data['list_outlet']);
        $data['session'] = $session;

        return view('superadmin/list_outlet', $data);
    }
    
    // form login sebagai admin outlet
    public function formlogin_adminoutlet() {
        // initialize the session
        $data['session'] = \Config\Services::session();
        
        // load the form helper
        helper('form');
        
        return view('adminoutlet/login_ao', $data);
    }    
    // proses login superadmin
    public function login_superadmin() {
        // initialize the session
        $session = \Config\Services::session();

        // terima data dari form input
        $inputUsername = $this->request->getPost('username');
        $inputPassword = $this->request->getPost('password');

        // default password db = null karena belum dilakukan query database
        $password_db = null;

        // QUERY MELALUI MODEL
        $model = new SuperadmAuthModel();
        $select_sa = $model->authSuperadmin($inputUsername);

        // jika data ditemukan
        foreach ($select_sa as $value):
            $password_db = $value->password;
            $nama_superadmin = $value->nama_superadmin;
        endforeach;
        //var_dump(password_verify($inputPassword, $password_db));
        //exit();
        
        // jika password benar
        if (password_verify($inputPassword, $password_db)) {
            $newdata = [
                'username' => $inputUsername,
                'role' => 'Superadmin',
                'nama_superadmin' => $nama_superadmin,
                'logged_in' => true
            ];
            $session->set($newdata);

            session_write_close();

            // Go to specific URI
            return redirect()->to(base_url('public/'));
        }
        // jika password salah
        else {
            $session->setFlashdata('loginGagal', 'Username atau Password salah');
            // Go to specific URI
            return redirect()->to(base_url('public/formlogin_sa'));
        }
    }

}
