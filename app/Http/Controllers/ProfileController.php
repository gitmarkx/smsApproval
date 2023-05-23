<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function profile(){
        return view('profile.index');
    }

    public function updateProfile(Request $request, User $user){
        $this->validate($request, [
            'name' => ['required', 'max:255'],
            // 'email' => ['email', 'max:255', Rule::unique(User::class)->ignore(auth()->user()->id)]
        ]);
        $user->update($request->only(['name']));
        return back()->with('profile-updated', 'profile-updated');
    }
}
