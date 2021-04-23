<?php

/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Github: https://github.com/dbrax/beem.africa-sms-laravel
 * Email: epmnzava@gmail.com
 * 
 */

namespace Epmnzava\BongolivesmsLaravel;

class BongolivesmsLaravel
{


    private $api_key;

    private $secret_key;

    private $base_url;

    private $sender_id;

    public function __construct()
    {
        $this->api_key = config("beemafrica.api_key");
        $this->secret_key = config("beemafrica.secret_key");
        $this->base_url = config('beemafrica.base_url');
        $this->sender_id=config('beemafrica.senderid');
    }



    /**
     * Function to send a message to only one msisdn
     */
    public function send__single_recipient($source_addr, $message, $recipient_msisdn)
    {



        //create an array of objects or data to be sent
        $postData = array(
            'source_addr' => $this->sender_id,
            'encoding' => 0,
            'schedule_time' => '',
            'message' => $message,
            'recipients' => [array('recipient_id' => '1', 'dest_addr' => $recipient_msisdn)]
        );


        //call a curl request  (Will create a separate class for curl get and post requests)
        $ch = curl_init($this->base_url . "/v1/send");
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization:Basic ' . base64_encode("$this->api_key:$this->secret_key"),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response_data = [];
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

   

        $postData = array(
            'source_addr' => $this->sender_id,
            'encoding' => 0,
            'schedule_time' => '',
            'message' => $message,
            'recipients' => $receipients
        );

        $ch = curl_init($this->base_url. "/v1/send");
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization:Basic ' . base64_encode("$this->api_key:$this->secret_key"),
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
