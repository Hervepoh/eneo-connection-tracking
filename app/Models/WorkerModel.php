<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkerModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'workers';
    protected $primaryKey       = 'worker_login';
   
    protected $returnType     = 'array';

    protected $allowedFields = [
        'worker_login','work_crm_id', 'firstname', 'lastname','number_of_assign_request',
        'active', 'dt_start', 'dt_end'
    ];

    protected $useSoftDeletes = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['beforeUpdate'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function beforeUpdate(array $data){
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

}
