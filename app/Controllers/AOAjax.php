<?php

namespace App\Controllers;

use App\Models\AOModel;

// class bagi Admin Outlet untuk fungsi Ajax 
class AOAjax extends BaseController {

    public function index() {
        echo 'hai';
    }

    // get data content outlet
    public function get_content() {
        // initialize the session
        $session = \Config\Services::session();

        $id_outlet = $session->id_outlet;

        //$data_content = [];

        // Check for AJAX request
        if ($this->request->isAJAX()) {
            // QUERY MELALUI MODEL
            $AOmodel = new AOModel();
            $get_data_content = $AOmodel->getContentByOutlet($id_outlet, 'all')->getResult();

//            foreach ($get_data_content as $key => $value):
//                // button update dan delete
//                $update_button = '<a class="btn btn-primary btn-sm" href="update/' . $value->id_content . '">Update...</a>';
//                $delete_button = '<a class="btn btn-secondary btn-sm" href="delete/' . $value->id_content . '" onclick="return confirm_del(' . $value->id_content . ')"><span class="fa fa-trash"></span></a>';
//
//                array_push($data_content,
//                        array($value->id_content,
//                            $value->jenis_content,
//                            $value->screen_orientation,
//                            $value->nama_content,
//                            $value->konten,
//                            $value->aktif,
//                            $value->timestamp,
//                            $update_button.$delete_button)
//                );
//            endforeach;

            $json_data = array(
                //"data" => $data_content
                "data" => $get_data_content
            );
            echo json_encode($json_data);
        }
        return false;
    }

    // get data content outlet yang aktif
    public function get_content_active() {
        // initialize the session
        $session = \Config\Services::session();

        $id_outlet = $session->id_outlet;


        // Check for AJAX request
        if ($this->request->isAJAX()) {
            // QUERY MELALUI MODEL
            $AOmodel = new AOModel();
            $get_data_content = $AOmodel->getContentByOutlet($id_outlet, 'active')->getResult();

            $json_data = array(
                //"data" => $data_content
                "data" => $get_data_content
            );
            echo json_encode($json_data);
        }
        return false;
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
    
    // get data text outlet yang aktif melalui API
    public function get_text_api($id_outlet) {

        $data_content = [];
        $base_url = base_url();

        // QUERY MELALUI MODEL
        $AOmodel = new AOModel();
        $get_data_content = $AOmodel->getContentByOutlet($id_outlet, 'active_text')->getResult();

        foreach ($get_data_content as $value):
            
            array_push($data_content,
                    array("orientasi_layar" => $value->screen_orientation,
                        "nama_konten" => $value->nama_content,
                        "konten" => $value->konten,
                        "timestamp" => $value->timestamp)
            );
        endforeach;

        return $this->response->setJSON($data_content);
    }
}
