<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class WhatsappApi extends BaseController
{
    private string $url;
    private string $token;
    private string $instance;

    public function __construct()
    {
        $this->url = getEnv('WHATSAPP_API_URL');
        $this->token = getEnv('WHATSAPP_API_TOKEN');
        $this->instance = getEnv('WHATSAPP_API_INSTANCE');
    }

    public function send(string $number,$message)
    {
        $curl = curl_init();
        $post_fields = "token=".$this->token."&to=$number&body=$message&priority=1&referenceId=";
        $curl_options = array(
            CURLOPT_URL => $this->url."/".$this->instance."/messages/chat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_fields,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        );

        curl_setopt_array($curl, $curl_options);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            $this->log('error',json_decode($post_fields), "cURL Error #:" . $err);
        } 
        return json_decode($response);
      
    }

    
    private function log(string $type,string $resquest ,string $response){
        $data = [
            'resquest'   => $resquest, 
            'response'   => $response,
            'error'      => ($type == 'error') ? '[ERROR]' : '',
            'type'  => ($type == 'error' || $type == 'critical' || $type == 'alert' ) ? 'exception' : 'response',
        ];
        log_message($type, "{error}  TRY CAll CALL API WITH  :: resquest {resquest} AND {type} :: {response} ", $data);
    }
}
