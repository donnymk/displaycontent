<?php

namespace App\Models;

use CodeIgniter\Model;

class AOAuthModel extends Model {

//protected $DBGroup = 'default';

    protected $table = 'admin_outlet';
    protected $primaryKey = 'id_outlet';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    //protected $useSoftDeletes = true;
    protected $allowedFields = ['username', 'password', 'nama_outlet', 'alamat_outlet', 'kota', 'foto_outlet'];
//protected $useTimestamps = true;
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    // cek username admin outlet
    public function authAO($username) {
        $builder = $this->builder();
        $builder->where('username', $username);
        $query = $builder->get();
        return $query->getResult();
    }

    // update password
    public function updatePassword($username, $newPassword) {
        $options = [
            'cost' => 10,
        ];
        $password_hash = password_hash($newPassword, PASSWORD_DEFAULT, $options);

        $builder = $this->builder();
        $builder->set('password', $password_hash);
        $builder->where('username', $username);
        $query = $builder->update();
        return $query;
    }

}
