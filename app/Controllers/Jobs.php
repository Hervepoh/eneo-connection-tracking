<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\Api;
use App\Controllers\WhatsappApi;
use App\Models\AttachmentModel;
use App\Models\ConnectionModel;
use App\Models\WorkerModel;


class Tasks extends BaseController
{
    public $limit = 2500;
    

    public function tasks(){	   
	$this->index();
	$this->attachment();
	$this->open();
    }

    public function index()
    {
        log_message('info', 'RUN CRONJOB : tasks_connection.');
        try {
            $api = new Api();

            // GETTING ALL CONNECTION REQUEST NOT YET SEND 
            $connectionModel = new ConnectionModel();
            $connections = $connectionModel
                ->where('status', 'pending')
                ->orderBy('created_at', 'asc')
                ->findAll($this->limit);
	    	    
	    foreach ($connections as $connection) {
		$check  = $api->check_case($connection['ticket_public']);    
	         
		if ($check->result_count == 0) {
		     $ticket =$api->crm_save_case($connection);
		     
		     if (!is_null($ticket)) {
                       $data = [
                          'id_request' => $connection['id_request'],
                          'ticket'    => $ticket,
                          'status'   => 'publish',
                       	  'crm_case_number' =>  $api->get_caseNumber($ticket),
                      	  'operation_sent_at' => date('Y-m-d H:i:s'),
                       	  'operation_number_attempts' =>  $connection['operation_number_attempts'] + 1,
                   	 ];
              	     } else {
                    	    $data = [
                       		 'id_request' => $connection['id_request'],
                   	    	 'operation_number_attempts' =>  $connection['operation_number_attempts'] + 1,
                	    ];
           	     }
	
		} else {
		     	$data = [
                       	'id_request'        =>  $connection['id_request'],
                        'ticket'            =>  $check->entry_list[0]->id,
                        'status'            =>  'publish',
                        'crm_case_number'   =>  $check->entry_list[0]->name_value_list->case_number->value,
                        'operation_sent_at' =>  date('Y-m-d H:i:s'),
                        'operation_number_attempts' =>  $connection['operation_number_attempts'] + 1,
                       ];
		}
		 
                $connectionModel->save($data);
	       
	    }
        } catch (\Exception $e) {
            log_message('error', "RUN CRONJOB : tasks_connection with error : " . $e->getMessage());
            exit($e->getMessage());
        }
    }

    public function attachment()
    {
        #log_message('info', 'RUN CRONJOB : tasks_attachment');
        try {
 
           $api = new Api(); 	   
 
	    // GETTING ALL Attachment NOT YET SEND  for a CONNECTION REQUEST SEND
            $attachmentModel = new AttachmentModel();

            $attachments = $attachmentModel
                ->select([
                    'request_attachment.id',
                    'request_attachment.title',
                    'request_attachment.description',
                    'request_attachment.file',
                    'request_attachment.filename',
                    'connection_request.ticket',
                    'request_attachment.operation_number_attempts',
                    'request_attachment.status '
                ])
                ->where('request_attachment.status', 'pending')
                ->join('connection_request', 'connection_request.id_request=request_attachment.id_request')
                ->where('connection_request.status', 'publish')
                ->orderBy('connection_request.created_at', 'asc')
                ->findAll($this->limit);


            foreach ($attachments as $attachment) {
	        	    
	       $check = $api->check_note($attachment);
	      
	       if (property_exists($check,'result_count')) {  
	      	
	         if ($check->result_count == 0) {
	           $response =  $api->crm_update_case($attachment);                             
	       
                   if (!is_null($response)) {
                      $data = [
                        'id' => $attachment['id'],
                        'status' => 'publish',
                        'operation_sent_at' => date('Y-m-d H:i:s'),
                        'operation_number_attempts' =>  $attachment['operation_number_attempts'] + 1,
                       ];
                    } else {
                       $data = [
			'id' => $attachment['id'],
			'status' => 'error',
                        'operation_sent_at' => date('Y-m-d H:i:s'),
                        'operation_number_attempts' =>  $attachment['operation_number_attempts'] + 1,
		       ];
		    }

	         }else if($check->result_count > 0)  {
		     $data = [
                        'id' => $attachment['id'],
                        'status' => 'publish',
                        'operation_sent_at' => date('Y-m-d H:i:s'),
                        'operation_number_attempts' =>  $attachment['operation_number_attempts'] + 1,
                      ];
                    
	         }else {
		     $data = [
                        'id' => $attachment['id'],
                        'operation_number_attempts' =>  $attachment['operation_number_attempts'] + 1,
                      ];
	         }

	         $attachmentModel->save($data);
	       }
            }
        } catch (\Exception $e) {
           //log_message('error', "RUN CRONJOB : tasks_attachment with error : " . $e->getMessage());
            exit($e->getMessage());
        }
    }

    public function open()
    {
        log_message('info', 'RUN CRONJOB : tasks_open');
        try {
            $api = new Api();
            // GETTING ALL CONNECTION REQUEST YET SEND 
            $connectionModel = new ConnectionModel();
            $connections = $connectionModel
                ->where('status', 'publish')
                ->orderBy('updated_at', 'asc')
                ->findAll($this->limit);
	    $db = db_connect();

            foreach ($connections as $connection) {
                // CHECK IF ALL FILE ARE PUBLISHED 
                $sql =
                    "select (
                (SELECT count(*) FROM request_attachment where id_request={$connection['id_request']}) - 
                (SELECT count(*) FROM request_attachment where status='publish' and id_request={$connection['id_request']}) 
                    ) AS nb";
                $result = $db->query($sql)->getRow();
                
	    
	        if ($result->nb == 0) {
                    //CHECK IF case is
                    //IF SO I UPDATE THE CONNECTION REQUEST TO OPEN AND I ASSIGN TO SOMEONE
                    $check = $api->check_case_toopen($connection['ticket']);
                 
                    if ($check == 1) {
                        $assigned_user = $this->assignTo();
                        $response      = $api->crm_update_state_case($connection['ticket'], 'Open_New', $assigned_user['id']);
                    } else {
                        $response = NULL;
                    }

                    if (!is_null($response)) {
                        $data = [
                            'id_request'       => $connection['id_request'],
                            'status'           => 'publish and open',
                            'assigned_user_id' => $assigned_user['id']
                        ];
                        $connectionModel->save($data);

                        $workerModel = new WorkerModel();
                        $workerData = [
                            'worker_login'             => $assigned_user['login'],
                            'number_of_assign_request' => $assigned_user['nb'] + 1
                        ];
                        $workerModel->save($workerData);
                    }

                }
            }
        } catch (\Exception $e) {
            log_message('error', "RUN CRONJOB : tasks_open with error : " . $e->getMessage());
            exit($e->getMessage());
        }
    }

     public function error()
     {
        log_message('info', 'RUN CRONJOB : tasks_error');
        try {
            $api = new Api();
            // GETTING ALL CONNECTION REQUEST YET SEND
            $connectionModel = new ConnectionModel();
            $connections = $connectionModel
                ->where('status', 'publish')
                ->orderBy('updated_at', 'asc')
                ->findAll($this->limit);
            $db = db_connect();
            foreach ($connections as $connection) {
                // CHECK IF ALL FILE ARE PUBLISHED
                $sql = "SELECT count(*) AS nb FROM request_attachment where status='error' and id_request={$connection['id_request']}";
                $result = $db->query($sql)->getRow();
                if ($result->nb > 0) {
                    //IF SO I UPDATE THE CONNECTION REQUEST TO ERROR 
                    $response = $api->crm_update_state_case($connection['ticket'],'Closed_Closed','Close');

                    if (!is_null($response)) {
                        $data = [
                            'id_request' => $connection['id_request'],
                            'status' => 'error',
                        ];
                        $connectionModel->save($data);
                    }
                }
            }
        } catch (\Exception $e) {
            log_message('error', "RUN CRONJOB : tasks_open with error : " . $e->getMessage());
            exit($e->getMessage());
        }
    }




    public function update()
    {
        log_message('info', 'RUN CRONJOB : tasks_update');
        try {
            $api = new Api();

            // GETTING ALL CONNECTION REQUEST NOT YET SEND 
            $where = "
                   status = 'publish and open' 
                   AND 
                   (work_request_number IS NULL 
                   OR work_request_number='' 
                   OR quotation_amount IS NULL 
                   OR quotation_amount='') ";

            $connectionModel = new ConnectionModel();
            $connections = $connectionModel
                //->where('status', 'publish and open')
                ->where($where)
                //->orderBy('updated_at', 'asc')
                //->findAll($this->limit);
                 ->findAll();

            foreach ($connections as $connection) {
                //$crm_data = $api->crm_get_branch_info($connection['ticket']);
                # Todo $crm_data = $api->crm_get_branch_info($connection['crm_case_number'], 'case_number_c');
                $crm_case_status = $api->crm_get_case_info($connection['ticket']);

	
		# Todo $crm_data = json_decode($crm_data);
                $data =   [ 
			'id_request' => $connection['id_request'],
			#'resolution' => (property_exists($crm_case_status,'result_count'))? $crm_case_status->resolution->value:NULL
		];
	
		echo '<pre>';
		var_dump($data);
		var_dump($crm_case_status);
		echo '</pre>';
		//die();
                /*
                if ($crm_data->result_count > 0) {
                    $work_request_number = $crm_data->entry_list[0]->name_value_list->name->value;
                    $montant_devis_c = $crm_data->entry_list[0]->name_value_list->montant_devis_c->value;
                    $details = $crm_data->entry_list[0]->name_value_list->wr_details_c->value;

                    $data = array_merge(
                        $data, [
                        'work_request_number'    => $work_request_number,
                        'quotation_details'      => $details
                        //'follow_number_attempts' =>  $connection['operation_number_attempts'] + 1,
                    ]);

                    if ($montant_devis_c <> "") {
                        $data = array_merge(
                            $data,
                            [
                                'quotation_amount' => $montant_devis_c,
                                'quotation_date'   => date('Y-m-d H:i:s'),
                            ]
                        );
                    }
                   
                }
		
		var_dump($crm_case_status->status->value);
		if ($crm_case_status->status->value == "Closed_Closed") {
                    $data = array_merge(
                        $data,
                        [
                            #'status' => 'close',
                            'resolution' => $crm_case_status->resolution->value
                        ]
                    );
		}*/
                $connectionModel->save($data);
            }
        } catch (\Exception $e) {
            log_message('error', "RUN CRONJOB : tasks_update with error : " . $e->getMessage());
            exit($e->getMessage());
        }
    }

    public function notify()
    {
        log_message('info', 'RUN CRONJOB : tasks_whatsapp_notification.');
        try {
            $api = new WhatsappApi();

            // GETTING ALL CLIENT REQUEST NOT YET NOTIFY 
            $connectionModel = new ConnectionModel();
            $where = ['notify' => 'pending'];
            $connections = $connectionModel
                ->where('notify', 'pending')
                ->orderBy('created_at', 'asc')
                ->findAll($this->limit);


            foreach ($connections as $connection) {
                $number  = $this->getWhatsappNumber($connection['phone'], $connection['phone_2'], $connection['is_whatsapp'], $connection['is_whatsapp_2'], $connection['phone_dial_code'], $connection['phone_2_dial_code']);
                $message = $this->getMessageToSend($connection);

                if (!is_null($number)) {
                    $send    = $api->send($number, $message);

                    if (!is_null($send) && property_exists($send, 'sent') && $send->sent) {
                        $data = [
                            'id_request' => $connection['id_request'],
                            'notify'     => 'send_notify',
                            'notify_id'  => $send->id,
                            'notify_at'  => date('Y-m-d H:i:s'),
                        ];
                        $connectionModel->save($data);
                    } else {
                        log_message('error', "RUN CRONJOB : tasks_whatsapp_notification with error : " . json_encode($send));
                    }
                } else {
                    $data = [
                        'id_request' => $connection['id_request'],
                        'notify'     => 'not available',
                        'notify_id'  => 'no whatsapp number available'
                    ];
                    $connectionModel->save($data);
                }
            }
        } catch (\Exception $e) {
            log_message('error', "RUN CRONJOB : tasks_whatsapp_notification with error : " . $e->getMessage());
            exit($e->getMessage());
        }
    }


    public function update_user_information()
    {
        $api = new Api();
        $workerModel = new WorkerModel();
        $where   = "active=1 AND dt_start <= NOW() AND dt_end >= NOW()";
        $workers = $workerModel
            ->select(['worker_login'])
            ->where($where)
            ->orderBy('created_at', 'asc')
            ->findAll();

        foreach ($workers as $worker) {
            $response  = $api->get_user($worker['worker_login']);
            if ($response->result_count > 0) {
                $response->entry_list['0'];

                $data = [
                    'worker_login'  => $worker['worker_login'],
                    'work_crm_id'   => $response->entry_list['0']->id,
                    'firstname'     => $response->entry_list['0']->name_value_list->first_name->value,
                    'lastname'      => strtoupper($response->entry_list['0']->name_value_list->last_name->value),
                    'active'        => ($response->entry_list['0']->name_value_list->status->value == 'Active') ? 1 : 0
                ];
                $workerModel->save($data);
            }
        }
    }


    private function assignTo()
    {
        $workerModel = new WorkerModel();
        $where       = "active=1 AND dt_start <= NOW() AND dt_end >= NOW()";
        $order       = "number_of_assign_request ASC, lastname ASC";
        $worker      = $workerModel
            ->select(['worker_login AS login', 'work_crm_id AS id', 'number_of_assign_request AS nb'])
            ->where($where)
            ->orderBy($order)
            ->first(1);
        if (is_null($worker)) {
            return "";
        }
        return $worker;
    }


    private function getWhatsappNumber($phone, $phone_2, $is_whatsapp, $is_whatsapp_2, $phone_dial_code, $phone_2_dial_code)
    {
        $number = "";
        if ($phone_2 && $is_whatsapp_2) {
            $number = $phone_2_dial_code . $phone_2;
        }
        if ($phone && $is_whatsapp) {
            $number = $phone_dial_code . $phone;
        }
        return "+" . $number;
    }

    private function getMessageToSend($connection)
    {

        return <<<EOT
        Bonjour {$connection['civility']} {$connection['title']} , 
        Numéro d'identifiant unique (NUI) : {$connection['taxnum']}
        votre demande N° {$connection['ticket_public']} a bien été prise en compte. 
        Pour des besoins d assistance, nos téléconseillers sont disponibles 24h/24 et 07jrs/7  au 8010  ou sur le Live Chat à travers le lien  
        https://my.eneocameroon.cm/login. 
        --------------------------------------------------------
        --------------------------------------------------------
        Hello {$connection['civility']} {$connection['title']}, 
        Unique tax identification number (NUI): {$connection['taxnum']}
        your request {$connection['ticket_public']} has been taken into account.
        For assistance, our teleconsultants are available 24 hours a day, 7 days a week on 8010 or on Live Chat through the link  
        https://my.eneocameroon.cm/login.
        EOT;
    }
}
