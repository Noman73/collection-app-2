<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Otp;
use Rakibhstu\Banglanumber\NumberToBangla;
use App\Models\User;
use App\Rules\OtpValidate;
use Hash;
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

    public function sendOtp(Request $request)
    {
        // $validator=Validator::make($request->all(),[
        //     'mobile'=>"required|max:11|min:11",
        // ]);
        
        $exist=User::where('mobile',$request->mobile)->count();
        if($exist>0){
            $bangla=new NumberToBangla;
            $code= Otp::generate('password:'.$request->mobile);
            $api_key="C20081826072b4bc932d35.83708572";
            $sender_id="8809601000185";
            $contacts=$request->mobile;
            $type="application/json";
            $msg="আপনার অর্ঘ্য প্রস্ব্যস্তি পাসওয়ার্ড রিসেট কোড ".$bangla->bnNum($code);
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
            
            return view('auth.passwords.custom-password-reset',compact('contacts'));
        }else{
            return redirect()->back()->with('mobile','আাপনার মোবাইল নাম্বারটি রেজিস্টার হয়নি');
        }
        
    }

    public function resetPassword(Request $request)
    {
        // Otp::validate('password:'.$request->mobile,$request->otp);
        $validator=Validator::make($request->all(),[
            'mobile'=>"required|max:200|min:1|",
            'otp'=>["required","max:6","min:6",new OtpValidate($request->mobile)],
            'password'=>"required|max:100|min:6|confirmed",
        ]);
        if($validator->passes()){
            $expence=User::where('mobile',$request->mobile)->first();
            $expence->password=Hash::make($request->password);
            $expence->save();
            if ($expence) {
                return redirect(route('login'))->with('message','Password Reset Success');
            }
        }
        // return $validator->errors();
        return redirect()->back()->withErrors($validator);
    }
}
