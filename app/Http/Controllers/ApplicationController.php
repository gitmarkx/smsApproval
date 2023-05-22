<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use App\Models\ApplicationImages;
use App\Models\Customer;
use App\Models\SearchIndex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::with(['user', 'branch', 'customer'])->paginate(10);
        return view('application.index', ['applications' => $applications]);
    }

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

    private function storeDocuments($request){
        // Save customer documents to storage folder
        $latestId = Application::latest('id')->value('id');
        $folderName = uniqid() . '-' . $latestId . '-' .  $request['customer_id'];
        $storage = 'documents/'.$folderName;
        // Storage::makeDirectory($storage);

        foreach($request['imgSrc'] as $image){
            // $path = Storage::disk('local')->put($storage, $image);
            $path = $image->store($storage, 'public');
            $imgData = [
                'app_id' => $latestId,
                'imgSrc' => $path
            ];
            ApplicationImages::create($imgData);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'applicationType'     => 'required',
            'fname'               => 'required',
            'lname'               => 'required',
            'contactNo'           => ['required', 'regex:/^[0-9]{11}$/'],
            'address'             => 'required',
            'salesAccount'        => 'required',
            'dealerSalesAccount'  => 'required',
            'imgSrc'              => ['required'], //, 'mimes:jpeg,jpg,png', 'size:2000'
        ], [
            'fname.required'      => 'The firstname field is required.',
            'lname.required'      => 'The lastname field is required.',
            'contactNo.required'  => 'The contact number field is required.',
            'contactNo.regex'     => 'The contact number field format is invalid',
            'imgSrc.required'     => 'The documents files is required',
            // 'imgSrc.mimes'        => 'The documents only accepts images "jpeg, jpg, png"',
            // 'imgSrc.size'         => 'lapas ra',
           
        ]);

        if($request->input('applicationType')){
            Application::create([
                'customer_id'           => $request->customer_id,
                'user_id'               => auth()->user()->id,
                'branch_id'             => auth()->user()->branch_id,
                'salesAccount'          => $request->salesAccount,
                'transactionType'       => $request->applicationType,
                'dealerSalesAccount'    => $request->dealerSalesAccount,
                'desiredUnit'           => $request->desiredUnit,
                'bip'                   => $request->bip,
                'status'                => 'Pending',
            ]);
            
            $this->storeDocuments([
                'customer_id' => $request->customer_id,
                'imgSrc' => $request->file('imgSrc')
            ]);

            return redirect(route('application'))->with('application.created', $request->fname. ' ' .$request->lname);
        }else{
            Customer::create([
                'fname'     => $request->fname,
                'mname'     => $request->mname,
                'lname'     => $request->lname,
                'contactNo' => $request->contactNo,
                'address'   => $request->address,
            ]);
            $latestCustId = Customer::latest('id')->value('id');
            
            Application::create([
                'customer_id'           => $latestCustId,
                'user_id'               => auth()->user()->id,
                'branch_id'             => auth()->user()->branch_id,
                'salesAccount'          => $request->salesAccount,
                'transactionType'       => $request->applicationType,
                'dealerSalesAccount'    => $request->dealerSalesAccount,
                'desiredUnit'           => $request->desiredUnit,
                'bip'                   => $request->bip,
                'status'                => 'Pending',
            ]);

            $this->storeDocuments([
                'customer_id' => $latestCustId,
                'imgSrc' => $request->file('imgSrc')
            ]);

            return redirect(route('application'))->with('application.created', $request->fname. ' ' .$request->lname);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $app)
    {

        return view('application.view' ,[
            'application' => $app,
            'customer' => $app->customer,
            'branch' => $app->branch,
            'user' => $app->user,
            'images' => $app->applicationImages,
        ]);
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
