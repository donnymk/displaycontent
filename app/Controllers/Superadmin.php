<?php

namespace App\Controllers;

use App\Models\SuperadmModel;
use App\Models\AuthModel;

class Superadmin extends BaseController {
    
    // auto cek login
//    public function initController(
//            RequestInterface $request,
//            ResponseInterface $response,
//            LoggerInterface $logger
//    ) {
//        parent::initController($request, $response, $logger);
//
//        // cek login
//        $this->cek_login();
//    }

    public function index() {
        // initialize the session
        //$session = \Config\Services::session();
        
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
        $model = new SuperadmModel();
        $data['list_outlet'] = $model->getAdminOutlet()->getResult();
        $data['jumlah_outlet'] = count($data['list_outlet']);
        
        return view('list_outlet', $data);
    }
    
    public function insert_outlet() {
        // initialize the session
        $session = \Config\Services::session();

        // terima data dari form input
        $namaOutlet = $this->request->getPost('namaOutlet');
        $alamatOutlet = $this->request->getPost('alamatOutlet');
        $kotaOutlet = $this->request->getPost('kotaOutlet');
        $usernameOutlet = $this->request->getPost('usernameOutlet');
        $passwordOutlet = $this->request->getPost('passwordOutlet');

        $data = [
            'username' => $usernameOutlet,
            'password' => $passwordOutlet,
            'nama_outlet' => $namaOutlet,
            'alamat_outlet' => $alamatOutlet,
            'kota' => $kotaOutlet 
        ];

        // QUERY MELALUI MODEL
        $model = new SuperadmModel();
        $insert = $model->insertOutlet($data);
        //var_dump($data); exit();
        if ($insert) {
            // set flash data
            $session->setFlashdata('inputCWPStatus', 'Claim Warranty Proposal berhasil ditambahkan');
            // Go to specific URI
            return redirect()->to(base_url('claim-warranty/resume'));
        }

        $errors = 'The file has already been moved.';
        return var_dump($errors);
    }
}
