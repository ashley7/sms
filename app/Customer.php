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

        }else{

            $phone_number=$phone;

        }

        return $phone_number;

    }

    public static function pushBulk_SMS($phone,$message)
    { 

        $username = env("API_USERNAME");

        $apiKey = env("API_KEY");

        $AT       = new AfricasTalking($username, $apiKey);

        $sms      = $AT->sms();

        $phone = Customer::validatePhoneNumber($phone);

        $sms->send([
            'to'      => $phone,
            'message' => $message
        ]);    

      }
}
