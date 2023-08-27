<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;

class SuperadmModel extends Model {

//protected $DBGroup = 'default';

    protected $table = 'admin_outlet';
    protected $primaryKey = 'id_outlet';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    //protected $useSoftDeletes = true;
    protected $allowedFields = ['username', 'password', 'nama_outlet', 'alamat_outlet', 'kota', 'foto_outlet', 'timestamp'];
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
    
    // get admin outlet by ID
    public function getAdminOutletById($id_outlet) {
        // tampilkan menggunakan query builder
        $builder = $this->builder();

        $builder->where('id_outlet', $id_outlet);
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
    
    // reset password admin outlet
    public function resetPassword($id_outlet, $newPasswordHash) {
        $builder = $this->builder();
        $builder->set('password', $newPasswordHash);
        $builder->where('id_outlet', $id_outlet);
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
