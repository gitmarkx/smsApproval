<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    public function edit(Request $request, User $user){
        $fields = $request->validate([
            'current_password' => ['required', 'min:6', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed']
        ]);

        $user->update([
            'password' => bcrypt($fields['password']),
        ]);
        return back()->with('password-updated', 'password-updated');
    }
}
