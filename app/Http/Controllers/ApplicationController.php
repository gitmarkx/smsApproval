<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use App\Models\ApplicationImages;
use App\Models\Customer;
use App\Models\SearchIndex;
use App\Models\StatusLog;
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
        $folderName = strtoupper($request['lname']) . ',' . strtoupper($request['fname']) . '-' . $latestId . '-' . $request['customer_id'];
        $storage = 'documents/'.$folderName;

        foreach($request['imgSrc'] as $image){
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
                'status'                => 'New Entry',
            ]);
            
            $this->storeDocuments([
                'customer_id' => $request->customer_id,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'imgSrc' => $request->file('imgSrc')
            ]);
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
                'status'                => 'New Entry',
            ]);

            $this->storeDocuments([
                'customer_id' => $latestCustId,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'imgSrc' => $request->file('imgSrc')
            ]);
        }

        $latestAppId = Application::latest('id')->value('id');
        StatusLog::create([
            'app_id'     => $latestAppId,
            'status'     => 'New Entry',
            'user_id'    => auth()->user()->id,
        ]);
        
        return redirect(route('application'))->with('application.created', $request->fname. ' ' .$request->lname);
    }

    public function uploadDocs(Request $request){
        $this->validate($request, [
            'imgSrc'              => ['required'], //, 'mimes:jpeg,jpg,png', 'size:2000'
        ], [
            // 'imgSrc.mimes'        => 'The documents only accepts images "jpeg, jpg, png"',
            // 'imgSrc.size'         => 'lapas ra',
        ]);

        // Save customer documents to storage folder
        $folderName = strtoupper($request->input('name')) . '-' . $request->input('app_id') . '-' . $request->input('customer_id');
        $storage = 'documents/'.$folderName;
        foreach($request['imgSrc'] as $image){
            $path = $image->store($storage, 'public');
            $imgData = [
                'app_id' => $request->input('app_id'),
                'imgSrc' => $path
            ];
            ApplicationImages::create($imgData);
        }
        return back()->with('documents.uploaded', 'Additional documents have been uploaded!');
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
            'logs' => $app->statusLogs,
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
    public function update(Request $request, Application $app)
    {
        // Branch Users actions
        $clickEvent = $request->input('clickEvent');
        if($clickEvent == 'Cancel'){
            return $this->cancel($app);

        }
        else if($clickEvent == 'Delete'){
            return $this->destroy($app);
        }
        else if($clickEvent == 'Release'){
            return $this->release($app, $request);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $app)
    {
        // Get customer data
        $data = Application::find($app->id)->customer;
        $custName = $data->lname . ', ' . $data->fname;

        // Remove images from storage folder
        $appimg = ApplicationImages::get()->where('app_id', '=', $app->id);
        $decodeJSON = json_decode($appimg);
        $imgPath = reset($decodeJSON)->imgSrc;
        $folderName = explode('/', $imgPath)[1];
        Storage::disk('public')->deleteDirectory('documents/' . $folderName);

        // Remove applications data from table
        ApplicationImages::whereIn('app_id', [$app->id])->delete();
        Application::findOrFail($app->id)->delete();

        return redirect('application')->with('application.deleted', $custName . ' application has been deleted!');
    }

    public function cancel(Application $app){
        // Update application status
        $app->status = 'Cancel';
        $app->save();

        // Insert new data to status logs
        StatusLog::create([
            'app_id'  => $app->id,
            'status'  => 'Cancel',
            'user_id' => auth()->user()->id
        ]);

        // Get customer data
        $custName = $app->customer->lname . ', ' . $app->customer->fname;
        return redirect('application')->with('application.canceled', $custName . ' application has been canceled!');
    }

    public function release(Application $app, Request $request)
    {
        // Update application status
        $app->status = 'Release';
        $app->releasedUnit = $request->input('releasedUnit');
        $app->save();

        // Insert new data to status logs
        StatusLog::create([
            'app_id'  => $app->id,
            'status'  => 'Release',
            'user_id' => auth()->user()->id
        ]);

        // Get customer data
        $custName = $app->customer->lname . ', ' . $app->customer->fname;
        return redirect('application')->with('application.released', $custName . ' application has been released!');
    }
}
