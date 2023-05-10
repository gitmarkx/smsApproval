<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view('user.user', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create-user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'email' => ['email', 'max:255', Rule::unique('users', 'email')],
            'authorizationType' => 'required',
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        $fields['password'] = bcrypt($fields['password']);
        $fields['status'] = '1';
        User::create($fields);

        return redirect('user')->with('user.created', $fields['name']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit-user', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, Request $request)
    {
        $user->update($request->only('authorizationType', 'status'));
        return redirect('user')->with('user.updated', $user->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
