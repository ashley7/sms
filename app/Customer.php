<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use AfricasTalking\SDK\AfricasTalking;

class Customer extends Model
{
    public static function validatePhoneNumber($phone)
    {

        $phone_number = "";

        if ($phone[0]=="+") {

           $phone_number=str_replace("+", "", $phone);

        }elseif ($phone[0]=="0") {

            $out = ltrim($phone, "0");

            $phone_number="256".$out;

        } elseif ($phone[0]=="7")

            $phone_number="256".$phone;

        else

            $phone_number=$phone;

        $phone_number = str_replace(" ","",$phone_number);

        return $phone_number;

    }

    // public static function pushBulk_SMS($phone,$message)
    // { 

    //     $username = env("API_USERNAME");

    //     $apiKey = env("API_KEY");

    //     $AT       = new AfricasTalking($username, $apiKey);

    //     $sms      = $AT->sms();

    //     $phone = Customer::validatePhoneNumber($phone);

    //     $sms->send([
    //         'to'      => $phone,
    //         'message' => $message
    //     ]);    

    //   }

    public static function pushBulk_SMS($phone_number,$message)
    {

        if(empty($phone_number)) return;

        $phone = User::validatePhoneNumber($phone_number); 
        
        $username = env("SMSUSERNAME");
        $pass   = env("SMSAPIKEY"); //password 
        
        $token = User::getSmSToken($username, $pass); 

        if (!$token) return;

        $url = "https://sms.dmarkmobile.com/v3/api/send_sms/";

        $data = json_encode([
            'msg' => $message,
            'numbers' => $phone
        ]);

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // JSON encoded body
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data),
            'authToken: ' . $token
        ]);        

        try {
            curl_exec($ch);
        } catch (\Exception $th) {}       

        curl_close($ch);            
 
    }

    public static  function getSmSToken($username,$pass){

        $url = "https://sms.dmarkmobile.com/v3/api/get_token/";
        
        $data = json_encode([
            'username' => $username,
            'password' => $pass
        ]);
        
        $ch = curl_init($url);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // JSON encoded body
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);

        try {
            $response = curl_exec($ch);

            curl_close($ch);

            $results = json_decode($response,1);

            return $results['access_token']; 

        } catch (\Exception $th) {

           curl_close($ch);

        }
    }
}
