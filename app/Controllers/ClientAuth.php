<?php

namespace App\Controllers;

// import model untuk mengelola data admin outlet
use App\Models\AOAuthModel;

// class bagi Client sebelum login dan sampai proses login
class ClientAuth extends BaseController {

    public function index() {
        echo 'Hello';
    }
    
    // form login
    public function formlogin_client() {
        // initialize the session
        $data['session'] = \Config\Services::session();
        
        // load the form helper
        helper('form');
        
        return view('client/login_c', $data);
    }    
    // proses login
    public function login_client() {
        // initialize the session
        $session = \Config\Services::session();

        // terima data dari form input
        $inputUsername = $this->request->getPost('username_ao');

        // default password db = null karena belum dilakukan query database
        $password_db = null;

        // QUERY MELALUI MODEL
        $model = new AOAuthModel();
        $select_ao = $model->authAO($inputUsername);
        //var_dump(count($select_ao)); exit();
        
        // jika admin outlet ditemukan
        if(count($select_ao) != 0){
            $id_outlet = $select_ao[0]->id_outlet;
            $nama_outlet = $select_ao[0]->nama_outlet;
            $alamat_outlet = $select_ao[0]->alamat_outlet;
            $kota = $select_ao[0]->kota;
            $foto_outlet = $select_ao[0]->foto_outlet;
            
            $newdata = [
                'username' => $inputUsername,
                'role' => 'Client',
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
            return redirect()->to(base_url('public/home_c'));
        }
        // jika tidak ditemukan
        else {
            $session->setFlashdata('loginGagal', 'Outlet tidak ditemukan');
            // Go to specific URI
            return redirect()->to(base_url('public/formlogin_c'));
        }
    }

}
