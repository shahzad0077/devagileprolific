<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()

    {

    
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('email', $user->email)->first();


            if($finduser){

     

                Auth::login($finduser);

    

                return redirect('/home');

     

            }else{

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,

                    'google_id'=> $user->id,
                    'email_verified_at'=> Carbon::now(),
                    'password' => encrypt('123456dummy')

                ]);

    

                Auth::login($newUser);

     

                return redirect('/home');

            }

        } catch (Exception $e) {

            dd($e->getMessage());

        }

    

  

    }

    public function redirectToFacebook()

    {

        return Socialite::driver('facebook')->redirect();

    }

           

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function handleFacebookCallback()

    {

        try {

        

            $user = Socialite::driver('facebook')->user();

         

            $finduser = User::where('facebook_id', $user->id)->first();

         

            if($finduser){

         

                Auth::login($finduser);

       

                return redirect()->intended('/home');

         

            }else{

                $newUser = User::updateOrCreate(['email' => $user->email],[

                        'name' => $user->name,
                        'facebook_id'=> $user->id,
                        'email_verified_at'=> Carbon::now(),
                        'password' => encrypt('123456dummy')

                    ]);

        

                Auth::login($newUser);

        

                return redirect()->intended('/home');

            }

       

        } catch (Exception $e) {

            dd($e->getMessage());

        }

    }
        
}
