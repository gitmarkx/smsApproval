<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticateSessionController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        // $cred = $request->only(['email', 'password'], ['status' => '1']);

        if(auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'status' => '1'])){
            $request->session()->regenerate();
            return redirect('/dashboard')->with('message', 'You have successfully logged in');
        }
        return back()->with('message', 'Invalid login credentials. Please try again.');
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
