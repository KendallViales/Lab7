<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{

    public function create() {
        return view('auth.register');
    }

    public function store(){

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::create($data);

        auth()->login($user);
        //Auth::login($user);

        return redirect('/tasks');
    }
}
