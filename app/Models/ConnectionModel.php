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
        'title',
        'person_type',
        'civility',
        'firstname',
        'lastname',
        'social_reason',
        'phone',
        'phone_dial_code',
        'phone_country_code',
        'is_whatsapp',
        'phone_2',
        'phone_2_dial_code',
        'phone_2_country_code',
        'is_whatsapp_2',
        'email',
        'region',
        'region_administrative',
        'town', # capture town information
        'identity_type_id',
        'identity_type',
        'identity_number',
        'identity_delivered_at',
        'identity_expires_on',
        'identity_country',
        'taxnum',
        'agency',
        'meter_quantity',
        'connection_type',
        'connection_type_label',
        'usage_description',
        'sub_category',
        'sub_category_detail',
        'appliances',
        'meter_type',
        'requestor',
        'type_compteur',
        'activity',
        'premise_activity',
        'construction_type',
        'number_floor',
        'networkDis',
        'premise_location',
        'contract_number',
        'qty',
        'requested_power',
        'existing_wire',
        'status',
        'ticket',
        'ticket_public',
        'operation_sent_at',
        'operation_number_attempts',
        'updated_at',
        'work_request_number',
        'quotation_details',
        'quotation_amount',
        'quotation_date',
        'crm_case_number',
        'notify',
        'notify_id',
        'notify_at',
        'resolution',
        'assigned_user_id'
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

    protected function beforeUpdate(array $data)
    {
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }


    public function getRequestsWithAttachments(?string $search = null, int $perPage = 10)
    {
        $builder = $this->select('
        connection_request.*,
        JSON_ARRAYAGG(
            JSON_OBJECT(
                "id", request_attachment.id,
                "title", request_attachment.title,
                "filename", request_attachment.filename,
                "file", request_attachment.file,
                "description", request_attachment.description
            )
        ) AS attachments
    ')
            ->join('request_attachment', 'request_attachment.id_request = connection_request.id_request', 'left')
            ->groupBy('connection_request.id_request')
            ->orderBy('connection_request.created_at', 'DESC');

        // if (!empty($search)) {
        //     $builder->groupStart()
        //         ->like('connection_request.ticket_public', $search)
        //         ->orLike('connection_request.firstname', $search)
        //         ->orLike('connection_request.lastname', $search)
        //         ->orLike('connection_request.taxnum', $search)
        //         ->groupEnd();
        // }

        // --- 🔍 Logique de recherche enrichie ---
        if (!empty($search)) {
            $search = trim(strtolower($search));

            // Si liste de WR séparée par des virgules
            if (strpos($search, ',') !== false) {
                $wrList = array_filter(array_map('trim', explode(',', $search)));

                if (!empty($wrList)) {
                    $builder->groupStart();
                    foreach ($wrList as $wr) {
                        $builder->orWhere('LOWER(connection_request.wr_number)', $wr);
                    }
                    $builder->groupEnd();
                }
            } else {
                // Recherche unitaire classique
                $builder->groupStart()
                    ->like('LOWER(connection_request.ticket_public)', $search)
                    ->orLike('LOWER(connection_request.firstname)', $search)
                    ->orLike('LOWER(connection_request.lastname)', $search)
                    ->orLike('LOWER(connection_request.taxnum)', $search)
                    ->orLike('LOWER(connection_request.work_request_number)', $search)
                    ->orLike('LOWER(connection_request.contract_number)', $search)
                    ->groupEnd();
            }
        }

        return $builder->paginate($perPage);
    }
}
