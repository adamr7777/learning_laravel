<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $req) {
        $incomingFields = $req-> validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        // var_dump($incomingFields);

        User::create($incomingFields);


        return 'you are registered';
    }

    public function login(Request $req) {
        $incomingFields = $req-> validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        $userLogin = auth()-> attempt([
            'username' => $incomingFields['loginusername'],
            'password' => $incomingFields['loginpassword'],
        ]);

        if($userLogin) {
            return 'you are logged in';
        } else {
            return 'login failled';
        };

    }
}
