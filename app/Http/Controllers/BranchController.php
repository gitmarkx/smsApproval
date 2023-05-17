<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        return view('branch.index', ['branches' => $branches]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'key' => ['required', 'min:3'],
        ]);
        $fields['description'] = $request->input('description');

        Branch::create($fields);
        return redirect('branch')->with('branch.created', $fields['key']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch, Request $request)
    {
        return view('branch.edit', ['branch' => $branch]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Branch $branch, Request $request)
    {
        $fields = $request->validate([
            'key' => ['required', 'min:3'],
        ]);
        $fields['description'] = $request->input('description');

        $branch->update($request->only('key', 'description'));
        return redirect('branch')->with('branch.updated', $fields['key']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
