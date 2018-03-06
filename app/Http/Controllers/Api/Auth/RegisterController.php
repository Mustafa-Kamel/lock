<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Route;

class RegisterController extends Controller
{
    protected $rules = [
        'client_id'     => 'required',
        'client_secret' => 'required',
        'firstname'     => 'required|string|min:3|max:255',
        'lastname'      => 'required|string|min:3|max:255',
        'email'         => 'required|string|email|max:255|unique:users,email',
        'password'      => 'required|string|min:8|max:255|confirmed',
        'avatar'        => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:4096'
    ];


    public function register(Request $request){
        $request->validate($this->rules);

        $imageName = Null;
        if($request->avatar){
            $imageName = time().'-'.$request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('img'), $imageName);
        }

        User::create([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'avatar'    => $imageName
        ]);

        $request->request->add([
            'grant_type'    => 'password',
            'username'      => $request->email,
            'scope'         => '*'
        ]);
        $proxy = Request::create('oauth/token', 'POST');

        return Route::dispatch($proxy);
    }
}
