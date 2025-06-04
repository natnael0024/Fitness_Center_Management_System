<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Specialty;
use App\Models\Trainer;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $trainers = Trainer::paginate(10);
            $specialties = Specialty::orderBy('name')->get();
            $branches = Branch::orderBy('name')->get();

            return view('pages.staff.trainers',compact('trainers','specialties','branches'));

        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(),'Error');
        }
        return redirect()->back();
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
        // dd($request);
        try {
            $validated = $request->validate([
                'username'          => 'required|string|max:255',
                'email'         => 'required|email',
                'firstname'          => 'required|string|max:255',
                'middlename'          => 'required|string|max:255',
                'lastname'          => 'required|string|max:255',
                'branch_id'          => 'nullable|string|max:255',
                'specialties'   => 'array|exists:specialties,id',
            ]);
            $validated['password'] = '123456';
            DB::transaction(function () use ($validated) {
                $user = User::create([
                    'username'     => $validated['username'],
                    'firstname'     => $validated['firstname'],
                    'middlename'     => $validated['middlename'],
                    'lastname'     => $validated['lastname'],
                    'email'    => $validated['email'],
                    'password' => bcrypt($validated['password']),
                ]);
    
                $user->assignRole('Trainer');
    
                $trainer = Trainer::create([
                    'user_id' => $user->id,
                    'branch_id'     => $validated['branch_id'] ?? null,
                ]);
    
                if (!empty($validated['specialties'])) {
                    $trainer->specialties()->sync($validated['specialties']);
                }
            });
            Toastr::success('Successfully stored','Success');
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(),'Error');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Trainer $trainer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trainer $trainer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trainer $trainer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainer $trainer)
    {
        //
    }
}
