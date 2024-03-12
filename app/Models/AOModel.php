<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

// class untuk query data konten yang dimuat dan diatur (aktif / tidak aktif)
// oleh Admin Outlet
class AOModel extends Model {

//protected $DBGroup = 'default';

    protected $table = 'content';
    protected $primaryKey = 'id_content';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    //protected $useSoftDeletes = true;
    protected $allowedFields = ['id_content', 'jenis_content', 'screen_orientation', 'nama_content', 'data', 'id_outlet', 'aktif', 'timestamp'];
//protected $useTimestamps = true;
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    // get content by ID outlet
    public function getContentByOutlet($id_outlet, $filter_content) {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        
        $builder->select('id_content, jenis_content, screen_orientation, nama_content, data AS konten, aktif, DATE_FORMAT(timestamp, \'%d %b %Y %H:%i:%s\') timestamp');
        // jika request all content
        if($filter_content == 'all'){
            $builder->where('id_outlet', $id_outlet);
        }
        // jika request active content baik videos, images maupun teks
        elseif($filter_content == 'active'){
            $builder->where('id_outlet', $id_outlet);
            $builder->where('aktif', '1');
        }
       // jika request active videos
        elseif($filter_content == 'active_videos'){
            $builder->where('id_outlet', $id_outlet);
            $builder->where('aktif', '1');
            $builder->where('jenis_content', 'video');
        }
        // jika request active images
        elseif($filter_content == 'active_images'){
            $builder->where('id_outlet', $id_outlet);
            $builder->where('aktif', '1');
            $builder->where('jenis_content', 'gambar');
        }
        
        //return $builder->getCompiledSelect();
        $query = $builder->get();
        return $query;
    }

    // get content by ID konten
    public function getContentByID($id_konten) {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        $builder->where('id_content', $id_konten);
        //return $builder->getCompiledSelect();
        $query = $builder->get();
        return $query;
    }

    // count content by ID outlet
    public function countContentById($id_outlet) {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        $builder->select('COUNT(*) countAll, (SELECT COUNT(*) FROM content WHERE aktif = 1) countActive, (SELECT COUNT(*) FROM content WHERE jenis_content = \'gambar\') countImage, (SELECT COUNT(*) FROM content WHERE jenis_content = \'video\') countVideo, (SELECT COUNT(*) FROM content WHERE jenis_content = \'teks\') countTeks');
        $builder->where('id_outlet', $id_outlet);
        //return $builder->getCompiledSelect();
        $query = $builder->get();
        return $query;
    }

    // insert data konten
    public function insertContent($data) {
        // tentukan tabel
        $builder = $this->builder();
        // insert data
        return $builder->insert($data);
        //return $builder->getCompiledInsert();
    }

    // delete konten by ID
    public function delKonten($id_konten) {
        // tentukan tabel
        $builder = $this->builder();
        $builder->where('id_content', $id_konten);
        return $builder->delete();
    }

    // aktifkan konten
    public function setContentActive($id_konten) {
        // update menggunakan query builder
        $builder = $this->builder();
        $builder->set('aktif', 1);
        $builder->where('id_content', $id_konten);
        //return $builder->getCompiledSelect();
        $query = $builder->update();
        return $query;
    }
    
    // nonaktifkan konten
    public function setContentInactive($id_konten) {
        // update menggunakan query builder
        $builder = $this->builder();
        $builder->set('aktif', 0);
        $builder->where('id_content', $id_konten);
        //return $builder->getCompiledSelect();
        $query = $builder->update();
        return $query;
    }

    // kosongkan data upload
//    public function empty_data_up() {
//        // tentukan tabel
//        $builder = $this->builder();
//        return $builder->truncate();
//    }
}
