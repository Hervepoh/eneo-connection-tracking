<?php

namespace App\Models;

use CodeIgniter\Model;

class ConnectionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'connection_request';
    protected $primaryKey       = 'id_request';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = [
        'title','person_type', 'civility', 'firstname', 'lastname','social_reason', 
        'phone','phone_dial_code','phone_country_code','is_whatsapp',
        'phone_2', 'phone_2_dial_code','phone_2_country_code','is_whatsapp_2',
        'email', 'region', 'region_administrative', 'town', # capture town information
        'identity_type_id','identity_type', 'identity_number','identity_delivered_at','identity_expires_on', 'identity_country',
        'taxnum', 'agency','meter_quantity',
        'connection_type','connection_type_label','usage_description','sub_category','sub_category_detail',
        'appliances','meter_type', 'requestor', 'type_compteur', 'activity', 'premise_activity',
        'construction_type', 'number_floor',  'networkDis', 'premise_location', 'contract_number',
        'qty', 'requested_power', 'existing_wire',
        'status' ,'ticket','ticket_public', 'operation_sent_at','operation_number_attempts',
        'updated_at','work_request_number','quotation_details','quotation_amount','quotation_date','crm_case_number',
        'notify','notify_id','notify_at',
        'resolution', 'assigned_user_id'
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
