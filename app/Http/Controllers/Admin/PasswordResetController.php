<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Otp;
class PasswordResetController extends Controller
{
    public function form()
    {
        
        return view('auth.passwords.custom-password-reset');
    }

    public function otpForm()
    {
        return view('auth.passwords.mobile');
    }

    public function sendOtp()
    {
        $code= Otp::generate('password:'.auth()->user()->mobile);
        $api_key="C20081826072b4bc932d35.83708572";
        $sender_id="8809601000185";
        $contacts=auth()->user()->mobile;
        $type="application/json";
        $msg="Your Argho Proshosti Password Reset Code is: ".$code;
        $fields='api_key='.$api_key.'&type='.$type.'&contacts='.$contacts.'&senderid='.$sender_id.'&msg='.$msg;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://esms.mimsms.com/smsapi");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
        // In real life you should use something like:
        // curl_setopt($ch, CURLOPT_POSTFIELDS, 
        //          http_build_query(array('postvar1' => 'value1')));
        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
        // Further processing ...
        // return $server_output;
        // if ($server_output == "OK") { 

        //  } else { 
             
        //  }
        
        return view('auth.passwords.custom-password-reset');
    }
}
