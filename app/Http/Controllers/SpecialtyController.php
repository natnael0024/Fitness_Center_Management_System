<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $specialties = Specialty::orderBy('name')->paginate(10);
            return view('pages.staff.specialty',compact('specialties'));
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(),'Error');
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
            $attributes = $request->validate([
                'name'=>'required',
                'description'=>'nullable'
            ]);
            Specialty::create($attributes);
            Toastr::success('saved','Success');
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(),'Failed');
        }
        return redirect()->back();
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
        try {
            $specialty = Specialty::findOrFail($id);
            $attributes = $request->validate([
                'name'=>'required',
                'description'=>'nullable'
            ]);
            $specialty->update($attributes);
            $specialty->save();
            Toastr::success('updated','Success');
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(),'Failed');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
