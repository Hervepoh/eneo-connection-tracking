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


    // public function getRequestsWithAttachments(?string $search = null, int $perPage = 10)
    // {
    //     $builder = $this->select('
    //     connection_request.*,
    //     JSON_ARRAYAGG(
    //         JSON_OBJECT(
    //             "id", request_attachment.id,
    //             "title", request_attachment.title,
    //             "filename", request_attachment.filename,
    //             "file", request_attachment.file,
    //             "description", request_attachment.description
    //         )
    //     ) AS attachments
    //     ')
    //         ->join('request_attachment', 'request_attachment.id_request = connection_request.id_request', 'left')
    //         ->groupBy('connection_request.id_request')
    //         ->orderBy('connection_request.created_at', 'DESC');

    //     // --- 🔍 Logique de recherche enrichie ---
    //     if (!empty($search)) {
    //         $search = trim(strtolower($search));

    //         // Si liste de WR séparée par des virgules, espaces ou points-virgules
    //         if (preg_match('/[,;]+/', $search)) {
    //             $wrList = array_filter(array_map('trim', preg_split('/[,\s;]+/', $search)));
    //             if (!empty($wrList)) {
    //                 $builder->groupStart();

    //                 foreach ($wrList as $index => $wr) {
    //                     $wrClean = strtolower(trim($wr));
    //                                var_dump($wrClean);
    //                     if ($index === 0) {
    //                         $builder->like('LOWER(connection_request.work_request_number)', $wrClean);
    //                     } else {
    //                         $builder->orLike('LOWER(connection_request.work_request_number)', $wrClean);
    //                     }
    //                 }

    //                 $builder->groupEnd();
    //             }
    //         } else {
    //             // Recherche unitaire classique
    //             $builder->groupStart()
    //                 ->like('LOWER(connection_request.ticket_public)', $search)
    //                 ->orLike('LOWER(connection_request.firstname)', $search)
    //                 ->orLike('LOWER(connection_request.lastname)', $search)
    //                 ->orLike('LOWER(connection_request.identity_number)', $search)
    //                 ->orLike('LOWER(connection_request.taxnum)', $search)
    //                 ->orLike('LOWER(connection_request.work_request_number)', $search)
    //                 ->orLike('LOWER(connection_request.contract_number)', $search)
    //                 ->groupEnd();
    //         }
    //     }

    //     return $builder->paginate($perPage);
    // }

    // public function getRequestsWithAttachments(?string $search = null, int $perPage = 10)
    // {
    //     $builder = $this->select('
    //         connection_request.*,
    //         JSON_ARRAYAGG(
    //             CASE 
    //                 WHEN request_attachment.id IS NOT NULL THEN
    //                     JSON_OBJECT(
    //                         "id", request_attachment.id,
    //                         "title", request_attachment.title,
    //                         "filename", request_attachment.filename,
    //                         "file", request_attachment.file,
    //                         "description", request_attachment.description
    //                     )
    //                 ELSE NULL
    //             END
    //         ) AS attachments
    //     ')
    //         ->join('request_attachment', 'request_attachment.id_request = connection_request.id_request', 'left')
    //         ->groupBy('connection_request.id_request')
    //         ->orderBy('connection_request.created_at', 'DESC');

    //     // --- 🔍 Logique de recherche enrichie ---
    //     if (!empty($search)) {
    //         $search = trim($search);

    //         // Détection de liste de Work Requests (séparés par virgules, points-virgules ou espaces)
    //         if (preg_match('/[,;\s]+/', $search)) {
    //             // Séparer les Work Requests
    //             $wrList = array_filter(
    //                 array_map('trim', preg_split('/[,;\s]+/', $search)),
    //                 fn($item) => !empty($item)
    //             );

    //             if (!empty($wrList)) {
    //                 $builder->groupStart();

    //                 foreach ($wrList as $index => $wr) {
    //                     if ($index === 0) {
    //                         $builder->like('connection_request.work_request_number', $wr);
    //                     } else {
    //                         $builder->orLike('connection_request.work_request_number', $wr);
    //                     }
    //                 }

    //                 $builder->groupEnd();

    //                 echo '<pre>';
    //                 echo "Liste détectée:\n";
    //                 print_r($wrList);
    //                 echo "\nRequête SQL:\n";
    //                 echo  $this->db->getLastQuery(); // false = ne pas reset la query
    //                 echo '</pre>';
    //             }
    //         } else {
    //             // Recherche unitaire classique sur plusieurs champs
    //             $builder->groupStart()
    //                 ->like('connection_request.ticket_public', $search)
    //                 ->orLike('connection_request.firstname', $search)
    //                 ->orLike('connection_request.lastname', $search)
    //                 ->orLike('connection_request.identity_number', $search)
    //                 ->orLike('connection_request.taxnum', $search)
    //                 ->orLike('connection_request.work_request_number', $search)
    //                 ->orLike('connection_request.contract_number', $search)
    //                 ->groupEnd();
    //         }
    //     }

    //     return $builder->paginate($perPage);
    // }

    public function getRequestsWithAttachments(?string $search = null, int $perPage = 10)
    {
        $builder = $this->select('
            connection_request.*,
            JSON_ARRAYAGG(
                CASE 
                    WHEN request_attachment.id IS NOT NULL THEN
                        JSON_OBJECT(
                            "id", request_attachment.id,
                            "title", request_attachment.title,
                            "filename", request_attachment.filename,
                            "file", request_attachment.file,
                            "description", request_attachment.description
                        )
                    ELSE NULL
                END
            ) AS attachments
        ')
            ->join('request_attachment', 'request_attachment.id_request = connection_request.id_request', 'left')
            ->groupBy('connection_request.id_request')
            ->orderBy('connection_request.created_at', 'DESC');

        // --- 🔍 Logique de recherche enrichie ---
        if (!empty($search)) {
            $search = trim($search);

            // Détection de liste de Work Requests (contient virgule ou point-virgule)
            if (strpos($search, ',') !== false || strpos($search, ';') !== false) {
                // Séparer les Work Requests
                $wrList = array_values(array_filter(
                    array_map('trim', preg_split('/[,;]+/', $search)),
                    fn($item) => !empty($item)
                ));

                if (!empty($wrList)) {
                    // Utiliser whereIn pour une recherche exacte sur plusieurs WR
                    $builder->whereIn('connection_request.work_request_number', $wrList);
                }
            } else {
                // Recherche unitaire classique sur plusieurs champs
                $builder->groupStart()
                    ->like('connection_request.ticket_public', $search)
                    ->orLike('connection_request.firstname', $search)
                    ->orLike('connection_request.lastname', $search)
                    ->orLike('connection_request.identity_number', $search)
                    ->orLike('connection_request.taxnum', $search)
                    ->orLike('connection_request.work_request_number', $search)
                    ->orLike('connection_request.contract_number', $search)
                    ->groupEnd();
            }
        }

        return $builder->paginate($perPage);
    }
}
