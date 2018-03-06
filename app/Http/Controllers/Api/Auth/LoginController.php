<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Route;

class LoginController extends Controller
{
    protected $rules = [
        'client_id'     => 'required',
        'client_secret' => 'required',
        'email'         => 'required|string|email|max:255',
        'password'      => 'required|string|min:8|max:255',
        'refresh_token' => 'required'
    ];

    
    public function login(Request $request){
        $rules = $this->rules;
        unset($rules['refresh_token']);

        $request->validate($rules);
        
        $request->request->add([
            'grant_type'    => 'password',
            'username'      => $request->email,
            'scope'         => '*'
        ]);
        $proxy = Request::create('oauth/token', 'POST');

        return Route::dispatch($proxy);
    }
    
    public function refresh(Request $request){
        $rules = $this->rules;
        unset($rules['email']);
        unset($rules['password']);

        $request->validate($rules);
        
        $request->request->add(['grant_type' => 'refresh_token', 'scope' => '*']);
        $proxy = Request::create('oauth/token', 'POST');
        
        return Route::dispatch($proxy);
    }
    
    public function logout(){
        $access_token = auth()->user()->token();

        DB::table('oauth_refresh_tokens')->where('access_token_id', $access_token->id)->update(['revoked' => true]);
        $access_token->revoke();
        
        return response()->json([], 204);
    }
}
