<?php

namespace App\Controllers;

//use App\Models\AOModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class untuk Client yang menjalankan konten dari suatu outlet
 */
class Client extends BaseController {
    
    // auto cek login
    public function initController(
            RequestInterface $request,
            ResponseInterface $response,
            LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // cek login Client
        $cekLogin = new CekLogin();
        $cekLogin->cek_login('Client');
    }
    
    // tampilkan konten dari suatu outlet
    public function index() {
        // initialize the session
        $session = \Config\Services::session();

        // default value
        //$data['username'] = null;
        $data['session'] = $session;

        //return view('adminoutlet/kelolakonten_ao', $data);
        return view('client/playkonten_c', $data);
    }
    
    // keluar dari client
    public function logout_c() {
        // initialize the session
        $session = \Config\Services::session();
        //$session->destroy();
        $array_items = ['username', 'role', 'nama_outlet', 'logged_in', 'id_outlet', 'alamat_outlet', 'kota', 'foto_outlet'];
        $session->remove($array_items);
        // Go to specific URI
        return redirect()->to(base_url('public/formlogin_c'));
    }
    
}
