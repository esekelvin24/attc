<?php

namespace App\Validators;
use GuzzleHttp\Client;
use DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class CustomLogin
{
    


    public function accountDisabled($attribute, $value, $parameters, $validator)
    {
        $user =  DB::table('users')->where('email',$value)->get();
       
        if(count($user) > 0)
        {
          if (Hash::check(request()->password, $user[0]->password)) {
                if($user[0]->status != 1 )
                {
                    Auth::logout();
                    return false;
                }
            }
        }
        return true;
    }

   

    public function accountConfirmationEmail($attribute, $value, $parameters, $validator)
    {
        
        $user =  DB::table('users')->where('email',$value)->get();

        if(count($user) > 0)
        {
            if (Hash::check(request()->password, $user[0]->password)) {
                if($user[0]->email_verified_at == null )
                {
                    Auth::logout();
                    return false;
                }
            }
        }
        
        return true;
    }

    public function loginCheck($attribute, $value, $parameters, $validator)
    {
        
        if(Auth::attempt(['email' => request()->email, 'password' => request()->password])) {
            return true;
        }else{
           return false;
        }
    }

    

    
    
    
}