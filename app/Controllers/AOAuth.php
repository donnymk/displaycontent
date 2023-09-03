<?php

namespace App\Controllers;

use App\Models\AOAuthModel;

// class bagi Admin Outlet sebelum login dan sampai proses login
class AOAuth extends BaseController {

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
    // proses login admin outlet
    public function login_adminoutlet() {
        // initialize the session
        $session = \Config\Services::session();

        // terima data dari form input
        $inputUsername = $this->request->getPost('username_ao');
        $inputPassword = $this->request->getPost('password_ao');

        // default password db = null karena belum dilakukan query database
        $password_db = null;

        // QUERY MELALUI MODEL
        $model = new AOAuthModel();
        $select_ao = $model->authAO($inputUsername);

        // jika data ditemukan
        foreach ($select_ao as $value):
            $password_db = $value->password;
            $id_outlet = $value->id_outlet;
            $nama_outlet = $value->nama_outlet;
            $alamat_outlet = $value->alamat_outlet;
            $kota = $value->kota;
            $foto_outlet = $value->foto_outlet;
        endforeach;
        //var_dump(password_verify($inputPassword, $password_db));
        //exit();
        
        // jika password benar
        if (password_verify($inputPassword, $password_db)) {
            $newdata = [
                'username' => $inputUsername,
                'role' => 'Admin Outlet',
                'nama_outlet' => $nama_outlet,
                'logged_in' => true,
                'id_outlet' => $id_outlet, 
                'alamat_outlet' => $alamat_outlet,
                'kota' => $kota,
                'foto_outlet' => $foto_outlet
            ];
            $session->set($newdata);

            session_write_close();

            // Go to specific URI
            return redirect()->to(base_url('public/home_ao'));
        }
        // jika password salah
        else {
            $session->setFlashdata('loginGagal', 'Username atau Password salah');
            // Go to specific URI
            return redirect()->to(base_url('public/formlogin_ao'));
        }
    }

}
