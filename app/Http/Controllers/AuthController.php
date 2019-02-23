<?php

namespace Nayourown\Http\Controllers;

use Illuminate\Http\Request;
use Nayourown\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Nayourown\User;
use Nayourown\Notifications\signupActivate;

class AuthController extends Controller
{
   /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] phone
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:7',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string|max:11|min:11|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'activation_token' => str_random(60)
        ]);

        // $user->notify(new SignupActivate($user));

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] username
     * @param  [string] password
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $http = new \GuzzleHttp\Client;

        try{
            $response = $http->post(config('services.passport.login_endpoint'),[
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password
                ]
            ]);
            return $response->getBody();

        }catch(\GuzzleHttp\Exception\BadResponseException $e){
            if($e->getCode() == 400){
                return response()->json('Invalid request. Please enter a username and a password',$e->getCode());
            }else if($e->getCode() == 401){
                return response()->json('Your credentials are incorrect. Please try again.',$e->getCode());
            }

            return response()->json('Something went wrong on the server',$e->getCode());

        }
    }

    public function signupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return $user;
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->each(function($token,$key){
            $token->delete();
        });
        return response()->json('Logged out successfully.',200);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

}
