<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebAuthController extends Controller
{
    public function formLogin(){
        return view('web.auth.login');
    }

    public function login(Request $request){
        if(Auth::attempt(
            [
            'email' => $request->email,
            'password' => $request->password
            ]))
        {
            return redirect('/');
        }

        return redirect()->route('web.auth')->with('error', 'Failed!');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
