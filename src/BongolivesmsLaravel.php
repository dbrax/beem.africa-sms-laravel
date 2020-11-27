<?php

namespace Epmnzava\BongolivesmsLaravel;

class BongolivesmsLaravel
{
    // Build your next great package.


    public function send__single_recipient($source_addr,$message,$recipient_msisdn){

         $api_key=config("bongolivesms-laravel.api_key");
         $secret_key=config("bongolivesms-laravel.secret_key");


        $postData = array(
            'source_addr' => $source_addr,
            'encoding'=>0,
            'schedule_time' => '',
            'message' => $message,
            'recipients' => [array('recipient_id' => '1','dest_addr'=>$recipient_msisdn)]
        );

        $ch = curl_init(config('bongolivesms-laravel.base_url'));
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));


        // Send  request
$response = curl_exec($ch);

// Check for errors
if($response === FALSE){
        echo $response;

    die(curl_error($ch));
}
var_dump($response);


    }


}
