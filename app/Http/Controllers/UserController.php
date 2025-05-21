<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $roleFilter = request()->input('roleFilter');
            $searchKey = request()->input('searchKey');

            
            // $users = User::query();
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->where('name', 'member');
            });
            if($roleFilter){
                $users->whereHas('roles',function($query) use ($roleFilter){
                    $query->where('name',$roleFilter);
                });
            }
            if ($searchKey) {
                $users->where(function ($query) use ($searchKey) {
                    $query->where('username', 'like', "%{$searchKey}%")
                          ->where('firstname', 'like', "%{$searchKey}%")
                          ->where('middlename', 'like', "%{$searchKey}%")
                          ->where('lastname', 'like', "%{$searchKey}%")
                          ->orWhere('email', 'like', "%{$searchKey}%");
                });
            }
            // $users = User::whereDoesntHave('roles', function ($query) {
            //     $query->where('name', 'member');
            // })->paginate(10);
            $users = $users->paginate(10);
            $roles = Role::all();
    
            return view('pages.user-management.users',compact('users','roles'));
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(), 'Error');
        }
    }

    public function getBranchManagers()
    {
        try {
            $users = User::whereHas('roles', function ($query) {
                $query->where('name', 'BranchManager');
            })->paginate(10);
            $roles = Role::all();
    
            return view('pages.user-management.users',compact('users','roles'));
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(), 'Error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        try {
            $attributes = request()->validate([
                'username' => 'required|max:255|min:2',
                'firstname' => 'required|max:255|min:2',
                'middlename' => 'required|max:255|min:2',
                'lastname' => 'required|max:255|min:2',
                'email' => 'required|email|max:255|unique:users,email',
                'role' => 'required'
            ]);

            // dd(request()->request);
    
            $attributes['password'] = '123456';
            $user = User::create($attributes);
            $user->syncRoles($attributes['role']);
            Toastr::success('User Created Successfully', 'Success');
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(), 'Error');
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
            $validated = $request->validate([
                'username' => 'nullable',
                'firstname' => 'nullable',
                'middlename' => 'nullable',
                'lastname' => 'nullable',
                'role' => 'nullable'
            ]);

            // dd($request->request);
    
            $user = User::findOrFail($id);
            $user->username = $validated['username'];
            $user->firstname = $validated['firstname'];
            $user->middlename = $validated['middlename'];
            $user->lastname = $validated['lastname'];
            $user->save();

            $user->syncRoles($request->input('role')); 
            Toastr::success('User Updated Successfully', 'Success');
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(), 'Error');
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
