<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $branches = Branch::orderBy('name')->paginate(10);
            $branchManagers = User::whereHas('roles', function ($query) {
                $query->where('name', 'branchManager');
            })->get();
            return view('pages.branch.index',compact('branches','branchManagers'));
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'status' => 'boolean',
            ]);

            $branch = Branch::create($data);

            Toastr::success('Branch stored successfully','Success');
        } catch (\Exception $e) {
            Toastr::error($th->getMessage());
        }
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
