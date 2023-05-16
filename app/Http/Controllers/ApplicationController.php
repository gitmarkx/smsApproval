<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use App\Models\Customer;
use App\Models\SearchIndex;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = User::find(2);
        // $applications = $user->applications;
        $applications = Application::with(['users', 'branches', 'customers'])->paginate(2);
        return view('application.application', ['applications' => $applications]);
        // return $applications;
    }

    // public function search($term){
    //     $results = Application::search($term)->get();
    //     return $results;
    // }

    public function searchCustomer($term){
        return ['customers' => Customer::search($term)->get()];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('application.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'applicationType'     => 'required',
            'customer_id'         => 'required',
            'fname'               => 'required',
            'lname'               => 'required',
            'contactNo'           => ['required', 'regex:/^[0-9]{11}$/'],
            'address'             => 'required',
            'salesAccount'        => 'required',
            'dealerSalesAccount'  => 'required',
            'imgSrc.*'            => ['required', 'image'],
        ]);

        if($request->input('applicationType')){
            // return dd($request->all());
            
        }else{
            return dd($request->all());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
