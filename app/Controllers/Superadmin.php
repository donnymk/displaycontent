<?php

namespace App\Controllers;

use App\Models\SuperadmModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
//use CodeIgniter\Database\RawSql;
use Psr\Log\LoggerInterface;

class Superadmin extends BaseController {

    // auto cek login
    public function initController(
            RequestInterface $request,
            ResponseInterface $response,
            LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // cek login
        $this->cek_login();
    }
    
    public function cek_login() {
        // initialize the session
        $session = \Config\Services::session();

        // jika belum login
        if (!$session->has('logged_in')) {
            echo '<script>window.location="' . base_url('public/formlogin_sa') . '"</script>';
            exit();
        }
    }

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
        // jika foto outlet berhasil diupload dan masih ada di temporary folder
        elseif (!$fotoOutlet->hasMoved()) {
            $nama_foto = $fotoOutlet->getRandomName();
            $fotoOutlet->move('uploads/', $nama_foto);
        }

        // enkripsi password
        $options = [
            'cost' => 10,
        ];
        $password_hash = password_hash($passwordOutlet, PASSWORD_DEFAULT, $options);

        $data_outlet = [
            'username' => $usernameOutlet,
            'password' => $password_hash,
            'nama_outlet' => $namaOutlet,
            'alamat_outlet' => $alamatOutlet,
            'kota' => $kotaOutlet,
            'foto_outlet' => $nama_foto
        ];

        // QUERY MELALUI MODEL
        $model = new SuperadmModel();
        $insert = $model->insertOutlet($data_outlet);
        //var_dump($data_outlet); exit();
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
    public function delete_outlet($id_outlet) {
        // initialize the session
        $session = \Config\Services::session();

        // QUERY MELALUI MODEL
        $model = new SuperadmModel();
        //get data admin outlet
        $data_outlet = $model->getAdminOutletById($id_outlet)->getResult();
        $foto_outlet = $data_outlet[0]->foto_outlet;
        
        // cek file foto, jika ada hapus
        if (file_exists('uploads/' . $foto_outlet) && is_file('uploads/' . $foto_outlet)) {
            unlink('uploads/' . $foto_outlet);
        }
        // hapus outlet dari database
        $del = $model->delOutlet($id_outlet);

        if ($del) {
            // set flash data
            $session->setFlashdata('delOutletStatus', 'Outlet berhasil dihapus.');
            // Go to specific URI
            return redirect()->to(base_url('public'));
        }
    }

    // reset password password
    public function resetpassw_outlet($id_outlet) {
        // initialize the session
        $session = \Config\Services::session();

        // QUERY MELALUI MODEL
        $model = new SuperadmModel();

        //get data admin outlet
        $data_outlet = $model->getAdminOutletById($id_outlet)->getResult();
        $nama_outlet = $data_outlet[0]->nama_outlet;

        // reset password admin outlet
        $default_password = '12345678';
        $options = [
            'cost' => 10,
        ];
        $password_hash = password_hash($default_password, PASSWORD_DEFAULT, $options);
        $model->resetPassword($id_outlet, $password_hash);
        //var_dump($password_hash); exit();
        
        $session->setFlashdata('resetPasswOutletStatus', 'Reset password untuk outlet ' . $nama_outlet . ' berhasil. Password sekarang adalah ' . $default_password . '.');

        // go to previous page
        return redirect()->to(base_url('public'));
    }

    // keluar dari superadmin
    public function logout_superadmin() {
        // initialize the session
        $session = \Config\Services::session();
        //$session->destroy();
        $array_items = ['username', 'role', 'nama_superadmin', 'logged_in'];
        $session->remove($array_items);
        // Go to specific URI
        return redirect()->to(base_url('public/formlogin_sa'));
    }
}
