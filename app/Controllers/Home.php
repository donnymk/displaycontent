<?php

namespace App\Controllers;

use App\Models\SuperadmModel;
use App\Models\AuthModel;

class Home extends BaseController {
    
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
}
