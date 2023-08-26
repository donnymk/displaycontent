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
        $model = new SuperadmModel();
        $data['list_outlet'] = $model->getAdminOutlet()->getResult();
        $data['jumlah_outlet'] = count($data['list_outlet']);
        $data['session'] = $session;
        
        return view('superadmin/list_outlet', $data);
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
        $fotoOutlet = $this->request->getFile('fotoOutlet');
        
        // aturan file upload (salah satunya tidak wajib diupload)
        $validationRule = [
            'fotoOutlet' => [
                'label' => 'Image File',
                'rules' => [
                    //'uploaded[fotoOutlet]',
                    'is_image[fotoOutlet]',
                    'mime_in[fotoOutlet,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[fotoOutlet,2000]',
                    'max_dims[fotoOutlet,8000,6000]',
                ],
            ]
        ];

        // jika yang diupload tidak sesuai rule
        if (!$this->validate($validationRule)) {
            $errors = $this->validator->getErrors();
            return var_dump($errors);
        }
        
        // JIKA FILE TIDAK DIUPLOAD = ERROR CODE 4
        //
        // jika foto tidak diupload
        if ($fotoOutlet->getError() == 4) {
            $nama_foto = '';
        }
        // jika foto1 berhasil diupload dan masih ada di temporary folder
        elseif (!$fotoOutlet->hasMoved()) {
            $nama_foto = $fotoOutlet->getRandomName();

            $fotoOutlet->move('uploads/', $nama_foto);
            //$filepath1 = WRITEPATH . 'uploads/' . $fotoOutlet->store();
            //$data = ['uploaded_fileinfo' => new File($filepath1)];
        }

        $data = [
            'username' => $usernameOutlet,
            'password' => $passwordOutlet,
            'nama_outlet' => $namaOutlet,
            'alamat_outlet' => $alamatOutlet,
            'kota' => $kotaOutlet,
            'foto_outlet' => $nama_foto
        ];

        // QUERY MELALUI MODEL
        $model = new SuperadmModel();
        $insert = $model->insertOutlet($data);
        //var_dump($data); exit();
        if ($insert) {
            // set flash data
            $session->setFlashdata('inputOutletStatus', 'Outlet berhasil ditambahkan.');
            // Go to specific URI
            return redirect()->to(base_url('public'));
        }

        $errors = 'The file has already been moved.';
        return var_dump($errors);
    }
    
    // delete data outlet by ID
    public function delete_outlet($no) {
        // initialize the session
        $session = \Config\Services::session();
        
        // QUERY MELALUI MODEL
        $model = new SuperadmModel();
        $del = $model->delOutlet($no);

        if ($del) {
            // set flash data
            $session->setFlashdata('delOutletStatus', 'Outlet berhasil dihapus.');
            // Go to specific URI
            return redirect()->to(base_url('public'));
        }
    }
    
    // form login sebagai superadmin
    public function formlogin_superadmin() {
        // initialize the session
        $data['session'] = \Config\Services::session();
        return view('superadmin/login_sa', $data);
    }
    
    // keluar dari superadmin
    public function logout_superadmin() {
        // initialize the session
        $session = \Config\Services::session();
        //$session->destroy();
        //$array_items = ['username', 'role', 'logged_in'];
        //$session->remove($array_items);

        // Go to specific URI
        return redirect()->to(base_url('public/formlogin_sa'));
    }
}
