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

    // get difference of the time zone from database server
    public function getTimeDiff() {
        // not using the query builder because on PHP 8 it doesn't work
        //$builder = $this->builder();
        //$query = $builder->get();
        
        $db = db_connect();
        $query = $db->query('SELECT timediff(now(),convert_tz(now(),@@session.time_zone,\'+00:00\')) AS time_diff');
        return $query;
    }

    // get all data upload including including converted timezone from timestamp
//    public function getDataUpload($from_timezone, $to_timezone) {
//        // tampilkan menggunakan query builder
//        $builder = $this->builder();
//
//        // use raw sql
//        $sql = 'nama_file_ori, lokasi, DATE_FORMAT(CONVERT_TZ(timestamp,\'' . $from_timezone . '\',\'' . $to_timezone . '\'), \'%d %b %Y %H:%i:%s\') AS converted_time';
//        $builder->select(new RawSql($sql));
//        $builder->orderBy('timestamp', 'DESC');
//        //return $builder->getCompiledSelect();
//        $query = $builder->get();
//        return $query;
//    }

    // get all data upload
    public function getAdminOutlet() {
        // tampilkan menggunakan query builder
        $builder = $this->builder();

        //return $builder->getCompiledSelect();
        $query = $builder->get();
        return $query;
    }

    // insert data
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
