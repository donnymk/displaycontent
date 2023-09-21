<?php

namespace App\Controllers;

use App\Models\AOModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
//use CodeIgniter\Database\RawSql;
use Psr\Log\LoggerInterface;

// Class bagi Admin Outlet setelah login
class AO extends BaseController {

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
            echo '<script>window.location="' . base_url('public/formlogin_ao') . '"</script>';
            exit();
        }
    }

    public function index() {
        // initialize the session
        $session = \Config\Services::session();

        // load the form helper
        //helper('form');

        // default value
        //$data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $id_outlet = $session->id_outlet;
            $data['session'] = $session;
        }
        //var_dump($session); exit();
        // QUERY MELALUI MODEL
        $model = new AOModel();
        $data['count_content'] = $model->countContentById($id_outlet)->getResult();
        $data['session'] = $session;

        return view('adminoutlet/home_ao', $data);
    }
    
    // halaman kelola konten oleh admin outlet
    public function konten_ao() {
        // initialize the session
        $session = \Config\Services::session();

        // load the form helper
        helper('form');

        // default value
        //$data['username'] = null;
        // cek session login
        if ($session->has('username')) {
            $id_outlet = $session->id_outlet;
            $data['session'] = $session;
        }
        //var_dump($session); exit();
        // QUERY MELALUI MODEL
        $model = new AOModel();
        $data['content'] = $model->getContentByOutlet($id_outlet)->getResult();
        $data['session'] = $session;
		
        return view('adminoutlet/kelolakonten_ao', $data);
    }

    // insert konten
    public function insert_konten() {
        // initialize the session
        $session = \Config\Services::session();

        // terima data dari form input
        $jenisKonten = $this->request->getPost('jenisKonten');
        $screenOrientation = $this->request->getPost('screenOrientation');
        $namaKonten = $this->request->getPost('namaKonten');
        $konten = $this->request->getFile('konten');
        //var_dump($jenisKonten);        exit();

        // aturan file upload (salah satunya wajib diupload)
        if($jenisKonten == 'gambar'){
            $validationRule = [
                'konten' => [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[konten]',
                        'is_image[konten]',
                        'mime_in[konten,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        'max_size[konten,4000]',
                        'max_dims[konten,8000,6000]',
                    ],
                ]
            ];            
        }
        elseif($jenisKonten == 'video'){
            $validationRule = [
                'konten' => [
                    'label' => 'Video File',
                    'rules' => [
                        'uploaded[konten]',
                        'max_size[konten,32000]'
                    ],
                ]
            ];    
        }

        // jika yang diupload tidak sesuai rule
        if (!$this->validate($validationRule)) {
            $errors = $this->validator->getErrors();
            return var_dump($errors);
        }
        // jika konten berhasil diupload dan masih ada di temporary folder
        if (!$konten->hasMoved()) {
            $content_name = $konten->getRandomName();
            $konten->move('uploads/contents/', $content_name);
        }

        $data_konten = [
            'jenis_content' => $jenisKonten,
            'screen_orientation' => $screenOrientation,
            'nama_content' => $namaKonten,
            'data' => $content_name,
            'id_outlet' => $session->id_outlet,
            'aktif' => 1
        ];

        // QUERY MELALUI MODEL
        $model = new AOModel();
        $insert = $model->insertContent($data_konten);
        //var_dump($data_konten); exit();
        if ($insert) {
            // set flash data
            $session->setFlashdata('inputKontenStatus', 'Konten berhasil ditambahkan.');
            // Go to specific URI
            return redirect()->to(base_url('public/konten_ao'));
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
    
    // delete data konten by ID
    public function delkonten($id_konten) {
        // initialize the session
        $session = \Config\Services::session();

        // QUERY MELALUI MODEL
        $model = new AOModel();
        //get data admin outlet
        $data_konten = $model->getContentByID($id_konten)->getResult();
        $konten = $data_konten[0]->data;
        
        // cek file, jika ada hapus
        if (file_exists('uploads/contents/' . $konten) && is_file('uploads/contents/' . $konten)) {
            unlink('uploads/contents/' . $konten);
        }
        // hapus file dari database
        $del = $model->delKonten($id_konten);

        if ($del) {
            // set flash data
            $session->setFlashdata('delKontenStatus', 'Konten berhasil dihapus.');
            // Go to specific URI
            return redirect()->to(base_url('public/konten_ao'));
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
