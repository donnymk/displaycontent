<?php

namespace App\Controllers;

use App\Models\AOModel;
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
    
    // get data video outlet yang aktif melalui API
    public function get_videos_api($id_outlet) {

        $data_content = [];
        $base_url = base_url();

        // QUERY MELALUI MODEL
        $AOmodel = new AOModel();
        $get_data_content = $AOmodel->getContentByOutlet($id_outlet, 'active_videos')->getResult();

        foreach ($get_data_content as $key => $value):
            
            array_push($data_content,
                    array("orientasi_layar" => $value->screen_orientation,
                        "nama_konten" => $value->nama_content,
                        "konten" => $base_url."/public/uploads/contents/".$value->konten,
                        "timestamp" => $value->timestamp)
            );
        endforeach;

        return $this->response->setJSON($data_content);
    }
    
    // get data image outlet yang aktif melalui API
    public function get_images_api($id_outlet) {

        $data_content = [];
        $base_url = base_url();

        // QUERY MELALUI MODEL
        $AOmodel = new AOModel();
        $get_data_content = $AOmodel->getContentByOutlet($id_outlet, 'active_images')->getResult();

        foreach ($get_data_content as $key => $value):
            
            array_push($data_content,
                    array("orientasi_layar" => $value->screen_orientation,
                        "nama_konten" => $value->nama_content,
                        "konten" => $base_url."/public/uploads/contents/".$value->konten,
                        "timestamp" => $value->timestamp)
            );
        endforeach;

        return $this->response->setJSON($data_content);
    }
    
}
