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
    protected $allowedFields = ['jenis_content', 'screen_orientation', 'nama_content', 'data', 'aktif', 'timestamp'];
//protected $useTimestamps = true;
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    

    // get all admin outlet
    public function getAdminOutlet() {
        // tampilkan menggunakan query builder
        $builder = $this->builder();

        //return $builder->getCompiledSelect();
        $query = $builder->get();
        return $query;
    }
    
    // count content by ID
    public function countContentById($id_outlet) {
        // tampilkan menggunakan query builder
        $builder = $this->builder();
        $builder->select('COUNT(*) countAll, (SELECT COUNT(*) FROM content WHERE aktif = 1) countActive, (SELECT COUNT(*) FROM content WHERE jenis_content = \'gambar\') countImage, (SELECT COUNT(*) FROM content WHERE jenis_content = \'video\') countVideo');
        $builder->where('id_outlet', $id_outlet);
        //return $builder->getCompiledSelect();
        $query = $builder->get();
        return $query;
    }

    // insert data outlet
    public function insertOutlet($data) {
        // tentukan tabel
        $builder = $this->builder();
        // insert data
        return $builder->insert($data);
    }
    
    // delete data by ID
    public function delOutlet($no) {
        // tentukan tabel
        $builder = $this->builder();
        $builder->where('id_outlet', $no);
        return $builder->delete();
    }

    // kosongkan data upload
//    public function empty_data_up() {
//        // tentukan tabel
//        $builder = $this->builder();
//        return $builder->truncate();
//    }
}
