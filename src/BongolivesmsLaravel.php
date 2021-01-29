<?php

namespace Epmnzava\BongolivesmsLaravel;

class BongolivesmsLaravel
{
    // Build your next great package.

    /**
     * Function to send a message to only one msisdn
     */
    public function send__single_recipient($source_addr, $message, $recipient_msisdn)
    {

        //get api keys from config files
        $api_key = config("bongolivesms-laravel.api_key");
        $secret_key = config("bongolivesms-laravel.secret_key");


        //create an array of objects or data to be sent
        $postData = array(
            'source_addr' => $source_addr,
            'encoding' => 0,
            'schedule_time' => '',
            'message' => $message,
            'recipients' => [array('recipient_id' => '1', 'dest_addr' => $recipient_msisdn)]
        );


        //call a curl request  (Will create a separate class for curl get and post requests)
        $ch = curl_init(config('bongolivesms-laravel.base_url') . "/v1/send");
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

        $response_data = [];
        // Send  request
        $response = curl_exec($ch);

        $response_array = json_decode($response);


        return json_encode($response_array);
    }

    /** 
     * Takes in multiple msisdn at one time all you need to do is pass
     * ["255679079774","25567890989"]
     * 
     * 
     */

    public function send__multiple_recipient($source_addr, $message, $recipient_array)
    {

        $receipients = [];

        for ($i = 0; $i < count($recipient_array); $i++)
            array_push($receipients, array('recipient_id' => $i, 'dest_addr' => $recipient_array[$i]));

        $api_key = config("bongolivesms-laravel.api_key");
        $secret_key = config("bongolivesms-laravel.secret_key");



        $postData = array(
            'source_addr' => $source_addr,
            'encoding' => 0,
            'schedule_time' => '',
            'message' => $message,
            'recipients' => $receipients
        );

        $ch = curl_init(config('bongolivesms-laravel.base_url') . "/v1/send");
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

        $response_data = [];
        // Send  request
        $response = curl_exec($ch);

        $response_array = json_decode($response);

        if ($response_array->code == 100) {
            //it is successful
            $response_data = ["status" => "1", "message" => $response_array->message, "request_id" => $response_array->request_id];
        } else
            $response_data = ["status" => "0", "message" => "Not successful", "request_id" => "0"];



        return $response_data;
    }
}
